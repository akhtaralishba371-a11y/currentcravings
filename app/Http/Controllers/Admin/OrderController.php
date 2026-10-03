<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::query()->latest('id');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('order_status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'like', "%$s%")
                  ->orWhere('customer_name', 'like', "%$s%")
                  ->orWhere('customer_email', 'like', "%$s%");
            });
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->paginate(20)->withQueryString();

        $statusCounts = Order::query()
            ->selectRaw('order_status, count(*) as cnt')
            ->groupBy('order_status')
            ->pluck('cnt', 'order_status')
            ->toArray();
        $statusCounts['all'] = array_sum($statusCounts);

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order): View
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'order_number'    => ['required', 'string', 'max:255', Rule::unique('orders','order_number')->ignore($order->id)],
            'customer_name'   => ['required', 'string', 'max:255'],
            'customer_email'  => ['required', 'email', 'max:255'],
            'customer_phone'  => ['nullable', 'string', 'max:50'],
            'shipping_address'=> ['required', 'string'],
            'city'            => ['required', 'string', 'max:255'],
            'postcode'        => ['required', 'string', 'max:20'],
            'delivery_slot'   => ['nullable', 'string', 'max:255'],
            'order_notes'     => ['nullable', 'string'],
            'subtotal'        => ['required', 'numeric', 'min:0'],
            'discount'        => ['nullable', 'numeric', 'min:0'],
            'delivery_fee'    => ['nullable', 'numeric', 'min:0'],
            'total'           => ['required', 'numeric', 'min:0'],
            'promo_code'      => ['nullable', 'string', 'max:100'],
            'payment_method'  => ['required', Rule::in(['card','cash','bank_transfer'])],
            'order_status'    => ['required', Rule::in(['pending','confirmed','preparing','out_for_delivery','delivered','cancelled'])],
        ]);
        $data['discount']     = (float) ($data['discount'] ?? 0);
        $data['delivery_fee'] = (float) ($data['delivery_fee'] ?? 0);
        $order->update($data);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated.');
    }

    public function bulkStatus(Request $request): RedirectResponse
    {
        $ids    = $request->input('ids', []);
        $status = $request->input('new_status');

        if (empty($ids) || ! $status) {
            return back()->with('error', 'Select orders and a status.');
        }

        Order::whereIn('id', $ids)->update(['order_status' => $status]);

        return back()->with('success', count($ids).' order(s) updated to '.str_replace('_',' ',$status).'.');
    }

    public function export(): Response
    {
        $orders = Order::query()->with('items')->latest()->get();

        $csv = "Order #,Customer,Email,Phone,Total,Payment,Status,Date\n";
        foreach ($orders as $o) {
            $csv .= implode(',', [
                $o->order_number,
                '"'.str_replace('"','""',$o->customer_name).'"',
                $o->customer_email,
                $o->customer_phone ?? '',
                $o->total,
                $o->payment_status ?? '',
                $o->order_status,
                $o->created_at->format('Y-m-d H:i'),
            ])."\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders-'.now()->format('Y-m-d').'.csv"',
        ]);
    }
}
