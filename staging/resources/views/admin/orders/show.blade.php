@extends('admin.layouts.app')
@section('title', 'Order '.$order->order_number)

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold font-mono">{{ $order->order_number }}</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.orders.edit', $order) }}" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">Edit</a>
            <a href="{{ route('admin.orders.index') }}" class="rounded-lg border border-stone-300 px-4 py-2 text-sm">Back</a>
        </div>
    </div>
    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <div class="bg-white rounded-xl border border-stone-200 p-6 space-y-3 text-sm">
            <h2 class="font-bold text-stone-900">Customer</h2>
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone ?? '—' }}</p>
            <p><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
            <p><strong>City / Postcode:</strong> {{ $order->city }}, {{ $order->postcode }}</p>
            <p><strong>Delivery slot:</strong> {{ $order->delivery_slot ?? '—' }}</p>
            @if($order->order_notes)
                <p><strong>Notes:</strong><br>{{ $order->order_notes }}</p>
            @endif
        </div>
        <div class="bg-white rounded-xl border border-stone-200 p-6 space-y-3 text-sm">
            <h2 class="font-bold text-stone-900">Payment</h2>
            <p><strong>Subtotal:</strong> £{{ number_format((float) $order->subtotal, 2) }}</p>
            <p><strong>Discount:</strong> £{{ number_format((float) $order->discount, 2) }}</p>
            <p><strong>Delivery:</strong> £{{ number_format((float) $order->delivery_fee, 2) }}</p>
            <p class="text-lg font-bold text-rose-600"><strong>Total:</strong> £{{ number_format((float) $order->total, 2) }}</p>
            <p><strong>Promo:</strong> {{ $order->promo_code ?? '—' }}</p>
            <p><strong>Payment method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Status:</strong> {{ $order->order_status }}</p>
        </div>
    </div>
    <div class="mt-8 bg-white rounded-xl border border-stone-200 overflow-x-auto">
        <h2 class="px-6 py-4 font-bold border-b border-stone-100">Line items</h2>
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-6 py-3 font-semibold">Product</th>
                <th class="px-6 py-3 font-semibold">Price</th>
                <th class="px-6 py-3 font-semibold">Qty</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            @forelse($order->items as $item)
                <tr>
                    <td class="px-6 py-3">{{ $item->product_name }}</td>
                    <td class="px-6 py-3">£{{ number_format((float) $item->price, 2) }}</td>
                    <td class="px-6 py-3">{{ $item->quantity }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-6 text-stone-500">No line items.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
