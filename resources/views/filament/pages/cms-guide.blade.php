<x-filament-panels::page>
    <div class="prose prose-sm dark:prose-invert max-w-none space-y-10">
        <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mt-0 text-lg font-semibold text-gray-900 dark:text-white">Menu (products &amp; categories)</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Under <strong>Menu</strong>, manage <strong>Categories</strong> first, then <strong>Products</strong>. Match each product's category slug to the URL you want
                (for example <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">cookies</code>) so the public menu page
                <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">/{slug}</code> loads your CMS items when that category exists in the database.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                Upload images under <strong>Products</strong>; they are stored in <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">storage/app/public</code>.
                Run <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">php artisan storage:link</code> if thumbnails do not show on the site.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                To sync existing hardcoded menu items into CMS tables without re-adding manually, run
                <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">php artisan products:sync-hardcoded</code>.
            </p>
        </section>

        <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mt-0 text-lg font-semibold text-gray-900 dark:text-white">Content (blog &amp; testimonials)</h2>
            <p class="text-gray-600 dark:text-gray-400">
                <strong>Blog posts</strong> appear on <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">/blog</code> and each post at
                <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">/blog/{slug}</code>. Use <strong>Published</strong> and <strong>Published at</strong> to control visibility.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                <strong>Testimonials</strong> are managed here for use on marketing pages; wire them in Blade when you are ready to show them on the homepage or about page.
            </p>
        </section>

        <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mt-0 text-lg font-semibold text-gray-900 dark:text-white">Inbox &amp; orders</h2>
            <p class="text-gray-600 dark:text-gray-400">
                <strong>Contact messages</strong> are created when visitors submit the contact form. Mark them as read as you reply.
            </p>
            <p class="text-gray-600 dark:text-gray-400">
                <strong>Orders</strong> list checkout records; line items are shown read-only on each order. New orders are not created from the admin panel.
            </p>
        </section>

        <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mt-0 text-lg font-semibold text-gray-900 dark:text-white">Public URLs</h2>
            <ul class="list-disc pl-5 text-gray-600 dark:text-gray-400">
                <li><strong>Product detail:</strong> <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">{{ url('/') }}/{category-slug}/{product-slug}</code></li>
                <li><strong>Category (CMS):</strong> <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">{{ url('/') }}/{category-slug}</code> when the category exists in the database</li>
                <li><strong>Blog:</strong> <code class="rounded bg-gray-100 px-1 py-0.5 text-xs dark:bg-gray-800">{{ url('/blog') }}</code></li>
            </ul>
        </section>

        <section class="rounded-xl border border-amber-200 bg-amber-50 p-6 dark:border-amber-900/50 dark:bg-amber-950/30">
            <h2 class="mt-0 text-lg font-semibold text-amber-900 dark:text-amber-100">Blade view files</h2>
            <p class="text-amber-900/90 dark:text-amber-100/90">
                Storefront templates for CMS output live under <code class="rounded bg-amber-100 px-1 py-0.5 text-xs dark:bg-amber-900">resources/views/website/</code>:
                <code class="rounded bg-amber-100 px-1 py-0.5 text-xs dark:bg-amber-900">menu-category.blade.php</code>,
                <code class="rounded bg-amber-100 px-1 py-0.5 text-xs dark:bg-amber-900">product-show.blade.php</code>,
                <code class="rounded bg-amber-100 px-1 py-0.5 text-xs dark:bg-amber-900">blog-show.blade.php</code>, and partials in
                <code class="rounded bg-amber-100 px-1 py-0.5 text-xs dark:bg-amber-900">partials/</code>.
            </p>
        </section>
    </div>
</x-filament-panels::page>

