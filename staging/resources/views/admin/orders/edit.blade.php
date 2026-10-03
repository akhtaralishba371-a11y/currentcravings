@extends('admin.layouts.app')
@section('title', 'Edit order')

@section('content')
    <h1 class="text-2xl font-bold">Edit order {{ $order->order_number }}</h1>
    <form method="post" action="{{ route('admin.orders.update', $order) }}" class="mt-8 space-y-4 max-w-3xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-stone-700">Order number</label>
            <input type="text" name="order_number" value="{{ old('order_number', $order->order_number) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 font-mono text-sm">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700">Customer name</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Email</label>
                <input type="email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Phone</label>
            <input type="text" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Shipping address</label>
            <textarea name="shipping_address" rows="3" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">{{ old('shipping_address', $order->shipping_address) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700">City</label>
                <input type="text" name="city" value="{{ old('city', $order->city) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Postcode</label>
                <input type="text" name="postcode" value="{{ old('postcode', $order->postcode) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Delivery slot</label>
            <input type="text" name="delivery_slot" value="{{ old('delivery_slot', $order->delivery_slot) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Order notes</label>
            <textarea name="order_notes" rows="2" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">{{ old('order_notes', $order->order_notes) }}</textarea>
        </div>
        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700">Subtotal (£)</label>
                <input type="number" step="0.01" min="0" name="subtotal" value="{{ old('subtotal', $order->subtotal) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Discount (£)</label>
                <input type="number" step="0.01" min="0" name="discount" value="{{ old('discount', $order->discount) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Delivery fee (£)</label>
                <input type="number" step="0.01" min="0" name="delivery_fee" value="{{ old('delivery_fee', $order->delivery_fee) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700">Total (£)</label>
                <input type="number" step="0.01" min="0" name="total" value="{{ old('total', $order->total) }}" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Promo code</label>
                <input type="text" name="promo_code" value="{{ old('promo_code', $order->promo_code) }}" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700">Payment method</label>
                <select name="payment_method" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
                    @foreach(['card' => 'Card', 'cash' => 'Cash', 'bank_transfer' => 'Bank transfer'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('payment_method', $order->payment_method) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700">Order status</label>
                <select name="order_status" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
                    @foreach(['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled'] as $st)
                        <option value="{{ $st }}" @selected(old('order_status', $order->order_status) === $st)>{{ str_replace('_', ' ', $st) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-col gap-3 pt-4 sm:flex-row">
            <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2">Save</button>
            <a href="{{ route('admin.orders.show', $order) }}" class="rounded-lg border border-stone-300 px-5 py-2">Cancel</a>
        </div>
    </form>
@endsection
