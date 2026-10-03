
<?php $__env->startSection('title', 'New product'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-2xl font-bold">New product</h1>
    <div class="mt-6">
        <?php echo $__env->make('admin.products.form', ['product' => $product, 'categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/products/create.blade.php ENDPATH**/ ?>