<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SeoMetaController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\AreaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public media fallback (works even when public/storage symlink is missing on shared hosting)
Route::get('/media/{path}', function (string $path) {
    $path = ltrim(str_replace('\\', '/', $path), '/');
    abort_if($path === '' || str_contains($path, '..'), 404);
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('media.public');

// Legacy image URLs support: /products/<filename>
Route::get('/products/{filename}', function (string $filename) {
    $filename = ltrim(str_replace('\\', '/', $filename), '/');
    abort_if($filename === '' || str_contains($filename, '..'), 404);

    $path = 'products/'.$filename;
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->file(Storage::disk('public')->path($path));
})->where('filename', '.*')->name('media.products.legacy');

// Menu
Route::prefix('menu')->name('menu.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [MenuController::class, 'category'])->name('category');
    Route::get('/product/{slug}', [MenuController::class, 'productLegacy'])->name('product.legacy');
    Route::get('/{categorySlug}/{slug}', [MenuController::class, 'productLegacyCategory'])->name('product.legacy.category');
    Route::get('/{slug}', [MenuController::class, 'showLegacy'])->name('show.legacy');
});

// Build Your Box
Route::get('/gift-a-box', function () {
    return view('website.boxes-build');
})->name('boxes.build');

// Legacy URL support
Route::redirect('/boxes/build', '/gift-a-box', 301);

Route::get('/{categorySlug}/{slug}', [MenuController::class, 'product'])
    ->where('categorySlug', 'cookies|brownies|tres-leches|drinks|boxes')
    ->name('menu.product');

Route::get('/{slug}', [MenuController::class, 'show'])
    ->where('slug', 'cookies|brownies|tres-leches|drinks|boxes')
    ->name('menu.show');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Privacy Policy
Route::get('/privacy-policy', fn() => view('website.privacy-policy'))->name('privacy-policy');

// Delivery & Shipping
Route::get('/delivery-and-shipping', fn() => view('website.delivery-shipping'))->name('delivery-shipping');

// Allergen Info
Route::get('/allergen-Information', fn() => view('website.allergen-info'))->name('allergen-info');

// Refunds & Returns
Route::get('/refund-policy', fn() => view('website.refunds-returns'))->name('refunds-returns');

// Terms of Service
Route::get('/terms-of-service', fn() => view('website.terms-of-service'))->name('terms-of-service');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Delivery Areas
Route::prefix('area')->name('area.')->group(function () {
    Route::get('/kettering', [AreaController::class, 'kettering'])->name('kettering');
    Route::get('/wellingborough', [AreaController::class, 'wellingborough'])->name('wellingborough');
    Route::get('/rushden', [AreaController::class, 'rushden'])->name('rushden');
    Route::get('/northampton', [AreaController::class, 'northampton'])->name('northampton');
    Route::get('/irthlingborough', [AreaController::class, 'irthlingborough'])->name('irthlingborough');
    Route::get('/corby', [AreaController::class, 'corby'])->name('corby');
    Route::get('/brackley', [AreaController::class, 'brackley'])->name('brackley');
});

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/{itemId}', [CartController::class, 'update'])->name('update');
    Route::delete('/{itemId}', [CartController::class, 'remove'])->name('remove');
    Route::post('/promo', [CartController::class, 'applyPromo'])->name('promo');
});

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
    Route::post('/webhook', [CheckoutController::class, 'webhook'])
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
        ->name('webhook');
});

// Admin auth (session)
Route::middleware('guest')->prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('blog-posts', BlogPostController::class);
    Route::post('blog-posts/upload-image', [BlogPostController::class, 'uploadImage'])->name('blog-posts.upload-image');
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contact-messages', ContactMessageController::class)->except(['create', 'store']);
    Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::post('orders/bulk-status', [OrderController::class, 'bulkStatus'])->name('orders.bulk-status');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'edit', 'update']);
    Route::post('products/bulk-action', [ProductController::class, 'bulkAction'])->name('products.bulk-action');
    Route::patch('products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggle-active');
    Route::get('site-content', [SiteContentController::class, 'index'])->name('site-content.index');
    Route::put('site-content', [SiteContentController::class, 'update'])->name('site-content.update');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
    Route::get('seo-meta', [SeoMetaController::class, 'index'])->name('seo-meta.index');
    Route::put('seo-meta', [SeoMetaController::class, 'update'])->name('seo-meta.update');
    // Media Library
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('media/folder', [MediaController::class, 'createFolder'])->name('media.folder.create');
    Route::delete('media/file', [MediaController::class, 'deleteFile'])->name('media.file.delete');
    Route::post('media/folder/delete', [MediaController::class, 'deleteFolder'])->name('media.folder.delete');
    Route::post('media/rename', [MediaController::class, 'renameFile'])->name('media.file.rename');
});
