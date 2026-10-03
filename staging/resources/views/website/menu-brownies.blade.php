@extends('layouts.app')
@section('title', 'Brownies | Current Cravings')

@push('styles')
<style>
:root {
  --accent: #b06a00;
  --accent-soft: #f4d1a2;
  --accent-deep: #8a4c00;
}

body { background:#fffbff; color:#393832; }

.glass-nav{
  background:rgba(255,251,255,.85);
  backdrop-filter:blur(16px);
  -webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(242,125,153,.08);
}

.gradient-headline{
  background:linear-gradient(135deg,#b06a00 0%,#8a4c00 45%,#f4d1a2 75%,#b06a00 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
}

.accent-bg{ background:var(--accent); }
.accent-text{ color:var(--accent); }
.accent-border{ border-color:var(--accent); }

.hover-scale-card{
  transition:all .35s ease;
}
.hover-scale-card:hover{
  transform:translateY(-8px);
  box-shadow:0 24px 48px rgba(176,106,0,.16);
}

main > section{
  width:100%;
  padding-left:10%!important;
  padding-right:10%!important;
}

@media(max-width:1024px){
  main > section{
    padding-left:8%!important;
    padding-right:8%!important;
  }
}

@media(max-width:640px){
  main > section{
    padding-left:4%!important;
    padding-right:4%!important;
  }
}
</style>
@endpush

@section('content')
<div>

    {{-- HERO --}}
    <section class="px-8 pb-20 md:pb-24 lg:pb-28 page-hero-under-header"
        style="background:linear-gradient(135deg,#fff4e8 0%,#fffbff 45%,#f7f3e9 100%);">

        <div class="max-w-6xl mx-auto text-center">
            <span class="uppercase tracking-[0.3em] text-xs font-bold accent-text">
                Premium Belgian Chocolate
            </span>

            <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
                Signature <span class="gradient-headline">Brownies</span>
            </h1>

            <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
                Rich, fudgy brownies handcrafted fresh daily using premium chocolate.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('menu.index') }}"
                   class="accent-bg text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform">
                    Back to Full Menu
                </a>

                <a href="{{ route('cart.index') }}"
                   class="border-2 accent-border accent-text px-8 py-3 rounded-full font-bold hover:bg-[#b06a00] hover:text-white transition-colors">
                    Start an Order
                </a>
            </div>
        </div>
    </section>


    {{-- PRODUCTS --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto">

        @php
          $dbProducts = \App\Models\Product::active()
            ->whereHas('category', fn($q) => $q->where('slug','brownies'))
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

                {{-- Kunafa Brownie --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/kunafa-brownie.webp') }}"
                             alt="Kunafa Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Kunafa Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Rich brownie topped with crunchy kunafa and chocolate drizzle.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£4.00</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Kunafa Brownie"
                            data-price="4.00"
                            data-category="brownies"
                            data-image="{{ asset('images/products/kunafa-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- Classic --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/classic-brownie.webp') }}"
                             alt="Classic Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Classic Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Traditional rich chocolate brownie with gooey fudgy centre.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Classic Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/classic-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- Biscoff --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/biscoff-brownie.webp') }}"
                             alt="Biscoff Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Biscoff Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Fudgy brownie loaded with Lotus Biscoff spread and crumb.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Biscoff Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/biscoff-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- Oreo --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/oreo-brownie.webp') }}"
                             alt="Oreo Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Oreo Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Chocolate brownie layered with crushed Oreo cookies.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Oreo Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/oreo-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- Double Choc --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/double-choc-brownie.webp') }}"
                             alt="Double Choc Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Double Choc Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Double dose of milk and dark chocolate in every bite.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Double Choc Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/double-choc-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- Salted Caramel --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/salted-caramel-brownie.webp') }}"
                             alt="Salted Caramel Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">Salted Caramel Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Sweet caramel swirls finished with sea salt flakes.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="Salted Caramel Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/salted-caramel-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- MnMs --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/mnms-brownie.webp') }}"
                             alt="MnMs Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">MnMs Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Colourful MnMs baked into rich chocolate brownie.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="MnMs Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/mnms-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>


                {{-- White Chocolate --}}
                <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card">
                    <div class="rounded-xl overflow-hidden mb-5 h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset('images/products/white-chocolate-brownie.webp') }}"
                             alt="White Chocolate Brownie">
                    </div>

                    <h3 class="font-headline text-xl font-bold mb-1">White Chocolate Brownie</h3>
                    <p class="text-[#66645e] text-sm mb-4">
                        Gooey brownie packed with creamy white chocolate chunks.
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg accent-text">£3.50</span>

                        <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold"
                            data-add-to-cart="1"
                            data-open-cart="1"
                            data-name="White Chocolate Brownie"
                            data-price="3.50"
                            data-category="brownies"
                            data-image="{{ asset('images/products/white-chocolate-brownie.webp') }}">
                            Add to Cart
                        </button>
                    </div>
                </article>

            </div>
        </div>
    </section>

</div>
@endsection
