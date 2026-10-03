@extends('layouts.app')
@section('title', 'Tres Leches | Current Cravings')

@push('styles')
<style>
:root {
      --accent: #f27d99;
      --accent-soft: #fcd47e;
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
      background: linear-gradient(135deg, #f27d99 0%, #fcd47e 50%, #e8627d 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .hover-scale-card { transition: transform 0.4s ease, box-shadow 0.4s ease; }
    .hover-scale-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(242,125,153,0.16); }
    .accent-bg { background: var(--accent); }
    .accent-border { border-color: var(--accent); }
    .accent-text { color: var(--accent); }
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
    <section class="px-8 pb-20 md:pb-24 lg:pb-28 page-hero-under-header" style="background: linear-gradient(135deg, #fff0f4 0%, #fff9ee 45%, #f7f3e9 100%);">
      <div class="max-w-6xl mx-auto text-center">
        <span class="uppercase tracking-[0.3em] text-xs font-bold accent-text">Made to Order</span>
        <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
          Ultimate <span class="gradient-headline">Tres Leches</span>
        </h1>
        <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
          Soaked in three milks, each cake is a masterpiece of moisture and flavor. Mini serves 2, large serves 4-5.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
          <a class="accent-bg text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform" href="{{ route('menu.index') }}">Back to Full Menu</a>
          <a class="accent-border border-2 accent-text px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors" href="{{ route('cart.index') }}">Reserve a Cake</a>
        </div>
      </div>
    </section>

    <section class="px-8 py-16">
      <div class="max-w-7xl mx-auto">
        <div class="mb-8 rounded-xl border border-[#f2d9b8] bg-[#fff8ef] p-4 text-sm text-[#5c4a30]">
          <strong>Serving guide:</strong> Mini Cake (serves 2) and Large Cake (serves 4-5). Price range for all flavors: <strong>&pound;7.99 - &pound;44.99</strong>.
        </div>
        @php
          $dbProducts = \App\Models\Product::active()
            ->whereHas('category', fn($q) => $q->where('slug','tres-leches'))
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
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/kunafa brownie.png') }}" alt="Kunafa Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Kunafa Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Decadent tres leches cake soaked in three milks with fluffy whipped cream finish.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Kunafa Tres Leches"
                      data-name="Kunafa Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/kunafa brownie.png') }}">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/products/image-4.webp') }}" alt="Strawberry Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Strawberry Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Fresh strawberries and sweet milk soak in a fruity creamy profile.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Strawberry Tres Leches"
                      data-name="Strawberry Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/products/image-4.webp') }}">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/saffron.png') }}" alt="Saffron and Rose Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Saffron and Rose Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Flavor-infused tres leches combining aromatic saffron and delicate rose.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Saffron and Rose Tres Leches"
                      data-name="Saffron and Rose Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/saffron.png') }}">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/2.jpg') }}" alt="Pistachio and White Chocolate Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Pistachio and White Chocolate Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Rich pistachio notes balanced with white chocolate accents.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Pistachio and White Chocolate Tres Leches"
                      data-name="Pistachio and White Chocolate Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/2.jpg') }}">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqflfHVKq0IBQkena64_e3puKj-eIccdLVDk0DT6yE2yA4FanEYGuSqpIHVwBPi3e8F35Rd3W9FFC-OPv5-L4vdCytNLVCX_JY69eQjF9rChH1QGRsJZHi-FtbTT2LPUB_OmztDgkOvu9qdLAvuqTq91pt64ztFzCANGfBmGJWW4gpitr7BvpQ7xv0QtAjkK8gzZd87ANt54M7XVMNZQvrlu6PqqIr_pv-T-CF0GR4Nc5_AybcN9PbQqF-Sk_V4HCKNMq4YOW6HNk" alt="Mocha Chocolate Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Mocha Chocolate Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Chocolate and coffee mocha twist on classic milk-soaked cake.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Mocha Chocolate Tres Leches"
                      data-name="Mocha Chocolate Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuBqflfHVKq0IBQkena64_e3puKj-eIccdLVDk0DT6yE2yA4FanEYGuSqpIHVwBPi3e8F35Rd3W9FFC-OPv5-L4vdCytNLVCX_JY69eQjF9rChH1QGRsJZHi-FtbTT2LPUB_OmztDgkOvu9qdLAvuqTq91pt64ztFzCANGfBmGJWW4gpitr7BvpQ7xv0QtAjkK8gzZd87ANt54M7XVMNZQvrlu6PqqIr_pv-T-CF0GR4Nc5_AybcN9PbQqF-Sk_V4HCKNMq4YOW6HNk">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/products/biscoff-brownie.webp') }}" alt="Lotus Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Lotus Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Lotus Biscoff-inspired creamy sponge with caramelized cookie flavor.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Lotus Tres Leches"
                      data-name="Lotus Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/products/biscoff-brownie.webp') }}">Reserve</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/tres leche.jpg') }}" alt="Classic Caramel Tres Leches">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Classic Caramel Tres Leches</h3>
            <p class="text-[#66645e] text-sm mb-3">Traditional tres leches cake finished with rich caramel flavor.</p>
            <p class="text-xs font-bold accent-text mb-4">Mini (2): &pound;7.99 | Large (4-5): &pound;44.99</p>
            <div class="flex flex-col gap-3">
              <button class="bg-[#f27d99] text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-[#e8627d] hover:scale-105 transition-transform"
                      data-add-to-cart
                      data-open-cart="1"
                      data-base-name="Classic Caramel Tres Leches"
                      data-name="Classic Caramel Tres Leches"
                      data-price="7.99"
                      data-category="tres-leches"
                      data-image="{{ asset('images/tres leche.jpg') }}">Reserve</button>
            </div>
          </article>
        </div>
      </div>
    </section>

    
  </div>
@endsection






