<?php
    $isEdit = $product->exists;
    $variantsJson = old('variants_json', $isEdit && $product->variants ? json_encode($product->variants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '{}');
    $ingredientsText = old('ingredients_text', $isEdit && is_array($product->ingredients) ? implode("\n", $product->ingredients) : '');
?>

<form method="post" enctype="multipart/form-data"
      action="<?php echo e($isEdit ? route('admin.products.update', $product) : route('admin.products.store')); ?>"
      class="space-y-6 max-w-4xl">
    <?php echo csrf_field(); ?>
    <?php if($isEdit): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 space-y-5">

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3">Product Info</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Product Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Slug <span class="text-slate-400 font-normal">(auto-generated if empty)</span></label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $product->slug)); ?>"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-rose-300">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Category <span class="text-rose-500">*</span></label>
                    <select name="category_id" required class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                        <option value="">— Select Category —</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->id); ?>" <?php if(old('category_id', $product->category_id) == $c->id): echo 'selected'; endif; ?>><?php echo e($c->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Short Description</label>
                    <textarea name="short_description" rows="2"
                              class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Full Description <span class="text-rose-500">*</span> <span class="text-slate-400 font-normal">(HTML allowed)</span></label>
                    <textarea name="description" id="productDescription" rows="7" required
                              class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-rose-300"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3">Pricing & Inventory</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Price (£) <span class="text-rose-500">*</span></label>
                        <input type="number" step="0.01" min="0" name="price" value="<?php echo e(old('price', $product->price)); ?>" required
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Compare at Price (£)</label>
                        <input type="number" step="0.01" min="0" name="compare_price" value="<?php echo e(old('compare_price', $product->compare_price)); ?>"
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Stock</label>
                        <input type="number" min="0" name="stock" value="<?php echo e(old('stock', $product->stock ?? 0)); ?>"
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Sort Order</label>
                        <input type="number" min="0" name="order" value="<?php echo e(old('order', $product->order ?? 0)); ?>"
                               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-4">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3">Ingredients & Variants</h3>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Ingredients <span class="text-slate-400 font-normal">(one per line)</span></label>
                    <textarea name="ingredients_text" rows="4"
                              class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-300"><?php echo e($ingredientsText); ?></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Variants <span class="text-slate-400 font-normal">(JSON)</span></label>
                    <textarea name="variants_json" rows="4"
                              class="w-full rounded-lg border border-slate-300 px-3 py-2 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-rose-300"><?php echo e($variantsJson); ?></textarea>
                </div>
            </div>
        </div>

        
        <div class="space-y-5">

            
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3 mb-4">Main Image</h3>

                
                <div id="imgPreviewWrap" class="mb-3 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 aspect-square flex items-center justify-center">
                    <?php if($isEdit && $product->image): ?>
                        <img id="imgPreview" src="<?php echo e(route('media.public', ['path' => $product->image], false)); ?>"
                             class="w-full h-full object-cover" alt="">
                    <?php else: ?>
                        <div id="imgPlaceholder" class="flex flex-col items-center gap-2 text-slate-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-xs">No image</span>
                        </div>
                        <img id="imgPreview" class="w-full h-full object-cover hidden" alt="">
                    <?php endif; ?>
                </div>

                <label class="block w-full cursor-pointer rounded-lg border-2 border-dashed border-slate-300 hover:border-rose-400 px-4 py-3 text-center text-xs text-slate-500 hover:text-rose-500 transition-colors">
                    <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    Click to upload image
                    <input type="file" name="image" accept="image/*" class="hidden" id="mainImageInput">
                </label>
                <?php if($isEdit && $product->image): ?>
                    <p class="text-[10px] text-slate-400 mt-2 truncate"><?php echo e($product->image); ?></p>
                <?php endif; ?>
            </div>

            
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3 mb-4">Gallery Images</h3>
                <?php if($isEdit && is_array($product->gallery) && count($product->gallery)): ?>
                    <div class="grid grid-cols-3 gap-2 mb-3">
                        <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(route('media.public', ['path' => $g], false)); ?>" class="w-full aspect-square object-cover rounded-lg border border-slate-200" alt="">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <label class="block w-full cursor-pointer rounded-lg border-2 border-dashed border-slate-300 hover:border-rose-400 px-4 py-3 text-center text-xs text-slate-500 hover:text-rose-500 transition-colors">
                    <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    Add gallery images (multiple)
                    <input type="file" name="gallery[]" accept="image/*" multiple class="hidden">
                </label>
            </div>

            
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <h3 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3 mb-4">Status & Badges</h3>
                <div class="space-y-3">
                    <?php $__currentLoopData = [
                        ['name'=>'is_active',     'label'=>'Active',     'desc'=>'Visible on website',       'checked'=>old('is_active', $product->is_active ?? true)],
                        ['name'=>'is_featured',   'label'=>'Featured',   'desc'=>'Show in featured sections', 'checked'=>old('is_featured', $product->is_featured)],
                        ['name'=>'is_bestseller', 'label'=>'Bestseller', 'desc'=>'Show bestseller badge',     'checked'=>old('is_bestseller', $product->is_bestseller)],
                        ['name'=>'is_new',        'label'=>'New',        'desc'=>'Show new badge',            'checked'=>old('is_new', $product->is_new)],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toggle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <div class="relative mt-0.5">
                            <input type="checkbox" name="<?php echo e($toggle['name']); ?>" value="1" <?php if($toggle['checked']): echo 'checked'; endif; ?>
                                   class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 peer-checked:bg-rose-500 rounded-full transition-colors"></div>
                            <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-4"></div>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-slate-700"><?php echo e($toggle['label']); ?></div>
                            <div class="text-xs text-slate-400"><?php echo e($toggle['desc']); ?></div>
                        </div>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="flex flex-col sm:flex-row gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-semibold px-6 py-2.5 text-sm transition-colors">
            <?php echo e($isEdit ? 'Update Product' : 'Create Product'); ?>

        </button>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="rounded-lg border border-slate-300 px-6 py-2.5 text-sm text-slate-700 hover:bg-slate-50 text-center">Cancel</a>
    </div>
</form>

<script>
document.getElementById('mainImageInput')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('imgPlaceholder');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
});
</script>

<script src="https://cdn.tiny.cloud/1/zn3zc3nrox0v9ksh5xojbwphfwg62pskd6l3jqmzazuh0tg0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
if (typeof tinymce !== 'undefined' && document.getElementById('productDescription')) {
    tinymce.init({
        selector: '#productDescription',
        height: 420,
        menubar: 'file edit view insert format tools table',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'wordcount', 'emoticons',
            'codesample', 'quickbars'
        ],
        toolbar:
            'undo redo | blocks fontsize | bold italic underline strikethrough | forecolor backcolor | ' +
            'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
            'link image media | table codesample | emoticons charmap | removeformat | fullscreen code',
        toolbar_mode: 'sliding',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote; Preformatted=pre',
        font_size_formats: '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px',
        content_style: [
            'body { font-family: "Be Vietnam Pro", sans-serif; font-size: 15px; color: #3a3526; line-height: 1.8; }',
            'h1,h2,h3,h4 { font-weight: 900; line-height: 1.3; }',
            'h2 { font-size: 1.5rem; }',
            'h3 { font-size: 1.2rem; color: #f27d99; }',
            'img { max-width: 100%; height: auto; border-radius: 8px; }',
            'table { border-collapse: collapse; width: 100%; }',
            'table td, table th { border: 1px solid #e2e8f0; padding: 8px 12px; }',
            'blockquote { border-left: 4px solid #f27d99; margin: 0; padding: 8px 16px; background: #fff5f7; color: #7c3f52; font-style: italic; }'
        ].join(' '),
        setup: function (editor) {
            editor.on('change input', function () { editor.save(); });
        }
    });
}
</script>
<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/products/form.blade.php ENDPATH**/ ?>