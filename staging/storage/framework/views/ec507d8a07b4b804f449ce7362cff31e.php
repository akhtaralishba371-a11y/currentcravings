
<?php $__env->startSection('title', $category->name.' | Menu | Current Cravings'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root { --accent: #f27d99; --accent-soft: #fbb6c8; }
    body { background: #fffbff; color: #393832; }
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .gradient-headline {
        background: linear-gradient(135deg, #f27d99 0%, #e8627d 60%, #fcd47e 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hover-scale-card { transition: transform 0.4s ease, box-shadow 0.4s ease; }
    .hover-scale-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(242,125,153,0.15); }
    .editorial-shadow { box-shadow: 0 4px 24px rgba(58, 40, 50, 0.08); }
    .menu-hero-eyebrow { display: inline-block; padding-top: 20px; }
    .btn-arrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 999px;
        background: linear-gradient(135deg, #f27d99, #e8627d);
        color: #fff;
        text-decoration: none;
        font-family: 'Epilogue', sans-serif;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.04em;
        box-shadow: 0 6px 18px rgba(242,125,153,0.35);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .btn-arrow:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(242,125,153,0.45);
    }
    .btn-arrow .btn-arrow-icon {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.24);
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .btn-arrow .btn-arrow-icon .material-symbols-outlined {
        font-size: 16px !important;
        color: #fff;
        line-height: 1;
    }
    .btn-arrow:hover .btn-arrow-icon {
        background: rgba(255,255,255,0.36);
        transform: translateX(-1px);
    }
    main > section { width: 100%; margin-left: auto; margin-right: auto; margin-top: 0 !important; margin-bottom: 0 !important; padding-left: 10% !important; padding-right: 10% !important; }
    @media (max-width: 1024px){ main > section { padding-left: 8%; padding-right: 8%; } }
    @media (max-width: 640px){ main > section { padding-left: 4%; padding-right: 4%; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $slug = strtolower($category->slug ?? '');
    $heroMap = [
        'cookies' => [
            'eyebrow' => 'Signature Collection',
            'lead' => 'Our',
            'highlight' => 'Signature',
            'tail' => 'Cookies',
            'desc' => 'Handcrafted with premium chocolate and real butter. Baked fresh every morning.',
            'bg' => 'linear-gradient(135deg, #fff0f4 0%, #fffbff 45%, #f7f3e9 100%)',
        ],
        'brownies' => [
            'eyebrow' => 'Premium Belgian Chocolate',
            'lead' => 'Signature',
            'highlight' => 'Brownies',
            'tail' => '',
            'desc' => 'Rich, fudgy brownies handcrafted fresh daily using premium chocolate.',
            'bg' => 'linear-gradient(135deg, #fff4e8 0%, #fffbff 45%, #f7f3e9 100%)',
        ],
        'tres-leches' => [
            'eyebrow' => 'Made to Order',
            'lead' => 'Ultimate',
            'highlight' => 'Tres Leches',
            'tail' => '',
            'desc' => 'Soaked in three milks, each cake is a masterpiece of moisture and flavor.',
            'bg' => 'linear-gradient(135deg, #fff0f4 0%, #fff9ee 45%, #f7f3e9 100%)',
        ],
        'drinks' => [
            'eyebrow' => 'The Perfect Companion',
            'lead' => 'Our',
            'highlight' => 'Drinks',
            'tail' => '',
            'desc' => 'The perfect companion to your sweet treat.',
            'bg' => 'linear-gradient(135deg, #f1ffe2 0%, #fffbff 45%, #f7f3e9 100%)',
        ],
        'boxes' => [
            'eyebrow' => 'Curated With Love',
            'lead' => 'Our Cravings',
            'highlight' => 'Boxes',
            'tail' => '',
            'desc' => 'The perfect gift for yourself or someone special. Curated boxes of happiness, delivered fresh.',
            'bg' => 'linear-gradient(135deg, #f5ffe7 0%, #fffbff 45%, #f7f3e9 100%)',
        ],
    ];
    $hero = $heroMap[$slug] ?? [
        'eyebrow' => 'Menu',
        'lead' => 'Our',
        'highlight' => $category->name,
        'tail' => '',
        'desc' => $category->icon ?: 'Freshly handcrafted with care and quality ingredients.',
        'bg' => 'linear-gradient(135deg, #fff0f4 0%, #fffbff 50%, #f7f3e9 100%)',
    ];
?>
<div>
    <section class="px-8 pb-20 md:pb-24 lg:pb-28 page-hero-under-header" style="background: <?php echo e($hero['bg']); ?>;">
        <div class="max-w-6xl mx-auto text-center">
            <span class="menu-hero-eyebrow uppercase tracking-[0.3em] text-xs font-bold text-primary"><?php echo e($hero['eyebrow']); ?></span>
            <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
                <?php if($hero['lead']): ?>
                    <?php echo e($hero['lead']); ?>

                <?php endif; ?>
                <span class="gradient-headline"><?php echo e($hero['highlight']); ?></span>
                <?php if($hero['tail']): ?>
                    <?php echo e(' '.$hero['tail']); ?>

                <?php endif; ?>
            </h1>
            <p class="text-on-surface-variant text-lg md:text-xl max-w-2xl mx-auto mt-4">
                <?php echo e($hero['desc']); ?>

            </p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a class="btn-arrow" href="<?php echo e(route('menu.index')); ?>">
                    <span>Back to Full Menu</span>
                    <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span></span>
                </a>
                <a class="border-2 border-primary text-primary px-8 py-3 rounded-full font-bold hover:bg-primary hover:text-white transition-colors" href="<?php echo e(route('cart.index')); ?>">Start an Order</a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4">
            <?php if($products->isEmpty()): ?>
                <p class="text-center text-on-surface-variant py-16">
                    No products in this category yet. Add items in <strong>Admin → Menu → Products</strong>.
                </p>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('website.partials.cms-product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/menu-category.blade.php ENDPATH**/ ?>