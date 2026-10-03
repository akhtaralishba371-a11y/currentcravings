@extends('layouts.app')
@section('title', $product->name.' | Current Cravings')

@push('styles')
<style>
/* ── Page Background ── */
.pd-page { background: linear-gradient(160deg,#fff0f4 0%,#fffbff 40%,#f7f3e9 100%); min-height: 100vh; }

/* ── Image Section ── */
.pd-main-img-wrap {
  position: relative; border-radius: 32px; overflow: hidden;
  background: #fff; aspect-ratio: 1/1;
  box-shadow: 0 32px 80px rgba(242,125,153,0.18), 0 0 0 1.5px rgba(242,125,153,0.14);
}
.pd-main-img-wrap img { width:100%; height:100%; object-fit:cover; transition: transform .7s cubic-bezier(.4,0,.2,1); }
.pd-main-img-wrap:hover img { transform: scale(1.05); }
.pd-badge-wrap { position:absolute; top:18px; left:18px; display:flex; flex-direction:column; gap:6px; }
.pd-badge { display:inline-flex; align-items:center; gap:5px; font-size:10px; font-weight:900; letter-spacing:.1em; text-transform:uppercase; padding:5px 13px; border-radius:999px; backdrop-filter:blur(8px); }
.pd-badge-best { background:linear-gradient(135deg,#f27d99,#e8627d); color:#fff; box-shadow:0 4px 16px rgba(242,125,153,.45); }
.pd-badge-new  { background:linear-gradient(135deg,#bef458,#97b931); color:#2a3a00; }
.pd-thumb-row { display:flex; gap:10px; margin-top:14px; overflow-x:auto; padding-bottom:2px; scrollbar-width:none; }
.pd-thumb-row::-webkit-scrollbar { display:none; }
.pd-thumb { width:76px; height:76px; border-radius:16px; object-fit:cover; cursor:pointer; border:2.5px solid transparent; transition:all .25s cubic-bezier(.34,1.56,.64,1); flex-shrink:0; }
.pd-thumb.active { border-color:#f27d99; box-shadow:0 6px 18px rgba(242,125,153,.35); transform:translateY(-3px); }
.pd-thumb:hover { border-color:#fbb6c8; transform:translateY(-2px); }

/* ── Info Panel ── */
.pd-info-card {
  background: #fff; border-radius: 28px;
  border: 1.5px solid rgba(242,125,153,0.12);
  box-shadow: 0 16px 48px rgba(242,125,153,0.08);
  padding: 36px;
}
.pd-cat-pill { display:inline-flex; align-items:center; gap:6px; font-size:10px; font-weight:900; letter-spacing:.14em; text-transform:uppercase; color:#f27d99; background:rgba(242,125,153,0.1); border:1px solid rgba(242,125,153,0.25); padding:5px 14px; border-radius:999px; text-decoration:none; margin-bottom:16px; transition:all .2s; }
.pd-cat-pill:hover { background:#f27d99; color:#fff; }
.pd-title { font-family:'Epilogue',sans-serif; font-size:clamp(1.9rem,3.5vw,2.8rem); font-weight:900; letter-spacing:-.03em; color:#2a1a22; line-height:1.05; margin:0 0 12px; }
.pd-short-desc { font-size:15px; line-height:1.85; color:#66645e; margin:0 0 24px; }
.pd-price-row { display:flex; align-items:center; gap:14px; flex-wrap:wrap; padding:20px 0; border-top:1.5px solid rgba(242,125,153,0.1); border-bottom:1.5px solid rgba(242,125,153,0.1); margin-bottom:24px; }
.pd-price { font-family:'Epilogue',sans-serif; font-size:2.8rem; font-weight:900; background:linear-gradient(135deg,#f27d99,#e8627d); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; line-height:1; }
.pd-compare { font-size:1.1rem; color:#bcb9b1; text-decoration:line-through; }
.pd-save { font-size:11px; font-weight:900; color:#4d6e00; background:#f0fce4; border:1px solid rgba(190,244,88,.5); padding:4px 12px; border-radius:999px; }

/* ── Features ── */
.pd-features { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:24px; }
.pd-feat { display:flex; align-items:center; gap:10px; background:#fdf9ef; border:1px solid rgba(242,125,153,0.12); border-radius:14px; padding:10px 14px; font-size:12px; font-weight:600; color:#66645e; }
.pd-feat .material-symbols-outlined { color:#f27d99; font-size:18px; flex-shrink:0; }

/* ── Qty & CTA ── */
.pd-actions { display:flex; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:16px; }
.pd-qty { display:flex; align-items:center; background:#f7f3e9; border:1.5px solid rgba(242,125,153,0.2); border-radius:999px; overflow:hidden; }
.pd-qty-btn { width:44px; height:44px; border:none; background:transparent; color:#f27d99; font-size:20px; font-weight:900; cursor:pointer; transition:background .2s; display:flex; align-items:center; justify-content:center; }
.pd-qty-btn:hover { background:rgba(242,125,153,0.15); }
.pd-qty-val { min-width:40px; text-align:center; font-family:'Epilogue',sans-serif; font-weight:900; font-size:1rem; color:#2a1a22; }
.pd-add-btn { display:inline-flex; align-items:center; gap:10px; background:linear-gradient(135deg,#f27d99,#e8627d); color:#fff; padding:14px 28px; border-radius:999px; font-family:'Epilogue',sans-serif; font-weight:900; font-size:.95rem; border:none; cursor:pointer; transition:all .35s cubic-bezier(.34,1.56,.64,1); box-shadow:0 8px 28px rgba(242,125,153,.35); position:relative; overflow:hidden; flex:1; justify-content:center; }
.pd-add-btn::before { content:''; position:absolute; inset:0; background:rgba(255,255,255,.18); transform:translateX(-110%) skewX(-12deg); transition:transform .5s ease; }
.pd-add-btn:hover::before { transform:translateX(110%) skewX(-12deg); }
.pd-add-btn:hover { transform:translateY(-3px); box-shadow:0 16px 40px rgba(242,125,153,.5); }
.pd-back-btn { display:inline-flex; align-items:center; gap:8px; border:2px solid rgba(242,125,153,.25); color:#f27d99; padding:12px 20px; border-radius:999px; font-family:'Epilogue',sans-serif; font-weight:800; font-size:.85rem; background:transparent; cursor:pointer; transition:all .25s; text-decoration:none; white-space:nowrap; }
.pd-back-btn:hover { background:#f27d99; color:#fff; border-color:#f27d99; }

/* ── Description ── */
.pd-desc-card { background:#fff; border-radius:24px; border:1.5px solid rgba(242,125,153,0.1); padding:32px; box-shadow:0 8px 32px rgba(242,125,153,0.06); }
.pd-section-title { font-family:'Epilogue',sans-serif; font-weight:900; font-size:1.1rem; color:#2a1a22; margin:0 0 16px; display:flex; align-items:center; gap:10px; }
.pd-section-title::before { content:''; display:block; width:4px; height:18px; background:linear-gradient(180deg,#f27d99,#fbb6c8); border-radius:4px; flex-shrink:0; }
.pd-desc-content { font-family:"Be Vietnam Pro",sans-serif; font-size:15px; line-height:1.8; color:#3a3526; }
.pd-desc-content h1,
.pd-desc-content h2,
.pd-desc-content h3,
.pd-desc-content h4 { font-family:"Epilogue",sans-serif; font-weight:900; line-height:1.3; margin:1.2em 0 .5em; color:#2a1a22; }
.pd-desc-content h1 { font-size:2rem; }
.pd-desc-content h2 { font-size:1.5rem; }
.pd-desc-content h3 { font-size:1.2rem; color:#f27d99; }
.pd-desc-content h4 { font-size:1rem; }
.pd-desc-content p { margin:0 0 1em; }
.pd-desc-content ul,
.pd-desc-content ol { margin:0 0 1em; padding-left:1.4rem; }
.pd-desc-content ul { list-style:disc; }
.pd-desc-content ol { list-style:decimal; }
.pd-desc-content li { margin:.3em 0; display:list-item; }
.pd-desc-content ul li::marker,
.pd-desc-content ol li::marker { color:#e8627d; font-weight:700; }
.pd-desc-content img { max-width:100%; height:auto; border-radius:8px; }
.pd-desc-content table { border-collapse:collapse; width:100%; margin:1em 0; }
.pd-desc-content table td,
.pd-desc-content table th { border:1px solid #e2e8f0; padding:8px 12px; }
.pd-desc-content blockquote { border-left:4px solid #f27d99; margin:1em 0; padding:8px 16px; background:#fff5f7; color:#7c3f52; font-style:italic; }

/* ── Ingredients ── */
.pd-ing-card { background:linear-gradient(135deg,#fff7fa,#fffbff); border:1.5px solid rgba(242,125,153,0.15); border-radius:24px; padding:28px; }
.pd-ing-tag { display:inline-flex; align-items:center; font-size:12px; font-weight:700; color:#66645e; background:#fff; border:1px solid rgba(242,125,153,0.2); border-radius:999px; padding:5px 14px; transition:all .2s; }
.pd-ing-tag:hover { background:#fde8ef; border-color:#f27d99; color:#e8627d; }

/* ── Related ── */
.pd-related-card { background:#fff; border-radius:22px; border:1.5px solid rgba(242,125,153,0.1); overflow:hidden; transition:all .4s cubic-bezier(.22,1,.36,1); text-decoration:none; display:block; }
.pd-related-card:hover { transform:translateY(-8px); box-shadow:0 24px 56px rgba(242,125,153,0.18); border-color:rgba(242,125,153,0.3); }
.pd-related-card .img-wrap { overflow:hidden; height:190px; }
.pd-related-card img { width:100%; height:100%; object-fit:cover; transition:transform .6s ease; }
.pd-related-card:hover img { transform:scale(1.08); }
.pd-related-card .info { padding:16px 18px; }
.pd-related-card .info-name { font-family:'Epilogue',sans-serif; font-weight:800; font-size:.95rem; color:#2a1a22; margin-bottom:6px; }
.pd-related-card .info-price { font-size:.9rem; font-weight:900; background:linear-gradient(135deg,#f27d99,#e8627d); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.pd-related-card .info-cta { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:800; color:#f27d99; margin-top:8px; }

/* ── Responsive ── */
@media(max-width:900px) {
  .pd-main-grid { grid-template-columns:1fr !important; }
  .pd-bottom-grid { grid-template-columns:1fr !important; }
  .pd-info-card { padding:24px; }
  .pd-features { grid-template-columns:1fr; }
}
@media(max-width:480px) {
  .pd-add-btn { padding:14px 20px; font-size:.85rem; }
}
</style>
@endpush

@section('content')
@php
  $mainImg   = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png');
  $gallery   = is_array($product->gallery) ? $product->gallery : [];
  $allImgs   = array_values(array_filter(array_merge([$product->image ?? null], $gallery)));
  $minQty    = in_array(strtolower($product->category?->slug ?? ''), ['cookies','brownies']) ? 4 : 1;
  $stockGuardRaw = strtolower(trim((string) \App\Models\SiteContent::get('stock_guard_enabled', '1')));
  $stockGuardEnabled = in_array($stockGuardRaw, ['1', 'true', 'yes', 'on'], true);

  $related = \App\Models\Product::active()
    ->where('id','!=',$product->id)
    ->when($product->category_id, fn($q) => $q->where('category_id',$product->category_id))
    ->with('category')->limit(4)->get();
@endphp

<div class="pd-page page-hero-under-header" style="padding:36px 0 72px;">
 <div style="max-width:1180px;margin:0 auto;padding:0 24px;">

  {{-- Breadcrumb --}}
  <nav style="font-size:12px;color:#9c9385;margin-bottom:28px;display:flex;align-items:center;gap:6px;flex-wrap:wrap; padding-top:20px;">
   <a href="{{ route('home') }}" style="color:#f27d99;font-weight:700;text-decoration:none;">Home</a>
   <span class="material-symbols-outlined" style="font-size:14px;color:#fbb6c8;">chevron_right</span>
   <a href="{{ route('menu.index') }}" style="color:#f27d99;font-weight:700;text-decoration:none;">Menu</a>
   @if($product->category)
    <span class="material-symbols-outlined" style="font-size:14px;color:#fbb6c8;">chevron_right</span>
    <a href="{{ route('menu.show',$product->category->slug) }}" style="color:#f27d99;font-weight:700;text-decoration:none;">{{ $product->category->name }}</a>
   @endif
   <span class="material-symbols-outlined" style="font-size:14px;color:#fbb6c8;">chevron_right</span>
   <span style="color:#3a3526;font-weight:600;">{{ $product->name }}</span>
  </nav>

  {{-- Main Grid --}}
  <div class="pd-main-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:52px;align-items:start;">

   {{-- LEFT: Image --}}
   <div>
    <div class="pd-main-img-wrap">
     <img src="{{ $mainImg }}" alt="{{ $product->name }}" id="pdMainImg">
     <div class="pd-badge-wrap">
      @if($product->is_bestseller)
       <span class="pd-badge pd-badge-best">⭐ Bestseller</span>
      @endif
      @if($product->is_new)
       <span class="pd-badge pd-badge-new">✨ New</span>
      @endif
      @if($product->is_featured)
       <span class="pd-badge" style="background:rgba(252,212,126,0.9);color:#7a4800;">🔥 Featured</span>
      @endif
     </div>
    </div>
    @if(count($allImgs) > 1)
     <div class="pd-thumb-row">
      @foreach($allImgs as $i => $img)
       <img src="{{ route('media.public', ['path' => $img], false) }}" alt="" class="pd-thumb {{ $i===0 ? 'active' : '' }}" onclick="pdSwitch(this,'{{ route('media.public', ['path' => $img], false) }}')">
      @endforeach
     </div>
    @endif

    {{-- Trust badges --}}
    <div style="display:flex;gap:10px;margin-top:20px;flex-wrap:wrap;">
     @foreach(['🌿 Halal','🚫 No Preservatives','🍞 Freshly Baked','📦 Careful Packaging'] as $b)
      <span style="font-size:11px;font-weight:700;color:#66645e;background:#f7f3e9;border:1px solid rgba(242,125,153,0.15);border-radius:999px;padding:5px 12px;">{{ $b }}</span>
     @endforeach
    </div>
   </div>

   {{-- RIGHT: Info --}}
   <div class="pd-info-card">

    @if($product->category)
     <a href="{{ route('menu.show',$product->category->slug) }}" class="pd-cat-pill">
      <span class="material-symbols-outlined" style="font-size:13px;">category</span>
      {{ $product->category->name }}
     </a>
    @endif

    <h1 class="pd-title">{{ $product->name }}</h1>

    @if($product->short_description)
     <p class="pd-short-desc">{{ $product->short_description }}</p>
    @endif

    {{-- Price --}}
    <div class="pd-price-row">
     <span class="pd-price">£{{ number_format((float)$product->price,2) }}</span>
     @if($product->compare_price && $product->compare_price > $product->price)
      <span class="pd-compare">£{{ number_format((float)$product->compare_price,2) }}</span>
      <span class="pd-save">Save {{ $product->discount_percentage }}%</span>
     @endif
    </div>

    {{-- Features --}}
    <div class="pd-features">
     <div class="pd-feat"><span class="material-symbols-outlined">verified</span>100% Halal</div>
     <div class="pd-feat"><span class="material-symbols-outlined">eco</span>Zero Preservatives</div>
     <div class="pd-feat"><span class="material-symbols-outlined">bakery_dining</span>Freshly Baked</div>
     <div class="pd-feat"><span class="material-symbols-outlined">schedule</span>Pre-order 1 day ahead</div>
    </div>

    @if($minQty > 1)
     <div style="background:#fff8e1;border:1px solid #fcd47e;border-radius:12px;padding:10px 14px;font-size:12px;color:#7a4800;font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
      <span class="material-symbols-outlined" style="font-size:16px;color:#e8a020;">info</span>
      Minimum order: {{ $minQty }} pieces
     </div>
    @endif

    {{-- Qty + Add to Cart --}}
    <div class="pd-actions">
     <div class="pd-qty">
      <button class="pd-qty-btn" onclick="pdQty(-1)" type="button">−</button>
      <span class="pd-qty-val" id="pdQtyVal">{{ $minQty }}</span>
      <button class="pd-qty-btn" onclick="pdQty(1)" type="button">+</button>
     </div>
     <button class="pd-add-btn"
      data-add-to-cart="1" data-open-cart="1"
      data-name="{{ $product->name }}"
      data-price="{{ $product->price }}"
      data-category="{{ $product->category?->slug ?? 'other' }}"
      data-image="{{ $mainImg }}"
      data-qty-target="pdQtyVal">
      <span class="material-symbols-outlined" style="font-size:20px;">shopping_bag</span>
      Add to Cart
     </button>
    </div>

    @if($product->category)
     <a href="{{ route('menu.show',$product->category->slug) }}" class="pd-back-btn">
      <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span>
      More {{ $product->category->name }}
     </a>
    @endif

    @if($stockGuardEnabled && $product->stock !== null)
     <p style="font-size:12px;color:#9c9385;margin-top:14px;display:flex;align-items:center;gap:6px;">
      @if($product->stock > 0)
       <span style="width:8px;height:8px;border-radius:50%;background:#4d6e00;display:inline-block;"></span>
       <span style="color:#4d6e00;font-weight:700;">In stock</span> — {{ $product->stock }} available
      @else
       <span style="width:8px;height:8px;border-radius:50%;background:#c0262d;display:inline-block;"></span>
       <span style="color:#c0262d;font-weight:700;">Out of stock</span> — check back soon
      @endif
     </p>
    @endif

   </div>
  </div>

  {{-- Description + Ingredients --}}
  @if($product->description || (is_array($product->ingredients) && count($product->ingredients)))
  <div class="pd-bottom-grid" style="display:grid;grid-template-columns:{{ (is_array($product->ingredients) && count($product->ingredients)) ? '1fr 320px' : '1fr' }};gap:28px;margin-top:40px;">

   @if($product->description)
   <div class="pd-desc-card">
    <div class="pd-section-title">About this Product</div>
    <div class="pd-desc-content">{!! $product->description !!}</div>
   </div>
   @endif

   @if(is_array($product->ingredients) && count($product->ingredients))
   <div class="pd-ing-card">
    <div class="pd-section-title">Ingredients</div>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
     @foreach($product->ingredients as $ing)
      <span class="pd-ing-tag">{{ $ing }}</span>
     @endforeach
    </div>
    <p style="font-size:11px;color:#9c9385;margin-top:16px;line-height:1.6;">
     ⚠️ Made in a kitchen that handles nuts, dairy, gluten and eggs. May contain traces.
    </p>
   </div>
   @endif

  </div>
  @endif

  {{-- Related Products --}}
  @if($related->count())
  <div style="margin-top:60px;">
   <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
    <div class="pd-section-title" style="margin:0;">You Might Also Like</div>
    @if($product->category)
     <a href="{{ route('menu.show',$product->category->slug) }}" class="btn-arrow" style="font-size:12px;padding:8px 16px;">
      <span>View All {{ $product->category->name }}</span>
      <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:14px;">arrow_forward</span></span>
     </a>
    @endif
   </div>
   <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;">
    @foreach($related as $rel)
    @php
      $relatedUrl = $rel->category?->slug
        ? route('menu.product', ['categorySlug' => $rel->category->slug, 'slug' => $rel->slug])
        : route('menu.product.legacy', ['slug' => $rel->slug]);
    @endphp
    <a href="{{ $relatedUrl }}" class="pd-related-card">
     <div class="img-wrap">
      <img src="{{ $rel->image ? route('media.public', ['path' => $rel->image], false) : asset('images/main image redesign.png') }}" alt="{{ $rel->name }}">
     </div>
     <div class="info">
      <div class="info-name">{{ $rel->name }}</div>
      <div class="info-price">£{{ number_format((float)$rel->price,2) }}</div>
      <div class="info-cta"><span class="material-symbols-outlined" style="font-size:14px;">arrow_forward</span> View Details</div>
     </div>
    </a>
    @endforeach
   </div>
  </div>
  @endif

 </div>
</div>

<script>
function pdSwitch(thumb, src) {
  document.getElementById('pdMainImg').src = src;
  document.querySelectorAll('.pd-thumb').forEach(t => t.classList.remove('active'));
  thumb.classList.add('active');
}
var pdMin = {{ $minQty }};
function pdQty(d) {
  var el = document.getElementById('pdQtyVal');
  var v = Math.max(pdMin, parseInt(el.textContent) + d);
  el.textContent = v;
}
</script>
@endsection
