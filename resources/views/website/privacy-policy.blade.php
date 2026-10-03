@extends('layouts.app')
@section('title', 'Privacy Policy | Current Cravings')

@section('content')
@php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
@endphp
<section class="page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);padding:60px 0 80px;">
 <div style="max-width:1300px;margin:0 auto;padding:0 24px;">

  <!-- Header -->
   <div style="text-align:center;margin-bottom:48px; padding-top:30px;">
    <span style="display:inline-block;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);padding:6px 18px;border-radius:999px;margin-bottom:16px;">{{ $cms['privacy_page_badge'] ?? 'Legal' }}</span>
    <h1 style="font-family:'Epilogue',sans-serif;font-size:clamp(2rem,5vw,3.2rem);font-weight:900;letter-spacing:-.03em;color:#2a1a22;margin:0 0 12px;">{{ $cms['privacy_page_title'] ?? 'Privacy Policy' }}</h1>
    <p style="color:#9c9385;font-size:13px;">{{ $cms['privacy_page_subtitle'] ?? 'Last updated: January 2025' }}</p>
   </div>

  <!-- Content Card -->
   <div style="background:#fff;border-radius:24px;border:1.5px solid rgba(242,125,153,0.14);box-shadow:0 16px 48px rgba(242,125,153,0.09);padding:40px 48px;">
   @if(filled($cms['privacy_page_body_html'] ?? null))
    {!! $cms['privacy_page_body_html'] !!}
   @else

   <p class="pp-lead">Current Cravings respects your privacy and is committed to protecting your personal information. By using our website, placing an order, or contacting us, you agree to the terms outlined in this Privacy Policy.</p>

   <div class="pp-section">
    <h2>Information We Collect</h2>
    <p>We collect personal information when you visit our website or place an order. This includes:</p>
    <ul>
     <li><strong>Personal Identification:</strong> Name, email address, phone number, delivery address, and payment details.</li>
     <li><strong>Order Information:</strong> Products purchased, order history, and shipping preferences.</li>
     <li><strong>Payment Information:</strong> Processed securely through third-party payment providers.</li>
     <li><strong>Website Usage Data:</strong> IP address, browser type, device information, and how you interact with our website.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>How We Use Your Information</h2>
    <ul>
     <li><strong>To Process Orders:</strong> Payment processing and delivery.</li>
     <li><strong>To Communicate with You:</strong> Order confirmations, tracking details, and promotional updates (if opted in).</li>
     <li><strong>To Improve Our Services:</strong> Website analytics and customer feedback.</li>
     <li><strong>For Marketing:</strong> If opted in, promotional content about new products and offers.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Sharing Your Information</h2>
    <p>We will never sell or rent your personal information. We may share it with:</p>
    <ul>
     <li><strong>Service Providers:</strong> Trusted third parties for order processing, payment gateways, delivery, and email marketing.</li>
     <li><strong>Legal Obligations:</strong> To comply with legal requirements such as subpoenas or enforcing our Terms.</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Data Security</h2>
    <p>We take reasonable precautions to protect your personal information. All sensitive data is encrypted using secure protocols and stored on secure servers. However, no method of internet transmission is 100% secure.</p>
   </div>

   <div class="pp-section">
    <h2>Cookies and Tracking</h2>
    <p>Our website uses cookies to enhance your browsing experience and gather analytics. You can control cookies through your browser settings, though disabling them may affect some website features.</p>
   </div>

   <div class="pp-section">
    <h2>Your Rights</h2>
    <p>You have the right to:</p>
    <ul>
     <li><strong>Access your data:</strong> Request a copy of the personal data we hold.</li>
     <li><strong>Update or correct your data:</strong> Fix any incorrect or incomplete information.</li>
     <li><strong>Request deletion:</strong> Ask us to delete your personal data (subject to legal exceptions).</li>
     <li><strong>Opt-out of marketing:</strong> Unsubscribe via email instructions or by contacting us directly.</li>
    </ul>
    <p>To exercise any of these rights, contact us at <a href="mailto:currentcravings4@gmail.com">currentcravings4@gmail.com</a>.</p>
   </div>

   <div class="pp-section">
    <h2>Retention of Data</h2>
    <p>We retain your personal information only as long as necessary to fulfill the purposes outlined in this policy, including legal, accounting, or reporting requirements. Once no longer needed, data is securely deleted or anonymised.</p>
   </div>

   <div class="pp-section">
    <h2>Third-Party Links</h2>
    <p>Our website may contain links to third-party websites not governed by this Privacy Policy. We encourage you to review the privacy policies of any external sites you visit.</p>
   </div>

   <div class="pp-section">
    <h2>Children's Privacy</h2>
    <p>Our website is not intended for children under 16. We do not knowingly collect personal data from children. If we become aware of such data, we will delete it promptly.</p>
   </div>

   <div class="pp-section">
    <h2>Changes to This Policy</h2>
    <p>We reserve the right to update this Privacy Policy at any time. Changes will be posted on this page with an updated "Last Updated" date. Continued use of our website constitutes acceptance of the updated policy.</p>
   </div>

   <!-- Contact Box -->
   <div style="margin-top:40px;background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.2);border-radius:18px;padding:28px 32px;">
    <h2 style="margin-top:0;">Contact Us</h2>
    <p style="margin-bottom:16px;">If you have any questions about this Privacy Policy, please contact us:</p>
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
.pp-section a { color:#e8627d; font-weight:600; text-decoration:underline; text-underline-offset:3px; }
@media(max-width:640px) {
 div[style*="padding:40px 48px"] { padding:28px 20px !important; }
}
</style>
@endsection
