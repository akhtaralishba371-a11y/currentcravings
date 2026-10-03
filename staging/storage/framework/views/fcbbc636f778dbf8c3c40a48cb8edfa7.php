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
        Order <strong><?php echo e($order->order_number); ?></strong> has been placed.
    </p>

    <p><strong>Customer:</strong> <?php echo e($order->customer_name); ?> (<?php echo e($order->customer_email); ?>)</p>
    <p><strong>Phone:</strong> <?php echo e($order->customer_phone); ?></p>
    <p><strong>Address:</strong> <?php echo e($order->shipping_address); ?>, <?php echo e($order->city); ?> <?php echo e($order->postcode); ?></p>
    <?php if($order->delivery_slot): ?>
        <p><strong>Delivery Slot:</strong> <?php echo e($order->delivery_slot); ?></p>
    <?php endif; ?>
    <?php if($order->order_notes): ?>
        <p><strong>Notes:</strong> <?php echo e($order->order_notes); ?></p>
    <?php endif; ?>

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
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product_name); ?></td>
                    <td align="right"><?php echo e((int) $item->quantity); ?></td>
                    <td align="right">GBP <?php echo e(number_format((float) $item->price, 2)); ?></td>
                    <td align="right">GBP <?php echo e(number_format((float) $item->price * (int) $item->quantity, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p style="margin-top: 16px;"><strong>Subtotal:</strong> GBP <?php echo e(number_format((float) $order->subtotal, 2)); ?></p>
    <p><strong>Delivery:</strong> GBP <?php echo e(number_format((float) $order->delivery_fee, 2)); ?></p>
    <p><strong>Total:</strong> GBP <?php echo e(number_format((float) $order->total, 2)); ?></p>
    <p><strong>Payment Status:</strong> <?php echo e(ucfirst((string) $order->payment_status)); ?></p>
    <p><strong>Order Status:</strong> <?php echo e(ucfirst(str_replace('_', ' ', (string) $order->order_status))); ?></p>
</body>
</html>
<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/emails/orders/admin-new-order.blade.php ENDPATH**/ ?>