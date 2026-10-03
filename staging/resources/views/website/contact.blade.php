@extends('layouts.app')
@section('title', 'Contact Us | Current Cravings')
@php use Illuminate\Support\Str; @endphp

@push('styles')
<style>
  /* ── CSS Variables ── */
  :root {
    --cc-rose:       #f27d99;
    --cc-rose-dk:    #e8627d;
    --cc-rose-lt:    #fbb6c8;
    --cc-rose-bg:    #fff0f4;
    --cc-rose-soft:  #fde8ef;
    --cc-lime:       #bef458;
    --cc-lime-bg:    #f0fce4;
    --cc-lime-dk:    #4d6e00;
    --cc-gold:       #FCD47E;
    --cc-gold-bg:    #fffbe8;
    --cc-gold-dk:    #b06a00;
    --cc-text:       #2a1a22;
    --cc-text-mid:   #66645e;
    --cc-text-muted: #9c9385;
    --cc-border:     rgba(242,125,153,.15);
    --cc-surface:    #fff7fa;
    --cc-white:      #fffbff;
    --cc-radius-sm:  10px;
    --cc-radius-md:  16px;
    --cc-radius-lg:  22px;
    --cc-radius-xl:  32px;
  }

  /* ── Page shell ── */
  .contact-shell {
    background: linear-gradient(135deg, #fff0f4 0%, #fffbff 50%, #f7f3e9 100%);
    font-family: 'Be Vietnam Pro', sans-serif;
  }

  /* ── Hero ── */
  .contact-hero {
    padding: 80px 0 60px;
    text-align: center;
  }
  .contact-hero h1 {
    font-family: 'Epilogue', sans-serif;
    font-size: clamp(2.8rem, 6vw, 5rem);
    font-weight: 900;
    letter-spacing: -.04em;
    line-height: .95;
    color: var(--cc-text);
    margin: 0 0 16px;
  }
  .contact-hero p {
    font-size: 15px;
    color: var(--cc-text-mid);
    max-width: 480px;
    margin: 0 auto 32px;
    line-height: 1.75;
  }

  /* ── Badge pill ── */
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--cc-rose-bg);
    border: 1px solid rgba(242,125,153,.25);
    border-radius: 999px;
    padding: 6px 16px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--cc-rose-dk);
    margin-bottom: 20px;
  }
  .hero-badge .dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--cc-rose);
  }

  /* ── Quick contact pills ── */
  .qpill {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1.5px solid rgba(242,125,153,.18);
    border-radius: 999px;
    padding: 10px 20px;
    font-size: 13px;
    font-weight: 700;
    color: var(--cc-text);
    text-decoration: none;
    transition: all .2s;
    box-shadow: 0 4px 16px rgba(242,125,153,.08);
  }
  .qpill:hover {
    border-color: var(--cc-rose);
    color: var(--cc-rose-dk);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(242,125,153,.18);
  }
  .qpill .icon {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: var(--cc-rose-bg);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .qpill .icon .material-symbols-outlined {
    font-size: 15px;
    color: var(--cc-rose);
  }

  /* ── Main grid ── */
  .contact-grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 24px;
    align-items: start;
    max-width: 1080px;
    margin: 0 auto;
  }
  @media (max-width: 1024px) {
    .contact-grid { grid-template-columns: 1fr; }
  }

  /* ── Form card ── */
  .form-card {
    background: #fff;
    border-radius: var(--cc-radius-xl);
    border: 1.5px solid rgba(242,125,153,.12);
    box-shadow: 0 20px 60px rgba(242,125,153,.1);
    padding: 40px;
  }
  @media (max-width: 640px) {
    .form-card { padding: 24px 20px; border-radius: var(--cc-radius-lg); }
  }
  .form-card h2 {
    font-family: 'Epilogue', sans-serif;
    font-size: 1.6rem;
    font-weight: 900;
    color: var(--cc-text);
    margin: 0 0 4px;
    letter-spacing: -.03em;
  }
  .form-card .form-sub {
    font-size: 13px;
    color: var(--cc-text-muted);
    margin: 0 0 28px;
  }

  /* ── Topic tabs ── */
  .topic-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--cc-text-muted);
    margin-bottom: 10px;
  }
  .topic-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px; }
  .topic-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 999px;
    border: 1.5px solid rgba(242,125,153,.2);
    background: #fff7fa;
    font-size: 13px;
    font-weight: 700;
    color: var(--cc-text-mid);
    cursor: pointer;
    transition: all .18s;
    font-family: 'Be Vietnam Pro', sans-serif;
  }
  .topic-tab:hover {
    border-color: var(--cc-rose);
    color: var(--cc-rose-dk);
    background: var(--cc-rose-bg);
  }
  .topic-tab.active {
    background: linear-gradient(135deg, #f27d99, #e8627d);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 6px 20px rgba(242,125,153,.35);
  }
  .topic-tab .tab-emoji { font-size: 14px; }

  /* ── Field groups ── */
  .field-group {
    display: grid;
    gap: 14px;
    margin-bottom: 14px;
  }
  .field-group.cols-2 {
    grid-template-columns: 1fr 1fr;
  }
  @media (max-width: 560px) {
    .field-group.cols-2 { grid-template-columns: 1fr; }
  }

  .field-wrap {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .field-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--cc-text-muted);
  }
  .field-label span { font-weight: 400; text-transform: none; letter-spacing: 0; font-size: 10px; }
  .field-input {
    width: 100%;
    border: 1.5px solid #f0dde5;
    border-radius: 999px;
    background: #fffbff;
    color: var(--cc-text);
    font-size: 14px;
    font-weight: 500;
    padding: 12px 16px;
    transition: border-color .18s, box-shadow .18s;
    outline: none;
    font-family: 'Be Vietnam Pro', sans-serif;
    box-sizing: border-box;
  }
  .field-input::placeholder { color: #bcb9b1; font-weight: 400; }
  .field-input:focus {
    border-color: var(--cc-rose);
    box-shadow: 0 0 0 3px rgba(242,125,153,.12);
    background: #fff;
  }
  .field-input.error { border-color: var(--cc-rose-dk); }
  textarea.field-input {
    resize: vertical;
    min-height: 120px;
    border-radius: 20px;
    line-height: 1.65;
  }

  /* ── Divider ── */
  .form-divider { border: none; border-top: 1.5px solid rgba(242,125,153,.1); margin: 24px 0; }

  /* ── Submit button ── */
  .submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: linear-gradient(135deg, #f27d99, #e8627d);
    color: #fff;
    border: none;
    border-radius: 999px;
    padding: 14px 32px;
    font-family: 'Epilogue', sans-serif;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: all .3s cubic-bezier(.34,1.56,.64,1);
    box-shadow: 0 8px 28px rgba(242,125,153,.35);
    position: relative;
    overflow: hidden;
  }
  .submit-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,.18);
    transform: translateX(-110%) skewX(-12deg);
    transition: transform .5s ease;
  }
  .submit-btn:hover::before { transform: translateX(110%) skewX(-12deg); }
  .submit-btn:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(242,125,153,.5); }
  .submit-note { font-size: 12px; color: var(--cc-text-muted); margin-left: 4px; }

  /* ── Alerts ── */
  .alert-success {
    display: flex; align-items: center; gap: 12px;
    background: var(--cc-lime-bg);
    border: 1px solid rgba(190,244,88,.4);
    border-radius: var(--cc-radius-md);
    padding: 14px 18px; margin-bottom: 24px;
    font-size: 13px; color: var(--cc-lime-dk);
  }
  .alert-error {
    background: var(--cc-rose-bg);
    border: 1px solid rgba(242,125,153,.25);
    border-radius: var(--cc-radius-md);
    padding: 14px 18px; margin-bottom: 24px;
    font-size: 13px; color: #8a1f1f;
  }
  .field-error { font-size: 11px; color: var(--cc-rose-dk); font-weight: 600; margin-top: 3px; }

  /* ── Sidebar ── */
  .side-card {
    background: #fff;
    border-radius: var(--cc-radius-lg);
    border: 1.5px solid rgba(242,125,153,.12);
    padding: 22px;
    box-shadow: 0 8px 32px rgba(242,125,153,.07);
  }
  .side-card + .side-card { margin-top: 14px; }
  .side-card-title {
    font-family: 'Epilogue', sans-serif;
    font-size: 15px;
    font-weight: 800;
    color: var(--cc-text);
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
  }
  .side-card-title .dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

  /* ── Info rows ── */
  .info-row { display: flex; align-items: center; gap: 12px; padding: 9px 0; border-bottom: 1px solid rgba(242,125,153,.08); }
  .info-row:last-child { border-bottom: none; padding-bottom: 0; }
  .info-icon { width: 34px; height: 34px; border-radius: 10px; background: var(--cc-rose-bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .info-icon .material-symbols-outlined { font-size: 15px; color: var(--cc-rose); }
  .info-text { font-size: 13px; font-weight: 600; color: var(--cc-text); }
  .info-sub  { font-size: 11px; color: var(--cc-text-muted); margin-top: 1px; }

  /* ── Area chips ── */
  .area-chip {
    display: inline-block;
    background: var(--cc-rose-bg);
    border: 1px solid rgba(242,125,153,.2);
    border-radius: 999px;
    padding: 5px 14px;
    font-size: 12px;
    font-weight: 700;
    color: var(--cc-text-mid);
    margin: 3px;
  }

  /* ── Social rows ── */
  .social-row { display: flex; align-items: center; gap: 12px; padding: 9px 10px; border-radius: var(--cc-radius-sm); text-decoration: none; transition: background .18s; }
  .social-row:hover { background: var(--cc-rose-bg); }
  .social-avatar { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0; overflow: hidden; }
  .social-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .social-name   { font-size: 13px; font-weight: 700; color: var(--cc-text); }
  .social-handle { font-size: 11px; color: var(--cc-text-muted); }

  /* ── Location card ── */
  .loc-card { padding: 0; overflow: hidden; }
  .loc-card img { width: 100%; height: 190px; object-fit: cover; display: block; }
  .loc-body { padding: 16px 20px; }
  .loc-body strong { font-family: 'Epilogue', sans-serif; font-size: 14px; font-weight: 800; color: var(--cc-text); display: block; margin-bottom: 3px; }
  .loc-body span   { font-size: 12px; color: var(--cc-text-muted); display: block; }

  /* ── FAQ ── */
  .faq-section { background: #f7f3e9; padding: 64px 0; }
  .faq-heading { font-family: 'Epilogue', sans-serif; font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 900; color: var(--cc-text); margin: 0 0 28px; letter-spacing: -.03em; }
  .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  @media (max-width: 768px) { .faq-grid { grid-template-columns: 1fr; } }
  .faq-item { background: #fff; border-radius: var(--cc-radius-md); border: 1.5px solid rgba(242,125,153,.1); padding: 18px 20px; display: flex; gap: 14px; align-items: flex-start; }
  .faq-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .faq-q { font-size: 13px; font-weight: 700; color: var(--cc-text); margin-bottom: 4px; }
  .faq-a { font-size: 12px; color: var(--cc-text-mid); line-height: 1.65; }

  /* ── Page padding ── */
  .page-pad { padding-left: 6%; padding-right: 6%; }
  @media (max-width: 768px)  { .page-pad { padding-left: 4%;  padding-right: 4%; } }
  @media (max-width: 480px)  { .page-pad { padding-left: 16px; padding-right: 16px; } }

  /* ── Animations ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .fade-up   { animation: fadeUp .65s ease forwards; }
  .fade-up-2 { animation: fadeUp .65s .1s ease both; }
  .fade-up-3 { animation: fadeUp .65s .2s ease both; }
</style>
@endpush

@section('content')
@php
  $contactPhone = $cms['contact_phone'] ?? '+44 7534738441';
  $contactEmail = $cms['contact_email'] ?? 'currentcravings4@gmail.com';
  $contactAddress = $cms['contact_address'] ?? '12 Rose Street, Kettering, NN16 9NN';
  $contactHours = $cms['contact_hours'] ?? 'Mon - Sun: 11:00 AM - 10:00 PM';
  $contactPhoneHref = preg_replace('/\s+/', '', (string) $contactPhone);

  $topicCustom = $cms['contact_topic_custom_label'] ?? 'Custom Order';
  $topicGeneral = $cms['contact_topic_general_label'] ?? 'General Query';
  $topicDelivery = $cms['contact_topic_delivery_label'] ?? 'Delivery';
  $topicOther = $cms['contact_topic_other_label'] ?? 'Other';

  $topics = [
    ['label' => $topicCustom, 'badge' => 'CO'],
    ['label' => $topicGeneral, 'badge' => 'GQ'],
    ['label' => $topicDelivery, 'badge' => 'DL'],
    ['label' => $topicOther, 'badge' => 'OT'],
  ];

  $topicDefault = old('topic', $topicCustom);

  $topicConfigs = [
    $topicCustom => [
      'placeholder' => $cms['contact_topic_custom_placeholder'] ?? 'Tell us the occasion, size, flavors, and event date...',
      'extras' => [['Event date','eventDate','date',''],['Servings','servings','number','e.g. 12'],['Flavor','flavor','text','Chocolate, pistachio...'],['Budget','budget','text','e.g. �80']],
    ],
    $topicGeneral => [
      'placeholder' => $cms['contact_topic_general_placeholder'] ?? 'Ask us anything about the menu, allergens, or ordering...',
      'extras' => [],
    ],
    $topicDelivery => [
      'placeholder' => $cms['contact_topic_delivery_placeholder'] ?? 'Include delivery date, address, and any special instructions...',
      'extras' => [['Delivery date','dDate','date',''],['Preferred time','dTime','text','e.g. 4-6 PM'],['Address','dAddr','text','Street address'],['Postcode','dPost','text','NN16 9NN']],
    ],
    $topicOther => [
      'placeholder' => $cms['contact_topic_other_placeholder'] ?? 'Share any details that help us assist you...',
      'extras' => [],
    ],
  ];

  $deliveryAreas = collect(explode(',', (string)($cms['contact_delivery_areas'] ?? 'Kettering, Wellingborough, Rushden, Northampton, Irthlingborough, Corby, Brackley')))
    ->map(fn ($area) => trim($area))
    ->filter()
    ->values();

  $faqItems = [
    ['icon' => 'timer',          'bg' => 'rgba(242,125,153,.1)',  'color' => '#f27d99', 'q' => $cms['contact_faq_1_q'] ?? 'How far in advance should I order?', 'a' => $cms['contact_faq_1_a'] ?? 'At least 48 hours for standard orders, 5 days for custom cakes.'],
    ['icon' => 'verified',       'bg' => 'rgba(190,244,88,.2)',   'color' => '#4d6e00', 'q' => $cms['contact_faq_2_q'] ?? 'Are all products Halal?', 'a' => $cms['contact_faq_2_a'] ?? 'Yes! Every single ingredient we use is certified Halal.'],
    ['icon' => 'local_shipping', 'bg' => 'rgba(252,212,126,.25)', 'color' => '#b06a00', 'q' => $cms['contact_faq_3_q'] ?? 'Do you deliver outside Kettering?', 'a' => $cms['contact_faq_3_a'] ?? 'Yes, we cover Wellingborough, Rushden, Northampton and more.'],
    ['icon' => 'cake',           'bg' => 'rgba(242,125,153,.1)',  'color' => '#f27d99', 'q' => $cms['contact_faq_4_q'] ?? 'Can I request a custom flavour?', 'a' => $cms['contact_faq_4_a'] ?? 'Absolutely! Use the form above and tell us your dream dessert.'],
  ];

  $instagramUrl = $cms['instagram_url'] ?? 'https://www.instagram.com/currentcravings_uk';
  $tiktokUrl = $cms['tiktok_url'] ?? 'https://www.tiktok.com/@currentcravings_uk';
  $pinterestUrl = $cms['contact_pinterest_url'] ?? 'https://www.pinterest.com/';
@endphp

<section class="contact-shell page-pad page-hero-under-header">
  <div class="contact-hero fade-up">
    <div class="hero-badge"><span class="dot"></span>{{ $cms['contact_hero_badge'] ?? "We'd love to hear from you" }}</div>
    <h1>{{ $cms['contact_hero_title_prefix'] ?? 'Say' }} <span class="gradient-headline">{{ $cms['contact_hero_title_highlight'] ?? 'Hello' }}</span> {{ $cms['contact_hero_title_suffix'] ?? 'to' }}<br>{{ $cms['contact_heading'] ?? 'Current Cravings' }}</h1>
    <p>{{ $cms['contact_subheading'] ?? 'Custom orders, questions, or just want to chat about desserts? We reply fast and love every message.' }}</p>

    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:10px;" class="fade-up-2">
      <a href="tel:{{ $contactPhoneHref }}" class="qpill">
        <span class="icon"><span class="material-symbols-outlined">call</span></span>
        {{ $contactPhone }}
      </a>
      <a href="mailto:{{ $contactEmail }}" class="qpill">
        <span class="icon"><span class="material-symbols-outlined">mail</span></span>
        {{ $contactEmail }}
      </a>
      <div class="qpill" style="cursor:default;">
        <span class="icon"><span class="material-symbols-outlined">schedule</span></span>
        {{ $cms['contact_hero_quick_hours'] ?? $contactHours }}
      </div>
    </div>
  </div>
</section>

<section style="background:#fffbff;padding:48px 0 64px;" class="page-pad">
  <div class="contact-grid">

    <div class="fade-up">
      <form class="form-card" id="contactForm" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <input type="hidden" id="topicField" name="topic" value="{{ $topicDefault }}">
        <input type="hidden" id="fullName"   name="name"  value="{{ old('name') }}">

        <h2>{{ $cms['contact_form_title'] ?? 'Send a Message' }}</h2>
        <p class="form-sub">{{ $cms['contact_form_sub'] ?? 'We reply within 24 hours - usually much faster!' }}</p>

        @if(session('success'))
        <div class="alert-success">
          <span class="material-symbols-outlined" style="font-size:18px;">check_circle</span>
          <div>
            <p style="font-weight:500;margin:0;">{{ $cms['contact_form_success_title'] ?? 'Message sent!' }}</p>
            <p style="margin:2px 0 0;font-weight:300;">{{ session('success') }}</p>
          </div>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-error">
          <strong style="font-weight:500;">{{ $cms['contact_form_error_title'] ?? 'Please fix the following:' }}</strong>
          <ul style="margin:6px 0 0;padding-left:16px;font-weight:300;">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
          </ul>
        </div>
        @endif

        <p class="topic-label">{{ $cms['contact_form_topic_label'] ?? "What's this about?" }}</p>
        <div class="topic-tabs">
          @foreach($topics as $t)
          <button type="button"
                  class="topic-tab {{ $topicDefault === $t['label'] ? 'active' : '' }}"
                  data-topic="{{ $t['label'] }}"
                  onclick="selectTopic(this)">
            <span class="tab-emoji">{{ $t['badge'] }}</span>{{ $t['label'] }}
          </button>
          @endforeach
        </div>

        <div class="field-group cols-2">
          <div class="field-wrap">
            <label class="field-label">{{ $cms['contact_form_first_name_label'] ?? 'First Name *' }}</label>
            <input id="firstName" name="first_name" type="text"
                   class="field-input {{ $errors->has('name') ? 'error' : '' }}"
                   placeholder="Sarah" value="{{ old('first_name') }}" required>
          </div>
          <div class="field-wrap">
            <label class="field-label">{{ $cms['contact_form_last_name_label'] ?? 'Last Name *' }}</label>
            <input id="lastName" name="last_name" type="text"
                   class="field-input"
                   placeholder="Ahmed" value="{{ old('last_name') }}" required>
          </div>
        </div>

        <div class="field-group cols-2">
          <div class="field-wrap">
            <label class="field-label">{{ $cms['contact_form_email_label'] ?? 'Email Address *' }}</label>
            <input name="email" type="email"
                   class="field-input {{ $errors->has('email') ? 'error' : '' }}"
                   placeholder="sarah@example.com" value="{{ old('email') }}" required>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
          </div>
          <div class="field-wrap">
            <label class="field-label">{{ $cms['contact_form_phone_label'] ?? 'Phone (optional)' }}</label>
            <input name="phone" type="tel"
                   class="field-input"
                   placeholder="+44 7700 000000" value="{{ old('phone') }}">
          </div>
        </div>

        <div id="topicExtra" class="field-group cols-2" style="display:none;"></div>

        <div class="field-group" style="margin-bottom:8px;">
          <div class="field-wrap">
            <label class="field-label">{{ $cms['contact_form_message_label'] ?? 'Your Message *' }}</label>
            <textarea id="messageInput" name="message"
                      class="field-input {{ $errors->has('message') ? 'error' : '' }}"
                      placeholder="{{ $cms['contact_form_message_placeholder'] ?? 'Tell us about your order or question...' }}"
                      required>{{ old('message') }}</textarea>
            @error('message')<span class="field-error">{{ $message }}</span>@enderror
          </div>
        </div>

        <hr class="form-divider">

        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:12px;">
          <button type="submit" class="submit-btn">
            <span class="material-symbols-outlined" style="font-size:16px;">send</span>
            {{ $cms['contact_form_submit'] ?? 'Send Message' }}
          </button>
          <span class="submit-note">{{ $cms['contact_form_submit_note'] ?? 'Your info is safe with us' }}</span>
        </div>
      </form>
    </div>

    <div class="fade-up-3">
      <div class="side-card loc-card">
        <img src="@if(!empty($cms['contact_sidebar_location_image'])){{ Str::startsWith($cms['contact_sidebar_location_image'],'http') ? $cms['contact_sidebar_location_image'] : route('media.public', ['path' => $cms['contact_sidebar_location_image']], false) }}@else{{ asset('images/baker.png') }}@endif" alt="Current Cravings location">
        <div class="loc-body">
          <strong>{{ $cms['contact_sidebar_location_title'] ?? 'Visit us in Kettering' }}</strong>
          <span>{{ $cms['contact_sidebar_location_address'] ?? $contactAddress }}</span>
          <span style="margin-top:2px;">{{ $cms['contact_sidebar_location_hours'] ?? $contactHours }}</span>
        </div>
      </div>

      <div class="side-card">
        <div class="side-card-title">
          <span class="dot" style="background:#f27d99;"></span>{{ $cms['contact_sidebar_get_in_touch_title'] ?? 'Get in Touch' }}
        </div>
        <div class="info-row">
          <div class="info-icon"><span class="material-symbols-outlined">call</span></div>
          <div>
            <div class="info-text">{{ $contactPhone }}</div>
            <div class="info-sub">{{ $cms['contact_sidebar_phone_sub'] ?? 'Call or WhatsApp' }}</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon"><span class="material-symbols-outlined">mail</span></div>
          <div>
            <div class="info-text">{{ $contactEmail }}</div>
            <div class="info-sub">{{ $cms['contact_sidebar_email_sub'] ?? 'Reply within 24 hours' }}</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon"><span class="material-symbols-outlined">schedule</span></div>
          <div>
            <div class="info-text">{{ $contactHours }}</div>
            <div class="info-sub">{{ $cms['contact_sidebar_hours_sub'] ?? 'Monday to Sunday' }}</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon"><span class="material-symbols-outlined">location_on</span></div>
          <div>
            <div class="info-text">{{ $contactAddress }}</div>
            <div class="info-sub">{{ $cms['contact_sidebar_address_sub'] ?? 'Bakery Address' }}</div>
          </div>
        </div>
      </div>

      <div class="side-card">
        <div class="side-card-title">
          <span class="dot" style="background:#bef458;"></span>{{ $cms['contact_delivery_title'] ?? 'Delivery Areas' }}
        </div>
        <div>
          @foreach($deliveryAreas as $area)
            <span class="area-chip">{{ $area }}</span>
          @endforeach
        </div>
      </div>

      <div class="side-card">
        <div class="side-card-title">
          <span class="dot" style="background:#FCD47E;"></span>{{ $cms['contact_social_title'] ?? 'Find Us Online' }}
        </div>
        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener" class="social-row">
          <div class="social-avatar">
            <img src="{{ asset('images/products/insta.jpg') }}" alt="Instagram icon">
          </div>
          <div>
            <div class="social-name">Instagram</div>
            <div class="social-handle">{{ $cms['contact_instagram_handle'] ?? '@currentcravings_uk' }}</div>
          </div>
          <span class="material-symbols-outlined" style="font-size:14px;color:var(--cc-text-muted);margin-left:auto;">arrow_forward</span>
        </a>
        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener" class="social-row">
          <div class="social-avatar">
            <img src="{{ asset('images/products/tiktok.jpg') }}" alt="TikTok icon">
          </div>
          <div>
            <div class="social-name">TikTok</div>
            <div class="social-handle">{{ $cms['contact_tiktok_handle'] ?? '@currentcravings_uk' }}</div>
          </div>
          <span class="material-symbols-outlined" style="font-size:14px;color:var(--cc-text-muted);margin-left:auto;">arrow_forward</span>
        </a>
        <a href="{{ $pinterestUrl }}" target="_blank" rel="noopener" class="social-row">
          <div class="social-avatar">
            <img src="{{ asset('images/products/pintrest.jpg') }}" alt="Pinterest icon">
          </div>
          <div>
            <div class="social-name">{{ $cms['contact_pinterest_name'] ?? 'Pinterest' }}</div>
            <div class="social-handle">{{ $cms['contact_pinterest_handle'] ?? '@current_cravings' }}</div>
          </div>
          <span class="material-symbols-outlined" style="font-size:14px;color:var(--cc-text-muted);margin-left:auto;">arrow_forward</span>
        </a>
      </div>

    </div>
  </div>
</section>

<section class="faq-section page-pad">
  <div style="max-width:1080px;margin:0 auto;">
    <h2 class="faq-heading">{{ $cms['contact_faq_title'] ?? 'Quick Answers' }}</h2>
    <div class="faq-grid">
      @foreach($faqItems as $faq)
      <div class="faq-item">
        <div class="faq-icon" style="background:{{ $faq['bg'] }};">
          <span class="material-symbols-outlined" style="font-size:17px;color:{{ $faq['color'] }};">{{ $faq['icon'] }}</span>
        </div>
        <div>
          <div class="faq-q">{{ $faq['q'] }}</div>
          <div class="faq-a">{{ $faq['a'] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
const topicConfigs = @json($topicConfigs);

function selectTopic(el) {
  document.querySelectorAll('.topic-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  const topic = el.dataset.topic;
  document.getElementById('topicField').value = topic;
  const cfg = topicConfigs[topic] || Object.values(topicConfigs)[0] || { placeholder: '', extras: [] };
  document.getElementById('messageInput').placeholder = cfg.placeholder || '';
  const extra = document.getElementById('topicExtra');
  extra.innerHTML = '';
  if ((cfg.extras || []).length) {
    extra.style.display = 'grid';
    cfg.extras.forEach(([label, id, type, ph]) => {
      extra.innerHTML += `
        <div class="field-wrap">
          <label class="field-label">${label}</label>
          <input id="${id}" type="${type}" placeholder="${ph}" class="field-input">
        </div>`;
    });
  } else {
    extra.style.display = 'none';
  }
}

const initTab = document.querySelector('.topic-tab.active');
if (initTab) selectTopic(initTab);

document.getElementById('contactForm').addEventListener('submit', () => {
  const fn = document.getElementById('firstName')?.value || '';
  const ln = document.getElementById('lastName')?.value || '';
  document.getElementById('fullName').value = (fn + ' ' + ln).trim();
});
</script>
@endpush