@extends('layouts.app')
@section('title', 'Drinks | Current Cravings')

@push('styles')
<style>
:root {
      --accent: #f27d99;
      --accent-soft: #fbb6c8;
      --accent-deep: #e8627d;
    }
    body { background: #fffbff; color: #393832; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .glass-nav {
  background: rgba(255, 251, 255, 0.85);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid rgba(242,125,153,0.08);
  transition: all 0.4s ease;
}
    .logo-img { display: block; mix-blend-mode: multiply; object-fit: contain; }
    .nav-active { color: var(--accent); position: relative; }
    .nav-active::after { content: ''; position: absolute; left: 0; bottom: -4px; height: 2px; width: 100%; background: var(--accent); border-radius: 999px; }
    .draw-underline { position: relative; display: inline-block; }
    .draw-underline::after { content: ''; position: absolute; left: 0; bottom: -4px; height: 2px; width: 0; background: var(--accent); transition: width 0.4s ease; }
    .draw-underline:hover::after { width: 100%; }
    .gradient-headline {
      background: linear-gradient(135deg, #f27d99 0%, #e8627d 45%, #fcd47e 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .hover-scale-card { transition: transform 0.4s ease, box-shadow 0.4s ease; }
    .hover-scale-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(77,110,0,0.18); }
    .accent-bg { background: var(--accent); }
    .accent-border { border-color: var(--accent); }
    .accent-text { color: var(--accent); }
    .marquee-wrap { background:#ffe6ef; border-top:1px solid rgba(242,125,153,0.15); border-bottom:1px solid rgba(242,125,153,0.15); overflow:hidden; }
    .marquee-track { display:inline-flex; gap:3rem; padding:0.6rem 2rem; white-space:nowrap; animation: marquee 22s linear infinite; font-weight:700; color:#f27d99; font-size:0.85rem; }
    .marquee-wrap:hover .marquee-track { animation-play-state: paused; }
    @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
      main > section { width: 100%; margin-left: auto; margin-right: auto; margin-top: 0 !important; margin-bottom: 0 !important; padding-left: 10% !important; padding-right: 10% !important; }
    @media (max-width: 1024px){
      main > section { padding-left: 8%; padding-right: 8%; }
    }
    @media (max-width: 640px){
      main > section { padding-left: 4%; padding-right: 4%; }
    }
    html { font-size: 14px; }
    @media (max-width: 640px){
      html { font-size: 13px; }
    }
      .site-shell{width:90%;margin:0 auto;}
      .site-shell nav{max-width:100% !important;}
      .site-shell .max-w-7xl{max-width:100% !important;}
    @media (max-width:1024px){.site-shell{width:94%;}}
    @media (max-width:640px){.site-shell{width:96%;}}
</style>
@endpush

@section('content')
<div>
    <div class="marquee-wrap">
      <div class="marquee-track">
        <span>Free Shipping on orders $100+</span>
        <span>New: Saffron Rose Tres Leches</span>
        <span>Limited Edition: Kunafa Brownie</span>
        <span>Artisan Baked Daily</span>
        <span>No Artificial Preservatives</span>
        <span>Free Shipping on orders $100+</span>
        <span>New: Saffron Rose Tres Leches</span>
        <span>Limited Edition: Kunafa Brownie</span>
        <span>Artisan Baked Daily</span>
        <span>No Artificial Preservatives</span>
      </div>
    </div>
    <section class="px-8 pb-20 md:pb-24 lg:pb-28 page-hero-under-header" style="background: linear-gradient(135deg, #f1ffe2 0%, #fffbff 45%, #f7f3e9 100%);">
      <div class="max-w-6xl mx-auto text-center">
        <span class="uppercase tracking-[0.3em] text-xs font-bold accent-text">The Perfect Companion</span>
        <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
          Our <span class="gradient-headline">Drinks</span>
        </h1>
        <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
          The perfect companion to your sweet treat.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
          <a class="accent-bg text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform" href="{{ route('menu.index') }}">Back to Full Menu</a>
          <a class="accent-border border-2 accent-text px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors" href="{{ route('cart.index') }}">Start an Order</a>
        </div>
      </div>
    </section>

    <section class="px-8 py-16">
      <div class="max-w-7xl mx-auto">
        @php
          $dbProducts = \App\Models\Product::active()
            ->whereHas('category', fn($q) => $q->where('slug','drinks'))
            ->with('category')->orderBy('order')->orderBy('name')->get();
        @endphp
        @if($dbProducts->count())
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($dbProducts as $product)
              @include('website.partials.cms-product-card', ['product' => $product])
            @endforeach
          </div>
          <hr style="border:none;border-top:1.5px dashed rgba(242,125,153,0.2);margin-bottom:40px;">
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/mango iced matcha.webp') }}" alt="Mango Iced Matcha">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">Mango Iced Matcha</h3>
            <p class="text-[#66645e] text-sm mb-3">A vibrant fusion of earthy Japanese matcha, creamy milk, and sweet tropical mango.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="Mango Iced Matcha"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/mango iced matcha.webp') }}">Add to Cart</button>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/drinks.jpg') }}" alt="Mango Limka">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">Mango Limka</h3>
            <p class="text-[#66645e] text-sm mb-3">A chilled tropical refreshment with juicy mango and zesty Limka soda.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="Mango Limka"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/drinks.jpg') }}">Add to Cart</button>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/4.jpg') }}" alt="Summer Berry Chiller">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">Summer Berry Chiller</h3>
            <p class="text-[#66645e] text-sm mb-3">A cool blend of mixed berries, lightly sweetened and chilled to perfection.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="Summer Berry Chiller"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/4.jpg') }}">Add to Cart</button>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/matcha.png') }}" alt="Iced Vanilla Matcha">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">Iced Vanilla Matcha</h3>
            <p class="text-[#66645e] text-sm mb-3">Smooth vanilla with earthy matcha and milk for a balanced iced latte.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="Iced Vanilla Matcha"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/matcha.png') }}">Add to Cart</button>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/products/image-6.webp') }}" alt="French Vanilla Latte">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">French Vanilla Latte</h3>
            <p class="text-[#66645e] text-sm mb-3">Premium espresso with silky French vanilla syrup, served hot or iced.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="French Vanilla Latte"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/products/image-6.webp') }}">Add to Cart</button>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card text-center">
            <div class="aspect-square rounded-full overflow-hidden mb-4 bg-[#f7f3e9]">
              <img class="w-full h-full object-cover" src="{{ asset('images/1.jpg') }}" alt="Iced Strawberry Matcha">
            </div>
            <h3 class="font-headline text-lg font-bold mb-1">Iced Strawberry Matcha</h3>
            <p class="text-[#66645e] text-sm mb-3">Earthy matcha with creamy milk and sweet strawberry notes.</p>
            <span class="font-bold accent-text">&pound;4.50</span>
            <button class="mt-4 accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                    data-add-to-cart="1"
                    data-open-cart="1"
                    data-name="Iced Strawberry Matcha"
                    data-price="4.50"
                    data-category="drinks"
                    data-image="{{ asset('images/1.jpg') }}">Add to Cart</button>
          </article>
        </div>
      </div>
    </section>

    
  </div>
@endsection


