<?php
    $isEdit = $post->exists;
    $publishTimezone = config('app.timezone');
    $tagsText = old('tags_text', $isEdit && is_array($post->tags) ? implode(', ', $post->tags) : '');
    $pub = old('published_at', $isEdit && $post->published_at ? $post->published_at->timezone($publishTimezone)->format('Y-m-d\TH:i') : '');
?>
<form method="post" enctype="multipart/form-data" action="<?php echo e($isEdit ? route('admin.blog-posts.update', $post) : route('admin.blog-posts.store')); ?>" class="space-y-4 max-w-3xl">
    <?php echo csrf_field(); ?>
    <?php if($isEdit): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>
    <div>
        <label class="block text-sm font-medium text-stone-700">Title</label>
        <input type="text" name="title" value="<?php echo e(old('title', $post->title)); ?>" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Slug <span class="text-stone-400">(auto-generated from title)</span></label>
        <div class="flex gap-2 mt-1">
            <input type="text" name="slug" id="slugInput" value="<?php echo e(old('slug', $post->slug)); ?>" class="w-full rounded-lg border border-stone-300 px-3 py-2" placeholder="leave-blank-to-auto-generate">
            <button type="button" onclick="generateSlug()" class="shrink-0 rounded-lg bg-stone-100 hover:bg-stone-200 border border-stone-300 px-3 py-2 text-sm font-medium text-stone-600">Generate</button>
        </div>
        <?php if($isEdit && $post->slug): ?>
            <p class="text-xs text-stone-400 mt-1">Current URL: <code>/blog/<?php echo e($post->slug); ?></code></p>
        <?php endif; ?>
    </div>
    <script>
    document.querySelector('[name="title"]').addEventListener('input', function() {
        var slug = document.getElementById('slugInput');
        if (!slug.dataset.manual) slug.value = slugify(this.value);
    });
    document.getElementById('slugInput').addEventListener('input', function() {
        this.dataset.manual = this.value ? '1' : '';
    });
    function slugify(str) {
        return str.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/[\s]+/g, '-').replace(/-+/g, '-');
    }
    function generateSlug() {
        var title = document.querySelector('[name="title"]').value;
        document.getElementById('slugInput').value = slugify(title);
        document.getElementById('slugInput').dataset.manual = '1';
    }
    </script>
    <div>
        <label class="block text-sm font-medium text-stone-700">Excerpt</label>
        <textarea name="excerpt" rows="3" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2"><?php echo e(old('excerpt', $post->excerpt)); ?></textarea>
    </div>
    <div class="rounded-xl border border-stone-200 bg-stone-50 p-4 space-y-3">
        <h3 class="text-sm font-semibold text-stone-800">SEO Meta</h3>
        <div>
            <label class="block text-sm font-medium text-stone-700">Meta title</label>
            <input type="text" name="meta_title" value="<?php echo e(old('meta_title', $post->meta_title)); ?>" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2" placeholder="Leave blank to use post title">
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Meta description</label>
            <textarea name="meta_description" rows="3" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2" placeholder="Short SEO summary for search results"><?php echo e(old('meta_description', $post->meta_description)); ?></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-stone-700">Canonical URL</label>
            <input type="text" name="canonical_url" value="<?php echo e(old('canonical_url', $post->canonical_url)); ?>" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2" placeholder="/blog/your-post-slug">
        </div>
        <label class="flex items-center gap-2 text-sm text-stone-700">
            <input type="checkbox" name="is_index" value="1" <?php if(old('is_index', $post->is_index ?? true)): echo 'checked'; endif; ?>>
            Allow indexing (if off, page will output <code>noindex, nofollow</code>)
        </label>
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700 mb-1">Content
            <span class="text-xs text-stone-400 font-normal ml-1">— use toolbar to add images, links, headings</span>
        </label>
        <textarea name="content" id="blogContent" rows="16" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 font-mono text-sm"><?php echo e(old('content', $post->content)); ?></textarea>
    </div>

    <script src="https://cdn.tiny.cloud/1/zn3zc3nrox0v9ksh5xojbwphfwg62pskd6l3jqmzazuh0tg0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#blogContent',
        height: 600,
        menubar: 'file edit view insert format tools table',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'wordcount', 'emoticons',
            'codesample', 'quickbars', 'autosave'
        ],
        toolbar: [
            'undo redo',
            'blocks fontsize',
            'bold italic underline strikethrough',
            'forecolor backcolor',
            'alignleft aligncenter alignright alignjustify',
            'bullist numlist outdent indent',
            'link image media',
            'table codesample',
            'emoticons charmap',
            'removeformat',
            'fullscreen code',
            'restoredraft'
        ].join(' | '),
        toolbar_mode: 'sliding',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote; Preformatted=pre',
        font_size_formats: '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px',
        // Image upload — uses the media.public route so no symlink needed
        images_upload_url: '<?php echo e(route("admin.blog-posts.upload-image")); ?>',
        images_reuse_filename: true,
        automatic_uploads: true,
        file_picker_types: 'image media',
        images_upload_handler: function(blobInfo, progress) {
            return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo e(route("admin.blog-posts.upload-image")); ?>');
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
                xhr.upload.onprogress = function(e) {
                    progress(Math.round(e.loaded / e.total * 100));
                };
                xhr.onload = function() {
                    if (xhr.status !== 200) { reject({ message: 'Upload failed: ' + xhr.status, remove: true }); return; }
                    var json;
                    try { json = JSON.parse(xhr.responseText); } catch(e) { reject({ message: 'Invalid JSON', remove: true }); return; }
                    if (!json || !json.location) { reject({ message: 'No location in response', remove: true }); return; }
                    resolve(json.location);
                };
                xhr.onerror = function() { reject({ message: 'Network error', remove: true }); };
                var fd = new FormData();
                fd.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(fd);
            });
        },
        // Drag & drop images directly into editor
        paste_data_images: true,
        // Quick toolbar on image/text selection
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
        quickbars_image_toolbar: 'alignleft aligncenter alignright | rotateleft rotateright | imageoptions',
        // Image resize handles
        object_resizing: true,
        // Table defaults
        table_default_attributes: { border: '0' },
        table_default_styles: { 'border-collapse': 'collapse', 'width': '100%' },
        // Autosave
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: 'blog-post-{path}{query}-{id}-',
        autosave_restore_when_empty: true,
        // Code sample languages
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' },
            { text: 'PHP', value: 'php' },
            { text: 'Python', value: 'python' },
        ],
        content_style: [
            'body { font-family: "Be Vietnam Pro", sans-serif; font-size: 15px; color: #3a3526; line-height: 1.8; max-width: 860px; margin: 16px auto; padding: 0 16px; }',
            'h1,h2,h3,h4 { font-weight: 900; line-height: 1.3; }',
            'h2 { font-size: 1.5rem; }',
            'h3 { font-size: 1.2rem; color: #f27d99; }',
            'img { max-width: 100%; height: auto; border-radius: 8px; }',
            'table { border-collapse: collapse; width: 100%; }',
            'table td, table th { border: 1px solid #e2e8f0; padding: 8px 12px; }',
            'pre { background: #1e293b; color: #e2e8f0; padding: 16px; border-radius: 8px; overflow-x: auto; }',
            'blockquote { border-left: 4px solid #f27d99; margin: 0; padding: 8px 16px; background: #fff5f7; color: #7c3f52; font-style: italic; }',
        ].join(' '),
        setup: function(editor) {
            editor.on('change input', function() { editor.save(); });
        }
    });
    </script>
    <div>
        <label class="block text-sm font-medium text-stone-700">Featured image</label>
        <input type="file" name="featured_image" accept="image/*" class="mt-1 block w-full text-sm">
        <?php if($isEdit && $post->featured_image): ?>
            <p class="text-xs text-stone-500 mt-1">Current: <?php echo e($post->featured_image); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Category label</label>
        <input type="text" name="category" value="<?php echo e(old('category', $post->category)); ?>" required class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Tags (comma-separated)</label>
        <input type="text" name="tags_text" value="<?php echo e($tagsText); ?>" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Views</label>
        <input type="number" min="0" name="views" value="<?php echo e(old('views', $post->views ?? 0)); ?>" class="mt-1 w-32 rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700">Published at <span class="text-xs text-stone-400">(<?php echo e($publishTimezone); ?>)</span></label>
        <input type="datetime-local" name="published_at" value="<?php echo e($pub); ?>" class="mt-1 rounded-lg border border-stone-300 px-3 py-2">
    </div>
    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_published" value="1" <?php if(old('is_published', $post->is_published ?? true)): echo 'checked'; endif; ?>>
        Published
    </label>
    <div class="pt-4 flex flex-col gap-3 sm:flex-row">
        <button type="submit" class="rounded-lg bg-rose-500 hover:bg-rose-600 text-white font-semibold px-5 py-2"><?php echo e($isEdit ? 'Update' : 'Create'); ?></button>
        <a href="<?php echo e(route('admin.blog-posts.index')); ?>" class="rounded-lg border border-stone-300 px-5 py-2 text-stone-700 hover:bg-stone-50">Cancel</a>
    </div>
</form>

<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/admin/blog_posts/form.blade.php ENDPATH**/ ?>