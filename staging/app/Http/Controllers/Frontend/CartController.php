<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        $summary = $this->summarizeCart($cart);

        return view('website.cart', $summary);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id'   => ['nullable', 'integer'],
            'name'         => ['nullable', 'string', 'max:255'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'category_slug'=> ['nullable', 'string', 'max:100'],
            'image'        => ['nullable', 'string', 'max:5000'],
            'quantity'     => ['nullable', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart();

        $productId = $data['product_id'] ?? null;
        $lookupName = $data['name'] ?? null;
        $lookupCategory = strtolower($data['category_slug'] ?? '');
        $image = $data['image'] ?? null;
        $stockGuardEnabled = $this->stockGuardEnabled();

        $product = null;
        if ($productId) {
            $product = Product::query()
                ->with('category')
                ->active()
                ->find($productId);
        } elseif ($lookupName) {
            $product = Product::query()
                ->with('category')
                ->active()
                ->where('name', $lookupName)
                ->when($lookupCategory, function ($query) use ($lookupCategory) {
                    $query->whereHas('category', function ($q) use ($lookupCategory) {
                        $q->where('slug', $lookupCategory);
                    });
                })
                ->first();
        }

        if ($product) {
            if ($this->isProductUnavailable($product, $stockGuardEnabled)) {
                return response()->json([
                    'success' => false,
                    'message' => 'This product is currently unavailable.',
                ], 422);
            }

            $productId = $product->id;
            $name = $product->name;
            $price = (float) $product->price;
            $categorySlug = strtolower($product->category?->slug ?? 'other');
            $image = $product->image ? route('media.public', ['path' => $product->image], false) : $image;
        } else {
            // If a real DB product exists but is inactive/out-of-stock, never allow fallback add.
            $hiddenProduct = null;
            if ($productId) {
                $hiddenProduct = Product::query()->with('category')->find($productId);
            } elseif ($lookupName) {
                $hiddenProduct = Product::query()
                    ->with('category')
                    ->where('name', $lookupName)
                    ->when($lookupCategory, function ($query) use ($lookupCategory) {
                        $query->whereHas('category', function ($q) use ($lookupCategory) {
                            $q->where('slug', $lookupCategory);
                        });
                    })
                    ->first();
            }

            if ($hiddenProduct && $this->isProductUnavailable($hiddenProduct, $stockGuardEnabled)) {
                return response()->json([
                    'success' => false,
                    'message' => 'This product is currently unavailable.',
                ], 422);
            }

            // Fallback: use request data directly (for hardcoded/static products)
            $priceRaw = $request->input('price');
            if (! $lookupName || ! $priceRaw) {
                return response()->json(['success' => false, 'message' => 'Invalid product.'], 422);
            }
            $productId = null;
            $name = $lookupName;
            $price = (float) $priceRaw;
            $categorySlug = $lookupCategory ?: 'other';
        }

        $key = $this->makeItemKey($productId, $name, $price, $categorySlug);
        $quantity = $this->enforceMinimumQty($categorySlug, (int) ($data['quantity'] ?? 1));

        if (isset($cart['items'][$key])) {
            $nextQty = $cart['items'][$key]['quantity'] + $quantity;
            $finalQty = $this->enforceMinimumQty($categorySlug, $nextQty);
            if ($stockGuardEnabled && $product && ! is_null($product->stock) && $finalQty > (int) $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested quantity is not available.',
                ], 422);
            }
            $cart['items'][$key]['quantity'] = $finalQty;
        } else {
            if ($stockGuardEnabled && $product && ! is_null($product->stock) && $quantity > (int) $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested quantity is not available.',
                ], 422);
            }

            $cart['items'][$key] = [
                'key' => $key,
                'product_id' => $productId,
                'name' => $name,
                'price' => (float) $price,
                'quantity' => $quantity,
                'category_slug' => $categorySlug,
                'image' => $image,
            ];
        }

        $this->saveCart($cart);
        $summary = $this->summarizeCart($cart);
        $itemPayload = $cart['items'][$key] ?? null;

        return response()->json([
            'success' => true,
            'message' => 'Added to cart!',
            'cart_count' => $summary['cartCount'],
            'cart_total' => $summary['cartTotalFormatted'],
            'cookies_count' => $summary['cookiesCount'],
            'brownies_count' => $summary['browniesCount'],
            'minimums_met' => $summary['minimumsMet'],
            'item' => $itemPayload,
        ]);
    }

    public function update(Request $request, $itemId)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart();
        $stockGuardEnabled = $this->stockGuardEnabled();
        if (isset($cart['items'][$itemId])) {
            $category = $cart['items'][$itemId]['category_slug'] ?? '';
            $productId = $cart['items'][$itemId]['product_id'] ?? null;

            if ($productId) {
                $product = Product::query()->find($productId);
                if (! $product || $this->isProductUnavailable($product, $stockGuardEnabled)) {
                    unset($cart['items'][$itemId]);
                    $this->saveCart($cart);
                    $summary = $this->summarizeCart($cart);

                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This product is currently unavailable.',
                            'cart_count' => $summary['cartCount'],
                            'cart_total' => $summary['cartTotalFormatted'],
                        ], 422);
                    }

                    return redirect()->route('cart.index')->with('error', 'This product is currently unavailable.');
                }

                $requestedQty = $this->enforceMinimumQty($category, (int) $data['quantity']);
                if ($stockGuardEnabled && ! is_null($product->stock) && $requestedQty > (int) $product->stock) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Requested quantity is not available.',
                        ], 422);
                    }

                    return redirect()->route('cart.index')->with('error', 'Requested quantity is not available.');
                }
            }

            $cart['items'][$itemId]['quantity'] = $this->enforceMinimumQty($category, (int) $data['quantity']);
            $this->saveCart($cart);
        }

        $summary = $this->summarizeCart($cart);
        $updatedQty = isset($cart['items'][$itemId]) ? (int) $cart['items'][$itemId]['quantity'] : (int) $data['quantity'];

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'cart_total' => $summary['cartTotalFormatted'],
                'item_total' => $summary['cartTotalFormatted'],
                'item_quantity' => $updatedQty,
                'cart_count' => $summary['cartCount'],
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function remove($itemId)
    {
        $cart = $this->getCart();
        if (isset($cart['items'][$itemId])) {
            unset($cart['items'][$itemId]);
            $this->saveCart($cart);
        }

        $summary = $this->summarizeCart($cart);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'cart_count' => $summary['cartCount'],
                'cart_total' => $summary['cartTotalFormatted'],
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function applyPromo(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        return response()->json(['success' => true, 'message' => 'Promo code applied!']);
    }

    private function getCart(): array
    {
        return session()->get('cart', ['items' => []]);
    }

    private function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    private function makeItemKey(?int $productId, string $name, float $price, string $categorySlug): string
    {
        if ($productId) {
            return 'p' . $productId;
        }

        $hash = substr(md5($name . '|' . $price . '|' . $categorySlug), 0, 12);
        return 'c-' . Str::slug($name) . '-' . $hash;
    }

    private function enforceMinimumQty(string $categorySlug, int $qty): int
    {
        $slug = strtolower($categorySlug);
        if (in_array($slug, ['cookies', 'brownies'], true)) {
            return max(4, $qty);
        }

        return max(1, $qty);
    }

    private function isProductUnavailable(Product $product, bool $stockGuardEnabled = true): bool
    {
        if (! (bool) $product->is_active) {
            return true;
        }

        if ($stockGuardEnabled && ! is_null($product->stock) && (int) $product->stock <= 0) {
            return true;
        }

        return false;
    }

    private function stockGuardEnabled(): bool
    {
        $raw = strtolower(trim((string) SiteContent::get('stock_guard_enabled', '1')));

        return in_array($raw, ['1', 'true', 'yes', 'on'], true);
    }

    private function summarizeCart(array $cart): array
    {
        $items = array_values($cart['items'] ?? []);
        $cartCount = 0;
        $cartTotal = 0.0;
        $cookiesCount = 0;
        $browniesCount = 0;

        foreach ($items as $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $price = (float) ($item['price'] ?? 0);
            $cartCount += $qty;
            $cartTotal += $price * $qty;

            $category = $item['category_slug'] ?? '';
            if ($category === 'cookies') {
                $cookiesCount += $qty;
            }
            if ($category === 'brownies') {
                $browniesCount += $qty;
            }
        }

        return [
            'items' => $items,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            'cartTotalFormatted' => '£' . number_format($cartTotal, 2),
            'cookiesCount' => $cookiesCount,
            'browniesCount' => $browniesCount,
            'minimumsMet' => $cookiesCount >= 4 && $browniesCount >= 4,
        ];
    }
}
