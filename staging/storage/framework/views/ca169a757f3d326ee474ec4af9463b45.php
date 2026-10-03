
<?php $__env->startSection('title', 'Testimonials'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Testimonials</h1>
        <a href="<?php echo e(route('admin.testimonials.create')); ?>" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">New testimonial</a>
    </div>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">Name</th>
                <th class="px-4 py-3 font-semibold">Rating</th>
                <th class="px-4 py-3 font-semibold">Approved</th>
                <th class="px-4 py-3 font-semibold">Featured</th>
                <th class="px-4 py-3 font-semibold w-40"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-stone-50">
                    <td class="px-4 py-3 font-medium"><?php echo e($t->name); ?></td>
                    <td class="px-4 py-3"><?php echo e($t->rating); ?></td>
                    <td class="px-4 py-3"><?php echo e($t->is_approved ? 'Yes' : 'No'); ?></td>
                    <td class="px-4 py-3"><?php echo e($t->is_featured ? 'Yes' : 'No'); ?></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="<?php echo e(route('admin.testimonials.edit', $t)); ?>" class="text-rose-600 hover:underline">Edit</a>
                        <form action="<?php echo e(route('admin.testimonials.destroy', $t)); ?>" method="post" class="inline" onsubmit="return confirm('Delete?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="px-4 py-8 text-center text-stone-500">No testimonials.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($testimonials->links()); ?></div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/testimonials/index.blade.php ENDPATH**/ ?>