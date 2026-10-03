@extends('layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('content')
    <section class="relative px-8 py-20 overflow-hidden page-hero-under-header" style="background: linear-gradient(135deg, #fff0f4 0%, #fffbff 45%, #f7f3e9 100%);">
      <div class="absolute -top-20 -left-20 w-72 h-72 bg-[#f27d99] rounded-full blob"></div>
      <div class="absolute -bottom-24 right-10 w-80 h-80 bg-[#fcd47e] rounded-full blob"></div>
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div>
          <span class="pill inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full">{{ $cms['about_page_pill'] ?? 'Our Story' }}</span>
          <h1 class="section-title text-5xl md:text-7xl leading-[0.95] mt-5">{{ $cms['about_page_title'] ?? 'About Current Cravings' }}</h1>
          <p class="text-[#66645e] text-lg mt-5 leading-relaxed max-w-xl">
            {{ $cms['about_page_story'] ?? 'Current Cravings started as a tiny home kitchen with a single mission: bring warm, nostalgic desserts to every celebration. Today, we still bake in small batches, using real butter, premium chocolate, and zero shortcuts.' }}
          </p>
          <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ $cms['about_page_cta1_url'] ?? route('menu.index') }}" class="bg-[#f27d99] text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform">{{ $cms['about_page_cta1_text'] ?? 'Explore Menu' }}</a>
            <a href="{{ $cms['about_page_cta2_url'] ?? route('cart.index') }}" class="border-2 border-[#f27d99] text-[#f27d99] px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors">{{ $cms['about_page_cta2_text'] ?? 'Order Now' }}</a>
          </div>
          <div class="mt-10 grid grid-cols-2 gap-4">
            <div class="soft-card rounded-2xl p-4">
              <div class="text-2xl font-black text-[#f27d99]">{{ $cms['about_page_stat1_value'] ?? '45K+' }}</div>
              <div class="text-xs uppercase tracking-widest text-[#66645e]">{{ $cms['about_page_stat1_label'] ?? 'Treats baked' }}</div>
            </div>
            <div class="soft-card rounded-2xl p-4">
              <div class="text-2xl font-black text-[#f27d99]">{{ $cms['about_page_stat2_value'] ?? '120+' }}</div>
              <div class="text-xs uppercase tracking-widest text-[#66645e]">{{ $cms['about_page_stat2_label'] ?? 'Signature recipes' }}</div>
            </div>
          </div>
        </div>
        <div class="relative max-w-[400px] mx-auto md:mx-0 md:ml-auto" style="padding-top:20px;">
          <div class="absolute top-2 left-3 bg-white/80 backdrop-blur rounded-2xl p-4 shadow-lg">
            <div class="text-sm font-bold">{{ $cms['about_page_badge1_title'] ?? 'Small Batch' }}</div>
            <div class="text-xs text-[#66645e]">{{ $cms['about_page_badge1_text'] ?? 'Fresh daily' }}</div>
          </div>
          <img src="@if(!empty($cms['about_page_image'])){{ Str::startsWith($cms['about_page_image'],'http') ? $cms['about_page_image'] : route('media.public', ['path' => $cms['about_page_image']], false) }}@else{{ asset('images/baker.jpg') }}@endif" alt="Baker at work" class="w-full h-[420px] md:h-[520px] object-cover object-top rounded-[2rem] shadow-2xl">
          <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-4 shadow-lg">
            <div class="text-sm font-bold">{{ $cms['about_page_badge2_title'] ?? '100% Real' }}</div>
            <div class="text-xs text-[#66645e]">{{ $cms['about_page_badge2_text'] ?? 'No preservatives' }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="px-8 py-20">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="section-title text-4xl md:text-5xl"><span>{{ $cms['about_page_section2_title_before'] ?? 'A Home Bakery' }}</span><br><span class="gradient-headline">{{ $cms['about_page_section2_title_highlight'] ?? 'With Soul' }}</span></h2>
          <p class="text-[#66645e] mt-4 leading-relaxed">
            {{ $cms['about_page_mission'] ?? 'Our flavors are inspired by family gatherings, late-night cravings, and the joy of gifting something handmade. We test every recipe until it feels like a memory.' }}
          </p>
          <div class="mt-8 space-y-4">
            <div class="flex items-start gap-4">
              <span class="material-symbols-outlined text-[#f27d99]">verified</span>
              <div>
                <div class="font-bold">{{ $cms['about_page_feature1_title'] ?? 'Handcrafted Daily' }}</div>
                <div class="text-sm text-[#66645e]">{{ $cms['about_page_feature1_desc'] ?? 'Freshly baked every morning in limited batches.' }}</div>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <span class="material-symbols-outlined text-[#f27d99]">favorite</span>
              <div>
                <div class="font-bold">{{ $cms['about_page_feature2_title'] ?? 'Ingredient First' }}</div>
                <div class="text-sm text-[#66645e]">{{ $cms['about_page_feature2_desc'] ?? 'Real butter, real chocolate, zero preservatives.' }}</div>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <span class="material-symbols-outlined text-[#f27d99]">redeem</span>
              <div>
                <div class="font-bold">{{ $cms['about_page_feature3_title'] ?? 'Gift Ready' }}</div>
                <div class="text-sm text-[#66645e]">{{ $cms['about_page_feature3_desc'] ?? 'Beautifully packed for every celebration.' }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <img src="@if(!empty($cms['about_page_gallery_image1'])){{ Str::startsWith($cms['about_page_gallery_image1'],'http') ? $cms['about_page_gallery_image1'] : route('media.public', ['path' => $cms['about_page_gallery_image1']], false) }}@else{{ asset('images/1.jpg') }}@endif" alt="Dessert closeup" class="rounded-2xl shadow-lg">
          <img src="@if(!empty($cms['about_page_gallery_image2'])){{ Str::startsWith($cms['about_page_gallery_image2'],'http') ? $cms['about_page_gallery_image2'] : route('media.public', ['path' => $cms['about_page_gallery_image2']], false) }}@else{{ asset('images/2.jpg') }}@endif" alt="Dessert slice" class="rounded-2xl shadow-lg translate-y-6">
          <img src="@if(!empty($cms['about_page_gallery_image3'])){{ Str::startsWith($cms['about_page_gallery_image3'],'http') ? $cms['about_page_gallery_image3'] : route('media.public', ['path' => $cms['about_page_gallery_image3']], false) }}@else{{ asset('images/3.jpg') }}@endif" alt="Baked treats" class="rounded-2xl shadow-lg">
          <img src="@if(!empty($cms['about_page_gallery_image4'])){{ Str::startsWith($cms['about_page_gallery_image4'],'http') ? $cms['about_page_gallery_image4'] : route('media.public', ['path' => $cms['about_page_gallery_image4']], false) }}@else{{ asset('images/4.jpg') }}@endif" alt="Sweet bites" class="rounded-2xl shadow-lg translate-y-6">
        </div>
      </div>
    </section>

    <section class="px-8 py-20 bg-[#f7f3e9]">
      <div class="max-w-7xl mx-auto text-center">
        <span class="pill inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full">{{ $cms['about_page_process_pill'] ?? 'Our Process' }}</span>
        <h2 class="section-title text-4xl md:text-5xl mt-4">{{ $cms['about_page_process_title'] ?? 'From Kitchen to Door' }}</h2>
        <p class="text-[#66645e] max-w-2xl mx-auto mt-4">{{ $cms['about_page_process_desc'] ?? 'Every step is designed to keep your desserts fresh, beautiful, and ready to celebrate.' }}</p>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="soft-card rounded-2xl p-6 text-left">
            <div class="text-sm font-bold text-[#f27d99]">01</div>
            <h3 class="font-bold text-xl mt-2">{{ $cms['about_page_process1_title'] ?? 'Small Batch Bake' }}</h3>
            <p class="text-sm text-[#66645e] mt-2">{{ $cms['about_page_process1_desc'] ?? 'We bake in limited batches so every bite tastes like it came straight from the oven.' }}</p>
          </div>
          <div class="soft-card rounded-2xl p-6 text-left">
            <div class="text-sm font-bold text-[#f27d99]">02</div>
            <h3 class="font-bold text-xl mt-2">{{ $cms['about_page_process2_title'] ?? 'Hand Finish' }}</h3>
            <p class="text-sm text-[#66645e] mt-2">{{ $cms['about_page_process2_desc'] ?? 'Each item is hand-finished with toppings, sauces, and a final quality check.' }}</p>
          </div>
          <div class="soft-card rounded-2xl p-6 text-left">
            <div class="text-sm font-bold text-[#f27d99]">03</div>
            <h3 class="font-bold text-xl mt-2">{{ $cms['about_page_process3_title'] ?? 'Pack & Deliver' }}</h3>
            <p class="text-sm text-[#66645e] mt-2">{{ $cms['about_page_process3_desc'] ?? 'We package with care so your treats arrive photo-ready and fresh.' }}</p>
          </div>
        </div>
      </div>
    </section>

    <section class="px-8 py-20">
      <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div class="soft-card rounded-[2rem] p-8 md:p-10">
          <h3 class="section-title text-3xl">{{ $cms['about_page_founder_title'] ?? 'Meet the Maker' }}</h3>
          <p class="text-[#66645e] mt-4">{{ $cms['about_page_founder_desc'] ?? 'Hi, I am Ayesha. I started Current Cravings after years of baking for family and friends. My goal is to make desserts that feel like a hug.' }}</p>
          <div class="mt-6 flex flex-wrap gap-3">
            <span class="pill px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">{{ $cms['about_page_founder_tag1'] ?? 'Founder' }}</span>
            <span class="pill px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">{{ $cms['about_page_founder_tag2'] ?? 'Recipe Developer' }}</span>
            <span class="pill px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">{{ $cms['about_page_founder_tag3'] ?? 'Taste Tester' }}</span>
          </div>
        </div>
        <div class="relative">
          <img src="@if(!empty($cms['about_page_founder_image'])){{ Str::startsWith($cms['about_page_founder_image'],'http') ? $cms['about_page_founder_image'] : route('media.public', ['path' => $cms['about_page_founder_image']], false) }}@else{{ asset('images/profile image.jpg') }}@endif" alt="Founder" class="w-full rounded-[2rem] shadow-2xl">
          <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-4 shadow-lg">
            <div class="text-sm font-bold">{{ $cms['about_page_founder_badge_title'] ?? 'Baked with love' }}</div>
            <div class="text-xs text-[#66645e]">{{ $cms['about_page_founder_badge_text'] ?? 'Every single day' }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="px-8 py-20 bg-[#fff0f4]">
      <div class="max-w-7xl mx-auto text-center">
        <h2 class="section-title text-4xl md:text-5xl">{{ $cms['about_page_final_title'] ?? 'Ready for a Sweet Moment?' }}</h2>
        <p class="text-[#66645e] max-w-2xl mx-auto mt-4">{{ $cms['about_page_final_desc'] ?? 'Choose your favorites or let us surprise you with a curated box.' }}</p>
        <div class="mt-8 flex flex-wrap justify-center gap-4">
          <a href="{{ $cms['about_page_final_cta1_url'] ?? route('menu.index') }}" class="bg-[#f27d99] text-white px-8 py-3 rounded-full font-bold hover:scale-105 transition-transform">{{ $cms['about_page_final_cta1_text'] ?? 'Shop the Menu' }}</a>
          <a href="{{ $cms['about_page_final_cta2_url'] ?? route('boxes.build') }}" class="border-2 border-[#f27d99] text-[#f27d99] px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors">{{ $cms['about_page_final_cta2_text'] ?? 'Gift a Box' }}</a>
        </div>
      </div>
    </section>


@endsection

