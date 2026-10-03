<?php $__env->startSection('title', 'Your Cart | Current Cravings'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <section class="px-6 md:px-10 py-12 page-hero-under-header" style="background: linear-gradient(135deg, #fff0f4 0%, #fffbff 55%, #f7f3e9 100%);">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <div class="text-xs uppercase tracking-[0.25em] text-primary font-bold">Your Cart</div>
                    <h1 class="font-headline text-4xl md:text-5xl font-black tracking-tight mt-2">Sweet Summary</h1>
                    <p class="text-on-surface-variant mt-2">Review your items and proceed to checkout when ready.</p>
                </div>
                <a href="<?php echo e(route('menu.index')); ?>" class="inline-flex items-center gap-2 text-primary font-bold">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Back to Menu
                </a>
            </div>

            <?php if(session('error')): ?>
                <div class="mb-6 rounded-2xl border border-error/30 bg-[#fff2f2] px-5 py-4 text-error font-semibold">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-[1.6fr_1fr] gap-8">
                <div class="space-y-4">
                    <?php if(empty($items)): ?>
                        <div class="rounded-2xl border border-primary/10 bg-surface-container-lowest p-10 text-center">
                            <div class="text-4xl mb-3">Cupcake</div>
                            <p class="text-on-surface-variant">Your cart is empty.</p>
                            <a href="<?php echo e(route('menu.index')); ?>" class="mt-6 inline-flex items-center justify-center rounded-full bg-primary px-6 py-3 text-white font-bold">
                                Explore Menu
                            </a>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex flex-col sm:flex-row gap-4 rounded-2xl border border-primary/10 bg-surface-container-lowest p-4">
                                <div class="h-24 w-24 rounded-xl overflow-hidden bg-surface-container-low">
                                    <?php if(!empty($item['image'])): ?>
                                        <img class="h-full w-full object-cover" src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>">
                                    <?php else: ?>
                                        <div class="h-full w-full flex items-center justify-center text-on-surface-variant text-xs">No Image</div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h3 class="font-headline text-lg font-bold"><?php echo e($item['name']); ?></h3>
                                            <div class="text-xs uppercase tracking-widest text-on-surface-variant mt-1">
                                                <?php echo e($item['category_slug'] ?? 'other'); ?>

                                            </div>
                                        </div>
                                        <div class="font-bold text-primary text-lg">
                                            £<?php echo e(number_format((float) $item['price'], 2)); ?>

                                        </div>
                                    </div>
                                    <div class="mt-4 flex flex-wrap items-center gap-3">
                                        <?php
                                            $minQty = in_array(($item['category_slug'] ?? ''), ['cookies', 'brownies'], true) ? 4 : 1;
                                        ?>
                                        <form method="post" action="<?php echo e(route('cart.update', $item['key'])); ?>" class="flex items-center gap-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <label class="text-sm text-on-surface-variant" for="qty-<?php echo e($item['key']); ?>">Qty</label>
                                            <input id="qty-<?php echo e($item['key']); ?>" name="quantity" type="number" min="<?php echo e($minQty); ?>" value="<?php echo e($item['quantity']); ?>" class="w-20 rounded-lg border border-primary/20 px-3 py-1 text-sm">
                                            <button class="rounded-full bg-primary px-4 py-2 text-xs font-bold text-white">Update</button>
                                        </form>
                                        <form method="post" action="<?php echo e(route('cart.remove', $item['key'])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="rounded-full border border-primary/20 px-4 py-2 text-xs font-bold text-primary hover:bg-primary hover:text-white transition-colors">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="rounded-2xl border border-primary/10 bg-surface-container-lowest p-6 h-fit">
                    <h2 class="font-headline text-2xl font-black mb-4">Order Details</h2>
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-on-surface-variant">Items</span>
                        <span class="font-bold"><?php echo e($cartCount); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-on-surface-variant">Cookies</span>
                        <span class="font-bold"><?php echo e($cookiesCount); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-sm mb-4">
                        <span class="text-on-surface-variant">Brownies</span>
                        <span class="font-bold"><?php echo e($browniesCount); ?></span>
                    </div>
                    <div class="border-t border-primary/10 pt-4 flex items-center justify-between mb-6">
                        <span class="text-on-surface-variant">Subtotal</span>
                        <span class="font-headline text-xl font-black text-primary"><?php echo e($cartTotalFormatted); ?></span>
                    </div>

                    <div class="rounded-xl border border-primary/15 bg-surface-container-low p-4 text-sm mb-6">
                        <div class="font-bold text-on-surface mb-1">Minimum Order</div>
                        <div class="text-on-surface-variant">At least 4 cookies and 4 brownies.</div>
                        <div class="mt-2 font-semibold <?php echo e($minimumsMet ? 'text-secondary' : 'text-error'); ?>">
                            <?php echo e($minimumsMet ? 'Requirement met.' : 'Requirement not met yet.'); ?>

                        </div>
                    </div>

                    <a href="<?php echo e(route('checkout.index')); ?>"
                       class="block w-full text-center rounded-full px-6 py-3 font-bold <?php echo e($minimumsMet ? 'bg-primary text-white' : 'bg-surface-container text-on-surface-variant pointer-events-none'); ?>">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/cart.blade.php ENDPATH**/ ?>