<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Orders</h1>
        <p class="text-slate-500 text-sm mt-0.5"><?php echo e($orders->total()); ?> total orders</p>
    </div>
    <a href="<?php echo e(route('admin.orders.export')); ?>" class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Export CSV
    </a>
</div>


<?php
$statuses = ['all'=>'All','pending'=>'Pending','confirmed'=>'Confirmed','preparing'=>'Preparing','out_for_delivery'=>'Out for Delivery','delivered'=>'Delivered','cancelled'=>'Cancelled'];
$activeStatus = request('status','all');
$tabColors = ['pending'=>'text-amber-700 border-amber-500','confirmed'=>'text-blue-700 border-blue-500','preparing'=>'text-purple-700 border-purple-500','out_for_delivery'=>'text-orange-700 border-orange-500','delivered'=>'text-emerald-700 border-emerald-500','cancelled'=>'text-red-700 border-red-500','all'=>'text-rose-700 border-rose-500'];
?>
<div class="flex flex-wrap gap-1 mb-5 bg-white rounded-xl border border-slate-200 shadow-sm p-2">
    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('admin.orders.index', array_merge(request()->except('page'), ['status' => $key === 'all' ? null : $key]))); ?>"
       class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors border
              <?php echo e($activeStatus === $key || ($key === 'all' && !request('status'))
                 ? ($tabColors[$key] ?? 'text-rose-700 border-rose-500').' bg-slate-50'
                 : 'text-slate-500 border-transparent hover:bg-slate-50'); ?>">
        <?php echo e($label); ?>

        <?php if(isset($statusCounts[$key])): ?><span class="ml-1 opacity-60">(<?php echo e($statusCounts[$key]); ?>)</span><?php endif; ?>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<form method="get" class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 mb-5 flex flex-wrap items-end gap-3">
    <?php if(request('status')): ?><input type="hidden" name="status" value="<?php echo e(request('status')); ?>"><?php endif; ?>
    <div class="flex-1 min-w-[200px]">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Search</label>
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Order #, customer name or email…"
               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
    </div>
    <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Payment</label>
        <select name="payment_status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
            <option value="">Any</option>
            <option value="paid" <?php if(request('payment_status')==='paid'): echo 'selected'; endif; ?>>Paid</option>
            <option value="unpaid" <?php if(request('payment_status')==='unpaid'): echo 'selected'; endif; ?>>Unpaid</option>
        </select>
    </div>
    <button type="submit" class="rounded-lg bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 text-sm font-semibold">Filter</button>
    <?php if(request()->hasAny(['search','payment_status'])): ?>
        <a href="<?php echo e(route('admin.orders.index', request()->only('status'))); ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">Clear</a>
    <?php endif; ?>
</form>


<form method="post" action="<?php echo e(route('admin.orders.bulk-status')); ?>" id="orderBulkForm">
    <?php echo csrf_field(); ?>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

        
        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center gap-3">
                <input type="checkbox" id="selectAllOrders" class="rounded border-slate-300 text-rose-600 focus:ring-rose-300">
                <label for="selectAllOrders" class="text-xs font-semibold text-slate-600">Select All</label>
                <span id="orderSelectedCount" class="text-xs text-slate-400 hidden"><span id="orderCountNum">0</span> selected</span>
            </div>
            <div class="flex items-center gap-2" id="orderBulkActions" style="display:none!important">
                <select name="new_status" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <option value="">Change Status To…</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="preparing">Preparing</option>
                    <option value="out_for_delivery">Out for Delivery</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button type="submit" onclick="return confirmOrderBulk()" class="rounded-lg bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 text-xs font-semibold">Apply</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-[800px] w-full text-sm">
                <thead class="bg-slate-50 text-left text-slate-600 border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 w-8"></th>
                    <th class="px-4 py-3 font-semibold">Order #</th>
                    <th class="px-4 py-3 font-semibold">Customer</th>
                    <th class="px-4 py-3 font-semibold">Total</th>
                    <th class="px-4 py-3 font-semibold">Payment</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Date</th>
                    <th class="px-4 py-3 font-semibold w-24">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3">
                        <input type="checkbox" name="ids[]" value="<?php echo e($order->id); ?>" class="order-checkbox rounded border-slate-300 text-rose-600 focus:ring-rose-300">
                    </td>
                    <td class="px-4 py-3 font-mono text-xs font-bold text-slate-700"><?php echo e($order->order_number); ?></td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-slate-800"><?php echo e($order->customer_name); ?></div>
                        <div class="text-xs text-slate-400"><?php echo e($order->customer_email); ?></div>
                    </td>
                    <td class="px-4 py-3 font-bold text-slate-800">£<?php echo e(number_format((float)$order->total, 2)); ?></td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-1 text-xs font-bold px-2 py-0.5 rounded-full
                            <?php echo e($order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600'); ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?php echo e($order->payment_status === 'paid' ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                            <?php echo e(ucfirst($order->payment_status ?? 'unpaid')); ?>

                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full <?php echo e($order->status_badge); ?>">
                            <?php echo e(ucfirst(str_replace('_',' ',$order->order_status))); ?>

                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-500 text-xs">
                        <div><?php echo e($order->created_at->format('M j, Y')); ?></div>
                        <div class="text-slate-400"><?php echo e($order->created_at->format('g:i A')); ?></div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-1.5">
                            <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                               class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                View
                            </a>
                            <a href="<?php echo e(route('admin.orders.edit', $order)); ?>"
                               class="inline-flex items-center gap-1 text-xs font-semibold text-slate-500 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 px-2.5 py-1.5 rounded-lg transition-colors">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="px-4 py-12 text-center text-slate-400">No orders found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<div class="mt-4"><?php echo e($orders->withQueryString()->links()); ?></div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const selectAllOrders = document.getElementById('selectAllOrders');
const orderCheckboxes = document.querySelectorAll('.order-checkbox');
const orderBulkActions = document.getElementById('orderBulkActions');
const orderSelectedCount = document.getElementById('orderSelectedCount');
const orderCountNum = document.getElementById('orderCountNum');

function updateOrderBulkUI() {
    const checked = document.querySelectorAll('.order-checkbox:checked').length;
    if (checked > 0) {
        orderBulkActions.style.removeProperty('display');
        orderSelectedCount.classList.remove('hidden');
        orderCountNum.textContent = checked;
    } else {
        orderBulkActions.style.setProperty('display','none','important');
        orderSelectedCount.classList.add('hidden');
    }
}

selectAllOrders.addEventListener('change', () => {
    orderCheckboxes.forEach(cb => cb.checked = selectAllOrders.checked);
    updateOrderBulkUI();
});
orderCheckboxes.forEach(cb => cb.addEventListener('change', updateOrderBulkUI));

function confirmOrderBulk() {
    const status = document.querySelector('[name="new_status"]').value;
    if (!status) { alert('Please select a status to apply.'); return false; }
    return confirm('Update status for all selected orders?');
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>