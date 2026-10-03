@extends('layouts.app')
@section('title', 'Gift Boxes | Current Cravings')

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
      background: linear-gradient(135deg, #f27d99 0%, #e8627d 60%, #fcd47e 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .hover-scale-card { transition: transform 0.4s ease, box-shadow 0.4s ease; }
    .hover-scale-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(58,112,0,0.18); }
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
    <section class="px-8 pb-16 md:pb-28 lg:pb-32 page-hero-under-header" style="background: linear-gradient(135deg, #f5ffe7 0%, #fffbff 45%, #f7f3e9 100%);">
      <div class="max-w-6xl mx-auto text-center">
        <span class="uppercase tracking-[0.3em] text-xs font-bold accent-text">Curated With Love</span>
        <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
          Our Cravings <span class="gradient-headline">Boxes</span>
        </h1>
        <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
          The perfect gift for yourself or someone special. Curated boxes of happiness, delivered fresh.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
          <a class="accent-bg text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform" href="{{ route('boxes.build') }}">Build Your Box</a>
          <a class="accent-border border-2 accent-text px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors" href="{{ route('menu.index') }}">Back to Full Menu</a>
          <a class="accent-border border-2 accent-text px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors" href="{{ route('boxes.build') }}">Send a Gift</a>
        </div>
      </div>
    </section>

    <section class="px-8 py-16">
      <div class="max-w-7xl mx-auto">
        @php
          $dbProducts = \App\Models\Product::active()
            ->whereHas('category', fn($q) => $q->where('slug','boxes'))
            ->with('category')->orderBy('order')->orderBy('name')->get();
        @endphp
        @if($dbProducts->count())
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($dbProducts as $product)
              @include('website.partials.cms-product-card', ['product' => $product])
            @endforeach
          </div>
          <hr style="border:none;border-top:1.5px dashed rgba(242,125,153,0.2);margin-bottom:40px;">
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <article class="bg-white p-8 rounded-2xl text-center shadow-sm hover-scale-card border border-dashed border-[#f27d99]/20 flex flex-col items-center h-full">
            <span class="material-symbols-outlined accent-text text-5xl mb-5">featured_seasonal_and_gifts</span>
            <h3 class="font-headline text-2xl font-bold mb-3">Craving Cookies Box of 6</h3>
            <p class="text-[#66645e] text-sm mb-5">A box of 6 handcrafted cookies with a different flavour in each slot.</p>
            <span class="text-3xl font-black accent-text mb-6 block">&pound;20.99</span>
            <a class="block w-full py-3 rounded-full accent-bg text-white font-bold hover:scale-105 transition-transform mt-auto" href="{{ route('boxes.build') }}">Gift This Box</a>
          </article>
          <article class="bg-white p-8 rounded-2xl text-center shadow-sm hover-scale-card border-2 border-[#f27d99] relative flex flex-col items-center h-full">
            <div class="absolute -top-4 -right-4 bg-[#f27d99] text-white text-xs font-bold px-3 py-1.5 rounded-full rotate-12">Most Popular</div>
            <span class="material-symbols-outlined accent-text text-5xl mb-5">card_giftcard</span>
            <h3 class="font-headline text-2xl font-bold mb-3">Craving Cookies Box of 4</h3>
            <p class="text-[#66645e] text-sm mb-5">A box of 4 handcrafted cookies, each one customizable by flavour.</p>
            <span class="text-3xl font-black accent-text mb-6 block">&pound;13.99</span>
            <a class="block w-full py-3 rounded-full accent-bg text-white font-bold hover:scale-105 transition-transform mt-auto" href="{{ route('boxes.build') }}">Gift This Box</a>
          </article>
          <article class="bg-white p-8 rounded-2xl text-center shadow-sm hover-scale-card border border-dashed border-[#f27d99]/20 flex flex-col items-center h-full">
            <span class="material-symbols-outlined accent-text text-5xl mb-5">celebration</span>
            <h3 class="font-headline text-2xl font-bold mb-3">Craving Brownies Box of 6</h3>
            <p class="text-[#66645e] text-sm mb-5">Mix box of 6 rich brownies with one base and your choice of toppings.</p>
            <span class="text-3xl font-black accent-text mb-6 block">&pound;20.99</span>
            <a class="block w-full py-3 rounded-full accent-bg text-white font-bold hover:scale-105 transition-transform mt-auto" href="{{ route('boxes.build') }}">Gift This Box</a>
          </article>
          <article class="bg-white p-8 rounded-2xl text-center shadow-sm hover-scale-card border border-dashed border-[#f27d99]/20 flex flex-col items-center h-full">
            <span class="material-symbols-outlined accent-text text-5xl mb-5">breakfast_dining</span>
            <h3 class="font-headline text-2xl font-bold mb-3">Craving Brownies Box of 4</h3>
            <p class="text-[#66645e] text-sm mb-5">Mix box of 4 fudgy brownies where you choose a topping for each piece.</p>
            <span class="text-3xl font-black accent-text mb-6 block">&pound;12.00 - &pound;13.99</span>
            <a class="block w-full py-3 rounded-full accent-bg text-white font-bold hover:scale-105 transition-transform mt-auto" href="{{ route('boxes.build') }}">Gift This Box</a>
          </article>
        </div>
      </div>
    </section>

    
  </div>
@endsection


