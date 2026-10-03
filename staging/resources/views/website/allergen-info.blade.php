@extends('layouts.app')
@section('title', 'Allergen Information | Current Cravings')

@section('content')
@php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
@endphp
<section class="page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);padding:60px 0 80px;">
 <div style="max-width:1300px;margin:0 auto;padding:0 24px;">

  <div style="text-align:center;margin-bottom:48px;" style="padding-top:20px;">
   <span style="display:inline-block;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);padding:6px 18px;border-radius:999px;margin-bottom:16px;">{{ $cms['allergen_page_badge'] ?? 'Health & Safety' }}</span>
   <h1 style="font-family:'Epilogue',sans-serif;font-size:clamp(2rem,5vw,3.2rem);font-weight:900;letter-spacing:-.03em;color:#2a1a22;margin:0 0 12px;">{{ $cms['allergen_page_title'] ?? 'Allergen Information' }}</h1>
   <p style="color:#9c9385;font-size:13px;">{{ $cms['allergen_page_subtitle'] ?? 'Your safety is our priority' }}</p>
  </div>

  <div style="background:#fff;border-radius:24px;border:1.5px solid rgba(242,125,153,0.14);box-shadow:0 16px 48px rgba(242,125,153,0.09);padding:40px 48px;">
   @if(filled($cms['allergen_page_body_html'] ?? null))
    {!! $cms['allergen_page_body_html'] !!}
   @else

   <p class="pp-lead">At Current Cravings, we care about the health and safety of our customers. We understand the importance of being transparent about the ingredients in our products, especially for those with allergies or dietary restrictions.</p>

   <!-- Warning box -->
   <div style="background:#fff8e1;border:1.5px solid #fcd47e;border-radius:16px;padding:18px 22px;margin-bottom:32px;display:flex;align-items:flex-start;gap:14px;">
    <span class="material-symbols-outlined" style="color:#e8a020;font-size:26px;flex-shrink:0;margin-top:2px;">warning</span>
    <div style="font-size:14px;color:#66645e;line-height:1.7;"><strong style="color:#2a1a22;">Cross-Contamination Notice:</strong> Our products are prepared in a kitchen that handles allergens including gluten, dairy, nuts, and eggs. We cannot guarantee products are free from trace amounts of allergens.</div>
   </div>

   <div class="pp-section">
    <h2>Our Commitment to Safety</h2>
    <p>We make every effort to clearly label allergens in all of our products. However, as we use shared equipment and ingredients, there may be cross-contamination risks. If you have a specific allergy, please read the ingredient list carefully and contact us directly for further clarification.</p>
   </div>

   <div class="pp-section">
    <h2>Common Allergens in Our Products</h2>
    <p>Our products may contain, or come into contact with, the following allergens:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px;margin-top:16px;">
     @foreach([
      ['icon'=>'grain',       'label'=>'Gluten',        'sub'=>'wheat, barley, oats'],
      ['icon'=>'water_drop',  'label'=>'Dairy',         'sub'=>'milk, butter, cream'],
      ['icon'=>'egg',         'label'=>'Eggs',          'sub'=>''],
      ['icon'=>'forest',      'label'=>'Nuts',          'sub'=>'almonds, walnuts, pecans'],
      ['icon'=>'spa',         'label'=>'Peanuts',       'sub'=>''],
      ['icon'=>'eco',         'label'=>'Soy',           'sub'=>''],
      ['icon'=>'grass',       'label'=>'Sesame Seeds',  'sub'=>''],
      ['icon'=>'science',     'label'=>'Sulphites',     'sub'=>'used as preservatives'],
      ['icon'=>'lemon',       'label'=>'Citrus',        'sub'=>'lemons, oranges'],
      ['icon'=>'local_bar',   'label'=>'Alcohol',       'sub'=>'certain desserts'],
     ] as $a)
     <div style="display:flex;align-items:center;gap:10px;background:#fff7fa;border:1px solid rgba(242,125,153,0.18);border-radius:14px;padding:12px 14px;">
      <span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;flex-shrink:0;">{{ $a['icon'] }}</span>
      <div>
       <div style="font-size:13px;font-weight:800;color:#2a1a22;">{{ $a['label'] }}</div>
       @if($a['sub'])<div style="font-size:11px;color:#9c9385;">{{ $a['sub'] }}</div>@endif
      </div>
     </div>
     @endforeach
    </div>
   </div>

   <div class="pp-section">
    <h2>How to Find Allergen Information</h2>
    <ul>
     <li><strong>Ingredient List:</strong> All allergens are clearly indicated in the ingredient list of each product.</li>
     <li><strong>Product Descriptions:</strong> We specify allergens in the descriptions of each product where relevant.</li>
     <li><strong>Packaging:</strong> All products are clearly labelled with allergen warnings on the packaging.</li>
     <li><strong>Website:</strong> Allergen information is available on individual product pages on our website.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Custom Orders</h2>
    <p>If you have specific dietary needs or allergies, we encourage you to reach out to us before placing an order. We will do our best to accommodate custom requests, but please be aware that we cannot guarantee a completely allergen-free environment.</p>
   </div>

   <div style="margin-top:8px;background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.2);border-radius:18px;padding:28px 32px;">
    <h2 style="margin-top:0;">Contact Us for More Information</h2>
    <p style="margin-bottom:16px;">Our team is happy to provide detailed allergen information for each of our offerings.</p>
    <div style="display:grid;gap:10px;">
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">mail</span><a href="mailto:currentcravings4@gmail.com" style="color:#e8627d;font-weight:600;">currentcravings4@gmail.com</a></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">call</span><span>+44 753 4738441</span></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">location_on</span><span>King Street, Kettering NN16 8JF, United Kingdom</span></div>
    </div>
   </div>

   @endif
  </div>
 </div>
</section>

<style>
.pp-lead { font-size:16px; line-height:1.8; color:#66645e; margin-bottom:32px; padding-bottom:32px; border-bottom:1.5px solid rgba(242,125,153,0.12); }
.pp-section { margin-bottom:32px; padding-bottom:32px; border-bottom:1.5px solid rgba(242,125,153,0.1); }
.pp-section:last-of-type { border-bottom:none; margin-bottom:0; padding-bottom:0; }
.pp-section h2 { font-family:'Epilogue',sans-serif; font-size:1.15rem; font-weight:900; color:#2a1a22; margin:0 0 12px; display:flex; align-items:center; gap:8px; }
.pp-section h2::before { content:''; display:block; width:4px; height:18px; background:linear-gradient(180deg,#f27d99,#fbb6c8); border-radius:4px; flex-shrink:0; }
.pp-section p { font-size:15px; line-height:1.8; color:#66645e; margin:0 0 12px; }
.pp-section ul { list-style:none; padding:0; margin:0; display:grid; gap:8px; }
.pp-section ul li { font-size:15px; line-height:1.7; color:#66645e; padding-left:20px; position:relative; }
.pp-section ul li::before { content:''; position:absolute; left:0; top:10px; width:7px; height:7px; border-radius:50%; background:#f27d99; }
@media(max-width:640px) { div[style*="padding:40px 48px"] { padding:28px 20px !important; } }
</style>
@endsection
