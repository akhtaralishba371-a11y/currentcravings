
<?php $__env->startSection('title', 'Blog posts'); ?>

<?php $__env->startSection('content'); ?>
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold">Blog posts</h1>
        <a href="<?php echo e(route('admin.blog-posts.create')); ?>" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold px-4 py-2">New post</a>
    </div>
    <div class="mt-6 bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto">
        <table class="min-w-[720px] w-full text-sm">
            <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3 font-semibold">Title</th>
                <th class="px-4 py-3 font-semibold">Category</th>
                <th class="px-4 py-3 font-semibold">Published</th>
                <th class="px-4 py-3 font-semibold w-40"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-stone-50">
                    <td class="px-4 py-3 font-medium"><?php echo e($post->title); ?></td>
                    <td class="px-4 py-3"><?php echo e($post->category); ?></td>
                    <td class="px-4 py-3"><?php echo e($post->is_published ? 'Yes' : 'No'); ?></td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="<?php echo e(route('admin.blog-posts.edit', $post)); ?>" class="text-rose-600 hover:underline">Edit</a>
                        <form action="<?php echo e(route('admin.blog-posts.destroy', $post)); ?>" method="post" class="inline" onsubmit="return confirm('Delete?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="px-4 py-8 text-center text-stone-500">No posts.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($posts->links()); ?></div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/blog_posts/index.blade.php ENDPATH**/ ?>