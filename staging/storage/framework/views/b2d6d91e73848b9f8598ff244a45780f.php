<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Products</h1>
        <p class="text-slate-500 text-sm mt-0.5"><?php echo e($products->total()); ?> total products</p>
    </div>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Product
    </a>
</div>


<form method="get" class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 mb-5 flex flex-wrap items-end gap-3">
    <div class="flex-1 min-w-[180px]">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Search</label>
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Product name…"
               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
    </div>
    <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Category</label>
        <select name="category_id" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>" <?php if(request('category_id') == $c->id): echo 'selected'; endif; ?>><?php echo e($c->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div>
        <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
        <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
            <option value="">All</option>
            <option value="active" <?php if(request('status') === 'active'): echo 'selected'; endif; ?>>Active</option>
            <option value="inactive" <?php if(request('status') === 'inactive'): echo 'selected'; endif; ?>>Inactive</option>
        </select>
    </div>
    <button type="submit" class="rounded-lg bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 text-sm font-semibold">Filter</button>
    <?php if(request()->hasAny(['search','category_id','status'])): ?>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">Clear</a>
    <?php endif; ?>
</form>


<form method="post" action="<?php echo e(route('admin.products.bulk-action')); ?>" id="bulkForm">
    <?php echo csrf_field(); ?>
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

        
        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center gap-3">
                <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-rose-600 focus:ring-rose-300">
                <label for="selectAll" class="text-xs font-semibold text-slate-600">Select All</label>
                <span id="selectedCount" class="text-xs text-slate-400 hidden"><span id="countNum">0</span> selected</span>
            </div>
            <div class="flex items-center gap-2" id="bulkActions" style="display:none!important">
                <select name="bulk_action" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-rose-300">
                    <option value="">Bulk Action</option>
                    <option value="activate">Set Active</option>
                    <option value="deactivate">Set Inactive</option>
                    <option value="delete">Delete Selected</option>
                </select>
                <button type="submit" onclick="return confirmBulk()" class="rounded-lg bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 text-xs font-semibold">Apply</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-[800px] w-full text-sm">
                <thead class="bg-slate-50 text-left text-slate-600 border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 w-8"></th>
                    <th class="px-4 py-3 font-semibold w-16">Image</th>
                    <th class="px-4 py-3 font-semibold">Name</th>
                    <th class="px-4 py-3 font-semibold">Category</th>
                    <th class="px-4 py-3 font-semibold">Price</th>
                    <th class="px-4 py-3 font-semibold">Stock</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Badges</th>
                    <th class="px-4 py-3 font-semibold w-28">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3">
                        <input type="checkbox" name="ids[]" value="<?php echo e($product->id); ?>" class="row-checkbox rounded border-slate-300 text-rose-600 focus:ring-rose-300">
                    </td>
                    <td class="px-4 py-3">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(route('media.public', ['path' => $product->image], false)); ?>"
                                 class="w-12 h-12 rounded-lg object-cover border border-slate-200" alt="">
                        <?php else: ?>
                            <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 text-lg">🍪</div>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-slate-800"><?php echo e($product->name); ?></div>
                        <div class="text-xs text-slate-400 mt-0.5"><?php echo e($product->slug); ?></div>
                    </td>
                    <td class="px-4 py-3 text-slate-600"><?php echo e($product->category?->name ?? '—'); ?></td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-slate-800">£<?php echo e(number_format((float)$product->price, 2)); ?></div>
                        <?php if($product->compare_price && $product->compare_price > $product->price): ?>
                            <div class="text-xs text-slate-400 line-through">£<?php echo e(number_format((float)$product->compare_price, 2)); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <?php if($product->stock !== null): ?>
                            <span class="font-semibold <?php echo e($product->stock > 0 ? 'text-emerald-600' : 'text-red-500'); ?>"><?php echo e($product->stock); ?></span>
                        <?php else: ?>
                            <span class="text-slate-400">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3">
                        <form method="post" action="<?php echo e(route('admin.products.toggle-active', $product)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border transition-colors
                                <?php echo e($product->is_active ? 'bg-emerald-50 border-emerald-200 text-emerald-700 hover:bg-emerald-100' : 'bg-slate-100 border-slate-200 text-slate-500 hover:bg-slate-200'); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo e($product->is_active ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                                <?php echo e($product->is_active ? 'Active' : 'Inactive'); ?>

                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            <?php if($product->is_bestseller): ?><span class="text-[10px] font-bold bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded">Best</span><?php endif; ?>
                            <?php if($product->is_new): ?><span class="text-[10px] font-bold bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded">New</span><?php endif; ?>
                            <?php if($product->is_featured): ?><span class="text-[10px] font-bold bg-purple-100 text-purple-700 px-1.5 py-0.5 rounded">Featured</span><?php endif; ?>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('admin.products.edit', $product)); ?>"
                               class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="post" onsubmit="return confirm('Delete <?php echo e(addslashes($product->name)); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-slate-500 hover:text-red-600 bg-slate-100 hover:bg-red-50 px-2.5 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="9" class="px-4 py-12 text-center text-slate-400">No products found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<div class="mt-4"><?php echo e($products->withQueryString()->links()); ?></div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const selectAll = document.getElementById('selectAll');
const checkboxes = document.querySelectorAll('.row-checkbox');
const bulkActions = document.getElementById('bulkActions');
const selectedCount = document.getElementById('selectedCount');
const countNum = document.getElementById('countNum');

function updateBulkUI() {
    const checked = document.querySelectorAll('.row-checkbox:checked').length;
    if (checked > 0) {
        bulkActions.style.removeProperty('display');
        selectedCount.classList.remove('hidden');
        countNum.textContent = checked;
    } else {
        bulkActions.style.setProperty('display','none','important');
        selectedCount.classList.add('hidden');
    }
}

selectAll.addEventListener('change', () => {
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
    updateBulkUI();
});
checkboxes.forEach(cb => cb.addEventListener('change', updateBulkUI));

function confirmBulk() {
    const action = document.querySelector('[name="bulk_action"]').value;
    if (!action) { alert('Please select a bulk action.'); return false; }
    if (action === 'delete') return confirm('Delete all selected products? This cannot be undone.');
    return true;
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/products/index.blade.php ENDPATH**/ ?>