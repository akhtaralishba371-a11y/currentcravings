
<?php use Illuminate\Support\Str; ?>

<?php $__env->startPush('styles'); ?>
<style>
 #section-hero .hero-copy {
  position: relative;
  z-index: 3;
 }
 #section-hero {
  background: radial-gradient(ellipse at 30% 40%, #fff8f0 0%, #fff0f4 45%, #fde8ee 100%);
  position: relative;
  isolation: isolate;
  padding-top: calc(var(--cc-header-offset, 88px) + 22px) !important;
 }
 @media (max-width: 767px) {
  #section-hero {
   padding-top: calc(var(--cc-header-offset, 72px) + 20px) !important;
  }
 }
 #section-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
   radial-gradient(ellipse 380px 300px at 8% 18%, rgba(242,125,153,0.18) 0%, transparent 70%),
   radial-gradient(ellipse 400px 300px at 92% 85%, rgba(252,212,126,0.22) 0%, transparent 70%),
   radial-gradient(ellipse 260px 200px at 18% 80%, rgba(190,244,88,0.13) 0%, transparent 70%),
   radial-gradient(ellipse 320px 250px at 88% 12%, rgba(242,125,153,0.14) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
 }
 #section-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
   linear-gradient(135deg, rgba(242,125,153,0.07) 0%, transparent 55%),
   linear-gradient(315deg, rgba(252,212,126,0.08) 0%, transparent 55%);
  pointer-events: none;
  z-index: 0;
 }
  #hero-eyebrow {
   display: inline-flex !important;
   align-items: center;
  gap: 8px;
  width: fit-content;
  padding: 0;
  border: none;
  border-radius: 0;
  background: linear-gradient(135deg, #e8627d 0%, #f27d99 32%, #f6a76b 68%, #d88c35 100%);
  background-size: 220% 220%;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  color: #d97745 !important;
  text-shadow: none;
  box-shadow: none;
  animation: gradientShift 4s ease infinite;
 }
 #hero-title-wrap h1,
 #hero-title-wrap h2 {
  color: #393832 !important;
  text-shadow: 0 3px 18px rgba(255,255,255,0.3);
 }
 #hero-title-main,
 #hero-title-sub {
  color: #393832 !important;
 }
 #hero-title-sub {
  color: #5a564f !important;
 }
 #hero-title-brand {
  color: #e8627d;
  background: linear-gradient(135deg, #ef6d92 0%, #f27d99 24%, #f6a76b 58%, #e8627d 100%);
  background-size: 220% 220%;
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0 10px 30px rgba(232,98,125,0.14);
 }
 #hero-desc {
  color: #5f5a53 !important;
  max-width: 40rem;
 }
 @keyframes glowPulse { 0%,100%{box-shadow:0 0 0 0 rgba(242,125,153,0.5)} 50%{box-shadow:0 0 0 14px rgba(242,125,153,0)} }
 .glow-btn { animation: glowPulse 2.5s ease-in-out infinite; }
 .glow-btn:hover { box-shadow:0 0 20px rgba(242,125,153,0.6),0 0 40px rgba(242,125,153,0.3); transform:translateY(-3px) scale(1.05); }
 .morph-btn { position:relative; overflow:hidden; transition:all 0.4s cubic-bezier(0.34,1.56,0.64,1); }
 .morph-btn::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,rgba(255,255,255,0.25) 0%,transparent 60%); transform:translateX(-120%) skewX(-15deg); transition:transform 0.5s ease; }
 .morph-btn:hover::before { transform:translateX(200%) skewX(-15deg); }
 .morph-btn:hover { letter-spacing:0.04em; }
 .btn-arrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  border-radius: 999px;
  background: linear-gradient(135deg, #f27d99, #e8627d);
  color: #fff !important;
  font-family: 'Epilogue', sans-serif;
  font-weight: 800;
  font-size: 13px;
  letter-spacing: 0.04em;
  text-decoration: none;
  position: relative;
  overflow: hidden;
  transition: box-shadow 0.3s ease, transform 0.3s ease;
  box-shadow: 0 4px 18px rgba(242,125,153,0.35);
 }
 .btn-arrow::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,0.18);
  transform: translateX(-110%) skewX(-15deg);
  transition: transform 0.45s ease;
 }
 .btn-arrow:hover::before { transform: translateX(120%) skewX(-15deg); }
 .btn-arrow:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(242,125,153,0.5); }
 .btn-arrow .btn-arrow-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 26px;
  height: 26px;
  border-radius: 50%;
  background: rgba(255,255,255,0.25);
  transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), background 0.3s ease;
 }
 .btn-arrow:hover .btn-arrow-icon { transform: translateX(4px); background: rgba(255,255,255,0.4); }
 @keyframes burstOut { to{ transform:translate(var(--bx),var(--by)) scale(0); opacity:0; } }
 .burst-particle { position:fixed; pointer-events:none; z-index:9999; width:8px; height:8px; border-radius:50%; animation:burstOut 0.7s ease-out forwards; }
 .ts-shell {
  position: relative !important;
  overflow: hidden !important;
  padding: 42px 0 12px !important;
  margin-top: -18px !important;
 }
 .ts-outer {
  position: relative !important;
  overflow: visible !important;
  padding: 0 !important;
 }
  .ts-track {
   display: flex !important;
   gap: 20px !important;
   width: max-content !important;
   animation: tsMarquee 32s linear infinite !important;
   padding: 10px 0 8px !important;
  }
 .ts-outer:hover .ts-track {
  animation-play-state: paused !important;
 }
 .ts-card {
  width: 300px !important;
  flex-shrink: 0 !important;
  background: #fff !important;
  border-radius: 18px !important;
  padding: 30px 22px 22px !important;
  border: 1px solid rgba(242,125,153,0.15) !important;
  box-shadow: 0 4px 20px rgba(242,125,153,0.08) !important;
  position: relative !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
  overflow: visible !important;
 }
 .ts-card:hover {
  transform: translateY(-6px) !important;
  box-shadow: 0 16px 40px rgba(242,125,153,0.18) !important;
 }
 .ts-featured {
  background: linear-gradient(135deg, #f27d99, #e8627d) !important;
 }
 .ts-qicon {
  position: absolute !important;
  top: -14px !important;
  right: 16px !important;
  width: 32px !important;
  height: 32px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
 }
 .ts-stars {
  color: #facc15 !important;
  font-size: 14px !important;
  margin-bottom: 10px !important;
 }
 .ts-text {
  font-size: 13px !important;
  line-height: 1.65 !important;
  color: #66645e !important;
  margin-bottom: 16px !important;
 }
 .ts-author {
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
  border-top: 1px solid rgba(242,125,153,0.12) !important;
  padding-top: 14px !important;
 }
 .ts-featured .ts-author {
  border-top-color: rgba(255,255,255,0.2) !important;
 }
 .ts-avatar {
  width: 34px !important;
  height: 34px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-weight: 900 !important;
  font-size: 13px !important;
  color: #fff !important;
  flex-shrink: 0 !important;
 }
 .ts-name {
  font-weight: 700 !important;
  font-size: 13px !important;
  color: #393832 !important;
 }
 .ts-loc {
  font-size: 11px !important;
  color: #9c9385 !important;
 }
 .ts-featured .ts-name {
  color: #fff !important;
 }
  .ts-featured .ts-loc {
   color: rgba(255,255,255,0.65) !important;
  }
  #section-testimonials {
   scroll-margin-top: calc(var(--cc-header-offset) + 72px);
  }
  #section-testimonials .ts-heading-wrap {
   position: relative;
   z-index: 2;
   padding-top: 22px;
  }
  @supports not ((-webkit-background-clip: text) or (background-clip: text)) {
   #hero-eyebrow {
    color: #d97745 !important;
    background: none !important;
   }
  #hero-title-brand {
   color: #e8627d !important;
   background: none !important;
  }
 }
  @media (max-width: 767px) {
   #hero-eyebrow {
    padding: 0;
    font-size: 11px !important;
    letter-spacing: 0.16em;
  }
  #hero-title-wrap h1,
  #hero-title-wrap h2 {
   line-height: 0.98 !important;
  }
  #hero-title-sub {
   display: inline-block;
   margin-top: 4px;
  }
   #hero-desc {
    color: #58534d !important;
   }
   .ts-card {
    width: 260px !important;
    padding: 26px 18px 18px !important;
   }
   .ts-track {
    gap: 14px !important;
    padding: 8px 0 8px !important;
   }
   .ts-shell {
    padding: 34px 0 10px !important;
    margin-top: -14px !important;
   }
   #section-testimonials .ts-heading-wrap {
    padding-top: 14px;
   }
  }
</style>
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>




 <!-- 1. Hero -->
  <section class="relative w-full min-h-[520px] sm:min-h-[720px] lg:min-h-[820px] flex items-start overflow-hidden" id="section-hero">
  <div class="morph-blob w-96 h-96 bg-primary" style="left:-5%;"></div>
  <div class="morph-blob w-80 h-80 bg-secondary-container" style="bottom:5%;right:10%;animation-delay:4s;"></div>
  <div style="position:absolute;inset:0;pointer-events:none;z-index:0; padding-top:30px;">
   <svg style="position:absolute;left:0;top:0;width:100%;height:100%;" fill="none" viewBox="0 0 500 800" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 0H420C420 0 350 100 450 150C550 200 400 320 380 450C360 580 500 650 500 800H0V0Z" fill="#ffb780" fill-opacity="0.18"></path>
   </svg>
   <svg style="position:absolute;right:0;bottom:0;width:100%;height:100%;" fill="none" viewBox="0 0 600 500" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M600 500H0C0 500 100 450 80 350C60 250 200 150 400 100C600 50 600 0 600 0V500Z" fill="#ffab69" fill-opacity="0.12"></path>
   </svg>
  </div>
  <div class="w-full max-w-7xl mx-auto px-4 sm:px-8 grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-center relative z-10 hero-grid">
   <div class="z-10 hero-copy">
    <span id="hero-eyebrow" class="reveal hero-swap-target font-bold tracking-widest uppercase text-sm mb-4 block" style="color:#FCD47E;animation-delay:0.1s"><?php echo e($cms['hero_eyebrow'] ?? 'Artisan Bakery Since 2018'); ?></span>
    <div id="hero-title-wrap">
     <h1 class="font-headline text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-on-surface tracking-tighter leading-[0.9] mb-6 sm:mb-8">
      <span id="hero-title-main" class="hero-swap-target"><?php echo e($cms['hero_title_main'] ?? 'Homemade Desserts'); ?></span> <br>
      <span id="hero-title-sub" class="hero-swap-target"><?php echo e($cms['hero_title_sub'] ?? 'in Kettering by'); ?></span>
      <span class="inline-block hover:scale-110 transition-transform cursor-default relative glitch-hover">
       <span id="hero-title-brand" class="hero-swap-target gradient-headline"><?php echo e($cms['hero_title_brand'] ?? 'Current Cravings'); ?></span>
       <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none">
        <path d="M2 6 Q50 2 100 6 Q150 10 198 4" stroke="#f27d99" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.5"/>
       </svg>
      </span>
     </h1>
    </div>
    <p id="hero-desc" class="hero-swap-target text-on-surface-variant text-base sm:text-lg max-w-md mb-8 sm:mb-10 leading-relaxed reveal delay-300">
     <?php echo e($cms['hero_desc'] ?? 'Enjoy our freshly baked treats, from soft, chewy cookies and rich, fudgy brownies to irresistibly moist tres leches cakes. Every bite is made with love, bringing the warmth of home and the sweetness you crave.'); ?>

    </p>
    <div class="flex flex-wrap gap-3 sm:gap-4 reveal delay-400 hero-cta">
     <a href="<?php echo e(route('menu.index')); ?>" class="inline-flex items-center justify-center bg-primary text-on-primary px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold hover:bg-primary-dim transition-all hover:scale-105 editorial-shadow glow-btn morph-btn burst-cta">Shop Now</a>
     <a href="<?php echo e(route('about')); ?>" class="inline-flex items-center justify-center bg-surface-container-lowest text-primary px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold border-2 border-primary/20 hover:bg-surface-container-low transition-all hover:border-primary/50 morph-btn">Our Story</a>
    </div>
   </div>
   <div class="relative flex justify-center lg:justify-end md:-translate-y-4 lg:-translate-y-14 hero-media">
    <div class="relative w-full max-w-[380px] sm:max-w-[500px] md:max-w-[600px] h-[220px] sm:h-[340px] md:h-[500px] transform transition-transform hover:scale-105 duration-700 hero-main">
     <img id="hero-main-image" alt="Fresh bakery basket" class="w-full h-full object-contain drop-shadow-2xl transition-transform duration-500" src="<?php echo e(asset('images/main image redesign.png')); ?>"/>
    </div>
    <div class="absolute bottom-0 right-0 w-full max-w-xs sm:max-w-sm md:max-w-lg hidden sm:block md:translate-y-16 lg:translate-y-24 hero-thumbs">
     <div class="bg-white/40 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/40 shadow-xl">
      <div class="flex items-center justify-between mb-3 sm:mb-4">
       <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-orange-950">Our category</h4>
       <div class="flex gap-2"><div class="w-8 h-1 bg-white/50 rounded-full"></div><div class="w-4 h-1 bg-orange-950 rounded-full"></div></div>
      </div>
      <div class="grid grid-cols-4 gap-2 sm:gap-3">
       <div class="aspect-square rounded-lg bg-orange-100 overflow-hidden"><img class="w-full h-full object-cover hero-category-thumb cursor-pointer transition-transform hover:scale-105" data-hero-src="<?php echo e(asset('images/Untitled design (1)/2.png')); ?>" data-hero-eyebrow="Artisan Bakery Since 2018" data-hero-title-main="Homemade Desserts" data-hero-title-sub="in Kettering by" data-hero-title-brand="Current Cravings" data-hero-desc="Handcrafted delights made with heritage grains and seasonal ingredients. From our hearth to your heart." src="<?php echo e(asset('images/Untitled design (1)/2.png')); ?>"/></div>
       <div class="aspect-square rounded-lg bg-orange-100 overflow-hidden"><img class="w-full h-full object-cover hero-category-thumb cursor-pointer transition-transform hover:scale-105" data-hero-src="<?php echo e(asset('images/Untitled design (1)/3.png')); ?>" data-hero-eyebrow="Best Seller" data-hero-title-main="Signature Cookies" data-hero-title-sub="Baked fresh today at" data-hero-title-brand="Current Cravings" data-hero-desc="Golden edges, soft centers, and rich butter notes with a melt-in-your-mouth finish." src="<?php echo e(asset('images/Untitled design (1)/3.png')); ?>"/></div>
       <div class="aspect-square rounded-lg bg-orange-100 overflow-hidden"><img class="w-full h-full object-cover hero-category-thumb cursor-pointer transition-transform hover:scale-105" data-hero-src="<?php echo e(asset('images/Untitled design (1)/4.png')); ?>" data-hero-eyebrow="Limited Batch" data-hero-title-main="Brownie Bliss" data-hero-title-sub="Fudgy & deep from" data-hero-title-brand="Current Cravings" data-hero-desc="Dense, crackly tops and intense cocoa flavor — made for true chocolate lovers." src="<?php echo e(asset('images/Untitled design (1)/4.png')); ?>"/></div>
       <div class="aspect-square rounded-lg bg-orange-100 overflow-hidden"><img class="w-full h-full object-cover hero-category-thumb cursor-pointer transition-transform hover:scale-105" data-hero-src="<?php echo e(asset('images/Untitled design (1)/1.png')); ?>" data-hero-eyebrow="Fan Favorite" data-hero-title-main="Celebration Cakes Layered" data-hero-title-sub=" with love at" data-hero-title-brand="Current Cravings" data-hero-desc="Soft sponge layers, silky frosting, and a finish that feels like a party." src="<?php echo e(asset('images/Untitled design (1)/1.png')); ?>"/></div>
      </div>
     </div>
    </div>
   </div>
  </div>
  </section>

 <!-- 2. Cookie Banner -->
 <section class="px-4 sm:px-8 pt-14 sm:pt-16 pb-12 sm:pb-16 bg-[#fff0f4] overflow-visible" id="section-cookie">
  <div class="max-w-7xl mx-auto relative">
   <div class="py-6 sm:py-8 bg-[#f7a8b8] text-white rounded-[2rem] sm:rounded-[3rem] p-6 sm:p-8 md:p-12 flex flex-col md:flex-row items-center editorial-shadow overflow-visible noise-overlay reveal relative cookie-banner" style="animation-delay:0.1s">
    <div class="flex-1 z-10 w-full">
     <h2 class="font-headline text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-black mb-4 leading-[1.1] uppercase tracking-tight reveal-left" style="animation-delay:0.2s"><?php echo e($cms['banner_title'] ?? 'White Choco Cookie'); ?></h2>
     <p class="text-white/90 text-base sm:text-lg md:text-xl mb-6 leading-relaxed max-w-md reveal delay-300"><?php echo e($cms['banner_desc'] ?? "Soft and chewy cookies loaded with creamy white chocolate chips, offering a sweet and buttery flavor that's simply irresistible."); ?></p>
     <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 reveal delay-400">
      <a href="<?php echo e(route('blog.index')); ?>" class="inline-flex items-center justify-center border-2 border-white/40 text-white px-8 py-3 sm:py-4 rounded-full font-bold hover:bg-white/10 transition-all hover:scale-105 hover:border-white/70">Learn More</a>
      <a href="<?php echo e(route('cart.index')); ?>" class="inline-flex items-center justify-center bg-[#dcf3f3] text-[#2d4a4a] px-8 py-3 sm:py-4 rounded-full font-bold hover:scale-105 transition-all editorial-shadow hover:shadow-lg">Order Now</a>
     </div>
    </div>
    <div class="flex-1 relative w-full mt-8 md:mt-0 z-10 flex justify-center cookie-hero-media">
     <div class="relative w-full max-w-[280px] sm:max-w-[360px] md:absolute md:right-0 md:top-1/2 md:-translate-y-1/2 md:w-[120%] md:max-w-[380px]">
      <img alt="White Chocolate Cookie" class="w-full h-auto drop-shadow-2xl animate-float-gentle hover:scale-105 transition-transform duration-500 cookie-hero-img" src="<?php echo e(asset('images/Layer-3.webp')); ?>">
     </div>
    </div>
   </div>
  </div>
 </section>

 <!-- 3. Products -->
 <section class="px-4 sm:px-8 py-16 sm:py-24 bg-surface-container-low" id="section-products">
  <div class="max-w-7xl mx-auto">
   <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-6 mb-10 sm:mb-16">
    <div class="menu-copy-box">
     <div class="section-line w-12 mb-3 reveal" style="animation-delay:0s"></div>
     <h3 class="menu-title text-on-surface text-left reveal" style="animation-delay:0.1s">FROM OUR <span class="gradient-headline">HOME TO</span> YOUR DOORSTEP</h3>
     <p class="menu-desc text-on-surface-variant mt-2 text-left reveal delay-200">Treat your friends, fam, and even your coworkers to limited-edition and best-selling treats.<br><span class="menu-highlight">For a limited-time, enjoy free standard shipping on orders $100+!</span></p>
    </div>
    <a class="btn-arrow reveal delay-300 shrink-0" href="<?php echo e(route('menu.index')); ?>">
     <span>View All Menu</span>
     <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
    </a>
   </div>
   <div id="productsGrid" class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
    <div class="group bg-surface-container-lowest p-4 rounded-lg editorial-shadow hover-scale-card holo-card reveal delay-100" style="position:relative">
     <div class="card-shine"></div>
     <div class="rounded-lg overflow-hidden mb-4 sm:mb-6 h-48 sm:h-64 relative">
      <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo e(asset('images/3.jpg')); ?>" alt="MNM Cookies">
      <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
     </div>
     <h3 class="font-headline text-xl font-bold mb-1">Cookies</h3>
     <p class="text-on-surface-variant text-sm mb-4">Treat your friends, fam, and even your coworkers to limited-edition and best-selling treats.</p>
     <div class="flex justify-between items-center">
      <span class="shimmer-price font-bold text-lg">$3.50</span>
      <button class="bg-secondary-container text-on-secondary-container p-2 rounded-full material-symbols-outlined hover:rotate-12 hover:scale-110 transition-all duration-300 active:scale-95"
              data-add-to-cart="1"
              data-open-cart="1"
              data-name="MNM Cookies"
              data-price="3.50"
              data-category="cookies"
              data-image="<?php echo e(asset('images/3.jpg')); ?>">add_shopping_cart</button>
     </div>
    </div>
    <div class="group bg-surface-container-lowest p-4 rounded-lg editorial-shadow hover-scale-card holo-card reveal delay-200" style="position:relative">
     <div class="card-shine"></div>
     <div class="rounded-lg overflow-hidden mb-4 sm:mb-6 h-48 sm:h-64 relative">
      <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo e(asset('images/4.jpg')); ?>" alt="Tres Leches">
      <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
     </div>
     <h3 class="font-headline text-xl font-bold mb-1">Tres Leches</h3>
     <p class="text-on-surface-variant text-sm mb-4">Treat your friends, fam, and even your coworkers to limited-edition and best-selling treats.</p>
     <div class="flex justify-between items-center">
      <span class="shimmer-price font-bold text-lg">$8.00</span>
      <button class="bg-secondary-container text-on-secondary-container p-2 rounded-full material-symbols-outlined hover:rotate-12 hover:scale-110 transition-all duration-300 active:scale-95"
              data-add-to-cart="1"
              data-open-cart="1"
              data-name="Tres Leches"
              data-price="8.00"
              data-category="tres-leches"
              data-image="<?php echo e(asset('images/4.jpg')); ?>">add_shopping_cart</button>
     </div>
    </div>
    <div class="group bg-surface-container-lowest p-4 rounded-lg editorial-shadow hover-scale-card holo-card reveal delay-300" style="position:relative">
     <div class="card-shine"></div>
     <div class="rounded-lg overflow-hidden mb-4 sm:mb-6 h-48 sm:h-64 relative">
      <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo e(asset('images/2.jpg')); ?>" alt="Double Choco Brownies">
      <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
     </div>
     <h3 class="font-headline text-xl font-bold mb-1">Brownies</h3>
     <p class="text-on-surface-variant text-sm mb-4">Treat your friends, fam, and even your coworkers to limited-edition and best-selling treats.</p>
     <div class="flex justify-between items-center">
      <span class="shimmer-price font-bold text-lg">$3.50</span>
      <button class="bg-secondary-container text-on-secondary-container p-2 rounded-full material-symbols-outlined hover:rotate-12 hover:scale-110 transition-all duration-300 active:scale-95"
              data-add-to-cart="1"
              data-open-cart="1"
              data-name="Double Choco Brownies"
              data-price="3.50"
              data-category="brownies"
              data-image="<?php echo e(asset('images/2.jpg')); ?>">add_shopping_cart</button>
     </div>
    </div>
    <div class="group bg-surface-container-lowest p-4 rounded-lg editorial-shadow hover-scale-card holo-card reveal delay-400" style="position:relative">
     <div class="card-shine"></div>
     <div class="rounded-lg overflow-hidden mb-4 sm:mb-6 h-48 sm:h-64 relative">
      <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo e(asset('images/1.jpg')); ?>" alt="Drinks">
      <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
     </div>
     <h3 class="font-headline text-xl font-bold mb-1">Drinks</h3>
     <p class="text-on-surface-variant text-sm mb-4">Treat your friends, fam, and even your coworkers to limited-edition and best-selling treats.</p>
     <div class="flex justify-between items-center">
      <span class="shimmer-price font-bold text-lg">$4.50</span>
      <button class="bg-secondary-container text-on-secondary-container p-2 rounded-full material-symbols-outlined hover:rotate-12 hover:scale-110 transition-all duration-300 active:scale-95"
              data-add-to-cart="1"
              data-open-cart="1"
              data-name="Drinks"
              data-price="4.50"
              data-category="drinks"
              data-image="<?php echo e(asset('images/1.jpg')); ?>">add_shopping_cart</button>
     </div>
    </div>
   </div>
  </div>
 </section>

 <!-- 4. Kunafa Banner -->
 <section class="px-4 sm:px-8 py-10 sm:py-16" id="section-kunafa">
  <div class="max-w-7xl mx-auto rounded-xl overflow-hidden relative min-h-[360px] sm:min-h-[500px] flex items-center p-8 sm:p-12 md:p-24 group reveal">
   <div class="absolute inset-0 bg-gradient-to-r from-on-surface/80 to-transparent z-10"></div>
   <img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" src="<?php echo e(asset('images/kunafa brownie.png')); ?>" alt="Kunafa Brownie">
   <div class="relative z-20 max-w-xl text-on-primary">
    <span class="bg-secondary text-on-secondary px-4 py-1 rounded-full text-xs font-bold uppercase mb-4 sm:mb-6 inline-block animate-bounce">Limited Edition</span>
    <h2 class="font-headline text-4xl sm:text-5xl md:text-6xl font-black mb-4 sm:mb-6 tracking-tighter reveal-left delay-200 glitch-hover">Kunafa Brownie</h2>
    <p class="text-base sm:text-xl opacity-90 mb-6 sm:mb-10 leading-relaxed reveal delay-300">A rich fusion of crispy golden kunafa layers and indulgent, gooey brownie — crafted to deliver the perfect balance of crunch and pure dessert bliss.</p>
    <a href="<?php echo e(route('menu.show', 'brownies')); ?>" class="inline-flex items-center justify-center bg-primary px-6 sm:px-8 py-3 sm:py-4 rounded-full font-bold editorial-shadow hover:scale-110 transition-transform text-on-primary glow-btn reveal delay-400">Experience the Crunch</a>
   </div>
  </div>
 </section>

 <!-- 5. Features -->
 <section class="py-12 sm:py-16 md:py-20 px-4 sm:px-6" id="section-features">
  <div class="max-w-5xl mx-auto text-center">
   <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-bold mb-10 sm:mb-16 text-explosion">What Makes Our Desserts Unique</h2>
   <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-12">
    <div class="flex flex-col items-center slide-stagger delay-100">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden flex items-center justify-center mb-4 sm:mb-6 feature-icon-wrap border border-primary/10 bg-white shadow-sm">
      <img src="<?php echo e(asset('images/halal food.jpg')); ?>" alt="100% Halal" class="w-full h-full object-cover scale-125">
     </div>
     <h4 class="font-headline font-bold text-lg sm:text-xl mb-2 sm:mb-3">100% Halal</h4>
     <p class="text-on-surface-variant text-sm sm:text-base">We use only certified halal ingredients for your peace of mind.</p>
    </div>
    <div class="flex flex-col items-center slide-stagger delay-200">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden flex items-center justify-center mb-4 sm:mb-6 feature-icon-wrap border border-primary/10 bg-white shadow-sm">
      <img src="<?php echo e(asset('images/guiltfree.jpg')); ?>" alt="Guilt-Free Options" class="w-full h-full object-cover scale-125">
     </div>
     <h4 class="font-headline font-bold text-lg sm:text-xl mb-2 sm:mb-3">Guilt-Free Options</h4>
     <p class="text-on-surface-variant text-sm sm:text-base">Selected low carb and keto-friendly treats available daily.</p>
    </div>
    <div class="flex flex-col items-center slide-stagger delay-300">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden flex items-center justify-center mb-4 sm:mb-6 feature-icon-wrap border border-primary/10 bg-white shadow-sm">
      <img src="<?php echo e(asset('images/zero preservatives.jpg')); ?>" alt="Zero Preservatives" class="w-full h-full object-cover scale-125">
     </div>
     <h4 class="font-headline font-bold text-lg sm:text-xl mb-2 sm:mb-3">Zero Preservatives</h4>
     <p class="text-on-surface-variant text-sm sm:text-base">Freshly made with real ingredients, just like at home.</p>
    </div>
   </div>
  </div>
 </section>

 <!-- 6. About -->
 <section class="px-4 sm:px-8 py-16 sm:py-24 bg-surface-container" id="section-about">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 sm:gap-20 items-center">
   <div class="relative group reveal-left">
    <div class="absolute -bottom-6 -left-6 w-full h-full border-4 border-secondary/20 rounded-xl group-hover:translate-x-2 group-hover:-translate-y-2 transition-transform duration-500 hidden sm:block"></div>
    <img class="relative rounded-xl w-full h-[300px] sm:h-[450px] md:h-[600px] object-cover editorial-shadow transition-transform duration-700 group-hover:scale-[1.02]" src="<?php echo e(asset('images/baker.jpg')); ?>" alt="Chef Elena">
   </div>
   <div class="reveal-right delay-100">
    <div class="section-line w-12 mb-4 reveal"></div>
    <h2 class="font-headline text-3xl sm:text-4xl md:text-5xl font-black text-on-surface tracking-tighter mb-6 sm:mb-8 leading-tight">
     About Bakery <span class="text-primary inline-block hover:scale-110 transition-transform">Owner</span>
    </h2>
    <p class="text-lg sm:text-xl text-on-surface-variant italic mb-6 sm:mb-8">"<?php echo e($cms['about_quote'] ?? 'Baking is a conversation between science and the soul.'); ?>"</p>
    <div class="space-y-4 sm:space-y-6 text-base sm:text-lg text-on-surface-variant leading-relaxed">
     <p><?php echo e($cms['about_text1'] ?? 'Chef Elena started The Confectionary in her small home kitchen with just a single sourdough starter and a passion for nostalgic flavors.'); ?></p>
     <p><?php echo e($cms['about_text2'] ?? 'Today, she leads a team of passionate artisans who believe that high-quality ingredients shouldn\'t be a luxury, but a standard.'); ?></p>
    </div>
    <div class="mt-8 sm:mt-12 group flex items-center gap-4">
     <img class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-4 border-primary/20 animate-slow-rotate shrink-0"
          src="<?php if(!empty($cms['about_owner_image'])): ?><?php echo e(Str::startsWith($cms['about_owner_image'],'http') ? $cms['about_owner_image'] : route('media.public', ['path' => $cms['about_owner_image']], false)); ?><?php else: ?><?php echo e(asset('images/profile image.jpg')); ?><?php endif; ?>"
          alt="<?php echo e($cms['about_owner_name'] ?? 'Elena Rodriguez'); ?>">
     <div>
      <h4 class="font-bold text-on-surface group-hover:text-primary transition-colors"><?php echo e($cms['about_owner_name'] ?? 'Elena Rodriguez'); ?></h4>
      <p class="text-sm text-secondary font-bold uppercase tracking-wider"><?php echo e($cms['about_owner_role'] ?? 'Founder & Head Baker'); ?></p>
     </div>
    </div>
   </div>
  </div>
 </section>

 <!-- 7. Tres Leches -->
 <section class="px-3 sm:px-8 py-4 sm:py-6" id="section-tresl">
  <div class="max-w-7xl mx-auto bg-[#f4efe4] rounded-2xl overflow-hidden editorial-shadow reveal group tresl-card">
   <div class="grid grid-cols-1 md:grid-cols-2 items-center">
    <div class="order-2 md:order-2 p-5 sm:p-6 md:p-8">
     <div class="h-1 rounded-full bg-[#f27d99] mb-3 tresl-line"></div>
     <h2 class="font-headline text-2xl sm:text-3xl md:text-4xl font-black leading-tight text-on-surface">Saffron and rose<br>Tres Leches</h2>
     <p class="text-on-surface-variant text-sm sm:text-base mt-3 leading-relaxed max-w-lg">Decadent tres leches cake soaked in a rich blend of three milks, creating a moist and luscious dessert topped with fluffy whipped cream for a delightful finish.</p>
     <a href="<?php echo e(route('menu.show', 'tres-leches')); ?>" class="inline-flex mt-5 sm:mt-6 bg-[#4d6e00] text-white px-6 sm:px-7 py-2 sm:py-2.5 rounded-full font-black uppercase tracking-wider text-xs tresl-btn">Reserve Yours</a>
    </div>
    <div class="order-1 md:order-1 flex items-center justify-center p-4 md:p-4 overflow-visible">
     <img class="w-full max-w-[280px] sm:max-w-[360px] md:max-w-[420px] h-auto drop-shadow-2xl -translate-y-4 sm:-translate-y-6 md:-translate-y-8 tresl-img" src="<?php echo e(asset('images/saffron.png')); ?>" alt="Saffron Rose Tres Leches">
    </div>
    </div>
   </div>
 </section>

 <!-- 8. Unforgettable -->
 <section class="relative bg-[#EAF7D3] py-16 sm:py-24 overflow-visible" id="section-unforgettable">
  <div class="unforgettable-top-fade"></div>
  <div class="pointer-events-none absolute bottom-0 left-0 w-full wave-bottom">
   <svg class="w-full h-12 sm:h-16 md:h-20 unforgettable-wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0,50 Q30,10 60,50 T120,50 T180,50 T240,50 T300,50 T360,50 T420,50 T480,50 T540,50 T600,50 T660,50 T720,50 T780,50 T840,50 T900,50 T960,50 T1020,50 T1080,50 T1140,50 T1200,50 T1260,50 T1320,50 T1380,50 T1440,50 L1440,80 L0,80 Z" fill="#fffbff"></path>
   </svg>
  </div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 text-center">
   <h2 class="font-headline text-2xl sm:text-4xl md:text-5xl font-black text-primary mb-10 sm:mb-16 text-explosion">Let's See What Makes Current Cravings Unforgettable!</h2>
   <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12">
    <div class="flex flex-col items-center text-center gap-3 sm:gap-4 unforgettable-card" style="animation-delay:0.05s">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-on-surface/30 bg-white/50 flex items-center justify-center shadow-sm unforgettable-icon" style="animation-delay:0.1s">
      <span class="material-symbols-outlined text-on-surface-variant text-2xl sm:text-3xl">bakery_dining</span>
     </div>
     <h3 class="font-headline text-base sm:text-lg font-bold">Freshly Made</h3>
     <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed max-w-[14rem]">Baked to perfection and served straight from the oven.</p>
    </div>
    <div class="flex flex-col items-center text-center gap-3 sm:gap-4 unforgettable-card" style="animation-delay:0.15s">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-on-surface/30 bg-white/50 flex items-center justify-center shadow-sm unforgettable-icon" style="animation-delay:0.25s">
      <span class="material-symbols-outlined text-on-surface-variant text-2xl sm:text-3xl">emoji_food_beverage</span>
     </div>
     <h3 class="font-headline text-base sm:text-lg font-bold">Premium Ingredients</h3>
     <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed max-w-[14rem]">Only the finest, hand-selected ingredients go into every bite.</p>
    </div>
    <div class="flex flex-col items-center text-center gap-3 sm:gap-4 unforgettable-card" style="animation-delay:0.25s">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-on-surface/30 bg-white/50 flex items-center justify-center shadow-sm unforgettable-icon" style="animation-delay:0.4s">
      <span class="material-symbols-outlined text-on-surface-variant text-2xl sm:text-3xl">restaurant_menu</span>
     </div>
     <h3 class="font-headline text-base sm:text-lg font-bold">Delicious Variety</h3>
     <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed max-w-[14rem]">A tempting selection that caters to all tastes and cravings.</p>
    </div>
    <div class="flex flex-col items-center text-center gap-3 sm:gap-4 unforgettable-card" style="animation-delay:0.35s">
     <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-on-surface/30 bg-white/50 flex items-center justify-center shadow-sm unforgettable-icon" style="animation-delay:0.55s">
      <span class="material-symbols-outlined text-on-surface-variant text-2xl sm:text-3xl">local_shipping</span>
     </div>
     <h3 class="font-headline text-base sm:text-lg font-bold">Delivery Convenience</h3>
     <p class="text-on-surface-variant text-xs sm:text-sm leading-relaxed max-w-[14rem]">Enjoy your favorites, delivered right to your door with ease.</p>
    </div>
   </div>
  </div>
 </section>

 <!-- 9. Mango Matcha -->
 <section class="px-3 sm:px-6 md:px-12 py-5 sm:py-7" id="section-mango">
  <div class="max-w-7xl mx-auto bg-[#AFCC3C] rounded-xl flex flex-col md:flex-row items-center mango-wrap overflow-hidden">
   <div class="w-full md:w-1/2 p-6 sm:p-8 md:p-11 order-2 md:order-1">
    <span class="text-primary font-bold tracking-widest text-sm uppercase mb-3 sm:mb-4 block" style="color: #3E4F0A;">New on the Menu</span>
    <h2 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 sm:mb-6 tracking-tighter text-explosion">MANGO ICED MATCHA</h2>
    <p class="text-white text-base sm:text-lg mb-6 sm:mb-8 leading-relaxed">Ceremonial grade matcha whisked with fresh mango puree and oat milk. The perfect tropical refresh.</p>
     <a href="<?php echo e(route('menu.show', 'drinks')); ?>" class="inline-flex items-center justify-center bg-[#3E4F0A] text-white px-8 sm:px-10 py-3 sm:py-4 rounded-full font-bold hover:shadow-lg transition-all">Sip the Freshness</a>
   </div>
   <div class="w-full md:w-1/2 h-[400px] sm:h-[500px] md:h-[380px] p-2 md:p-4 flex items-center justify-center overflow-hidden order-1 md:order-2">
    <img alt="Mango Iced Matcha" class="transition-transform duration-700 animate-float-gentle hover:scale-105" style="width:100%;max-width:900px;height:100%;max-height:100%;object-fit:contain;transform:scale(1.1);filter:drop-shadow(0 24px 48px rgba(0,0,0,0.2));" src="<?php echo e(asset('images/mango matcha.png')); ?>"/>
   </div>
  </div>
 </section>

 <!-- 10. Promise -->
 <section class="px-3 sm:px-8 py-6 sm:py-12" id="section-promise">
  <div class="max-w-7xl mx-auto">
   <div class="relative rounded-[2rem] sm:rounded-[3rem] overflow-hidden" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);border:1.5px solid rgba(242,125,153,0.15);box-shadow:0 24px 64px rgba(242,125,153,0.1);">
    <div style="position:absolute;top:-60px;left:-60px;width:300px;height:300px;background:radial-gradient(circle,rgba(242,125,153,0.18),transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-40px;right:-40px;width:250px;height:250px;background:radial-gradient(circle,rgba(190,244,88,0.2),transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:500px;height:500px;background:radial-gradient(circle,rgba(252,212,126,0.1),transparent 60%);pointer-events:none;"></div>
    <div class="relative z-10 px-6 py-10 sm:px-8 sm:py-12 md:px-12 md:py-14 text-center">
     <span class="inline-block font-bold tracking-[0.3em] uppercase text-xs mb-4 px-4 py-2 rounded-full reveal" style="color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);">Our Commitment</span>
     <h2 class="font-headline font-black tracking-tighter mb-3 reveal delay-100" style="font-size:clamp(2rem,6vw,4.2rem);line-height:0.95;color:#2a1a22;">The <span style="background:linear-gradient(135deg,#f27d99,#e8627d,#FCD47E);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Promise</span></h2>
     <div class="w-14 h-1 mx-auto mb-4 sm:mb-6 rounded-full reveal delay-200" style="background:linear-gradient(90deg,#f27d99,#FCD47E);"></div>
     <h3 class="font-headline text-lg sm:text-xl font-black mb-4 sm:mb-5 reveal delay-200" style="color:#393832;">Purity In Every Crumb</h3>
     <p class="text-base sm:text-lg font-light leading-relaxed max-w-2xl mx-auto reveal delay-300" style="color:#66645e;">
      We promise never to use artificial preservatives, bleached flours, or hydrogenated oils. Our bakery is a temple of real food, where the ingredients speak for themselves. If we can't source it responsibly, we don't bake it. Period.
     </p>
     <div class="flex flex-wrap justify-center gap-3 sm:gap-4 mt-6 sm:mt-8 reveal delay-400">
      <div class="flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full" style="background:#f0fce4;border:1px solid rgba(190,244,88,0.4);">
       <span class="material-symbols-outlined text-sm" style="color:#4d6e00;">eco</span>
       <span class="text-xs sm:text-sm font-semibold" style="color:#3a5200;">Zero Preservatives</span>
      </div>
      <div class="flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full" style="background:#fff0f4;border:1px solid rgba(242,125,153,0.3);">
       <span class="material-symbols-outlined text-sm" style="color:#f27d99;">verified</span>
       <span class="text-xs sm:text-sm font-semibold" style="color:#c04060;">100% Halal</span>
      </div>
      <div class="flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full" style="background:#fffbe8;border:1px solid rgba(252,212,126,0.5);">
       <span class="material-symbols-outlined text-sm" style="color:#b06a00;">bakery_dining</span>
       <span class="text-xs sm:text-sm font-semibold" style="color:#7a4800;">Freshly Baked Daily</span>
      </div>
      <div class="flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full" style="background:#fff0f4;border:1px solid rgba(242,125,153,0.3);">
       <span class="material-symbols-outlined text-sm" style="color:#f27d99;">favorite</span>
       <span class="text-xs sm:text-sm font-semibold" style="color:#c04060;">Made with Love</span>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>

  <!-- 11. Testimonials -->
  <section class="pt-24 pb-16 sm:pt-32 sm:pb-24 testimonial-bg" id="section-testimonials" style="overflow:visible;">
   <div class="ts-heading-wrap max-w-7xl mx-auto px-4 sm:px-8 mb-10 sm:mb-14 text-center">
    <span class="inline-block font-bold tracking-[0.3em] uppercase text-xs mb-4 px-4 py-2 rounded-full" style="color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);">Happy Customers</span>
    <h2 class="font-headline text-3xl sm:text-5xl font-black text-on-surface tracking-tighter reveal">Word on the Street</h2>
    <p class="text-on-surface-variant mt-3 text-base sm:text-lg reveal delay-200">Real reviews from real sweet tooths</p>
   </div>
   <div class="ts-shell">
    <div class="ts-outer" style="width:100%;">
     <div class="ts-track" id="tsTrack">

     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#f27d99,#e8627d)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Their Kunafa brownies are life-changing. I drive 40 minutes every weekend just for a batch. Nothing else comes close!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#f27d99,#e8627d)">S</div><div><div class="ts-name">Sarah M.</div><div class="ts-loc">Kettering</div></div></div>
     </div>

     <div class="ts-card ts-featured">
      <div class="ts-qicon" style="background:#fff"><span class="material-symbols-outlined" style="font-size:16px;color:#f27d99;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars" style="color:#fde047">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text" style="color:rgba(255,255,255,0.95)">&ldquo;Elegant, modern, and absolutely delicious. The Saffron Tres Leches is a showstopper &mdash; ordered it for my wedding and everyone asked where it came from!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:rgba(255,255,255,0.2)">M</div><div><div class="ts-name" style="color:#fff">Marcus T.</div><div class="ts-loc" style="color:rgba(255,255,255,0.65)">Northampton</div></div></div>
     </div>

     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#f27d99,#e8627d)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;The cookies are perfectly chewy with crispy edges. Ordered a box for my office and they were gone in 10 minutes. Already placed my next order!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#FCD47E,#e8a020)">J</div><div><div class="ts-name">James L.</div><div class="ts-loc">Wellingborough</div></div></div>
     </div>

     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#bef458,#97b931)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Best brownies I&rsquo;ve ever had, no exaggeration. Fudgy, rich, and the Mango Matcha drink paired with it was absolutely divine.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#bef458,#97b931);color:#3a5200">A</div><div><div class="ts-name">Aisha R.</div><div class="ts-loc">Rushden</div></div></div>
     </div>

     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#fbb6c8,#f27d99)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Ordered a gift box for my mum&rsquo;s birthday &mdash; she cried happy tears! The packaging was gorgeous and everything tasted incredible. 10/10.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#fbb6c8,#f27d99)">Z</div><div><div class="ts-name">Zara K.</div><div class="ts-loc">Corby</div></div></div>
     </div>

     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#FCD47E,#e8a020)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;I&rsquo;ve tried bakeries all over the UK and Current Cravings is genuinely top tier. The White Choco Cookie is soft, buttery perfection.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#FCD47E,#e8a020)">O</div><div><div class="ts-name">Omar F.</div><div class="ts-loc">Brackley</div></div></div>
     </div>

     <!-- duplicate set for seamless loop -->
     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#f27d99,#e8627d)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Their Kunafa brownies are life-changing. I drive 40 minutes every weekend just for a batch. Nothing else comes close!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#f27d99,#e8627d)">S</div><div><div class="ts-name">Sarah M.</div><div class="ts-loc">Kettering</div></div></div>
     </div>
     <div class="ts-card ts-featured">
      <div class="ts-qicon" style="background:#fff"><span class="material-symbols-outlined" style="font-size:16px;color:#f27d99;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars" style="color:#fde047">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text" style="color:rgba(255,255,255,0.95)">&ldquo;Elegant, modern, and absolutely delicious. The Saffron Tres Leches is a showstopper &mdash; ordered it for my wedding and everyone asked where it came from!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:rgba(255,255,255,0.2)">M</div><div><div class="ts-name" style="color:#fff">Marcus T.</div><div class="ts-loc" style="color:rgba(255,255,255,0.65)">Northampton</div></div></div>
     </div>
     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#f27d99,#e8627d)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;The cookies are perfectly chewy with crispy edges. Ordered a box for my office and they were gone in 10 minutes. Already placed my next order!&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#FCD47E,#e8a020)">J</div><div><div class="ts-name">James L.</div><div class="ts-loc">Wellingborough</div></div></div>
     </div>
     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#bef458,#97b931)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Best brownies I&rsquo;ve ever had, no exaggeration. Fudgy, rich, and the Mango Matcha drink paired with it was absolutely divine.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#bef458,#97b931);color:#3a5200">A</div><div><div class="ts-name">Aisha R.</div><div class="ts-loc">Rushden</div></div></div>
     </div>
     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#fbb6c8,#f27d99)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;Ordered a gift box for my mum&rsquo;s birthday &mdash; she cried happy tears! The packaging was gorgeous and everything tasted incredible. 10/10.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#fbb6c8,#f27d99)">Z</div><div><div class="ts-name">Zara K.</div><div class="ts-loc">Corby</div></div></div>
     </div>
     <div class="ts-card">
      <div class="ts-qicon" style="background:linear-gradient(135deg,#FCD47E,#e8a020)"><span class="material-symbols-outlined text-white" style="font-size:16px;font-variation-settings:'FILL' 1;">format_quote</span></div>
      <div class="ts-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p class="ts-text">&ldquo;I&rsquo;ve tried bakeries all over the UK and Current Cravings is genuinely top tier. The White Choco Cookie is soft, buttery perfection.&rdquo;</p>
      <div class="ts-author"><div class="ts-avatar" style="background:linear-gradient(135deg,#FCD47E,#e8a020)">O</div><div><div class="ts-name">Omar F.</div><div class="ts-loc">Brackley</div></div></div>
     </div>

     </div>
    </div>
   </div>
  </section>

 <!-- 12. Community -->
 <section class="w-full py-12 sm:py-16 md:py-24 px-4 sm:px-6 lg:px-12 bg-background flex flex-col items-center gap-10 sm:gap-16" id="section-community">
  <div class="w-full max-w-7xl flex flex-col gap-8 sm:gap-12">
   <div class="flex flex-col items-start gap-3 sm:gap-4 max-w-2xl">
    <span class="font-label text-sm font-bold tracking-[0.05em] text-primary uppercase">The Social Slice</span>
    <h2 class="font-headline text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-[-0.02em] text-primary leading-tight">Our Community</h2>
    <p class="font-body text-base sm:text-lg text-on-surface-variant leading-relaxed">Tag us in your sweetest moments. We love seeing how you enjoy our daily bakes across all our platforms.</p>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12 w-full items-start">
    <!-- Instagram -->
    <div class="flex flex-col gap-8 group">
     <div class="bg-surface-container-low rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-primary/10 h-full">
      <div class="flex items-center justify-between mb-6 sm:mb-8">
       <div class="flex gap-3 sm:gap-4 items-center">
        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-full border-2 border-primary/20 p-1 animate-float shrink-0">
         <img alt="Instagram" class="h-full w-full rounded-full object-cover" src="<?php echo e(asset('images/products/insta.jpg')); ?>"/>
        </div>
        <div>
         <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface">Instagram</h3>
          <p class="font-label text-xs text-primary font-bold">@currentcravings_uk</p>
          <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">Instagram Community</p>
        </div>
       </div>
        <a class="bg-primary text-on-primary h-9 sm:h-10 px-4 sm:px-6 rounded-full font-bold text-xs hover:scale-105 transition-transform shadow-lg shadow-primary/20 shrink-0 inline-flex items-center justify-center" href="https://www.instagram.com/currentcravings_uk" target="_blank" rel="noopener noreferrer">Follow</a>
      </div>
      <div class="grid grid-cols-2 gap-3 sm:gap-4">
       <div class="aspect-square rounded-2xl overflow-hidden relative group/post">
        <img alt="Post" class="w-full h-full object-cover transition-transform duration-700 group-hover/post:scale-110" src="<?php echo e(asset('images/instagram1.jpeg')); ?>"/>
        <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover/post:opacity-100 transition-opacity flex items-center justify-center"><span class="material-symbols-outlined text-white text-2xl sm:text-3xl">favorite</span></div>
       </div>
       <div class="aspect-square rounded-2xl overflow-hidden relative group/post">
        <img alt="Post" class="w-full h-full object-cover transition-transform duration-700 group-hover/post:scale-110" src="<?php echo e(asset('images/instagram3.jpeg')); ?>"/>
        <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover/post:opacity-100 transition-opacity flex items-center justify-center"><span class="material-symbols-outlined text-white text-2xl sm:text-3xl">favorite</span></div>
       </div>
       <div class="col-span-2 aspect-[16/9] rounded-2xl overflow-hidden relative group/post">
        <img alt="Post" class="w-full h-full object-cover transition-transform duration-700 group-hover/post:scale-110" src="<?php echo e(asset('images/instagram2.jpeg')); ?>"/>
       </div>
      </div>
     </div>
    </div>
    <!-- TikTok -->
    <div class="flex flex-col gap-8 group">
     <div class="bg-surface-container-low rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-[#97b931]/20 h-full">
      <div class="flex items-center justify-between mb-6 sm:mb-8">
       <div class="flex gap-3 sm:gap-4 items-center">
        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-full border-2 border-[#97b931]/20 p-1 animate-float shrink-0" style="animation-delay:0.5s">
         <img alt="TikTok" class="h-full w-full rounded-full object-cover" src="<?php echo e(asset('images/products/tiktok.jpg')); ?>"/>
        </div>
        <div>
         <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface">TikTok</h3>
          <p class="font-label text-xs text-[#97b931] font-bold">@currentcravings_uk</p>
          <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">TikTok Community</p>
        </div>
       </div>
        <a class="bg-[#97b931] text-white h-9 sm:h-10 px-4 sm:px-6 rounded-full font-bold text-xs hover:scale-105 transition-transform shadow-lg shadow-[#97b931]/20 shrink-0 inline-flex items-center justify-center" href="https://www.tiktok.com/@currentcravings_uk" target="_blank" rel="noopener noreferrer">Follow</a>
      </div>
      <div class="grid grid-cols-1 gap-3 sm:gap-4">
       <div class="aspect-[4/3] sm:aspect-[4/5] rounded-2xl overflow-hidden relative group/post">
        <video class="w-full h-full object-cover transition-transform duration-700 group-hover/post:scale-110" autoplay muted loop playsinline preload="metadata" poster="<?php echo e(asset('images/products/tiktok.jpg')); ?>">
         <source src="<?php echo e(asset('images/tiktokvideo.mp4')); ?>" type="video/mp4"/>
         Your browser does not support the video tag.
        </video>
        <div class="absolute bottom-4 sm:bottom-6 left-4 sm:left-6 right-4 sm:right-6 text-white z-10">
         <p class="text-xs sm:text-sm font-bold flex items-center gap-2">
          <span class="material-symbols-outlined text-sm">play_circle</span> Watch us bake
         </p>
        </div>
       </div>
       <div class="grid grid-cols-2 gap-3 sm:gap-4">
        <div class="aspect-square rounded-2xl overflow-hidden">
         <video class="w-full h-full object-cover" autoplay muted loop playsinline preload="metadata" poster="<?php echo e(asset('images/products/tiktok.jpg')); ?>">
          <source src="<?php echo e(asset('images/tiktok1.mp4')); ?>" type="video/mp4"/>
          Your browser does not support the video tag.
         </video>
        </div>
        <div class="aspect-square rounded-2xl overflow-hidden">
         <video class="w-full h-full object-cover" autoplay muted loop playsinline preload="metadata" poster="<?php echo e(asset('images/products/tiktok.jpg')); ?>">
          <source src="<?php echo e(asset('images/tiktok2.mp4')); ?>" type="video/mp4"/>
          Your browser does not support the video tag.
         </video>
        </div>
       </div>
      </div>
      </div>
     </div>
     <!-- Pinterest -->
     <div class="flex flex-col gap-8 group">
     <div class="bg-surface-container-low rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-primary/10 h-full">
      <div class="flex items-center justify-between mb-6 sm:mb-8">
       <div class="flex gap-3 sm:gap-4 items-center">
        <div class="h-12 w-12 sm:h-16 sm:w-16 rounded-full border-2 border-primary/20 p-1 animate-float shrink-0" style="animation-delay:1s">
         <img alt="Pinterest" class="h-full w-full rounded-full object-cover" src="<?php echo e(asset('images/products/pintrest.jpg')); ?>"/>
        </div>
        <div>
         <h3 class="font-headline text-lg sm:text-xl font-bold text-on-surface">Pinterest</h3>
         <p class="font-label text-xs text-primary font-bold">@current_cravings</p>
         <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">2.5k Pins &middot; Inspiring Sweetness</p>
        </div>
       </div>
       <button class="bg-primary text-on-primary h-9 sm:h-10 px-4 sm:px-6 rounded-full font-bold text-xs hover:scale-105 transition-transform shadow-lg shadow-primary/20 shrink-0">Follow</button>
      </div>
      <div class="grid grid-cols-2 gap-3 sm:gap-4">
       <div class="flex flex-col gap-3 sm:gap-4">
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-36 sm:h-48 object-cover" src="images/pinterest1.jpeg"/></div>
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-40 sm:h-64 object-cover" src="images/pinterest2.jpeg"/></div>
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-28 sm:h-40 object-cover" src="images/pinterest3.jpeg"/></div>
       </div>
       <div class="flex flex-col gap-3 sm:gap-4 pt-4 sm:pt-8">
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-40 sm:h-64 object-cover" src="images/pinterset4.jpeg"/></div>
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-36 sm:h-48 object-cover" src="images/pinterest5.jpeg"/></div>
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-500"><img alt="" class="w-full h-32 sm:h-56 object-cover" src="images/pinterest6.jpeg"/></div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>





<script>
const PASTRY_SVGS = {
 donut1:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#f7c5d5" stroke="#f27d99" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><ellipse cx="50" cy="26" rx="18" ry="10" fill="#fbb6c8" opacity="0.9"/><ellipse cx="68" cy="36" rx="8" ry="12" fill="#fbb6c8" opacity="0.7"/><ellipse cx="32" cy="34" rx="7" ry="10" fill="#fbb6c8" opacity="0.7"/><rect x="40" y="20" width="6" height="2.5" rx="1.2" fill="#bef458" transform="rotate(30 43 21)"/><rect x="56" y="22" width="6" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(-20 59 23)"/></svg>`,
 donut2:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#FCD47E" stroke="#e8a020" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><path d="M32 38 Q50 18 68 38 Q75 50 68 62 Q50 55 32 62 Q25 50 32 38Z" fill="#8B4513" opacity="0.7"/></svg>`,
 donut3:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#c8f0a0" stroke="#97b931" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><path d="M50 12 Q70 16 82 32 Q86 50 78 64 Q65 75 50 78 Q35 75 22 64 Q14 50 18 32 Q30 16 50 12Z" fill="#f7a8b8" opacity="0.6" clip-path="url(#dc3)"/><defs><clipPath id="dc3"><circle cx="50" cy="50" r="38"/></clipPath></defs></svg>`,
 croissant:`<svg viewBox="0 0 110 80" xmlns="http://www.w3.org/2000/svg"><ellipse cx="55" cy="40" rx="50" ry="20" fill="#FCD47E" transform="rotate(-15 55 40)"/><path d="M10 55 Q55 10 100 45 Q80 70 55 65 Q30 60 10 55Z" fill="#e8a020" opacity="0.5"/></svg>`,
 cake:`<svg viewBox="0 0 90 100" xmlns="http://www.w3.org/2000/svg"><rect x="41" y="8" width="8" height="18" rx="2" fill="#fbb6c8"/><ellipse cx="45" cy="6" rx="4" ry="5" fill="#FCD47E"/><rect x="15" y="55" width="60" height="22" rx="4" fill="#f7c5d5"/><rect x="10" y="40" width="70" height="20" rx="4" fill="#fbb6c8"/><rect x="20" y="26" width="50" height="18" rx="4" fill="#f7a8b8"/></svg>`,
 macaron:`<svg viewBox="0 0 100 70" xmlns="http://www.w3.org/2000/svg"><ellipse cx="50" cy="20" rx="38" ry="18" fill="#f7a8b8"/><rect x="12" y="30" width="76" height="10" rx="2" fill="#fdd4e0"/><ellipse cx="50" cy="50" rx="38" ry="18" fill="#f7a8b8"/></svg>`,
 cupcake:`<svg viewBox="0 0 90 100" xmlns="http://www.w3.org/2000/svg"><path d="M45 10 Q58 5 65 15 Q72 8 72 20 Q80 16 78 28 Q84 26 80 38 Q84 40 78 48 Q60 52 30 48 Q24 40 28 38 Q22 26 30 28 Q28 16 36 20 Q36 8 45 10Z" fill="#fbb6c8"/><ellipse cx="45" cy="48" rx="35" ry="10" fill="#f7c5d5"/><path d="M10 58 L80 58 L72 95 L18 95 Z" fill="#FCD47E"/></svg>`,
 cookie:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="42" fill="#c8944a"/><ellipse cx="32" cy="38" rx="6" ry="5" fill="#3d1c08" transform="rotate(-15 32 38)"/><ellipse cx="58" cy="30" rx="6" ry="5" fill="#3d1c08" transform="rotate(20 58 30)"/><ellipse cx="68" cy="52" rx="6" ry="5" fill="#3d1c08"/><ellipse cx="42" cy="65" rx="6" ry="5" fill="#3d1c08"/></svg>`
};
const sectionPastryMap=[
 {id:'section-hero',left:'donut1',right:'cupcake'},
 {id:'section-cookie',left:'cookie',right:'donut2'},
 {id:'section-products',left:'macaron',right:'donut3'},
 {id:'section-kunafa',left:'croissant',right:'cupcake'},
 {id:'section-features',left:'donut1',right:'macaron'},
 {id:'section-about',left:'cake',right:'donut2'},
 {id:'section-tresl',left:'cupcake',right:'cookie'},
 {id:'section-unforgettable',left:'donut3',right:'croissant'},
 {id:'section-mango',left:'macaron',right:'donut1'},
 {id:'section-promise',left:'cake',right:'cupcake'},
 {id:'section-testimonials',left:'cookie',right:'donut2'},
 {id:'section-community',left:'donut3',right:'croissant'},
];
const leftPastry=document.getElementById('globalLeftPastry');
const rightPastry=document.getElementById('globalRightPastry');
let pastryState='hidden',currentLeft='donut1',currentRight='cupcake',idleTimer=null;
function setPastrySVG(side,key){const el=side==='left'?leftPastry:rightPastry;el.innerHTML=PASTRY_SVGS[key]||PASTRY_SVGS.donut1;}
function showPastries(lk,rk){
 if(pastryState==='entering')return;
 const changing=(lk!==currentLeft||rk!==currentRight);
 currentLeft=lk;currentRight=rk;
 if(pastryState==='visible'&&!changing)return;
 if(pastryState==='visible'&&changing){hidePastries(()=>showPastries(lk,rk));return;}
 pastryState='entering';clearTimeout(idleTimer);
 setPastrySVG('left',lk);setPastrySVG('right',rk);
 leftPastry.className='pastry-fixed left-pastry';rightPastry.className='pastry-fixed right-pastry';
 void leftPastry.offsetWidth;
 leftPastry.classList.add('spin-enter-left');rightPastry.classList.add('spin-enter-right');
 idleTimer=setTimeout(()=>{if(pastryState==='entering'){leftPastry.className='pastry-fixed left-pastry idle-left';rightPastry.className='pastry-fixed right-pastry idle-right';pastryState='visible';}},1100);
}
function hidePastries(cb){
 if(pastryState==='hidden'||pastryState==='exiting'){if(cb)cb();return;}
 pastryState='exiting';clearTimeout(idleTimer);
 leftPastry.className='pastry-fixed left-pastry spin-exit-left';rightPastry.className='pastry-fixed right-pastry spin-exit-right';
 setTimeout(()=>{leftPastry.className='pastry-fixed left-pastry';rightPastry.className='pastry-fixed right-pastry';pastryState='hidden';if(cb)cb();},620);
}
const sectionList=sectionPastryMap.map(c=>({...c,el:document.getElementById(c.id)})).filter(c=>c.el);
function checkPastries(){
 const vh=window.innerHeight;let found=null;
 for(const cfg of sectionList){const r=cfg.el.getBoundingClientRect();if(r.top<vh*0.75&&r.bottom>vh*0.25){found=cfg;break;}}
 if(found)showPastries(found.left,found.right);else hidePastries();
}
let ticking=false;
window.addEventListener('scroll',()=>{if(!ticking){requestAnimationFrame(()=>{checkPastries();ticking=false;});ticking=true;}},{passive:true});

// REVEAL
const revealEls=document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale,.clip-reveal,.section-line,.text-explosion,.bounce-in,.slide-stagger');
const revealObs=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');revealObs.unobserve(e.target);}});},{threshold:0.12,rootMargin:'0px 0px -40px 0px'});
revealEls.forEach(el=>revealObs.observe(el));

// SPRINKLES
const sc=document.getElementById('sprinkles-container');
const colors=['#f27d99','#fbb6c8','#bef458','#FCD47E','#fdd4e0'];
function createSprinkle(){
 const s=document.createElement('div');s.className='sprinkle';
 const size=4+Math.random()*8;
 s.style.cssText=`width:${size}px;height:${size}px;background:${colors[Math.floor(Math.random()*colors.length)]};left:${Math.random()*100}vw;animation-duration:${10+Math.random()*18}s;animation-delay:${Math.random()*12}s;border-radius:${Math.random()>0.5?'50%':'2px'};`;
 sc.appendChild(s);setTimeout(()=>s.remove(),30000);
}
for(let i=0;i<18;i++)createSprinkle();
setInterval(createSprinkle,2400);

// MOUSE TRAIL
document.addEventListener('mousemove',(e)=>{
 if(Math.random()>0.94){
  const dot=document.createElement('div');
  dot.style.cssText=`position:fixed;pointer-events:none;z-index:9999;width:6px;height:6px;border-radius:50%;background:${colors[Math.floor(Math.random()*colors.length)]};left:${e.clientX-3}px;top:${e.clientY-3}px;opacity:0.8;transition:transform 0.6s ease,opacity 0.6s ease;`;
  document.body.appendChild(dot);
  requestAnimationFrame(()=>{dot.style.transform=`translate(${(Math.random()-0.5)*40}px,${-30-Math.random()*30}px) scale(0)`;dot.style.opacity='0';});
  setTimeout(()=>dot.remove(),700);
 }
});

// RIPPLE
const rippleStyle=document.createElement('style');
rippleStyle.textContent='@keyframes rippleAnim{to{transform:scale(3.5);opacity:0}}';
document.head.appendChild(rippleStyle);
document.querySelectorAll('button,.glow-btn,.morph-btn').forEach(btn=>{
 btn.style.position='relative';btn.style.overflow='hidden';
 btn.addEventListener('click',function(e){
  const r=document.createElement('span');const rect=this.getBoundingClientRect();const size=Math.max(rect.width,rect.height);
  r.style.cssText=`position:absolute;border-radius:50%;pointer-events:none;width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;background:rgba(255,255,255,0.35);transform:scale(0);animation:rippleAnim 0.55s ease-out;`;
  this.appendChild(r);setTimeout(()=>r.remove(),600);
 });
});

// SCROLL PROGRESS
const progressBar=document.getElementById('scroll-progress');
window.addEventListener('scroll',()=>{const pct=(window.scrollY/(document.body.scrollHeight-window.innerHeight))*100;progressBar.style.width=pct+'%';},{passive:true});

// 3D TILT
document.querySelectorAll('.hover-scale-card').forEach(card=>{
 card.addEventListener('mousemove',e=>{
  const r=card.getBoundingClientRect();const x=(e.clientX-r.left)/r.width,y=(e.clientY-r.top)/r.height;
  card.style.transform=`perspective(800px) rotateX(${(y-0.5)*-14}deg) rotateY(${(x-0.5)*14}deg) translateY(-12px) scale(1.03)`;
  card.style.setProperty('--mx',(x*100)+'%');card.style.setProperty('--my',(y*100)+'%');
 });
 card.addEventListener('mouseleave',()=>{card.style.transform='';card.style.boxShadow='';});
});

// BURST
document.querySelectorAll('.burst-cta').forEach(btn=>{
 btn.addEventListener('click',e=>{
  for(let i=0;i<16;i++){
   const p=document.createElement('div');p.className='burst-particle';
   const angle=(i/16)*360,dist=60+Math.random()*80;
   p.style.cssText=`left:${e.clientX}px;top:${e.clientY}px;background:${colors[Math.floor(Math.random()*colors.length)]};--bx:${Math.cos(angle*Math.PI/180)*dist}px;--by:${Math.sin(angle*Math.PI/180)*dist}px;`;
   document.body.appendChild(p);setTimeout(()=>p.remove(),750);
  }
 });
});

// HERO SWITCHER
const heroImage=document.getElementById('hero-main-image');
const heroThumbs=document.querySelectorAll('.hero-category-thumb');
if(heroImage&&heroThumbs.length){
 const heroEyebrow=document.getElementById('hero-eyebrow');
 const heroDesc=document.getElementById('hero-desc');
 const heroTitleWrap=document.getElementById('hero-title-wrap');
 const titleClass="font-headline text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-on-surface tracking-tighter leading-[0.9] mb-6 sm:mb-8";
 const titleSvg=`<svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none"><path d="M2 6 Q50 2 100 6 Q150 10 198 4" stroke="#f27d99" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.5"/></svg>`;
 let currentIndex=0;
 const renderTitle=(tag,d)=>{
  if(!heroTitleWrap)return;
  heroTitleWrap.innerHTML=`<${tag} class="${titleClass}"><span id="hero-title-main" class="hero-swap-target">${d.heroTitleMain||''}</span> <br><span id="hero-title-sub" class="hero-swap-target">${d.heroTitleSub||''}</span><span class="inline-block hover:scale-110 transition-transform cursor-default relative glitch-hover"><span id="hero-title-brand" class="hero-swap-target gradient-headline">${d.heroTitleBrand||''}</span>${titleSvg}</span></${tag}>`;
 };
 const goToSlide=(index,animate=true)=>{
  const thumb=heroThumbs[index];if(!thumb)return;
  const src=thumb.dataset.heroSrc||thumb.src;if(src)heroImage.src=src;
  const d=thumb.dataset;
  if(animate){
   const targets=[heroEyebrow,heroDesc].filter(Boolean);
   targets.forEach(el=>{el.classList.remove('hero-swap-anim');el.classList.add('hero-swap-out');});
   setTimeout(()=>{
    if(heroEyebrow&&d.heroEyebrow)heroEyebrow.textContent=d.heroEyebrow;
    if(heroDesc&&d.heroDesc)heroDesc.textContent=d.heroDesc;
    renderTitle(index===0?'h1':'h2',d);
    targets.forEach(el=>{el.classList.remove('hero-swap-out');void el.offsetWidth;el.classList.add('hero-swap-anim');});
   },220);
  } else {
   if(heroEyebrow&&d.heroEyebrow)heroEyebrow.textContent=d.heroEyebrow;
   if(heroDesc&&d.heroDesc)heroDesc.textContent=d.heroDesc;
   renderTitle('h1',d);
  }
  heroThumbs.forEach(t=>t.classList.remove('ring-2','ring-primary'));
  thumb.classList.add('ring-2','ring-primary');
  currentIndex=index;
 };
 goToSlide(0,false);
 heroThumbs.forEach((t,i)=>t.addEventListener('click',()=>goToSlide(i,true)));
 let heroTimer=setInterval(()=>{goToSlide((currentIndex+1)%heroThumbs.length,true);},3500);
 const heroSection=document.getElementById('section-hero');
 if(heroSection){
  heroSection.addEventListener('mouseenter',()=>clearInterval(heroTimer));
  heroSection.addEventListener('mouseleave',()=>{clearInterval(heroTimer);heroTimer=setInterval(()=>{goToSlide((currentIndex+1)%heroThumbs.length,true);},3500);});
 }
}

// TESTIMONIAL AUTO SCROLL (JS fallback for consistent cross-browser behavior)
(function(){
 const outer=document.querySelector('#section-testimonials .ts-outer');
 const track=document.getElementById('tsTrack');
 if(!outer||!track)return;
 if(window.matchMedia('(prefers-reduced-motion: reduce)').matches)return;

 // Disable CSS animation and run a controlled marquee loop.
 outer.style.setProperty('overflow','hidden','important');
 track.style.setProperty('animation','none','important');

 let userPaused=false;
 let speed=0.65;
 let rafId=null;

 function setSpeed(){
  speed=window.matchMedia('(max-width: 767px)').matches?0.45:0.65;
 }

 function step(){
  const resetAt=track.scrollWidth/2;
  if(!userPaused&&!document.hidden&&resetAt>0){
   outer.scrollLeft+=speed;
   if(outer.scrollLeft>=resetAt){
    outer.scrollLeft-=resetAt;
   }
  }
  rafId=requestAnimationFrame(step);
 }

 outer.addEventListener('mouseenter',()=>{userPaused=true;});
 outer.addEventListener('mouseleave',()=>{userPaused=false;});
 outer.addEventListener('touchstart',()=>{userPaused=true;},{passive:true});
 outer.addEventListener('touchend',()=>{userPaused=false;},{passive:true});
 outer.addEventListener('focusin',()=>{userPaused=true;});
 outer.addEventListener('focusout',()=>{userPaused=false;});

 window.addEventListener('resize',()=>{
  setSpeed();
  const resetAt=track.scrollWidth/2;
  if(resetAt>0)outer.scrollLeft%=resetAt;
 });

 setSpeed();
 outer.scrollLeft=0;
 rafId=requestAnimationFrame(step);
})();

// PARTICLES
(function(){
 const canvas=document.getElementById('particles');if(!canvas)return;
 const ctx=canvas.getContext('2d');let W,H,particles=[];
 function resize(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
 resize();window.addEventListener('resize',resize);
 for(let i=0;i<45;i++){particles.push({x:Math.random()*W,y:Math.random()*H,vx:(Math.random()-0.5)*0.4,vy:(Math.random()-0.5)*0.4,r:1+Math.random()*2,c:['#f27d99','#fbb6c8','#bef458','#FCD47E'][Math.floor(Math.random()*4)],a:0.1+Math.random()*0.25});}
 function draw(){
  ctx.clearRect(0,0,W,H);
  particles.forEach(p=>{p.x+=p.vx;p.y+=p.vy;if(p.x<0)p.x=W;if(p.x>W)p.x=0;if(p.y<0)p.y=H;if(p.y>H)p.y=0;ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,Math.PI*2);ctx.fillStyle=p.c;ctx.globalAlpha=p.a;ctx.fill();});
  requestAnimationFrame(draw);
 }
 draw();
})();

// SWEEP
const sectionSweepStyle=document.createElement('style');
sectionSweepStyle.textContent=`@keyframes sectionSweep{0%{opacity:.18;transform:translateX(-100%) skewX(-5deg)}100%{opacity:0;transform:translateX(110%) skewX(-5deg)}}.section-sweep-anim::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(242,125,153,.15),transparent);animation:sectionSweep 1s ease forwards;pointer-events:none;z-index:20;border-radius:inherit}`;
document.head.appendChild(sectionSweepStyle);
const sweepObs=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){e.target.style.position='relative';e.target.classList.add('section-sweep-anim');setTimeout(()=>e.target.classList.remove('section-sweep-anim'),1100);sweepObs.unobserve(e.target);}});},{threshold:0.2});
['section-cookie','section-kunafa','section-unforgettable','section-promise','section-community'].forEach(id=>{const el=document.getElementById(id);if(el)sweepObs.observe(el);});

// FOOTER SPRINKLES
const fsc=document.getElementById('footerSprinkles');
const scColors=['#f27d99','#fbb6c8','#bef458','#FCD47E','#fdd4e0','#e8627d','#97b931'];
function createFooterSprinkle(){
 const el=document.createElement('div');el.className='footer-sprinkle';
 const size=4+Math.random()*11,left=1+Math.random()*98,dur=6+Math.random()*13,delay=Math.random()*10;
 const color=scColors[Math.floor(Math.random()*scColors.length)];const isRect=Math.random()>0.55;
 el.style.cssText=`width:${isRect?size*2.8:size}px;height:${size}px;left:${left}%;background:${color};border-radius:${isRect?'3px':'50%'};animation:fSprinkleUp ${dur}s ease-in-out ${delay}s infinite;opacity:0;`;
 fsc.appendChild(el);return el;
}
for(let i=0;i<40;i++)createFooterSprinkle();
setInterval(()=>{const el=createFooterSprinkle();setTimeout(()=>{try{el.remove();}catch(e){}},25000);},1200);

setTimeout(checkPastries,500);
</script>
<?php $__env->stopSection(); ?>









<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/index.blade.php ENDPATH**/ ?>