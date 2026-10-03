@extends('layouts.app')
@section('title', 'Refunds & Returns Policy | Current Cravings')

@section('content')
@php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
@endphp
<section class="page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);padding:60px 0 80px;">
 <div style="max-width:1300px;margin:0 auto;padding:0 24px;">

  <div style="text-align:center;margin-bottom:48px; padding-top:20px;">
   <span style="display:inline-block;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);padding:6px 18px;border-radius:999px;margin-bottom:16px;">{{ $cms['refunds_page_badge'] ?? 'Legal' }}</span>
   <h1 style="font-family:'Epilogue',sans-serif;font-size:clamp(2rem,5vw,3.2rem);font-weight:900;letter-spacing:-.03em;color:#2a1a22;margin:0 0 12px;">{{ $cms['refunds_page_title'] ?? 'Refunds & Returns Policy' }}</h1>
   <p style="color:#9c9385;font-size:13px;">{{ $cms['refunds_page_subtitle'] ?? 'Last updated: January 2025' }}</p>
  </div>

  <div style="background:#fff;border-radius:24px;border:1.5px solid rgba(242,125,153,0.14);box-shadow:0 16px 48px rgba(242,125,153,0.09);padding:40px 48px;">
   @if(filled($cms['refunds_page_body_html'] ?? null))
    {!! $cms['refunds_page_body_html'] !!}
   @else

   <p class="pp-lead">We take great care in preparing and packaging every order. As our products are freshly made food items, returns are not accepted for change of mind once an order has been prepared or dispatched. This policy explains what happens if an order is damaged, incomplete, delayed, or missed at the point of delivery.</p>

   <div class="pp-section">
    <h2>Cancellations &amp; Change of Mind</h2>
    <p>Because our items are freshly prepared and perishable, orders cannot usually be cancelled or returned once production has started or the order has been dispatched. This aligns with UK rules that limit cancellation rights for perishable goods.</p>
    <p>If you need to amend an order, please contact us as soon as possible and we will try our best to accommodate if preparation has not yet begun.</p>
   </div>

   <div class="pp-section">
    <h2>If Your Order Arrives Damaged or Items Are Missing</h2>
    <p>If your order arrives damaged, incorrect, or with missing items, please contact us as soon as possible so we can resolve it quickly.</p>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:16px;">
     <div style="background:#fff7fa;border:1px solid rgba(242,125,153,0.18);border-radius:14px;padding:18px;">
      <div style="font-family:'Epilogue',sans-serif;font-weight:900;font-size:.9rem;color:#2a1a22;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
       <span class="material-symbols-outlined" style="color:#f27d99;font-size:18px;">report_problem</span> How to Report
      </div>
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:7px;">
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#f27d99;display:block;"></span>Call or message us via our contact details</li>
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#f27d99;display:block;"></span>Share your order number</li>
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#f27d99;display:block;"></span>Share clear photos of packaging and items</li>
      </ul>
     </div>
     <div style="background:#f0fce4;border:1px solid rgba(190,244,88,0.4);border-radius:14px;padding:18px;">
      <div style="font-family:'Epilogue',sans-serif;font-weight:900;font-size:.9rem;color:#2a1a22;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
       <span class="material-symbols-outlined" style="color:#4d6e00;font-size:18px;">check_circle</span> What We Will Do
      </div>
      <ul style="list-style:none;padding:0;margin:0;display:grid;gap:7px;">
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#4d6e00;display:block;"></span>A replacement (where possible)</li>
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#4d6e00;display:block;"></span>A partial refund</li>
       <li style="font-size:13px;color:#66645e;padding-left:16px;position:relative;"><span style="position:absolute;left:0;top:8px;width:6px;height:6px;border-radius:50%;background:#4d6e00;display:block;"></span>A full refund for affected items</li>
      </ul>
     </div>
    </div>
    <p style="margin-top:14px;">UK consumer law gives customers remedies when goods are faulty or not as described.</p>
   </div>

   <div class="pp-section">
    <h2>Missed Deliveries</h2>
    <div style="display:grid;gap:12px;margin-top:4px;">
     <div style="background:#fff7fa;border:1px solid rgba(242,125,153,0.18);border-radius:14px;padding:16px 20px;">
      <div style="font-weight:800;font-size:13px;color:#2a1a22;margin-bottom:6px;">📍 Local Deliveries (Northamptonshire)</div>
      <p style="font-size:14px;color:#66645e;margin:0;line-height:1.7;">If we are delivering personally and you miss the delivery, we will contact you to rearrange where possible. A re-delivery fee may apply depending on distance and scheduling.</p>
     </div>
     <div style="background:#fff7fa;border:1px solid rgba(242,125,153,0.18);border-radius:14px;padding:16px 20px;">
      <div style="font-weight:800;font-size:13px;color:#2a1a22;margin-bottom:6px;">🚚 Nationwide Deliveries (Other UK)</div>
      <p style="font-size:14px;color:#66645e;margin:0;line-height:1.7;">For third-party couriers such as Royal Mail, missed delivery procedures and re-delivery options follow the courier's process. Customers will need to use the tracking or delivery instructions provided by the courier. Contact us if you need help understanding a courier update.</p>
     </div>
    </div>
   </div>

   <div class="pp-section">
    <h2>Re-Delivery &amp; Charges</h2>
    <ul>
     <li><strong>Local delivery:</strong> Re-delivery may be offered and a reasonable re-delivery charge may apply.</li>
     <li><strong>Courier delivery:</strong> Any re-delivery or re-routing fees are controlled by the courier and may be payable by the customer.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>If the Delivery Driver Needs Assistance</h2>
    <p>If a driver requires additional help to complete delivery (e.g. access issues, security gates, or difficulty locating the address), please respond promptly to calls or messages.</p>
    <ul>
     <li>For local deliveries, we may request a quick call to complete the drop-off smoothly.</li>
     <li>For courier deliveries, assistance requests are handled under the courier's standard delivery procedure.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Delivery Fees</h2>
    <p>Delivery and shipment fee is fixed at <strong>£5.00</strong> per order and is shown during checkout. If you believe the fee shown is incorrect, contact us and we will review it with you.</p>
   </div>

   <div class="pp-section">
    <h2>Refund Processing Times</h2>
    <p>If a refund is approved, we process it back to the original payment method. Refunds are issued without undue delay and typically within <strong>14 days from approval</strong>, in line with UK requirements.</p>
   </div>

   <div style="margin-top:8px;background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.2);border-radius:18px;padding:28px 32px;">
    <h2 style="margin-top:0;">Contact Us</h2>
    <p style="margin-bottom:16px;">For any delivery issue, damage report, or order query, please get in touch:</p>
    <div style="display:grid;gap:10px;">
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">mail</span><a href="mailto:info@currentcravings.co.uk" style="color:#e8627d;font-weight:600;">info@currentcravings.co.uk</a></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">call</span><span>+44 753 4738441</span></div>
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
@media(max-width:640px) {
 div[style*="padding:40px 48px"] { padding:28px 20px !important; }
 div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr !important; }
}
</style>
@endsection
