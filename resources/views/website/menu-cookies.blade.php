@extends('layouts.app')
@section('title', 'Cookies | Current Cravings')

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
    .hover-scale-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(242,125,153,0.18); }
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
    <section class="px-8 pb-20 md:pb-24 lg:pb-28 page-hero-under-header" style="background: linear-gradient(135deg, #fff0f4 0%, #fffbff 45%, #f7f3e9 100%);">
      <div class="max-w-6xl mx-auto text-center">
        <span class="uppercase tracking-[0.3em] text-xs font-bold accent-text">Signature Collection</span>
        <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
          Our <span class="gradient-headline">Signature</span> Cookies
        </h1>
        <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
          Handcrafted with premium chocolate and real butter. Baked fresh every morning.
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
            ->whereHas('category', fn($q) => $q->where('slug','cookies'))
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
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/products/image-3.webp') }}" alt="Classic Choc Chip Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Classic Choc Chip Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Warm, soft, and chewy classic chocolate chip cookies loaded with gooey chocolate chips, delivering a timeless favorite in every bite.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Classic Choc Chip Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="{{ asset('images/products/image-3.webp') }}">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPUqfrMhxsmXXxNUvC1sgK4BMtK23iIqLJCVHVvV4wY1LZcyN61qmBM3KGXAR4B7sGyadHdsoDWen25La1hfAQC1mLvDDEE_1ScOyNbSe6bxAqDn0CWHYfZJn54ygL9K-zhweNoo9h3hOkYpj6hg6i6BOa3MBwZENS712o54H46ZS5mR1Zf1E3MO58gq8qKTSwPfeJmZRFDoLfApH5L1QWUE7XjfM-YE-JiU-XyYCQT6fxzwfHwBpxCegIBMNQd-7wtncrCJ1_UwU" alt="Brown Butter Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Brown Butter Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Rich and nutty brown butter cookies with a soft, chewy texture and a hint of caramelized flavor, perfect for a delightful treat.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Brown Butter Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuDPUqfrMhxsmXXxNUvC1sgK4BMtK23iIqLJCVHVvV4wY1LZcyN61qmBM3KGXAR4B7sGyadHdsoDWen25La1hfAQC1mLvDDEE_1ScOyNbSe6bxAqDn0CWHYfZJn54ygL9K-zhweNoo9h3hOkYpj6hg6i6BOa3MBwZENS712o54H46ZS5mR1Zf1E3MO58gq8qKTSwPfeJmZRFDoLfApH5L1QWUE7XjfM-YE-JiU-XyYCQT6fxzwfHwBpxCegIBMNQd-7wtncrCJ1_UwU">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_f0WGgFA-zxKiC4dXbkhJbpREaMlE-4Wm72wcy2hxG7JFt0n2xFB5VigeETHu3-fG8bcqkx5gQSvwXC_yFqFv1qc4fbuEhm5nyOVGAPj5g24qy5Xnh0l65qf_BhymHHtGKvg5H2SYdnx1S-p0Hk6kgJnvhj8suvcYcm9-NQyO3DNYz8TKcnyvOCLu86A7FNc6zE15sf-F-xay9kuQM3KiIwH49W7rs2xjtyw_VdZ81lL8k9_FwEjUogbyHGDa2F-Cz5COPZ9mBc" alt="Double Choc Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Double Choc Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Decadent double chocolate cookies with a rich chocolatey base, loaded with chocolate chunks and topped with a silky chocolate drizzle for an ultimate chocolate experience.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Double Choc Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_f0WGgFA-zxKiC4dXbkhJbpREaMlE-4Wm72wcy2hxG7JFt0n2xFB5VigeETHu3-fG8bcqkx5gQSvwXC_yFqFv1qc4fbuEhm5nyOVGAPj5g24qy5Xnh0l65qf_BhymHHtGKvg5H2SYdnx1S-p0Hk6kgJnvhj8suvcYcm9-NQyO3DNYz8TKcnyvOCLu86A7FNc6zE15sf-F-xay9kuQM3KiIwH49W7rs2xjtyw_VdZ81lL8k9_FwEjUogbyHGDa2F-Cz5COPZ9mBc">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuByFa-Xqe1dV0icYszxIQTERLBcN_o1BGJjnhm0kI5hKmU3AdJNg0S8hK-fIFXjmoNHH22y1awCUyYUAIGy2s1JE3irgpLKrL3JJbKrC91qspzOTUZMkAmBdIdzuqAEJehnORA-6EOuMd7S4JBN2aJQfgBKGj9SIzZcdX79B3kpDzgm1WmMdywyvkpvJWa5JLyUsY_k1bayexMtywiDv9tDKvc9LACzN15_ZNqepOobv6gJ-K4ayGXfQXx0HAWQF0CdcdWoVEQ6obc" alt="White Choc Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">White Choc Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Soft and chewy cookies loaded with creamy white chocolate chips, offering a sweet and buttery flavor that's simply irresistible.</p>
            <div class="flex justify-between items-center mt-auto">
              <div class="flex flex-col">
                <span class="text-xs text-[#9c9385] line-through">&pound;3.00</span>
                <span class="font-bold text-lg accent-text">&pound;2.25</span>
              </div>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="White Choc Cookie"
                      data-price="2.25"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuByFa-Xqe1dV0icYszxIQTERLBcN_o1BGJjnhm0kI5hKmU3AdJNg0S8hK-fIFXjmoNHH22y1awCUyYUAIGy2s1JE3irgpLKrL3JJbKrC91qspzOTUZMkAmBdIdzuqAEJehnORA-6EOuMd7S4JBN2aJQfgBKGj9SIzZcdX79B3kpDzgm1WmMdywyvkpvJWa5JLyUsY_k1bayexMtywiDv9tDKvc9LACzN15_ZNqepOobv6gJ-K4ayGXfQXx0HAWQF0CdcdWoVEQ6obc">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/3.jpg') }}" alt="MnMs Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">MnMs Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Chewy cookies bursting with colorful M&amp;M's, combining fun and flavor in every delicious bite.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="MnMs Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="{{ asset('images/3.jpg') }}">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPUqfrMhxsmXXxNUvC1sgK4BMtK23iIqLJCVHVvV4wY1LZcyN61qmBM3KGXAR4B7sGyadHdsoDWen25La1hfAQC1mLvDDEE_1ScOyNbSe6bxAqDn0CWHYfZJn54ygL9K-zhweNoo9h3hOkYpj6hg6i6BOa3MBwZENS712o54H46ZS5mR1Zf1E3MO58gq8qKTSwPfeJmZRFDoLfApH5L1QWUE7XjfM-YE-JiU-XyYCQT6fxzwfHwBpxCegIBMNQd-7wtncrCJ1_UwU" alt="Lotus Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Lotus Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Lotus cookies drizzled with rich caramel and topped with crunchy Lotus bits, creating a delightful blend of flavors and textures in every bite, perfect for enjoying with coffee or as a sweet snack on its own.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Lotus Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuDPUqfrMhxsmXXxNUvC1sgK4BMtK23iIqLJCVHVvV4wY1LZcyN61qmBM3KGXAR4B7sGyadHdsoDWen25La1hfAQC1mLvDDEE_1ScOyNbSe6bxAqDn0CWHYfZJn54ygL9K-zhweNoo9h3hOkYpj6hg6i6BOa3MBwZENS712o54H46ZS5mR1Zf1E3MO58gq8qKTSwPfeJmZRFDoLfApH5L1QWUE7XjfM-YE-JiU-XyYCQT6fxzwfHwBpxCegIBMNQd-7wtncrCJ1_UwU">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_f0WGgFA-zxKiC4dXbkhJbpREaMlE-4Wm72wcy2hxG7JFt0n2xFB5VigeETHu3-fG8bcqkx5gQSvwXC_yFqFv1qc4fbuEhm5nyOVGAPj5g24qy5Xnh0l65qf_BhymHHtGKvg5H2SYdnx1S-p0Hk6kgJnvhj8suvcYcm9-NQyO3DNYz8TKcnyvOCLu86A7FNc6zE15sf-F-xay9kuQM3KiIwH49W7rs2xjtyw_VdZ81lL8k9_FwEjUogbyHGDa2F-Cz5COPZ9mBc" alt="Oreo Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Oreo Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Decadent cookies loaded with creamy Oreo chunks, delivering a delightful twist on a classic favorite with every indulgent bite.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Oreo Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_f0WGgFA-zxKiC4dXbkhJbpREaMlE-4Wm72wcy2hxG7JFt0n2xFB5VigeETHu3-fG8bcqkx5gQSvwXC_yFqFv1qc4fbuEhm5nyOVGAPj5g24qy5Xnh0l65qf_BhymHHtGKvg5H2SYdnx1S-p0Hk6kgJnvhj8suvcYcm9-NQyO3DNYz8TKcnyvOCLu86A7FNc6zE15sf-F-xay9kuQM3KiIwH49W7rs2xjtyw_VdZ81lL8k9_FwEjUogbyHGDa2F-Cz5COPZ9mBc">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuByFa-Xqe1dV0icYszxIQTERLBcN_o1BGJjnhm0kI5hKmU3AdJNg0S8hK-fIFXjmoNHH22y1awCUyYUAIGy2s1JE3irgpLKrL3JJbKrC91qspzOTUZMkAmBdIdzuqAEJehnORA-6EOuMd7S4JBN2aJQfgBKGj9SIzZcdX79B3kpDzgm1WmMdywyvkpvJWa5JLyUsY_k1bayexMtywiDv9tDKvc9LACzN15_ZNqepOobv6gJ-K4ayGXfQXx0HAWQF0CdcdWoVEQ6obc" alt="Salted Caramel Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">Salted Caramel Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Soft and buttery cookies filled with rich salted caramel and a hint of sea salt, perfectly balancing sweet and savory in every bite.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="Salted Caramel Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="https://lh3.googleusercontent.com/aida-public/AB6AXuByFa-Xqe1dV0icYszxIQTERLBcN_o1BGJjnhm0kI5hKmU3AdJNg0S8hK-fIFXjmoNHH22y1awCUyYUAIGy2s1JE3irgpLKrL3JJbKrC91qspzOTUZMkAmBdIdzuqAEJehnORA-6EOuMd7S4JBN2aJQfgBKGj9SIzZcdX79B3kpDzgm1WmMdywyvkpvJWa5JLyUsY_k1bayexMtywiDv9tDKvc9LACzN15_ZNqepOobv6gJ-K4ayGXfQXx0HAWQF0CdcdWoVEQ6obc">Add to Cart</button>
            </div>
          </article>
          <article class="bg-white p-4 rounded-2xl shadow-sm hover-scale-card h-full flex flex-col">
            <div class="rounded-xl overflow-hidden mb-5 h-56">
              <img class="w-full h-full object-cover" src="{{ asset('images/cookies.jpg') }}" alt="S'mores Cookie">
            </div>
            <h3 class="font-headline text-xl font-bold mb-1">S'mores Cookie</h3>
            <p class="text-[#66645e] text-sm mb-4">Delightfully chewy cookies packed with gooey marshmallows, chocolate chunks, and crunchy graham cracker bits, bringing the campfire treat to your cookie jar.</p>
            <div class="flex justify-between items-center mt-auto">
              <span class="font-bold text-lg accent-text">&pound;3.50</span>
              <button class="accent-bg text-white px-4 py-2 rounded-full text-sm font-bold hover:scale-105 transition-transform"
                      data-add-to-cart="1"
                      data-open-cart="1"
                      data-name="S'mores Cookie"
                      data-price="3.50"
                      data-category="cookies"
                      data-image="{{ asset('images/cookies.jpg') }}">Add to Cart</button>
            </div>
          </article>
        </div>
      </div>
    </section>

    
  </div>
@endsection
