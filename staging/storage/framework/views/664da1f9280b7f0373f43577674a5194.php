
<?php $__env->startSection('title', 'Terms of Service | Current Cravings'); ?>

<?php $__env->startSection('content'); ?>
<?php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
?>
<section class="page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);padding:60px 0 80px;">
 <div style="max-width:1300px;margin:0 auto;padding:0 24px;">

  <div style="text-align:center;margin-bottom:48px; padding-top:20px;">
   <span style="display:inline-block;font-size:11px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#c04060;background:rgba(242,125,153,0.1);border:1px solid rgba(242,125,153,0.25);padding:6px 18px;border-radius:999px;margin-bottom:16px;"><?php echo e($cms['terms_page_badge'] ?? 'Legal'); ?></span>
   <h1 style="font-family:'Epilogue',sans-serif;font-size:clamp(2rem,5vw,3.2rem);font-weight:900;letter-spacing:-.03em;color:#2a1a22;margin:0 0 12px;"><?php echo e($cms['terms_page_title'] ?? 'Terms of Service'); ?></h1>
   <p style="color:#9c9385;font-size:13px;"><?php echo e($cms['terms_page_subtitle'] ?? 'Last updated: January 2025'); ?></p>
  </div>

  <div style="background:#fff;border-radius:24px;border:1.5px solid rgba(242,125,153,0.14);box-shadow:0 16px 48px rgba(242,125,153,0.09);padding:40px 48px;">
   <?php if(filled($cms['terms_page_body_html'] ?? null)): ?>
    <?php echo $cms['terms_page_body_html']; ?>

   <?php else: ?>

   <p class="pp-lead">Welcome to Current Cravings! These Terms of Service govern your use of our website (currentcravings.co.uk) and the products and services we offer. By using our website, placing an order, or interacting with our services, you agree to these Terms. Please read them carefully.</p>

   <div class="pp-section">
    <h2>Agreement to Terms</h2>
    <p>By accessing and using our website and services, you agree to comply with and be bound by these Terms. If you do not agree, you must refrain from using our website and services.</p>
    <p>We reserve the right to update or modify these Terms at any time. Changes will be posted on this page with the updated date. Continued use of the website after changes are posted constitutes your acceptance of the updated Terms.</p>
   </div>

   <div class="pp-section">
    <h2>Orders and Payments</h2>
    <p>To place an order, select your products, provide contact and payment information, and submit through our website. All orders are subject to availability. You will receive an order confirmation email once placed. If there are any issues, we will contact you as soon as possible.</p>
    <p>We accept payments through credit/debit cards and PayPal. Payments must be completed before orders are processed. By submitting payment details, you confirm the information is accurate and you are authorised to use the payment method.</p>
   </div>

   <div class="pp-section">
    <h2>Product Availability and Descriptions</h2>
    <p>We make every effort to ensure products are accurately described and available. However, errors may occur and we cannot guarantee all products will be in stock at all times.</p>
    <p>If a product is unavailable or described incorrectly, we will inform you and offer options to cancel the order or select an alternative.</p>
   </div>

   <div class="pp-section">
    <h2>Delivery and Shipping</h2>
    <p>We offer local delivery within Kettering and surrounding areas, and UK-wide delivery for selected products. Please refer to our <a href="<?php echo e(route('delivery-shipping')); ?>">Delivery &amp; Shipping page</a> for detailed information.</p>
    <p>All orders require a minimum 1-day pre-order. Once dispatched, you will receive tracking details via email. Delivery times may vary due to weather, courier delays, or high demand.</p>
   </div>

   <div class="pp-section">
    <h2>Returns and Refunds</h2>
    <p>Due to the perishable nature of our products, we generally do not accept returns. If you receive a damaged or faulty product, please contact us within 24 hours of delivery and we will offer a replacement or refund at our discretion.</p>
    <p>Refunds will not be provided for products that were not faulty or damaged, or if you change your mind after the order is placed. Please see our <a href="<?php echo e(route('refunds-returns')); ?>">Refunds &amp; Returns Policy</a> for full details.</p>
   </div>

   <div class="pp-section">
    <h2>Privacy and Data Protection</h2>
    <p>We respect your privacy and are committed to protecting your personal data. For details on how we collect, use, and protect your information, please refer to our <a href="<?php echo e(route('privacy-policy')); ?>">Privacy Policy</a>.</p>
   </div>

   <div class="pp-section">
    <h2>Use of the Website</h2>
    <p>We do not require account registration to use our website. You can place orders by providing your email address and other necessary information. You agree to provide accurate and complete details when placing an order.</p>
    <p>You agree not to use our website for any unlawful or prohibited purposes, including:</p>
    <ul>
     <li>Using the website for fraudulent purposes</li>
     <li>Attempting to disrupt or interfere with the functionality of the website</li>
     <li>Violating any intellectual property rights</li>
    </ul>
   </div>

   <div class="pp-section">
    <h2>Intellectual Property</h2>
    <p>All content on the Current Cravings website — including images, logos, text, graphics, and other materials — is owned by Current Cravings or its licensors and is protected by copyright and intellectual property laws. You may not copy, reproduce, distribute, or modify any content without prior written consent.</p>
   </div>

   <div class="pp-section">
    <h2>Limitation of Liability</h2>
    <p>To the fullest extent permitted by law, Current Cravings will not be liable for any indirect, special, incidental, or consequential damages arising from your use of our website or products, including loss of profits, revenue, data, or other intangible losses.</p>
    <p>We do not guarantee the website will be free of errors or interruptions, and we are not responsible for any downtime caused by external factors.</p>
   </div>

   <div class="pp-section">
    <h2>Governing Law</h2>
    <p>These Terms are governed by and construed in accordance with the laws of <strong>England and Wales</strong>. Any disputes arising under these Terms will be subject to the exclusive jurisdiction of the courts of England and Wales.</p>
   </div>

   <div style="margin-top:8px;background:linear-gradient(135deg,#fff0f4,#fffbff);border:1.5px solid rgba(242,125,153,0.2);border-radius:18px;padding:28px 32px;">
    <h2 style="margin-top:0;">Contact Us</h2>
    <p style="margin-bottom:16px;">If you have any questions about these Terms of Service, please contact us:</p>
    <div style="display:grid;gap:10px;">
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">mail</span><a href="mailto:currentcravings4@gmail.com" style="color:#e8627d;font-weight:600;">currentcravings4@gmail.com</a></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">call</span><span>+44 753 4738441</span></div>
     <div style="display:flex;align-items:center;gap:10px;"><span class="material-symbols-outlined" style="color:#f27d99;font-size:20px;">location_on</span><span>King Street, Kettering NN16 8JF, United Kingdom</span></div>
    </div>
   </div>

   <?php endif; ?>
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
.pp-section a { color:#e8627d; font-weight:600; text-decoration:underline; text-underline-offset:3px; }
.pp-section ul { list-style:none; padding:0; margin:0; display:grid; gap:8px; }
.pp-section ul li { font-size:15px; line-height:1.7; color:#66645e; padding-left:20px; position:relative; }
.pp-section ul li::before { content:''; position:absolute; left:0; top:10px; width:7px; height:7px; border-radius:50%; background:#f27d99; }
@media(max-width:640px) { div[style*="padding:40px 48px"] { padding:28px 20px !important; } }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/terms-of-service.blade.php ENDPATH**/ ?>