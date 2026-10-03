<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
  $defaultMetaTitle = trim($__env->yieldContent('title', 'The Confectionary | Freshly Baked Happiness'));
  $viewMetaDescription = trim($__env->yieldContent('meta_description', ''));
  $viewCanonicalSource = trim($__env->yieldContent('canonical_url', ''));
  $viewRobotsMeta = trim($__env->yieldContent('meta_robots', ''));
  $routeName = request()->route()?->getName();
  $siteCms = null;
  $seoMetaTag = null;

  if (\Illuminate\Support\Facades\Schema::hasTable('site_contents')) {
      $siteCms = \App\Models\SiteContent::allKeyed();
  }

  if (\Illuminate\Support\Facades\Schema::hasTable('seo_meta_tags')) {
      $seoMetaTag = \App\Models\SeoMetaTag::forRequest(request());
  }

  $routeSeoPrefixMap = [
      'home' => 'home_seo',
      'menu.index' => 'menu_page_seo',
      'about' => 'about_page_seo',
      'contact' => 'contact_page_seo',
      'checkout.index' => 'checkout_page_seo',
      'privacy-policy' => 'privacy_page_seo',
      'terms-of-service' => 'terms_page_seo',
      'refunds-returns' => 'refunds_page_seo',
      'allergen-info' => 'allergen_page_seo',
      'delivery-shipping' => 'delivery_page_seo',
      'blog.index' => 'blog_page_seo',
  ];

  $seoPrefix = $routeName && isset($routeSeoPrefixMap[$routeName]) ? $routeSeoPrefixMap[$routeName] : null;
  $siteContentMetaTitle = null;
  $siteContentMetaDescription = null;
  $siteContentCanonical = null;
  $siteContentIndex = null;

  if (is_array($siteCms) && filled($seoPrefix)) {
      $siteContentMetaTitle = $siteCms[$seoPrefix . '_title'] ?? null;
      $siteContentMetaDescription = $siteCms[$seoPrefix . '_description'] ?? null;
      $siteContentCanonical = $siteCms[$seoPrefix . '_canonical'] ?? null;
      $rawIndex = $siteCms[$seoPrefix . '_index'] ?? null;
      if ($rawIndex !== null && $rawIndex !== '') {
          $siteContentIndex = ((string) $rawIndex) === '1';
      }
  }

  $metaTitle = filled($siteContentMetaTitle)
      ? $siteContentMetaTitle
      : (filled($seoMetaTag?->meta_title) ? $seoMetaTag->meta_title : $defaultMetaTitle);

  $metaDescription = filled($viewMetaDescription)
      ? $viewMetaDescription
      : (filled($siteContentMetaDescription) ? $siteContentMetaDescription : $seoMetaTag?->meta_description);

  $canonicalSource = filled($viewCanonicalSource)
      ? $viewCanonicalSource
      : (filled($siteContentCanonical) ? $siteContentCanonical : $seoMetaTag?->canonical_url);

  $canonicalUrl = filled($canonicalSource)
      ? (\Illuminate\Support\Str::startsWith($canonicalSource, ['http://', 'https://']) ? $canonicalSource : url($canonicalSource))
      : url()->current();

  if (filled($viewRobotsMeta)) {
      $robotsMeta = $viewRobotsMeta;
  } elseif ($siteContentIndex !== null) {
      $robotsMeta = $siteContentIndex ? 'index, follow' : 'noindex, nofollow';
  } else {
      $robotsMeta = ($seoMetaTag && ! $seoMetaTag->is_index) ? 'noindex, nofollow' : 'index, follow';
  }
@endphp
<title>{{ $metaTitle }}</title>
@if(filled($metaDescription))
<meta name="description" content="{{ $metaDescription }}">
@endif
<link rel="canonical" href="{{ $canonicalUrl }}">
<link rel="icon" type="image/png" href="{{ asset('images/Artboard1.png') }}">
<meta name="robots" content="{{ $robotsMeta }}">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@700;800;900&family=Be+Vietnam+Pro:wght@300;400;500;600;700&family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script id="tailwind-config">
 tailwind.config = {
 darkMode: "class",
 theme: {
 extend: {
 colors: {
 "primary": "#f27d99",
 "primary-dim": "#e8627d",
 "primary-container": "#fbb6c8",
 "primary-fixed": "#fdd4e0",
 "primary-fixed-dim": "#f9a3b9",
 "on-primary": "#ffffff",
 "on-primary-container": "#5a0020",
 "on-primary-fixed": "#000000",
 "on-primary-fixed-variant": "#7a1535",
 "inverse-primary": "#f27d99",
 "surface-variant": "#ece8dd",
 "surface-container-highest": "#ece8dd",
 "tertiary-dim": "#8f3c5b",
 "error-container": "#fb5151",
 "inverse-surface": "#FEF6E7",
 "error": "#c0262d",
 "on-surface-variant": "#66645e",
 "inverse-on-surface": "#9f9d95",
 "on-secondary-fixed": "#304600",
 "surface": "#fffbff",
 "tertiary-fixed-dim": "#f9a3b9",
 "tertiary-container": "#fbb6c8",
 "surface-container-high": "#f1eee3",
 "outline-variant": "#bcb9b1",
 "on-secondary": "#ffffff",
 "on-error-container": "#570008",
 "on-surface": "#393832",
 "surface-container-low": "#fdf9ef",
 "secondary-container": "#bef458",
 "on-secondary-container": "#3f5a00",
 "secondary-fixed-dim": "#b0e54b",
 "on-background": "#393832",
 "background": "#fffbff",
 "on-tertiary-container": "#621837",
 "on-tertiary": "#ffffff",
 "surface-dim": "#e6e2d7",
 "tertiary": "#9d4867",
 "surface-tint": "#f27d99",
 "on-tertiary-fixed": "#420020",
 "surface-container": "#f7f3e9",
 "outline": "#838079",
 "secondary-fixed": "#bef458",
 "on-secondary-fixed-variant": "#466500",
 "secondary": "#4d6e00",
 "surface-bright": "#fffbff",
 "secondary-dim": "#446100",
 "on-error": "#ffffff",
 "surface-container-lowest": "#ffffff",
 },
 fontFamily: {
 "headline": ["Epilogue"],
 "body": ["Be Vietnam Pro"],
 "label": ["Be Vietnam Pro"],
 "noto-serif": ["Noto Serif", "serif"]
 },
 borderRadius: {
 "DEFAULT": "1rem",
 "lg": "2rem",
 "xl": "3rem",
 "full": "9999px"
 },
 },
 },
 }
</script>
@php
  $appCssPath = public_path('css/app.css');
  $appCssVersion = is_file($appCssPath) ? filemtime($appCssPath) : null;
@endphp
<link href="{{ asset('css/app.css') }}{{ $appCssVersion ? '?v='.$appCssVersion : '' }}" rel="stylesheet">
@stack('styles')
<style>
  :root {
    /* Fallback values if public/css/app.css is missing on server */
    --header-h: 96px;
    --cc-header-top-gap: 12px;
    --marquee-h: 0px;
    --cc-header-offset: calc(var(--header-h) + var(--marquee-h, 0px) + var(--cc-header-top-gap));
  }
  main {
    padding-top: 0;
  }
  html,
  body {
    max-width: 100%;
    overflow-x: hidden;
  }
  img,
  video,
  canvas,
  svg {
    max-width: 100%;
  }
  .site-shell {
    width: 90%;
    margin: 0 auto;
  }
  main > section {
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: clamp(16px, 5vw, 10%) !important;
    padding-right: clamp(16px, 5vw, 10%) !important;
  }
  .page-hero-under-header {
    padding-top: var(--cc-header-offset) !important;
  }
  .page-hero-under-header-tight {
    padding-top: calc(var(--cc-header-offset) - 8px) !important;
  }
  .page-hero-under-header-roomy {
    padding-top: calc(var(--cc-header-offset) + 14px) !important;
  }
  @media (max-width: 767px) {
    :root {
      --cc-header-top-gap: 8px;
      --header-h: 96px;
    }
    .page-hero-under-header {
      padding-top: calc(var(--cc-header-offset) + 10px) !important;
    }
    .site-shell {
      width: 96%;
    }
    main > section {
      padding-left: 14px !important;
      padding-right: 14px !important;
    }
    .page-hero-under-header-tight {
      padding-top: calc(var(--cc-header-offset) - 4px) !important;
    }
    .page-hero-under-header-roomy {
      padding-top: calc(var(--cc-header-offset) + 10px) !important;
    }
  }
  .reveal,
  .reveal-left,
  .reveal-right,
  .reveal-scale,
  .clip-reveal,
  .text-explosion,
  .slide-stagger,
  .bounce-in,
  .anim-up {
    opacity: 1 !important;
    transform: none !important;
  }
  .section-line {
    transform: scaleX(1) !important;
  }
  .footer-sprinkles-container {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    z-index: 0;
  }
  @media (max-width: 767px) {
    #sprinkles-container,
    #particles,
    #footerSprinkles {
      display: none !important;
    }
  }
  /* search fix */
  .search-overlay{position:fixed!important;inset:0!important;z-index:1100!important;opacity:0!important;pointer-events:none!important;background:rgba(20,10,18,.55)!important;backdrop-filter:blur(6px)!important;transition:opacity .25s ease!important;}
  .search-overlay.open{opacity:1!important;pointer-events:all!important;}
  .search-modal{position:fixed!important;top:0!important;left:0!important;right:0!important;bottom:auto!important;width:100%!important;height:auto!important;display:flex!important;align-items:flex-start!important;justify-content:center!important;z-index:1101!important;padding:80px 16px 24px!important;pointer-events:none!important;opacity:1!important;background:none!important;border-radius:0!important;box-shadow:none!important;border:none!important;}
  .search-modal.open{pointer-events:all!important;}
  .search-box,
  .search-modal-inner{
    width:100%!important;
    max-width:680px!important;
    display:block!important;
    background:#fff!important;
    border-radius:28px!important;
    overflow:hidden!important;
    transform:translateY(-24px) scale(.97)!important;
    opacity:0!important;
    transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s ease!important;
    padding:0!important;
    box-shadow:0 32px 80px rgba(242,125,153,.22),0 8px 24px rgba(0,0,0,.12)!important;
  }
  .search-modal.open .search-box,
  .search-modal.open .search-modal-inner{
    transform:translateY(0) scale(1)!important;
    opacity:1!important;
  }
  .search-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    padding:18px 20px 14px;
    border-bottom:1.5px solid rgba(242,125,153,.12);
  }
  .search-title{
    font-family:'Epilogue',sans-serif;
    font-size:clamp(1.2rem,2.5vw,1.6rem);
    font-weight:800;
    color:#2a1a22;
    letter-spacing:-.01em;
  }
  .search-close{
    width:34px;
    height:34px;
    border-radius:50%;
    border:1.5px solid rgba(242,125,153,.2);
    background:#fff;
    color:#66645e;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:all .2s ease;
    position:relative;
    font-size:0;
  }
  .search-close::before{
    content:'\00D7';
    font-size:24px;
    line-height:1;
    display:block;
    transform:translateY(-1px);
  }
  .search-close > *{
    display:none !important;
  }
  .search-close:hover{
    background:#f27d99;
    color:#fff;
    border-color:#f27d99;
  }
  .search-form{
    display:flex;
    gap:10px;
    align-items:center;
    padding:14px 20px;
  }
  .search-input{
    flex:1;
    min-width:0;
    border:1.5px solid rgba(242,125,153,.22);
    border-radius:14px;
    padding:11px 14px;
    font-size:16px;
    color:#3a3526;
    outline:none;
    background:#fff;
  }
  .search-input:focus{
    border-color:#f27d99;
    box-shadow:0 0 0 3px rgba(242,125,153,.12);
  }
  .search-btn{
    border:none;
    border-radius:12px;
    padding:11px 16px;
    background:linear-gradient(135deg,#f27d99,#e8627d);
    color:#fff;
    font-weight:700;
    cursor:pointer;
    white-space:nowrap;
  }
  .search-hint{
    padding:0 20px 10px;
    color:#9c9385;
    font-size:12px;
  }
  .search-cats{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    padding:0 20px 18px;
  }
  .search-cat{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:8px 14px;
    border-radius:999px;
    border:1.5px solid rgba(242,125,153,.18);
    background:#fff7fa;
    color:#66645e;
    text-decoration:none;
    font-size:12px;
    font-weight:700;
    transition:all .2s ease;
  }
  .search-cat:hover{
    background:#f27d99;
    color:#fff;
    border-color:#f27d99;
  }
  .search-cat .dot{
    width:7px;
    height:7px;
    border-radius:50%;
    background:currentColor;
    opacity:.7;
  }
  @media (max-width: 640px){
    .search-form{
      flex-direction:column;
      align-items:stretch;
    }
    .search-btn{
      width:100%;
    }
  }
</style>
</head>

<body class="bg-surface font-body text-on-surface">
<canvas id="particles"></canvas>
<div id="scroll-progress"></div>




{{-- Header --}}
@include('layouts.header')

{{-- Main Content --}}
<main style="position:relative;z-index:1;">
    @yield('content')
</main>

{{-- Footer --}}
@include('layouts.footer')



{{-- <script>
@include('layouts.scripts-inline')
</script> --}}

<script>
(function () {
  const root = document.documentElement;
  const header = document.getElementById('main-header');
  if (!header) return;

  const setHeaderHeight = () => {
    const height = Math.ceil(header.getBoundingClientRect().height);
    root.style.setProperty('--header-h', `${height}px`);
  };

  setHeaderHeight();

  if ('ResizeObserver' in window) {
    const ro = new ResizeObserver(setHeaderHeight);
    ro.observe(header);
  }

  window.addEventListener('load', setHeaderHeight);
  window.addEventListener('resize', setHeaderHeight);
})();
</script>
@stack('scripts')
<script>
(function () {
  const isMobile = window.matchMedia('(max-width: 767px)').matches;
  if (isMobile) return;
  const fsc = document.getElementById('footerSprinkles');
  if (!fsc || fsc.children.length) return;

  const colors = ['#f27d99','#fbb6c8','#bef458','#FCD47E','#fdd4e0','#e8627d','#97b931'];
  const create = () => {
    const el = document.createElement('div');
    el.className = 'footer-sprinkle';
    const size = 4 + Math.random() * 11;
    const left = 1 + Math.random() * 98;
    const dur = 6 + Math.random() * 13;
    const delay = Math.random() * 10;
    const color = colors[Math.floor(Math.random() * colors.length)];
    const isRect = Math.random() > 0.55;
    el.style.cssText =
      `width:${isRect ? size * 2.8 : size}px;height:${size}px;left:${left}%;` +
      `background:${color};border-radius:${isRect ? '3px' : '50%'};` +
      `animation:fSprinkleUp ${dur}s ease-in-out ${delay}s infinite;opacity:0;`;
    fsc.appendChild(el);
    return el;
  };

  for (let i = 0; i < 20; i++) create();
  setInterval(() => {
    const el = create();
    setTimeout(() => { try { el.remove(); } catch (e) {} }, 25000);
  }, 2000);
})();
</script>
<script>
(function () {
  const tokenEl = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = tokenEl ? tokenEl.getAttribute('content') : '';

  function updateCartCount(count) {
    document.querySelectorAll('[data-cart-count]').forEach((el) => {
      if (count > 0) {
        el.textContent = count;
        el.style.display = '';
      } else {
        el.textContent = '0';
        el.style.display = 'none';
      }
    });
  }

  function setButtonState(btn, state, message) {
    if (!btn) return;
    const isIconOnly = btn.classList.contains('material-symbols-outlined');
    if (isIconOnly) {
      const original = btn.getAttribute('data-orig-label') || btn.textContent;
      if (!btn.getAttribute('data-orig-label')) {
        btn.setAttribute('data-orig-label', original);
      }
      btn.disabled = state === 'loading';
      if (state === 'loading') {
        btn.textContent = 'autorenew';
        btn.style.pointerEvents = 'none';
        return;
      }
      if (state === 'success') {
        btn.textContent = 'check';
        setTimeout(() => {
          btn.textContent = original;
          btn.style.pointerEvents = '';
        }, 1500);
        return;
      }
      btn.textContent = original;
      btn.style.pointerEvents = '';
      return;
    }

    const originalHtml = btn.getAttribute('data-orig-html') || btn.innerHTML;
    if (!btn.getAttribute('data-orig-html')) {
      btn.setAttribute('data-orig-html', originalHtml);
    }
    btn.disabled = state === 'loading';
    if (state === 'loading') {
      btn.textContent = 'Adding...';
      btn.style.pointerEvents = 'none';
      return;
    }
    if (state === 'success') {
      btn.textContent = message || 'Added!';
      setTimeout(() => {
        btn.innerHTML = originalHtml;
        btn.style.pointerEvents = '';
      }, 1500);
      return;
    }
    btn.innerHTML = originalHtml;
    btn.style.pointerEvents = '';
  }

  function upsertSidecartItem(item) {
    if (!item || !item.key) return;
    const container = document.getElementById('cartItems');
    if (!container) return;

    const existing = container.querySelector(`.cart-item[data-key="${item.key}"]`);
    if (existing) {
      const qtyEl = existing.querySelector('.cart-qty-val');
      if (qtyEl) qtyEl.textContent = item.quantity;
      if (window.ccUpdateCartTotals) window.ccUpdateCartTotals();
      return;
    }

    const empty = container.querySelector('.cart-empty');
    if (empty) empty.remove();

    const row = document.createElement('div');
    row.className = 'cart-item';
    row.dataset.key = item.key;
    row.dataset.price = item.price;
    row.dataset.category = item.category_slug || 'other';
    row.id = `cart-item-${item.key}`;

    const img = document.createElement('img');
    img.className = 'cart-item-img';
    img.src = item.image || '{{ asset('images/image.png') }}';
    img.alt = item.name || 'Cart item';

    const info = document.createElement('div');
    info.className = 'cart-item-info';

    const nameEl = document.createElement('div');
    nameEl.className = 'cart-item-name';
    nameEl.textContent = item.name || 'Item';

    const variantEl = document.createElement('div');
    variantEl.className = 'cart-item-variant';
    variantEl.textContent = (item.category_slug || 'item').replace(/-/g, ' ');

    const rowWrap = document.createElement('div');
    rowWrap.className = 'cart-item-row';

    const priceEl = document.createElement('span');
    priceEl.className = 'cart-item-price';
    priceEl.textContent = '\u00A3' + Number(item.price || 0).toFixed(2);

    const qtyWrap = document.createElement('div');
    qtyWrap.className = 'cart-item-qty';

    const minus = document.createElement('button');
    minus.className = 'cart-qty-btn';
    minus.type = 'button';
    minus.textContent = '-';
    minus.onclick = function () { if (window.cartQty) window.cartQty(item.key, -1); };

    const qtyVal = document.createElement('span');
    qtyVal.className = 'cart-qty-val';
    qtyVal.id = `${item.key}-qty`;
    qtyVal.textContent = item.quantity || 1;

    const plus = document.createElement('button');
    plus.className = 'cart-qty-btn';
    plus.type = 'button';
    plus.textContent = '+';
    plus.onclick = function () { if (window.cartQty) window.cartQty(item.key, 1); };

    qtyWrap.appendChild(minus);
    qtyWrap.appendChild(qtyVal);
    qtyWrap.appendChild(plus);

    rowWrap.appendChild(priceEl);
    rowWrap.appendChild(qtyWrap);

    info.appendChild(nameEl);
    info.appendChild(variantEl);
    info.appendChild(rowWrap);

    const removeBtn = document.createElement('button');
    removeBtn.className = 'cart-item-remove';
    removeBtn.type = 'button';
    removeBtn.onclick = function () { if (window.removeCartItem) window.removeCartItem(item.key); };
    removeBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:16px">delete</span>';

    row.appendChild(img);
    row.appendChild(info);
    row.appendChild(removeBtn);

    container.prepend(row);

    if (window.ccUpdateCartTotals) window.ccUpdateCartTotals();
  }

  function slugifyProductName(name) {
    return String(name || '')
      .toLowerCase()
      .trim()
      .replace(/&/g, ' and ')
      .replace(/[^a-z0-9]+/g, '-')
      .replace(/^-+|-+$/g, '');
  }

  function getProductCardFromTarget(target) {
    return target.closest('article, .card-entry, .menu-card');
  }

  function isInteractiveTarget(target) {
    return !!target.closest('a, button, input, select, textarea, label, summary, [role="button"], [data-add-to-cart]');
  }

  function setProductCardPointers() {
    const cards = document.querySelectorAll('article, .card-entry, .menu-card');
    cards.forEach((card) => {
      const addBtn = card.querySelector('[data-add-to-cart][data-name][data-category]');
      if (!addBtn) return;
      card.style.cursor = 'pointer';
    });
  }

  setProductCardPointers();

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-add-to-cart]');
    if (!btn) return;
    if (btn.disabled || btn.getAttribute('aria-disabled') === 'true') return;
    e.preventDefault();

    let qty = 1;
    const categorySlug = (btn.dataset.category || '').toLowerCase();
    if (btn.dataset.qtyTarget) {
      const qtyInput = document.getElementById(btn.dataset.qtyTarget);
      if (qtyInput) {
        const parsed = parseInt(qtyInput.value || '1', 10);
        qty = Number.isFinite(parsed) && parsed > 0 ? parsed : 1;
      }
    } else if (btn.dataset.quantity) {
      const parsed = parseInt(btn.dataset.quantity, 10);
      qty = Number.isFinite(parsed) && parsed > 0 ? parsed : 1;
    }

    if (categorySlug === 'cookies' || categorySlug === 'brownies') {
      qty = Math.max(4, qty);
    }

    const payload = {
      product_id: btn.dataset.productId || null,
      name: btn.dataset.name || null,
      price: btn.dataset.price || null,
      category_slug: btn.dataset.category || null,
      image: btn.dataset.image || null,
      quantity: qty,
    };
    setButtonState(btn, 'loading');

    fetch('{{ route('cart.add', [], false) }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json',
      },
      credentials: 'same-origin',
      body: JSON.stringify(payload),
    })
      .then((res) => res.json())
      .then((data) => {
        if (!data || !data.success) {
          setButtonState(btn, 'error');
          return;
        }
        updateCartCount(data.cart_count || 0);
        if (data.item) {
          upsertSidecartItem(data.item);
        }
        setButtonState(btn, 'success');
        if (btn.dataset.openCart === '1' && window.openCart) {
          window.openCart();
        }
        if (btn.dataset.closeModal === '1' && window.closeProductModal) {
          window.closeProductModal();
        }
      })
      .catch(() => {
        setButtonState(btn, 'error');
      });
  });

  document.addEventListener('click', (e) => {
    if (isInteractiveTarget(e.target)) return;

    const card = getProductCardFromTarget(e.target);
    if (!card) return;

    const addBtn = card.querySelector('[data-add-to-cart][data-name][data-category]');
    if (!addBtn) return;

    const category = String(addBtn.dataset.category || '').trim().toLowerCase();
    const name = String(addBtn.dataset.baseName || addBtn.dataset.name || '').trim();

    if (!category || !name) return;

    const productSlug = slugifyProductName(name);
    if (!productSlug) return;

    window.location.href = `${window.location.origin}/${category}/${productSlug}`;
  });
})();
</script>
</body>
</html>
