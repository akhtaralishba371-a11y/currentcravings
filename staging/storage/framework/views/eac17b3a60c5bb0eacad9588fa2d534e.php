
<?php $__env->startSection('title', 'Site Content'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold">Site Content</h1>
        <p class="text-sm text-stone-500 mt-1">Edit text and images shown on each page of the website.</p>
    </div>
    <a href="<?php echo e(route('home')); ?>" target="_blank" class="text-xs text-rose-500 hover:text-rose-700 font-semibold flex items-center gap-1">
        View Website ->
    </a>
</div>

<?php
$activeTab = old('_active_tab', request('tab', array_key_first($contents->toArray())));
$tabIcons = [
    'Home - Hero'       => 'HM',
    'Home - Hero Cards' => 'HC',
    'Home - Banner'     => 'HB',
    'Home - About'      => 'HA',
    'Menu Page'         => 'MN',
    'About Page'        => 'AB',
    'Contact Page'      => 'CT',
    'Checkout Page'     => 'CK',
    'Privacy Policy Page' => 'PP',
    'Terms of Service Page' => 'TS',
    'Refunds & Returns Page' => 'RF',
    'Allergen Info Page' => 'AL',
    'Delivery & Shipping Page' => 'DS',
    'General'           => 'GN',
];
?>

<div class="flex flex-col gap-6 items-start lg:flex-row">

    
    <aside class="w-full shrink-0 lg:w-56 lg:sticky lg:top-6">
        <nav class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-x-auto lg:overflow-hidden">
            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="?tab=<?php echo e(urlencode($section)); ?>"
               class="flex items-center gap-2 px-4 py-3 text-sm font-medium border-b border-stone-100 last:border-0 transition-colors whitespace-nowrap
                      <?php echo e($activeTab === $section ? 'bg-rose-50 text-rose-700 font-bold border-l-4 border-l-rose-500' : 'text-stone-600 hover:bg-stone-50'); ?>">
                <span><?php echo e($tabIcons[$section] ?? '*'); ?></span>
                <span><?php echo e($section); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
        <p class="text-xs text-stone-400 mt-3 px-1">Changes appear on the website immediately after saving.</p>
    </aside>

    
    <div class="flex-1 min-w-0">
        <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="<?php echo e($activeTab === $section ? 'block' : 'hidden'); ?>">

            <form method="POST" action="<?php echo e(route('admin.site-content.update')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="_active_tab" value="<?php echo e($section); ?>">

                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden mb-4">
                    <div class="flex items-center gap-3 bg-stone-50 border-b border-stone-200 px-6 py-4">
                        <span class="text-2xl"><?php echo e($tabIcons[$section] ?? '*'); ?></span>
                        <div>
                            <h2 class="font-bold text-stone-800"><?php echo e($section); ?></h2>
                            <p class="text-xs text-stone-400 mt-0.5">
                                <?php if($section === 'Home - Hero'): ?> Main hero area at the top of Home page.
                                <?php elseif($section === 'Home - Hero Cards'): ?> The 4 mini hero slider cards on Home page.
                                <?php elseif(str_contains($section,'Banner')): ?> The pink cookie banner section on the home page.
                                <?php elseif($section === 'Home - About'): ?> The "About Bakery Owner" section on the home page.
                                <?php elseif($section === 'Menu Page'): ?> Text shown at the top of the Menu page.
                                <?php elseif($section === 'About Page'): ?> Content shown on the dedicated About Us page.
                                <?php elseif($section === 'Contact Page'): ?> Contact details shown on the Contact page.
                                <?php elseif($section === 'Checkout Page'): ?> Text shown on the Checkout page.
                                <?php elseif($section === 'Privacy Policy Page'): ?> Content shown on the Privacy Policy page.
                                <?php elseif($section === 'Terms of Service Page'): ?> Content shown on the Terms of Service page.
                                <?php elseif($section === 'Refunds & Returns Page'): ?> Content shown on the Refunds & Returns page.
                                <?php elseif($section === 'Allergen Info Page'): ?> Content shown on the Allergen Info page.
                                <?php elseif($section === 'Delivery & Shipping Page'): ?> Content shown on the Delivery & Shipping page.
                                <?php else: ?> Site-wide settings like logo, tagline and social links.
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-b border-stone-100 pb-6 last:border-0 last:pb-0">
                            <label class="block text-sm font-bold text-stone-700 mb-1">
                                <?php echo e($item->label); ?>

                                <span class="ml-2 text-xs font-normal text-stone-400 bg-stone-100 px-2 py-0.5 rounded-full"><?php echo e($item->type); ?></span>
                            </label>

                            <?php if($item->type !== 'image'): ?>
                                <?php if(filled($item->value)): ?>
                                    <p class="text-xs text-stone-500 mb-2 flex items-start gap-1">
                                        <span class="shrink-0">Hint:</span>
                                        <span>Current value: <em>"<?php echo e(Str::limit($item->value, 120)); ?>"</em></span>
                                    </p>
                                <?php elseif(filled($item->placeholder)): ?>
                                    <p class="text-xs text-stone-400 mb-2 flex items-start gap-1">
                                        <span class="shrink-0">Hint:</span>
                                        <span>Default: <em>"<?php echo e(Str::limit($item->placeholder, 120)); ?>"</em></span>
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($item->type === 'image'): ?>
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start">
                                    <?php if($item->value): ?>
                                        <img src="<?php echo e(Str::startsWith($item->value,'http') ? $item->value : route('media.public', ['path' => $item->value], false)); ?>"
                                             class="h-24 w-24 rounded-xl border border-stone-200 object-cover shrink-0" alt="<?php echo e($item->label); ?>">
                                    <?php else: ?>
                                        <div class="h-24 w-24 rounded-xl border-2 border-dashed border-stone-200 flex items-center justify-center text-stone-300 text-xs shrink-0">No image</div>
                                    <?php endif; ?>
                                    <div class="flex-1">
                                        <input type="file" name="_file_<?php echo e($item->key); ?>" accept="image/*"
                                               class="block w-full text-sm text-stone-600 file:mr-3 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100">
                                        <p class="text-xs text-stone-400 mt-1">Upload a new image to replace the current one. Recommended: JPG or PNG.</p>
                                    </div>
                                </div>

                            <?php elseif($item->type === 'checkbox'): ?>
                                <label class="inline-flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="<?php echo e($item->key); ?>" value="1"
                                           <?php if(($item->value ?? $item->placeholder ?? '0') === '1'): echo 'checked'; endif; ?>
                                           class="h-4 w-4 rounded border-stone-300 text-rose-500 focus:ring-rose-300">
                                    <span class="text-sm text-stone-700">Enabled</span>
                                </label>
                                <?php if($item->key === 'stock_guard_enabled'): ?>
                                    <p class="text-xs text-stone-400 mt-1">Turn OFF to ignore stock-based out-of-stock checks site-wide.</p>
                                <?php elseif(str_ends_with($item->key, '_seo_index')): ?>
                                    <p class="text-xs text-stone-400 mt-1">Turn OFF to output <code>noindex, nofollow</code> meta for this page.</p>
                                <?php endif; ?>

                            <?php elseif($item->type === 'textarea'): ?>
                                <textarea name="<?php echo e($item->key); ?>" rows="3"
                                          placeholder="<?php echo e($item->placeholder); ?>"
                                          class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-400 resize-none"><?php echo e($item->value); ?></textarea>

                            <?php else: ?>
                                <input type="text" name="<?php echo e($item->key); ?>"
                                       value="<?php echo e($item->value); ?>"
                                       placeholder="<?php echo e($item->placeholder); ?>"
                                       class="w-full rounded-xl border border-stone-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300 focus:border-rose-400">
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <button type="submit" class="rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold px-6 py-2.5 text-sm transition-colors">
                        Save <?php echo e($section); ?>

                    </button>
                    <?php if(session('success') && old('_active_tab') === $section): ?>
                        <span class="text-sm text-emerald-600 font-semibold">Saved!</span>
                    <?php endif; ?>
                </div>
            </form>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/site-content/index.blade.php ENDPATH**/ ?>