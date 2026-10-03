<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.5;">
    <h2 style="margin-bottom: 8px;">New order received</h2>
    <p style="margin-top: 0;">
        Order <strong>{{ $order->order_number }}</strong> has been placed.
    </p>

    <p><strong>Customer:</strong> {{ $order->customer_name }} ({{ $order->customer_email }})</p>
    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Address:</strong> {{ $order->shipping_address }}, {{ $order->city }} {{ $order->postcode }}</p>
    @if ($order->delivery_slot)
        <p><strong>Delivery Slot:</strong> {{ $order->delivery_slot }}</p>
    @endif
    @if ($order->order_notes)
        <p><strong>Notes:</strong> {{ $order->order_notes }}</p>
    @endif

    <h3 style="margin-top: 24px;">Items</h3>
    <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #e5e7eb;">
        <thead style="background: #f9fafb;">
            <tr>
                <th align="left">Item</th>
                <th align="right">Qty</th>
                <th align="right">Price</th>
                <th align="right">Line Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td align="right">{{ (int) $item->quantity }}</td>
                    <td align="right">GBP {{ number_format((float) $item->price, 2) }}</td>
                    <td align="right">GBP {{ number_format((float) $item->price * (int) $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 16px;"><strong>Subtotal:</strong> GBP {{ number_format((float) $order->subtotal, 2) }}</p>
    <p><strong>Delivery:</strong> GBP {{ number_format((float) $order->delivery_fee, 2) }}</p>
    <p><strong>Total:</strong> GBP {{ number_format((float) $order->total, 2) }}</p>
    <p><strong>Payment Status:</strong> {{ ucfirst((string) $order->payment_status) }}</p>
    <p><strong>Order Status:</strong> {{ ucfirst(str_replace('_', ' ', (string) $order->order_status)) }}</p>
</body>
</html>
