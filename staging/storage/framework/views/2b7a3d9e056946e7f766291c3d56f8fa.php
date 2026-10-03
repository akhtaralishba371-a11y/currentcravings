
<?php $__env->startSection('title', 'SEO Meta Tags'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold">SEO Meta Tags</h1>
            <p class="text-sm text-stone-500 mt-1">Set meta title, description, canonical URL, and index/noindex for each page.</p>
        </div>
    </div>

    <form method="post" action="<?php echo e(route('admin.seo-meta.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="rounded-2xl border border-stone-200 bg-white overflow-x-auto">
            <table class="min-w-[720px] w-full text-sm">
                <thead class="bg-stone-50 border-b border-stone-200">
                    <tr class="text-left">
                        <th class="px-4 py-3 font-semibold text-stone-700">Page</th>
                        <th class="px-4 py-3 font-semibold text-stone-700">Meta Title</th>
                        <th class="px-4 py-3 font-semibold text-stone-700">Meta Description</th>
                        <th class="px-4 py-3 font-semibold text-stone-700">Canonical URL</th>
                        <th class="px-4 py-3 font-semibold text-stone-700">Index</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-200">
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-4 py-3 align-top">
                                <div class="font-semibold text-stone-800"><?php echo e($page['page_label']); ?></div>
                                <div class="text-xs text-stone-500 mt-1"><?php echo e($page['page_key']); ?></div>
                                <input type="hidden" name="rows[<?php echo e($i); ?>][page_key]" value="<?php echo e($page['page_key']); ?>">
                                <input type="hidden" name="rows[<?php echo e($i); ?>][page_label]" value="<?php echo e($page['page_label']); ?>">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="text" name="rows[<?php echo e($i); ?>][meta_title]" value="<?php echo e(old('rows.'.$i.'.meta_title', $page['meta_title'])); ?>" class="w-72 rounded-lg border border-stone-300 px-3 py-2">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <textarea name="rows[<?php echo e($i); ?>][meta_description]" rows="3" class="w-96 rounded-lg border border-stone-300 px-3 py-2"><?php echo e(old('rows.'.$i.'.meta_description', $page['meta_description'])); ?></textarea>
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="text" name="rows[<?php echo e($i); ?>][canonical_url]" value="<?php echo e(old('rows.'.$i.'.canonical_url', $page['canonical_url'])); ?>" class="w-80 rounded-lg border border-stone-300 px-3 py-2">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="hidden" name="rows[<?php echo e($i); ?>][is_index]" value="0">
                                <label class="inline-flex items-center gap-2 text-stone-700">
                                    <input type="checkbox" name="rows[<?php echo e($i); ?>][is_index]" value="1" <?php if(old('rows.'.$i.'.is_index', $page['is_index'])): echo 'checked'; endif; ?>>
                                    Index
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $customPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $row = count($pages) + $j;
                        ?>
                        <tr class="bg-amber-50/40">
                            <td class="px-4 py-3 align-top">
                                <div class="font-semibold text-stone-800"><?php echo e($page['page_label']); ?></div>
                                <div class="text-xs text-stone-500 mt-1"><?php echo e($page['page_key']); ?> (Custom)</div>
                                <input type="hidden" name="rows[<?php echo e($row); ?>][page_key]" value="<?php echo e($page['page_key']); ?>">
                                <input type="hidden" name="rows[<?php echo e($row); ?>][page_label]" value="<?php echo e($page['page_label']); ?>">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="text" name="rows[<?php echo e($row); ?>][meta_title]" value="<?php echo e(old('rows.'.$row.'.meta_title', $page['meta_title'])); ?>" class="w-72 rounded-lg border border-stone-300 px-3 py-2">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <textarea name="rows[<?php echo e($row); ?>][meta_description]" rows="3" class="w-96 rounded-lg border border-stone-300 px-3 py-2"><?php echo e(old('rows.'.$row.'.meta_description', $page['meta_description'])); ?></textarea>
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="text" name="rows[<?php echo e($row); ?>][canonical_url]" value="<?php echo e(old('rows.'.$row.'.canonical_url', $page['canonical_url'])); ?>" class="w-80 rounded-lg border border-stone-300 px-3 py-2">
                            </td>
                            <td class="px-4 py-3 align-top">
                                <input type="hidden" name="rows[<?php echo e($row); ?>][is_index]" value="0">
                                <label class="inline-flex items-center gap-2 text-stone-700">
                                    <input type="checkbox" name="rows[<?php echo e($row); ?>][is_index]" value="1" <?php if(old('rows.'.$row.'.is_index', $page['is_index'])): echo 'checked'; endif; ?>>
                                    Index
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="flex justify-start sm:justify-end">
            <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2.5">
                Save Meta Tags
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/seo-meta/index.blade.php ENDPATH**/ ?>