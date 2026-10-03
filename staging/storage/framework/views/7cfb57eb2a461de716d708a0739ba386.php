
<?php $__env->startSection('title', 'Checkout | Current Cravings'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  /* ORDER SUCCESS POPUP */
  .order-popup-overlay {
    position: fixed; inset: 0; background: rgba(26,16,24,.55);
    backdrop-filter: blur(6px); z-index: 2000;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity .35s ease;
  }
  .order-popup-overlay.show { opacity: 1; pointer-events: all; }
  .order-popup {
    background: #fffbff; border-radius: 28px;
    padding: 40px 36px; max-width: 460px; width: 90%;
    text-align: center; position: relative;
    box-shadow: 0 32px 80px rgba(242,125,153,.25);
    transform: translateY(30px) scale(.96);
    transition: transform .4s cubic-bezier(.34,1.56,.64,1);
  }
  .order-popup-overlay.show .order-popup { transform: translateY(0) scale(1); }
  .popup-icon {
    width: 72px; height: 72px; border-radius: 50%;
    background: linear-gradient(135deg,#f27d99,#e8627d);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 12px 32px rgba(242,125,153,.35);
  }
  .popup-icon .material-symbols-outlined { font-size: 36px; color: #fff; font-variation-settings: 'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24; }
  .popup-title { font-family: "Epilogue",sans-serif; font-size: 26px; font-weight: 900; color: #3a3526; letter-spacing: -.02em; margin-bottom: 8px; }
  .popup-sub { font-size: 13.5px; color: #6b6455; margin-bottom: 22px; line-height: 1.6; }
  .popup-details {
    background: #f7f3e9; border-radius: 16px; padding: 16px 20px;
    text-align: left; margin-bottom: 24px;
  }
  .popup-row { display: flex; justify-content: space-between; align-items: center; padding: 6px 0; border-bottom: 1px dashed rgba(242,125,153,.2); font-size: 13px; }
  .popup-row:last-child { border-bottom: none; }
  .popup-row .pl { color: #9c9385; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: .07em; }
  .popup-row .pv { font-weight: 700; color: #3a3526; }
  .popup-row .pv.pink { color: #f27d99; font-size: 16px; font-family: "Epilogue",sans-serif; }
  .popup-btn {
    width: 100%; padding: 14px;
    background: linear-gradient(135deg,#f27d99,#e8627d);
    color: #fff; border: none; border-radius: 14px;
    font-family: "Epilogue",sans-serif; font-size: 12px; font-weight: 900;
    letter-spacing: .12em; text-transform: uppercase;
    cursor: pointer; transition: transform .2s, box-shadow .2s;
  }
  .popup-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(242,125,153,.4); }
  .confetti-wrap { position: absolute; inset: 0; pointer-events: none; overflow: hidden; border-radius: 28px; }
  :root {
    --pink:       #f27d99;
    --pink-deep:  #e8627d;
    --pink-soft:  #fde8ef;
    --pink-pale:  #fff5f8;
    --cream:      #fffbf5;
    --butter:     #f7f3e9;
    --green:      #bef458;
    --green-dark: #6a9a1f;
    --gold:       #fcd47e;
    --ink:        #3a3526;
    --ink-mid:    #6b6455;
    --ink-light:  #9c9385;
  }

  .material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
    font-size: 17px;
    vertical-align: middle;
    line-height: 1;
  }

  .checkout-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: calc(var(--cc-header-offset) + 38px) 28px 80px;
  }
  @media (max-width: 640px) { .checkout-wrap { padding: calc(var(--cc-header-offset) + 24px) 16px 60px; } }

  .pg-head { margin-bottom: 30px; }
  .pg-head h1 {
    font-family: "Epilogue", sans-serif;
    font-size: 40px;
    font-weight: 900;
    letter-spacing: -.025em;
    line-height: 1;
    color: var(--ink);
  }
  .pg-head h1 em { font-style: italic; color: var(--pink); }
  .pg-head p { color: var(--ink-mid); margin-top: 9px; font-size: 13.5px; max-width: 500px; }
  @media (max-width: 640px) { .pg-head h1 { font-size: 30px; } }

  .stepper {
    display: inline-flex;
    align-items: center;
    margin-bottom: 30px;
    background: #fff;
    border: 1.5px solid rgba(242,125,153,0.18);
    border-radius: 16px;
    padding: 5px;
  }
  .spill {
    border: none;
    background: transparent;
    padding: 9px 20px;
    border-radius: 12px;
    font-family: "Epilogue", sans-serif;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--ink-light);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: all .2s;
  }
  .spill .snum {
    width: 21px; height: 21px;
    border-radius: 50%;
    border: 1.5px solid currentColor;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; flex-shrink: 0; transition: all .2s;
  }
  .spill.active { background: var(--pink); color: #fff; }
  .spill.done { color: var(--pink-deep); }
  .spill.done .snum { background: var(--pink); color: #fff; border-color: var(--pink); }
  .sdivider { width: 18px; height: 1.5px; background: rgba(242,125,153,0.18); }
  @media (max-width: 480px) {
    .spill { padding: 8px 12px; font-size: 10px; }
    .spill .snum { width: 18px; height: 18px; }
  }

  .checkout-grid {
    display: grid;
    grid-template-columns: 1.2fr .8fr;
    gap: 24px;
    align-items: start;
  }
  @media (max-width: 860px) { .checkout-grid { grid-template-columns: 1fr; } }

  .card {
    background: #fff;
    border: 1.5px solid rgba(242,125,153,0.14);
    border-radius: 24px;
    padding: 26px;
    margin-bottom: 18px;
  }
  .card:last-of-type { margin-bottom: 0; }
  .ctitle {
    font-family: "Epilogue", sans-serif;
    font-size: 12px; font-weight: 900;
    letter-spacing: .13em; text-transform: uppercase;
    color: var(--pink); margin-bottom: 3px;
  }
  .csub { font-size: 12.5px; color: var(--ink-light); margin-bottom: 18px; }
  .cdivider { height: 1px; background: rgba(242,125,153,0.11); margin: 18px 0; }

  .field { margin-top: 13px; }
  .field label { display: block; font-size: 11.5px; font-weight: 700; color: var(--ink-mid); margin-bottom: 6px; letter-spacing: .03em; }
  .field input, .field select, .field textarea {
    width: 100%;
    border: 1.5px solid rgba(58,53,38,0.12);
    border-radius: 13px;
    padding: 11px 14px;
    font-family: "Be Vietnam Pro", sans-serif;
    font-size: 13.5px;
    background: var(--butter);
    color: var(--ink);
    transition: border .2s, box-shadow .2s;
    outline: none;
  }
  .field input:focus, .field select:focus, .field textarea:focus {
    border-color: var(--pink);
    background: #fff;
    box-shadow: 0 0 0 3px rgba(242,125,153,0.12);
  }
  .field input::placeholder, .field textarea::placeholder { color: #bfb8ae; }
  .form-error { margin-top: 6px; font-size: 11.5px; color: #c43d4f; font-weight: 600; }
  .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 13px; }
  .three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; margin-top: 13px; }
  @media (max-width: 520px) { .two-col, .three-col { grid-template-columns: 1fr; } }

  .chip-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; }
  .chip {
    border: 1.5px solid rgba(58,53,38,0.12);
    background: var(--butter);
    border-radius: 11px;
    padding: 9px 13px;
    font-size: 12px; font-weight: 700; letter-spacing: .04em;
    color: var(--ink-mid);
    display: flex; align-items: center; gap: 7px;
    cursor: pointer; transition: all .2s; user-select: none;
  }
  .chip:hover { border-color: var(--pink); color: var(--pink); background: var(--pink-soft); }
  .chip.active { background: var(--pink-soft); color: var(--pink-deep); border-color: var(--pink); }

  .step-panel { display: none; }
  .step-panel.active { display: block; }

  .rtable { margin-top: 6px; }
  .rrow {
    display: flex; justify-content: space-between; align-items: flex-start;
    gap: 14px; padding: 11px 0;
    border-bottom: 1px dashed rgba(242,125,153,0.18);
  }
  .rrow:last-child { border-bottom: none; }
  .rlabel { font-size: 11px; font-weight: 800; letter-spacing: .09em; text-transform: uppercase; color: var(--ink-light); flex-shrink: 0; }
  .rval { font-weight: 700; font-size: 13.5px; color: var(--ink); text-align: right; }

  .actions { display: flex; gap: 10px; margin-top: 4px; }
  .btn-back {
    flex: 0 0 auto;
    border: 1.5px solid rgba(58,53,38,0.14);
    background: var(--butter);
    border-radius: 14px; padding: 12px 20px;
    font-family: "Epilogue", sans-serif;
    font-weight: 900; letter-spacing: .1em; text-transform: uppercase; font-size: 11px;
    cursor: pointer; color: var(--ink-mid); transition: all .2s;
  }
  .btn-back:hover { border-color: var(--pink); color: var(--pink); }
  .btn-back:disabled { opacity: .38; cursor: not-allowed; }
  .btn-next {
    flex: 1;
    background: linear-gradient(135deg, var(--pink) 0%, var(--pink-deep) 100%);
    color: #fff; border: none; border-radius: 14px; padding: 13px 20px;
    font-family: "Epilogue", sans-serif;
    font-weight: 900; letter-spacing: .13em; text-transform: uppercase; font-size: 12px;
    cursor: pointer; transition: transform .2s, box-shadow .2s;
  }
  .btn-next:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(242,125,153,0.3); }

  .summary { position: sticky; top: 78px; }
  @media (max-width: 860px) { .summary { position: static; } }

  .prod-row {
    display: flex; gap: 13px; align-items: center;
    padding: 12px 0;
    border-bottom: 1px dashed rgba(242,125,153,0.16);
  }
  .prod-row:last-of-type { border-bottom: none; padding-bottom: 2px; }
  .prod-img {
    width: 52px; height: 52px; border-radius: 13px; flex-shrink: 0;
    background: var(--pink-soft);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    border: 1.5px solid rgba(242,125,153,0.15); overflow: hidden;
  }
  .prod-img img { width: 100%; height: 100%; object-fit: cover; }
  .prod-name { font-weight: 800; font-size: 13.5px; color: var(--ink); }
  .prod-meta { font-size: 12px; color: var(--ink-light); margin-top: 2px; }
  .pprice { font-weight: 800; color: var(--pink); font-size: 14px; flex-shrink: 0; }

  .totals { margin-top: 14px; padding-top: 13px; border-top: 1.5px solid rgba(242,125,153,0.14); }
  .trow { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; font-size: 13px; }
  .trow .tl { color: var(--ink-mid); }
  .trow .tv { font-weight: 700; color: var(--ink); }
  .trow.grand { margin-top: 11px; padding-top: 11px; border-top: 1px dashed rgba(242,125,153,0.18); }
  .trow.grand .tl { font-weight: 800; font-size: 14.5px; color: var(--ink); }
  .trow.grand .tv { font-family: "Epilogue", sans-serif; font-size: 26px; color: var(--pink); font-weight: 900; }

  .free-badge { background: var(--green); color: var(--green-dark); font-size: 11px; font-weight: 800; padding: 3px 9px; border-radius: 999px; letter-spacing: .05em; }

  .place-btn {
    width: 100%; margin-top: 18px;
    background: linear-gradient(135deg, var(--pink) 0%, var(--pink-deep) 100%);
    color: #fff; border: none; border-radius: 16px; padding: 15px;
    font-family: "Epilogue", sans-serif;
    font-size: 12px; font-weight: 900; letter-spacing: .14em; text-transform: uppercase;
    cursor: pointer; transition: transform .22s, box-shadow .22s; display: none;
  }
  .place-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(242,125,153,0.35); }

  .order-note { font-size: 11px; color: var(--ink-light); text-align: center; margin-top: 10px; line-height: 1.65; }

  .badges { display: flex; justify-content: center; gap: 16px; margin-top: 15px; flex-wrap: wrap; }
  .badge { display: flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 700; color: var(--ink-light); }
  .badge .material-symbols-outlined { font-size: 15px; color: var(--pink); }

  .promo-bar {
    background: var(--green); border-radius: 16px; padding: 13px 16px;
    display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
  }
  .promo-bar .material-symbols-outlined { color: var(--green-dark); font-size: 18px; flex-shrink: 0; }
  .promo-bar p { font-size: 12.5px; font-weight: 700; color: var(--green-dark); }
  .promo-bar p b { font-weight: 900; }

  .status-alert {
    border-radius: 18px;
    padding: 14px 16px;
    margin-bottom: 18px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    border: 1.5px solid transparent;
  }
  .status-alert .material-symbols-outlined { margin-top: 1px; }
  .status-alert.error {
    background: #fff1f3;
    border-color: rgba(196,61,79,.18);
    color: #9f2f43;
  }
  .status-alert.info {
    background: #fff8e9;
    border-color: rgba(252,212,126,.35);
    color: #8d6200;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $cms = $cms ?? [];
  $checkoutTimeSlots = [
    $cms['checkout_time_slot_1'] ?? '9:00 AM - 11:00 AM',
    $cms['checkout_time_slot_2'] ?? '11:00 AM - 1:00 PM',
    $cms['checkout_time_slot_3'] ?? '1:00 PM - 3:00 PM',
    $cms['checkout_time_slot_4'] ?? '3:00 PM - 5:00 PM',
    $cms['checkout_time_slot_5'] ?? '5:00 PM - 7:00 PM',
  ];
?>

<?php if(session('order_confirmed')): ?>
<?php $oc = session('order_confirmed'); ?>
<div class="order-popup-overlay" id="orderPopup">
  <div class="order-popup">
    <div class="confetti-wrap" id="confettiWrap"></div>
    <div class="popup-icon">
      <span class="material-symbols-outlined">check</span>
    </div>
    <div class="popup-title"><?php echo e($cms['checkout_popup_title'] ?? 'Order Confirmed!'); ?></div>
    <div class="popup-sub"><?php echo e(str_replace(':name', $oc['customer_name'] ?? '', $cms['checkout_popup_sub'] ?? 'Thank you, :name! Your sweet treats are on their way.')); ?></div>
    <div class="popup-details">
      <div class="popup-row">
        <span class="pl"><?php echo e($cms['checkout_popup_order_label'] ?? 'Order No.'); ?></span>
        <span class="pv">#<?php echo e($oc['order_number']); ?></span>
      </div>
      <div class="popup-row">
        <span class="pl"><?php echo e($cms['checkout_popup_delivery_label'] ?? 'Delivery'); ?></span>
        <span class="pv"><?php echo e($oc['delivery_slot'] ?? ($cms['checkout_popup_delivery_fallback'] ?? 'TBD')); ?></span>
      </div>
      <div class="popup-row">
        <span class="pl"><?php echo e($cms['checkout_popup_total_label'] ?? 'Total'); ?></span>
        <span class="pv pink">&pound;<?php echo e(number_format((float)$oc['total'], 2)); ?></span>
      </div>
    </div>
    <button class="popup-btn" onclick="document.getElementById('orderPopup').classList.remove('show'); window.location='<?php echo e(route('home')); ?>'">
      <?php echo e($cms['checkout_popup_button'] ?? 'Back to Home'); ?>

    </button>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('orderPopup');
    setTimeout(() => popup.classList.add('show'), 100);

    const wrap = document.getElementById('confettiWrap');
    const colors = ['#f27d99','#fbb6c8','#bef458','#fcd47e','#e8627d','#fff'];
    for (let i = 0; i < 40; i++) {
      const el = document.createElement('div');
      const size = 6 + Math.random() * 8;
      el.style.cssText = `position:absolute;width:${size}px;height:${size}px;`
        + `background:${colors[Math.floor(Math.random()*colors.length)]};`
        + `border-radius:${Math.random()>.5?'50%':'3px'};`
        + `left:${Math.random()*100}%;top:-10px;`
        + `animation:confettiFall ${1.5+Math.random()*2}s ease-in ${Math.random()*1.2}s forwards;`
        + `opacity:0;`;
      wrap.appendChild(el);
    }
  });
</script>
<style>
  @keyframes confettiFall {
    0%   { transform: translateY(0) rotate(0deg); opacity: 1; }
    100% { transform: translateY(500px) rotate(720deg); opacity: 0; }
  }
</style>
<?php endif; ?>
<div class="checkout-wrap">
  <?php if(session('error')): ?>
    <div class="status-alert error">
      <span class="material-symbols-outlined">error</span>
      <div><?php echo e(session('error')); ?></div>
    </div>
  <?php endif; ?>

  <?php if(session('info')): ?>
    <div class="status-alert info">
      <span class="material-symbols-outlined">info</span>
      <div><?php echo e(session('info')); ?></div>
    </div>
  <?php endif; ?>

  <div class="pg-head">
    <h1><?php echo e($cms['checkout_heading'] ?? 'Your Sweet Checkout'); ?></h1>
    <p><?php echo e($cms['checkout_subheading'] ?? 'Fast, secure, and smooth. Your desserts are minutes away from door-to-door happiness.'); ?></p>
  </div>

  <div class="stepper">
    <button type="button" class="spill active" data-step="shipping">
      <span class="snum">1</span> <?php echo e($cms['checkout_step_shipping'] ?? 'Shipping'); ?>

    </button>
    <div class="sdivider"></div>
    <button type="button" class="spill" data-step="payment">
      <span class="snum">2</span> <?php echo e($cms['checkout_step_payment'] ?? 'Payment'); ?>

    </button>
    <div class="sdivider"></div>
    <button type="button" class="spill" data-step="review">
      <span class="snum">3</span> <?php echo e($cms['checkout_step_review'] ?? 'Review'); ?>

    </button>
  </div>

  <form class="checkout-grid" id="checkoutForm" method="POST" action="<?php echo e(route('checkout.store')); ?>">
    <?php echo csrf_field(); ?>

    <div>
      <div class="step-panel active" data-step="shipping">
        <div class="card">
          <div class="ctitle"><?php echo e($cms['checkout_delivery_title'] ?? 'Delivery Details'); ?></div>
          <div class="csub"><?php echo e($cms['checkout_delivery_sub'] ?? 'Tell us where to drop the sweetness.'); ?></div>

          <div class="two-col">
            <div class="field">
              <label><?php echo e($cms['checkout_first_name_label'] ?? 'First Name'); ?></label>
              <input id="firstName" name="first_name" type="text" placeholder="<?php echo e($cms['checkout_first_name_placeholder'] ?? 'Aisha'); ?>" value="<?php echo e(old('first_name')); ?>" />
              <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="field">
              <label><?php echo e($cms['checkout_last_name_label'] ?? 'Last Name'); ?></label>
              <input id="lastName" name="last_name" type="text" placeholder="<?php echo e($cms['checkout_last_name_placeholder'] ?? 'Khan'); ?>" value="<?php echo e(old('last_name')); ?>" />
              <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>

          <input id="fullName" name="name" type="hidden" />

          <div class="field">
            <label><?php echo e($cms['checkout_email_label'] ?? 'Email Address'); ?></label>
            <input id="email" name="email" type="email" placeholder="<?php echo e($cms['checkout_email_placeholder'] ?? 'you@example.com'); ?>" value="<?php echo e(old('email')); ?>" />
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="field">
            <label><?php echo e($cms['checkout_phone_label'] ?? 'Phone Number'); ?></label>
            <input id="phone" name="phone" type="tel" placeholder="<?php echo e($cms['checkout_phone_placeholder'] ?? '+44 7700 900123'); ?>" value="<?php echo e(old('phone')); ?>" />
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="field">
            <label><?php echo e($cms['checkout_address_label'] ?? 'Street Address'); ?></label>
            <input id="address" name="address" type="text" placeholder="<?php echo e($cms['checkout_address_placeholder'] ?? '123 Baker Street'); ?>" value="<?php echo e(old('address')); ?>" />
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="two-col">
            <div class="field">
              <label><?php echo e($cms['checkout_city_label'] ?? 'City / Town'); ?></label>
              <input id="city" name="city" type="text" placeholder="<?php echo e($cms['checkout_city_placeholder'] ?? 'e.g. Kettering, London, Manchester'); ?>" value="<?php echo e(old('city')); ?>" />
              <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="field">
              <label><?php echo e($cms['checkout_postcode_label'] ?? 'Postcode'); ?></label>
              <input id="postcode" name="postcode" type="text" placeholder="<?php echo e($cms['checkout_postcode_placeholder'] ?? 'NN16'); ?>" value="<?php echo e(old('postcode')); ?>" />
              <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>

          <div class="cdivider"></div>

          <div class="ctitle" style="margin-bottom:3px"><?php echo e($cms['checkout_datetime_title'] ?? 'Delivery Date & Time'); ?></div>
          <div class="csub" style="margin-bottom:8px"><?php echo e($cms['checkout_datetime_sub'] ?? 'Select your preferred delivery date and time.'); ?></div>
          <div class="two-col">
            <div class="field">
              <label><?php echo e($cms['checkout_date_label'] ?? 'Choose Date'); ?></label>
              <input type="date" id="deliveryDate" name="delivery_date" value="<?php echo e(old('delivery_date')); ?>" />
            </div>
            <div class="field">
              <label><?php echo e($cms['checkout_time_label'] ?? 'Choose Time'); ?></label>
              <select id="deliveryTime" name="delivery_time">
                <?php $__currentLoopData = $checkoutTimeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($slot); ?>" <?php if(old('delivery_time') === $slot): echo 'selected'; endif; ?>><?php echo e($slot); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          </div>
        </div>

        <div class="actions">
          <button type="button" class="btn-back" id="back1" disabled><?php echo e($cms['checkout_back_button'] ?? 'Back'); ?></button>
          <button type="button" class="btn-next" id="next1"><?php echo e($cms['checkout_continue_payment_button'] ?? 'Continue to Payment'); ?> -></button>
        </div>
      </div>

      <div class="step-panel" data-step="payment">
        <div class="card">
          <div class="ctitle"><?php echo e($cms['checkout_payment_title'] ?? 'Secure Payment'); ?></div>
          <div class="csub"><?php echo e($cms['checkout_payment_sub'] ?? 'We use Stripe Checkout so card details never touch your server. Stripe may show card, Apple Pay, Google Pay, and other supported methods automatically.'); ?></div>

          <div class="promo-bar" style="background:var(--pink-soft); margin-bottom:0;">
            <span class="material-symbols-outlined" style="color:var(--pink-deep);">lock</span>
            <p style="color:var(--pink-deep);"><?php echo e($cms['checkout_payment_redirect_note'] ?? 'After review, you will be redirected to Stripe\'s secure payment page to complete your order.'); ?></p>
          </div>

          <div class="badges" style="justify-content:flex-start; margin-top:16px;">
            <div class="badge"><span class="material-symbols-outlined">verified_user</span><?php echo e($cms['checkout_payment_badge_1'] ?? 'Stripe-hosted'); ?></div>
            <div class="badge"><span class="material-symbols-outlined">credit_card</span><?php echo e($cms['checkout_payment_badge_2'] ?? 'Cards + wallets'); ?></div>
            <div class="badge"><span class="material-symbols-outlined">shield_lock</span><?php echo e($cms['checkout_payment_badge_3'] ?? 'PCI-safer flow'); ?></div>
          </div>

          <div class="cdivider"></div>

          <div class="field">
            <label><?php echo e($cms['checkout_order_notes_label'] ?? 'Order Notes'); ?> <span style="font-weight:400;opacity:.65"><?php echo e($cms['checkout_optional_text'] ?? '(optional)'); ?></span></label>
            <textarea id="orderNotes" name="order_notes" rows="3" placeholder="<?php echo e($cms['checkout_order_notes_placeholder'] ?? 'Allergies, special instructions, delivery notes'); ?>"><?php echo e(old('order_notes')); ?></textarea>
          </div>
        </div>

        <div class="actions">
          <button type="button" class="btn-back" id="back2"><?php echo e($cms['checkout_back_button'] ?? 'Back'); ?></button>
          <button type="button" class="btn-next" id="next2"><?php echo e($cms['checkout_continue_review_button'] ?? 'Continue to Review'); ?> -></button>
        </div>
      </div>

      <div class="step-panel" data-step="review">
        <div class="card">
          <div class="ctitle"><?php echo e($cms['checkout_review_title'] ?? 'Review Your Order'); ?></div>
          <div class="csub"><?php echo e($cms['checkout_review_sub'] ?? 'Everything look right? We will send you to secure Stripe Checkout for payment.'); ?></div>
          <div class="rtable">
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_name_label'] ?? 'Name'); ?></span><span class="rval" id="reviewName"></span></div>
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_email_label'] ?? 'Email'); ?></span><span class="rval" id="reviewEmail"></span></div>
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_address_label'] ?? 'Address'); ?></span><span class="rval" id="reviewAddress"></span></div>
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_delivery_label'] ?? 'Delivery'); ?></span><span class="rval" id="reviewDelivery"></span></div>
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_payment_label'] ?? 'Payment'); ?></span><span class="rval" id="reviewPayment"></span></div>
            <div class="rrow"><span class="rlabel"><?php echo e($cms['checkout_review_notes_label'] ?? 'Notes'); ?></span><span class="rval" id="reviewNotes"></span></div>
          </div>
        </div>

        <div class="actions">
          <button type="button" class="btn-back" id="back3"><?php echo e($cms['checkout_back_button'] ?? 'Back'); ?></button>
          <button type="button" class="btn-next" id="next3"><?php echo e($cms['checkout_continue_secure_button'] ?? 'Continue to Secure Payment'); ?> -></button>
        </div>
      </div>

    </div>

    <div>
      <div class="promo-bar">
        <span class="material-symbols-outlined">local_offer</span>
        <p><?php echo $cms['checkout_promo_bar_text'] ?? '&pound;5.00 delivery &amp; shipment charge applies to all orders.'; ?></p>
      </div>

      <div class="card summary">
        <div class="ctitle"><?php echo e($cms['checkout_order_summary_title'] ?? 'Your Order'); ?></div>
        <div class="csub"><?php echo e($cms['checkout_order_summary_sub'] ?? 'A sweet summary of your cart.'); ?></div>

        <?php
          $items = $items ?? [];
        ?>
        <?php if(count($items)): ?>
          <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="prod-row">
              <div class="prod-img">
                <?php if(!empty($item['image'])): ?>
                  <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name'] ?? 'Item'); ?>" onerror="this.parentElement.innerHTML='Cookie'" />
                <?php else: ?>
                  Cookie
                <?php endif; ?>
              </div>
              <div style="flex:1">
                <div class="prod-name"><?php echo e($item['name'] ?? 'Item'); ?></div>
                <div class="prod-meta"><?php echo e((int)($item['quantity'] ?? 0)); ?> x &pound;<?php echo e(number_format((float)($item['price'] ?? 0), 2)); ?></div>
              </div>
              <div class="pprice">&pound;<?php echo e(number_format((float)($item['line_total'] ?? 0), 2)); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <div class="prod-row"><div class="prod-name"><?php echo e($cms['checkout_empty_cart_text'] ?? 'Your cart is empty.'); ?></div></div>
        <?php endif; ?>

        <div class="totals">
          <div class="trow">
            <span class="tl"><?php echo e($cms['checkout_subtotal_label'] ?? 'Subtotal'); ?></span>
            <span class="tv">&pound;<?php echo e(number_format((float)($subtotal ?? 0), 2)); ?></span>
          </div>
          <div class="trow">
            <span class="tl"><?php echo e($cms['checkout_delivery_label'] ?? 'Delivery & Shipment'); ?></span>
            <span class="tv">&pound;<?php echo e(number_format((float)($delivery_fee ?? 0), 2)); ?></span>
          </div>
          <div class="trow grand">
            <span class="tl"><?php echo e($cms['checkout_total_label'] ?? 'Total'); ?></span>
            <span class="tv">&pound;<?php echo e(number_format((float)($total ?? 0), 2)); ?></span>
          </div>
        </div>

        <button class="place-btn" id="placeOrderBtn" type="submit"><?php echo e($cms['checkout_place_button'] ?? 'Continue to Secure Payment'); ?></button>
        <p class="order-note"><?php echo e($cms['checkout_note'] ?? 'By continuing, you agree to our Terms & Conditions and will be redirected to Stripe Checkout to pay securely.'); ?></p>

        <div class="badges">
          <div class="badge"><span class="material-symbols-outlined">lock</span><?php echo e($cms['checkout_badge_secure'] ?? 'Secure'); ?></div>
          <div class="badge"><span class="material-symbols-outlined">verified</span><?php echo e($cms['checkout_badge_encrypted'] ?? 'Encrypted'); ?></div>
          <div class="badge"><span class="material-symbols-outlined">local_shipping</span><?php echo e($cms['checkout_badge_delivery'] ?? 'Fast Delivery'); ?></div>
        </div>
      </div>
    </div>

  </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
  const steps = ["shipping", "payment", "review"];
  let cur = 0;

  const pills    = document.querySelectorAll(".spill");
  const panels   = document.querySelectorAll(".step-panel");
  const placeBtn = document.getElementById("placeOrderBtn");

  const g   = id => document.getElementById(id);
  const set = (id, v) => { const e = g(id); if (e) e.textContent = v || ""; };

  const syncName = () => {
    const full = g("fullName");
    if (!full) return;
    full.value = ((g("firstName")?.value || "") + " " + (g("lastName")?.value || "")).trim();
  };

  function fillReview() {
    syncName();
    set("reviewName",     g("fullName")?.value || "");
    set("reviewEmail",    g("email")?.value || "");
    set("reviewAddress",  [g("address")?.value, g("city")?.value, g("postcode")?.value].filter(Boolean).join(", "));
    set("reviewDelivery", (g("deliveryDate")?.value || "") + (g("deliveryTime")?.value ? " - " + g("deliveryTime").value : ""));
    set("reviewPayment",  <?php echo json_encode($cms['checkout_review_payment_value'] ?? 'Stripe Checkout', 15, 512) ?>);
    set("reviewNotes",    g("orderNotes")?.value || "");
  }

  function go(idx) {
    cur = Math.min(Math.max(idx, 0), steps.length - 1);
    pills.forEach((b, i) => {
      b.classList.toggle("active", i === cur);
      b.classList.toggle("done",   i < cur);
    });
    panels.forEach(p => p.classList.toggle("active", p.dataset.step === steps[cur]));
    if (placeBtn) placeBtn.style.display = cur === steps.length - 1 ? "block" : "none";
    if (cur === steps.length - 1) fillReview();
  }

  pills.forEach((b, i) => b.addEventListener("click", () => go(i)));
  ["back1","back2","back3"].forEach(id => { const b = g(id); if (b) b.addEventListener("click", () => go(cur - 1)); });
  ["next1","next2","next3"].forEach(id => {
    const b = g(id);
    if (b) b.addEventListener("click", () => {
      if (cur === steps.length - 1) { placeBtn?.click(); return; }
      go(cur + 1);
    });
  });

  const form = g("checkoutForm");
  if (form) form.addEventListener("submit", syncName);

  const timeSlots = [
    { label: <?php echo json_encode($checkoutTimeSlots[0], 15, 512) ?>, start: 9  },
    { label: <?php echo json_encode($checkoutTimeSlots[1], 15, 512) ?>, start: 11 },
    { label: <?php echo json_encode($checkoutTimeSlots[2], 15, 512) ?>, start: 13 },
    { label: <?php echo json_encode($checkoutTimeSlots[3], 15, 512) ?>, start: 15 },
    { label: <?php echo json_encode($checkoutTimeSlots[4], 15, 512) ?>, start: 17 },
  ];

  const dateInput  = document.getElementById('deliveryDate');
  const timeSelect = document.getElementById('deliveryTime');

  function updateTimeOptions() {
    if (!dateInput || !timeSelect) return;

    const now     = new Date();
    const nowY    = now.getFullYear(), nowM = now.getMonth(), nowD = now.getDate();
    const parts   = (dateInput.value || '').split('-');
    const selY    = parseInt(parts[0], 10), selM = parseInt(parts[1], 10) - 1, selD = parseInt(parts[2], 10);

    // If date is invalid/missing, keep all slots enabled.
    if (!Number.isFinite(selY) || !Number.isFinite(selM) || !Number.isFinite(selD)) {
      Array.from(timeSelect.options).forEach(opt => { opt.disabled = false; });
      return;
    }

    const diffDays = Math.round((new Date(selY, selM, selD) - new Date(nowY, nowM, nowD)) / 86400000);

    // Restrict only same-day bookings, not tomorrow/future dates.
    const minHour = diffDays === 0 ? now.getHours() : -1;

    let firstEnabled = null;
    Array.from(timeSelect.options).forEach(opt => {
      const slot   = timeSlots.find(s => s.label === opt.value);
      opt.disabled = slot ? slot.start <= minHour : false;
      if (!opt.disabled && !firstEnabled) firstEnabled = opt.value;
    });

    // Failsafe: if all were disabled by any edge case, re-enable everything.
    if (!firstEnabled) {
      Array.from(timeSelect.options).forEach(opt => { opt.disabled = false; });
      firstEnabled = timeSelect.options[0]?.value || '';
    }

    if (!timeSelect.value || timeSelect.options[timeSelect.selectedIndex]?.disabled) {
      timeSelect.value = firstEnabled || '';
    }
  }

  if (dateInput) {
    const now      = new Date();
    const tomorrow = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1);
    const fmt      = d => `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
    const existingValue = dateInput.value;
    dateInput.min   = fmt(tomorrow);
    dateInput.value = existingValue || fmt(tomorrow);
    dateInput.addEventListener('change', updateTimeOptions);
    updateTimeOptions();
  }

  go(0);
})();
</script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/checkout.blade.php ENDPATH**/ ?>