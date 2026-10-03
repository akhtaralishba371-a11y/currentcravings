{{-- Expects: $product (App\Models\Product) --}}
@php
    $img = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png');
    $productCategorySlug = $product->category?->slug ?? request()->route('slug');
    $productUrl = $productCategorySlug
        ? route('menu.product', ['categorySlug' => $productCategorySlug, 'slug' => $product->slug])
        : route('menu.product.legacy', ['slug' => $product->slug]);
    $isReserveCategory = $productCategorySlug === 'tres-leches';
    $stockGuardRaw = strtolower(trim((string) \App\Models\SiteContent::get('stock_guard_enabled', '1')));
    $stockGuardEnabled = in_array($stockGuardRaw, ['1', 'true', 'yes', 'on'], true);
    $isOutOfStock = $stockGuardEnabled && !is_null($product->stock) && (int) $product->stock <= 0;
    $ctaLabel = $isOutOfStock ? 'Unavailable' : ($isReserveCategory ? 'Reserve' : 'Add to Cart');
@endphp

<article class="group relative bg-surface-container-lowest p-4 rounded-2xl editorial-shadow hover-scale-card border border-primary/10 flex flex-col h-full cursor-pointer">
    <a href="{{ $productUrl }}" class="absolute inset-0 z-10 rounded-2xl" aria-label="Open {{ $product->name }}"></a>

    <div class="relative z-0 rounded-xl overflow-hidden mb-4 h-52 block bg-surface-container-low">
        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $img }}" alt="{{ $product->name }}">
        @if($product->is_bestseller)
            <span class="absolute top-3 right-3 bg-primary text-on-primary text-xs font-bold px-3 py-1 rounded-full">Bestseller</span>
        @elseif($product->is_new)
            <span class="absolute top-3 right-3 bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full">New</span>
        @endif
    </div>

    <h3 class="relative z-0 font-headline text-xl font-bold mb-1 text-[#2a1a22]">{{ $product->name }}</h3>

    @if($product->short_description)
        <p class="relative z-0 text-on-surface-variant text-sm mb-4 flex-1">{{ \Illuminate\Support\Str::limit($product->short_description, 120) }}</p>
    @else
        <p class="relative z-0 text-on-surface-variant text-sm mb-4 flex-1">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 120) }}</p>
    @endif

    <div class="relative z-20 mt-auto flex items-center justify-between gap-3 pt-2 border-t border-primary/10">
        <div>
            <span class="text-2xl font-black text-primary">&pound;{{ number_format((float) $product->price, 2) }}</span>
            @if($product->compare_price && $product->compare_price > $product->price)
                <span class="text-sm text-on-surface-variant line-through ml-2">&pound;{{ number_format((float) $product->compare_price, 2) }}</span>
            @endif
        </div>

        <div class="flex items-center">
            <button
                type="button"
                class="shrink-0 inline-flex items-center justify-center rounded-full px-4 py-2 text-xs font-extrabold tracking-wide transition-colors {{ $isOutOfStock ? 'bg-zinc-300 text-zinc-600 cursor-not-allowed' : 'bg-primary text-white hover:bg-primary-dim' }}"
                data-add-to-cart="1"
                data-open-cart="1"
                data-product-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ number_format((float) $product->price, 2, '.', '') }}"
                data-category="{{ $productCategorySlug }}"
                data-image="{{ $img }}"
                @disabled($isOutOfStock)
                aria-disabled="{{ $isOutOfStock ? 'true' : 'false' }}">
                {{ $ctaLabel }}
            </button>
        </div>
    </div>
</article>
