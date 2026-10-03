@extends('layouts.app')
@section('title', 'Delivery & Shipping | Current Cravings')

@section('content')
@php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
@endphp
<section class="page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);padding:60px 0 80px;">
 <div style="max-width:1300px;margin:0 auto;padding:0 24px;">

  <!-- Header -->
  <div style="text-align:center;margin-bottom:48px;">
   <span style="display:inline-block;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);padding:6px 18px;border-radius:999px;margin-bottom:16px;">{{ $cms['delivery_page_badge'] ?? 'Shipping Info' }}</span>
   <h1 style="font-family:'Epilogue',sans-serif;font-size:clamp(2rem,5vw,3.2rem);font-weight:900;letter-spacing:-.03em;color:#2a1a22;margin:0 0 12px;">{{ $cms['delivery_page_title'] ?? 'Delivery & Shipping' }}</h1>
   <p style="color:#9c9385;font-size:13px;">{{ $cms['delivery_page_subtitle'] ?? 'Fresh to your door, every time' }}</p>
  </div>

  <!-- Content Card -->
  <div style="background:#fff;border-radius:24px;border:1.5px solid rgba(242,125,153,0.14);box-shadow:0 16px 48px rgba(242,125,153,0.09);padding:40px 48px;">
   @if(filled($cms['delivery_page_body_html'] ?? null))
    {!! $cms['delivery_page_body_html'] !!}
   @else

   <p class="pp-lead">At Current Cravings, every order is freshly prepared with care to ensure quality, taste, and presentation. To help us maintain our baking standards, all orders must be placed in advance.</p>

   <!-- Pre-Order highlight box -->
   <div style="background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.25);border-radius:16px;padding:20px 24px;margin-bottom:32px;display:flex;align-items:center;gap:16px;">
    <span class="material-symbols-outlined" style="color:#f27d99;font-size:32px;flex-shrink:0;">schedule</span>
    <div>
     <div style="font-family:'Epilogue',sans-serif;font-weight:900;font-size:1rem;color:#2a1a22;margin-bottom:4px;">Pre-Order Policy</div>
     <div style="font-size:14px;color:#66645e;line-height:1.6;">Orders must be placed <strong style="color:#e8627d;">at least 1 day in advance.</strong> We do not offer same-day orders. This allows us to prepare each item fresh and deliver it in the best possible condition.</div>
    </div>
   </div>

   <div style="background:linear-gradient(135deg,#f7f3e9,#fffbff);border:1.5px solid rgba(252,212,126,0.5);border-radius:16px;padding:20px 24px;margin-bottom:32px;display:flex;align-items:center;gap:16px;">
    <span class="material-symbols-outlined" style="color:#b06a00;font-size:32px;flex-shrink:0;">local_shipping</span>
    <div>
     <div style="font-family:'Epilogue',sans-serif;font-weight:900;font-size:1rem;color:#2a1a22;margin-bottom:4px;">Delivery &amp; Shipment Charges</div>
     <div style="font-size:14px;color:#66645e;line-height:1.6;"><strong style="color:#b06a00;">£5.00</strong> delivery and shipment charge applies to all orders.</div>
    </div>
   </div>

   <div class="pp-section">
    <h2>Local Delivery Areas</h2>
    <p>We currently offer local delivery in the following areas:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:10px;margin-top:14px;">
     @foreach(['Kettering','Wellingborough','Rushden','Northampton','Irthlingborough','Corby','Brackley'] as $area)
     <div style="display:flex;align-items:center;gap:8px;background:#f7f3e9;border:1px solid rgba(242,125,153,0.18);border-radius:12px;padding:10px 14px;">
      <span style="width:8px;height:8px;border-radius:50%;background:#f27d99;flex-shrink:0;"></span>
      <span style="font-size:13px;font-weight:700;color:#3a3526;">{{ $area }}</span>
     </div>
     @endforeach
    </div>
   </div>

   <div class="pp-section">
    <h2>UK-Wide Delivery</h2>
    <p>In addition to local delivery, we also offer delivery across the UK for selected items. Nationwide orders are carefully packed to maintain freshness and quality during transit.</p>
    <p>Delivery availability may vary depending on the type of product ordered.</p>
   </div>

   <div class="pp-section">
    <h2>Delivery Timing</h2>
    <ul>
     <li>All orders require advance booking of <strong>at least 1 day.</strong></li>
     <li>Delivery and shipment charge is <strong>£5.00</strong> per order for all orders.</li>
     <li>Local deliveries are arranged according to the selected date and availability.</li>
     <li>UK-wide orders are dispatched in line with the agreed order schedule and courier timelines.</li>
     <li>We recommend placing your order as early as possible, especially during busy periods, weekends, and special occasions.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Packaging</h2>
    <p>All products are carefully packed to protect their quality during delivery. We take extra care with presentation and freshness so that your order arrives in the best condition possible.</p>
   </div>

   <div class="pp-section">
    <h2>Important Information</h2>
    <ul>
     <li>Please ensure your delivery details are entered correctly at checkout. Once an order is confirmed, changes may not always be possible.</li>
     <li>Delivery times may occasionally be affected by traffic, weather conditions, courier delays, or high-demand periods. While we always aim to deliver on time, slight delays may happen in rare cases.</li>
    </ul>
   </div>

   <!-- Contact Box -->
   <div style="margin-top:8px;background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.2);border-radius:18px;padding:28px 32px;">
    <h2 style="margin-top:0;">Need Help with Your Order?</h2>
    <p style="margin-bottom:16px;">If you have any questions about delivery areas, product availability, or placing an order, our team will be happy to assist you.</p>
    <div style="display:grid;gap:10px;">
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">chat</span><a href="https://wa.me/447534738441" target="_blank" style="color:#e8627d;font-weight:600;">WhatsApp: +44 753 4738441</a></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">mail</span><a href="mailto:currentcravings4@gmail.com" style="color:#e8627d;font-weight:600;">currentcravings4@gmail.com</a></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">contact_page</span><a href="{{ route('contact') }}" style="color:#e8627d;font-weight:600;">Fill out our Contact Form</a></div>
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
.pp-section a { color:#e8627d; font-weight:600; text-decoration:underline; text-underline-offset:3px; }
@media(max-width:640px) {
 div[style*="padding:40px 48px"] { padding:28px 20px !important; }
}
</style>
@endsection
