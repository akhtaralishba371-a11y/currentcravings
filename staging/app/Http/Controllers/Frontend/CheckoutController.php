<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\NewOrderAdminMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Symfony\Component\HttpFoundation\Response;
use UnexpectedValueException;

class CheckoutController extends Controller
{
    private const NORTHAMPTONSHIRE_DELIVERY_FEE = 5.00;
    private const NATIONWIDE_DELIVERY_FEE = 5.00;
    private const DELIVERY_AREAS = [
        'Kettering',
        'Wellingborough',
        'Rushden',
        'Northampton',
        'Irthlingborough',
        'Corby',
        'Brackley',
    ];

    public function index()
    {
        $cms = SiteContent::allKeyed();
        $cart = session()->get('cart', ['items' => []]);
        if (session()->has('order_confirmed') && empty($cart['items'])) {
            $summary = $this->summarizeCart($cart);

            return view('website.checkout', array_merge($summary, [
                'deliveryAreas' => self::DELIVERY_AREAS,
                'cms' => $cms,
            ]));
        }

        $rehydrated = $this->rehydrateCartFromDatabase($cart);
        if (! $rehydrated['ok']) {
            return redirect()->route('cart.index')->with('error', $rehydrated['message']);
        }

        $cart = $rehydrated['cart'];
        session(['cart' => $cart]);

        $summary = $this->summarizeCart($cart);

        return view('website.checkout', array_merge($summary, [
            'deliveryAreas' => self::DELIVERY_AREAS,
            'cms' => $cms,
        ]));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9\\-\\+\\(\\)\\s]{7,20}$/'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'postcode' => ['required', 'string', 'max:30'],
            'delivery_date' => ['nullable', 'string', 'max:30'],
            'delivery_time' => ['nullable', 'string', 'max:80'],
            'delivery_slot' => ['nullable', 'string', 'max:80'],
            'order_notes' => ['nullable', 'string', 'max:500'],
        ]);

        if (! $this->hasStripeCredentials()) {
            return back()
                ->withInput()
                ->with('error', 'Stripe is not configured yet. Add your Stripe keys before taking payments.');
        }

        $cart = session()->get('cart', ['items' => []]);
        $rehydrated = $this->rehydrateCartFromDatabase($cart);
        if (! $rehydrated['ok']) {
            return redirect()->route('cart.index')->with('error', $rehydrated['message']);
        }

        $cart = $rehydrated['cart'];
        session(['cart' => $cart]);

        $summary = $this->summarizeCart($cart, $validated['city'] ?? null);
        if (empty($summary['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $customerName = trim($validated['name'] ?? ($validated['first_name'].' '.$validated['last_name']));

        $order = DB::transaction(function () use ($validated, $summary, $customerName) {
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $customerName,
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'shipping_address' => $validated['address'],
                'city' => $validated['city'],
                'postcode' => $validated['postcode'],
                'delivery_slot' => trim(($validated['delivery_date'] ?? '').' '.($validated['delivery_time'] ?? '')) ?: null,
                'order_notes' => $validated['order_notes'] ?? null,
                'subtotal' => $summary['subtotal'],
                'discount' => 0,
                'delivery_fee' => $summary['delivery_fee'],
                'total' => $summary['total'],
                'promo_code' => null,
                'payment_method' => 'card',
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
            ]);

            foreach ($summary['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['name'] ?? 'Item',
                    'price' => (float) ($item['price'] ?? 0),
                    'quantity' => (int) ($item['quantity'] ?? 1),
                    'variant' => $item['variant'] ?? null,
                ]);
            }

            return $order;
        });

        try {
            $session = $this->stripe()->checkout->sessions->create([
                'mode' => 'payment',
                'submit_type' => 'pay',
                'customer_email' => $order->customer_email,
                'client_reference_id' => (string) $order->id,
                'billing_address_collection' => 'auto',
                'line_items' => $this->buildStripeLineItems($summary),
                'metadata' => [
                    'order_id' => (string) $order->id,
                    'order_number' => $order->order_number,
                ],
                'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);
        } catch (ApiErrorException|\Throwable $exception) {
            Log::error('Stripe Checkout session could not be created.', [
                'order_id' => $order->id,
                'message' => $exception->getMessage(),
            ]);

            DB::transaction(function () use ($order) {
                $order->items()->delete();
                $order->delete();
            });

            return back()
                ->withInput()
                ->with('error', 'We could not start secure payment right now. Please try again.');
        }

        $order->forceFill([
            'stripe_checkout_session_id' => $session->id,
        ])->save();

        return redirect()->away($session->url);
    }

    public function success(Request $request): RedirectResponse
    {
        $sessionId = $request->string('session_id')->toString();
        if ($sessionId === '') {
            return redirect()->route('checkout.index')->with('info', 'Payment confirmation is still being checked.');
        }

        if (! $this->hasStripeCredentials()) {
            return redirect()->route('checkout.index')->with('error', 'Stripe is not configured yet.');
        }

        try {
            $session = $this->stripe()->checkout->sessions->retrieve($sessionId);
        } catch (ApiErrorException|\Throwable $exception) {
            Log::warning('Stripe Checkout session could not be retrieved.', [
                'session_id' => $sessionId,
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('checkout.index')->with('info', 'Payment confirmation is still being checked. Please refresh in a moment.');
        }

        $order = $this->resolveOrderFromStripeSession($session);
        if (! $order) {
            return redirect()->route('checkout.index')->with('error', 'We could not match this Stripe payment to an order.');
        }

        if (in_array($session->payment_status, ['paid', 'no_payment_required'], true)) {
            $this->finalizePaidOrder($order, $session);
            session()->forget('cart');

            return redirect()
                ->route('checkout.index')
                ->with('order_confirmed', [
                    'order_number' => $order->fresh()->order_number,
                    'customer_name' => $order->fresh()->customer_name,
                    'delivery_slot' => $order->fresh()->delivery_slot,
                    'total' => $order->fresh()->total,
                ]);
        }

        return redirect()->route('checkout.index')->with('info', 'Your payment is still processing. We will confirm your order shortly.');
    }

    public function cancel(): RedirectResponse
    {
        return redirect()
            ->route('checkout.index')
            ->with('error', 'Payment was cancelled. Your cart has been kept so you can try again.');
    }

    public function webhook(Request $request): Response
    {
        $webhookSecret = config('services.stripe.webhook_secret');
        if (! $webhookSecret) {
            Log::warning('Stripe webhook received without webhook secret configured.');

            return response('Webhook secret missing.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $payload = $request->getContent();
        $signature = (string) $request->header('Stripe-Signature');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $signature, $webhookSecret);
        } catch (UnexpectedValueException|SignatureVerificationException $exception) {
            Log::warning('Stripe webhook signature verification failed.', [
                'message' => $exception->getMessage(),
            ]);

            return response('Invalid payload.', Response::HTTP_BAD_REQUEST);
        }

        /** @var \Stripe\StripeObject $eventData */
        $eventData = $event->data->object;
        if (! $eventData instanceof StripeCheckoutSession) {
            return response('Event ignored.', Response::HTTP_OK);
        }

        $order = $this->resolveOrderFromStripeSession($eventData);
        if (! $order) {
            Log::warning('Stripe webhook could not find matching order.', [
                'event_type' => $event->type,
                'session_id' => $eventData->id ?? null,
            ]);

            return response('Order not found.', Response::HTTP_OK);
        }

        match ($event->type) {
            'checkout.session.completed' => in_array($eventData->payment_status, ['paid', 'no_payment_required'], true)
                ? $this->finalizePaidOrder($order, $eventData)
                : null,
            'checkout.session.async_payment_succeeded' => $this->finalizePaidOrder($order, $eventData),
            'checkout.session.async_payment_failed' => $this->markOrderPaymentState($order, 'failed', $eventData),
            'checkout.session.expired' => $this->markOrderPaymentState($order, 'expired', $eventData),
            default => null,
        };

        return response('Webhook received.', Response::HTTP_OK);
    }

    private function rehydrateCartFromDatabase(array $cart): array
    {
        $items = $cart['items'] ?? [];
        if (empty($items)) {
            return ['ok' => false, 'message' => 'Your cart is empty.'];
        }

        $updated = ['items' => []];
        foreach ($items as $key => $item) {
            $productId = $item['product_id'] ?? null;
            $name = $item['name'] ?? null;
            $category = $item['category_slug'] ?? null;

            $product = null;
            if ($productId) {
                $product = \App\Models\Product::query()->with('category')->active()->find($productId);
            } elseif ($name) {
                $product = \App\Models\Product::query()
                    ->with('category')->active()
                    ->where('name', $name)
                    ->when($category, fn ($query) => $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $category)))
                    ->first();
            }

            if ($product) {
                $itemKey = 'p'.$product->id;
                $updated['items'][$itemKey] = [
                    'key' => $itemKey,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'quantity' => (int) ($item['quantity'] ?? 1),
                    'category_slug' => $product->category?->slug ?? 'other',
                    'image' => $product->image ? route('media.public', ['path' => $product->image], false) : ($item['image'] ?? null),
                ];
            } else {
                $updated['items'][$key] = array_merge($item, [
                    'key' => $key,
                    'quantity' => (int) ($item['quantity'] ?? 1),
                    'price' => (float) ($item['price'] ?? 0),
                ]);
            }
        }

        return ['ok' => true, 'cart' => $updated];
    }

    private function summarizeCart(array $cart, ?string $city = null): array
    {
        $items = array_values($cart['items'] ?? []);
        $subtotal = 0.0;

        foreach ($items as $index => $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $price = (float) ($item['price'] ?? 0);
            $lineTotal = $price * $qty;
            $items[$index]['line_total'] = $lineTotal;
            $subtotal += $lineTotal;
        }

        $isLocal = $city && in_array(ucfirst(strtolower(trim($city))), self::DELIVERY_AREAS);
        $deliveryFee = count($items) > 0
            ? ($isLocal ? self::NORTHAMPTONSHIRE_DELIVERY_FEE : self::NATIONWIDE_DELIVERY_FEE)
            : 0.0;

        $total = $subtotal + $deliveryFee;

        return [
            'items'        => $items,
            'subtotal'     => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total'        => $total,
            'is_local'     => $isLocal,
        ];
    }

    private function sendOrderEmails(Order $order): void
    {
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
        } catch (\Throwable $exception) {
            Log::warning('Customer order confirmation email could not be sent.', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_email' => $order->customer_email,
                'message' => $exception->getMessage(),
            ]);

            report($exception);
        }

        $adminAddress = trim((string) config('mail.admin.address', ''));
        if (! filled($adminAddress)) {
            return;
        }

        if (! $this->isValidEmailAddress($adminAddress)) {
            Log::warning('Invalid admin email configured; skipping admin new order email.', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'configured_admin_address' => $adminAddress,
            ]);

            return;
        }

        try {
            Mail::to($adminAddress)->send(new NewOrderAdminMail($order));
        } catch (\Throwable $exception) {
            Log::warning('Admin new order email could not be sent.', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'admin_email' => $adminAddress,
                'message' => $exception->getMessage(),
            ]);

            report($exception);
        }
    }

    private function isValidEmailAddress(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function hasStripeCredentials(): bool
    {
        return filled(config('services.stripe.key')) && filled(config('services.stripe.secret'));
    }

    private function stripe(): StripeClient
    {
        return new StripeClient(config('services.stripe.secret'));
    }

    private function buildStripeLineItems(array $summary): array
    {
        $currency = strtolower((string) config('services.stripe.currency', 'gbp'));

        $lineItems = collect($summary['items'])
            ->map(function (array $item) use ($currency) {
                return [
                    'price_data' => [
                        'currency' => $currency,
                        'unit_amount' => $this->moneyToMinor((float) ($item['price'] ?? 0)),
                        'product_data' => [
                            'name' => $item['name'] ?? 'Item',
                        ],
                    ],
                    'quantity' => max(1, (int) ($item['quantity'] ?? 1)),
                ];
            })
            ->values()
            ->all();

        $deliveryFee = (float) ($summary['delivery_fee'] ?? 0);
        if ($deliveryFee > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $this->moneyToMinor($deliveryFee),
                    'product_data' => [
                        'name' => 'Delivery & Shipment',
                    ],
                ],
                'quantity' => 1,
            ];
        }

        return $lineItems;
    }

    private function moneyToMinor(float $amount): int
    {
        return (int) round($amount * 100);
    }

    private function resolveOrderFromStripeSession(StripeCheckoutSession $session): ?Order
    {
        $orderId = null;

        if (isset($session->metadata) && isset($session->metadata->order_id)) {
            $orderId = (int) $session->metadata->order_id;
        } elseif (! empty($session->client_reference_id)) {
            $orderId = (int) $session->client_reference_id;
        }

        if ($orderId > 0) {
            return Order::find($orderId);
        }

        return filled($session->id)
            ? Order::where('stripe_checkout_session_id', $session->id)->first()
            : null;
    }

    private function finalizePaidOrder(Order $order, StripeCheckoutSession $session): void
    {
        $paymentIntentId = $this->extractStripeId($session->payment_intent ?? null);
        $customerId = $this->extractStripeId($session->customer ?? null);

        $updates = array_filter([
            'stripe_checkout_session_id' => $session->id ?? null,
            'stripe_payment_intent_id' => $paymentIntentId,
            'stripe_customer_id' => $customerId,
        ], fn ($value) => filled($value));

        if ($order->payment_status === 'paid') {
            if (! empty($updates)) {
                $order->forceFill($updates)->save();
            }

            return;
        }

        $order->forceFill(array_merge($updates, [
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'paid_at' => $order->paid_at ?? now(),
        ]))->save();

        $order->loadMissing('items');
        $this->sendOrderEmails($order);
    }

    private function markOrderPaymentState(Order $order, string $paymentStatus, StripeCheckoutSession $session): void
    {
        if ($order->payment_status === 'paid') {
            return;
        }

        $order->forceFill(array_filter([
            'payment_method' => 'card',
            'payment_status' => $paymentStatus,
            'order_status' => in_array($paymentStatus, ['failed', 'expired'], true) ? 'cancelled' : $order->order_status,
            'stripe_checkout_session_id' => $session->id ?? null,
            'stripe_payment_intent_id' => $this->extractStripeId($session->payment_intent ?? null),
            'stripe_customer_id' => $this->extractStripeId($session->customer ?? null),
        ], fn ($value) => $value !== null))->save();
    }

    private function extractStripeId(mixed $value): ?string
    {
        if (is_string($value) && $value !== '') {
            return $value;
        }

        if (is_object($value) && isset($value->id) && is_string($value->id)) {
            return $value->id;
        }

        return null;
    }
}
