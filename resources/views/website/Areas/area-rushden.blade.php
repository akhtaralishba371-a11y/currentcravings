@extends('layouts.app')
@section('title', 'Rushden Delivery | Current Cravings')

@push('styles')
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --marquee-h: 0px;
      --rose:       #f27d99;
      --rose-dark:  #e8627d;
      --rose-light: #fdd4e0;
      --rose-pale:  #fff0f4;
      --pink-mid:   #fbb6c8;
      --cream:      #fffbff;
      --ink:        #393832;
      --ink-muted:  #66645e;
      --white:      #ffffff;
      --font-headline: "Epilogue", sans-serif;
      --font-body: "Be Vietnam Pro", sans-serif;
      --header-top-gap: 14px;
    }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-body);
      background: var(--cream);
      color: var(--ink);
      overflow-x: hidden;
      cursor: none;
    }

    /* Cursor */
    #cur  { position:fixed;width:10px;height:10px;background:var(--rose);border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:width .25s,height .25s; }
    #cring{ position:fixed;width:34px;height:34px;border:1.5px solid var(--rose);border-radius:50%;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);opacity:.45;transition:width .25s,height .25s,opacity .25s; }

    /* Top marquee */
    .top-bar {
      position:fixed;top:var(--header-top-gap);left:0;right:0;z-index:200;
      background:#ffe6ef;height:34px;
      overflow:hidden;display:flex;align-items:center;
    }
    .mq-track { display:inline-flex;animation:mq 20s linear infinite;white-space:nowrap; }
    .mq-item  { font-family:var(--font-headline);font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:var(--rose);padding:0 2.5rem; }
    .mq-dot   { color:var(--rose-dark);font-size:8px;line-height:34px; }
    @keyframes mq{ from{transform:translateX(0)} to{transform:translateX(-50%)} }

    /* Header */
    header {
      position:fixed;top:calc(34px + var(--header-top-gap));left:0;right:0;z-index:100;
      height:64px;padding:0 3rem;
      display:flex;align-items:center;justify-content:space-between;
    }
    .hbg {
      position:absolute;inset:0;
      background:rgba(255,251,255,.88);
      backdrop-filter:blur(18px);
      border-bottom:1px solid rgba(242,125,153,.1);
    }
    .hc { position:relative;z-index:1;width:100%;display:flex;align-items:center;justify-content:space-between; }
    .logo { font-family:var(--font-headline);font-size:1.35rem;font-weight:900;color:var(--ink);text-decoration:none;letter-spacing:-.02em; }
    .logo span { color:var(--rose); }
    nav { display:flex;gap:1.75rem;align-items:center; }
    nav a {
      font-family:var(--font-headline);
      font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
      color:var(--ink-muted);text-decoration:none;
      position:relative;transition:color .2s;
    }
    nav a::after { content:"";position:absolute;left:0;bottom:-3px;height:1.5px;width:0;background:var(--rose);transition:width .35s cubic-bezier(.22,1,.36,1); }
    nav a:hover,nav a.active { color:var(--rose); }
    nav a:hover::after,nav a.active::after { width:100%; }
    .order-btn {
      font-family:var(--font-headline);
      font-size:10.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
      color:var(--white);background:var(--rose);
      padding:9px 22px;border-radius:100px;text-decoration:none;
      transition:transform .25s,background .25s;
    }
    .order-btn:hover { background:var(--rose-dark);transform:translateY(-2px); }

    /* Hero */
    .hero {
      min-height:100svh;
      padding:calc(var(--cc-header-offset) + var(--header-top-gap) + 18px) 3rem 6rem;
      display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;
      position:relative;overflow:hidden;
    }
    .ghost {
      position:absolute;bottom:-.05em;left:-.03em;
      font-family:var(--font-headline);
      font-size:clamp(130px,21vw,260px);font-weight:900;
      color:transparent;
      -webkit-text-stroke:1px rgba(242,125,153,.09);
      line-height:1;pointer-events:none;user-select:none;z-index:0;
    }
    .blob { position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;z-index:0; }
    .b1 { width:380px;height:380px;background:rgba(242,125,153,.13);top:8%;right:8%;animation:bf 9s ease-in-out infinite; }
    .b2 { width:260px;height:260px;background:rgba(251,182,200,.18);bottom:12%;right:28%;animation:bf 7s ease-in-out infinite;animation-delay:-3s; }
    .b3 { width:180px;height:180px;background:rgba(242,125,153,.09);top:45%;left:3%;animation:bf 11s ease-in-out infinite;animation-delay:-6s; }
    @keyframes bf{ 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-28px) scale(1.06)} }

    .hero-l,.hero-r { position:relative;z-index:1; }
    .badge {
      display:inline-flex;align-items:center;gap:8px;
      font-family:var(--font-headline);font-size:9.5px;font-weight:700;
      letter-spacing:.15em;text-transform:uppercase;
      color:var(--rose-dark);background:var(--rose-pale);
      border:1px solid rgba(242,125,153,.22);
      padding:6px 16px;border-radius:100px;margin-bottom:1.4rem;
    }
    .badge::before {
      content:"";width:6px;height:6px;border-radius:50%;
      background:var(--rose);animation:pulse 1.8s ease-in-out infinite;
    }
    @keyframes pulse{ 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.7);opacity:.35} }

    h1 {
      font-family:var(--font-headline);
      font-size:clamp(3.2rem,6.5vw,5.8rem);font-weight:900;
      line-height:.96;letter-spacing:-.03em;margin-bottom:1.4rem;
    }
    h1 em { font-style:italic;color:var(--rose); }

    .hero-p {
      font-size:1rem;color:var(--ink-muted);line-height:1.8;
      max-width:440px;margin-bottom:2.2rem;
    }
    .ctas { display:flex;gap:.9rem;flex-wrap:wrap; }

    .btn-fill {
      display:inline-flex;align-items:center;gap:10px;
      font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;
      color:var(--white);text-decoration:none;
      background:var(--rose);padding:15px 30px;border-radius:100px;
      position:relative;overflow:hidden;
      transition:transform .3s,box-shadow .3s;
    }
    .btn-fill::before {
      content:"";position:absolute;inset:0;border-radius:inherit;
      background:var(--rose-dark);transform:translateX(-105%);
      transition:transform .4s cubic-bezier(.22,1,.36,1);
    }
    .btn-fill:hover { transform:translateY(-3px);box-shadow:0 16px 40px rgba(242,125,153,.38); }
    .btn-fill:hover::before { transform:translateX(0); }
    .btn-fill span,.btn-fill .arr { position:relative;z-index:1; }
    .btn-fill:hover .arr { transform:translateX(4px); }
    .arr { display:inline-block;transition:transform .3s; }

    .btn-ghost {
      display:inline-flex;align-items:center;gap:8px;
      font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;
      color:var(--rose);text-decoration:none;
      border:1.5px solid rgba(242,125,153,.4);
      padding:15px 30px;border-radius:100px;
      transition:border-color .3s,background .3s,transform .3s;
    }
    .btn-ghost:hover { border-color:var(--rose);background:var(--rose-pale);transform:translateY(-3px); }

    /* Delivery card */
    .dcard {
      background:var(--white);
      border:1px solid rgba(242,125,153,.18);
      border-radius:28px;
      box-shadow:0 32px 80px rgba(242,125,153,.14);
      padding:2.5rem;overflow:hidden;position:relative;
    }
    .dcard::before {
      content:"";position:absolute;top:0;left:0;right:0;
      height:4px;background:linear-gradient(90deg,var(--rose),var(--pink-mid),var(--rose));
    }
    .dcard-eye {
      font-family:var(--font-headline);font-size:9.5px;
      letter-spacing:.18em;text-transform:uppercase;
      color:var(--rose);margin-bottom:1.4rem;
      display:flex;align-items:center;gap:10px;
    }
    .dcard-eye::after { content:"";flex:1;height:1px;background:rgba(242,125,153,.2); }
    .dcard-title {
      font-family:var(--font-headline);font-size:1.5rem;font-weight:900;
      color:var(--ink);margin-bottom:1.8rem;
    }
    .drow {
      display:flex;align-items:center;justify-content:space-between;
      padding:.9rem 0;border-bottom:1px solid rgba(242,125,153,.1);
    }
    .drow:last-child { border-bottom:none; }
    .dl {
      font-family:var(--font-headline);font-size:9.5px;
      letter-spacing:.1em;text-transform:uppercase;color:var(--ink-muted);
    }
    .dv { font-size:13px;font-weight:700;color:var(--ink); }
    .dv.pink { color:var(--rose); }

    /* Stats bar */
    .stats {
      background:var(--rose);
      padding:1.5rem 3rem;
      display:flex;justify-content:space-around;align-items:center;
      flex-wrap:wrap;gap:1.5rem;
    }
    .stat-n {
      font-family:var(--font-headline);font-size:2rem;font-weight:900;color:var(--white);line-height:1;
    }
    .stat-l {
      font-family:var(--font-headline);font-size:9px;letter-spacing:.14em;
      text-transform:uppercase;color:rgba(255,255,255,.7);margin-top:4px;
    }
    .sdiv { width:1px;height:44px;background:rgba(255,255,255,.22); }

    /* Services */
    .services { padding:5rem 3rem; }
    .sec-kicker { font-family:var(--font-headline);font-size:9.5px;letter-spacing:.15em;text-transform:uppercase;color:var(--rose); }
    .sec-title { font-family:var(--font-headline);font-size:2.6rem;font-weight:900;margin-top:.7rem; }
    .sec-sub { color:var(--ink-muted);margin-top:.7rem;max-width:560px; }
    .svc-grid { margin-top:2.2rem;display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem; }
    .svc-card { background:var(--white);border:1px solid rgba(242,125,153,.15);border-radius:22px;padding:1.4rem;box-shadow:0 14px 28px rgba(242,125,153,.12);transition:transform .25s; }
    .svc-card:hover { transform:translateY(-6px); }
    .svc-card h4 { font-family:var(--font-headline);font-size:1.2rem;font-weight:900;margin:.9rem 0 .4rem; }
    .svc-card p { color:var(--ink-muted);font-size:.92rem; }
    .svc-ico { width:42px;height:42px;border-radius:14px;background:rgba(242,125,153,.14);color:var(--rose);display:grid;place-items:center; }

    /* CTA */
    .cta { padding:0 3rem 5rem; }
    .cta-box { background:var(--rose-pale);border:1px solid rgba(242,125,153,.2);border-radius:26px;padding:2.2rem;display:flex;align-items:center;justify-content:space-between;gap:1.6rem;flex-wrap:wrap; }

    /* Footer */
    footer { padding:2rem 3rem;color:var(--ink-muted);font-size:.9rem;border-top:1px solid rgba(242,125,153,.12); }
    @media (max-width: 1024px){
      .hero { grid-template-columns:1fr; }
      .svc-grid { grid-template-columns:repeat(2,1fr); }
    }
    @media (max-width: 640px){
      header { padding:0 1.5rem; }
      .hero { padding:calc(var(--cc-header-offset) + var(--header-top-gap) + 12px) 1.5rem 4rem; }
      .services,.cta,footer { padding-left:1.5rem;padding-right:1.5rem; }
      .svc-grid { grid-template-columns:1fr; }
      nav { display:none; }
    }
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
      .site-shell{width:80%;margin:0 auto;}
      .site-shell nav{max-width:100% !important;}
      .site-shell .max-w-7xl{max-width:100% !important;}
    @media (max-width:1024px){.site-shell{width:90%;}}
    @media (max-width:640px){.site-shell{width:94%;}}
    section { width:80%; margin-left:auto; margin-right:auto; }
    @media (max-width:1024px){ section { width:90%; } }
    @media (max-width:640px){ section { width:94%; } }
</style>
@endpush

@section('content')
<div id="cur"></div>
  <div id="cring"></div>
  <section class="hero">
    <div class="ghost">Rushden</div>
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>

    <div class="hero-l">
      <span class="badge">Delivery Area</span>
      <h1>Fresh bakes for <em>Rushden</em></h1>
      <p class="hero-p">
        We deliver warm desserts across Rushden with same-day and next-day slots. Choose your favorites and we will bring the sweetness to your door.
      </p>
      <div class="ctas">
        <a class="btn-fill" href="{{ route('menu.index') }}"><span>Shop the Menu</span><span class="arr">?</span></a>
        <a class="btn-ghost" href="{{ route('contact') }}">Schedule Delivery</a>
      </div>
    </div>

    <div class="hero-r">
      <div class="dcard">
        <div class="dcard-eye">Delivery Details</div>
        <div class="dcard-title">Next slot: 1-3 PM</div>
        <div class="drow"><span class="dl">Hours</span><span class="dv">9am - 9pm</span></div>
        <div class="drow"><span class="dl">Same-day</span><span class="dv pink">Order before 2pm</span></div>
        <div class="drow"><span class="dl">Fee</span><span class="dv">Free over $100</span></div>
        <div class="drow"><span class="dl">Pickup</span><span class="dv">Available on request</span></div>
      </div>
    </div>
  </section>

  

  <section class="services" id="services">
    <div class="sec-kicker">Local Services</div>
    <div class="sec-title">What we offer in Rushden</div>
    <div class="sec-sub">From quick treats to celebration spreads, these are our most-loved services in Rushden.</div>

    <div class="svc-grid">
      <div class="svc-card">
        <div class="svc-ico"><span class="material-symbols-outlined">bolt</span></div>
        <h4>Express Delivery</h4>
        <p>Order by 2pm for fresh bakes delivered the same day.</p>
      </div>
      <div class="svc-card">
        <div class="svc-ico"><span class="material-symbols-outlined">cake</span></div>
        <h4>Celebration Cakes</h4>
        <p>Tailored flavors, messages, and styles for birthdays or events.</p>
      </div>
      <div class="svc-card">
        <div class="svc-ico"><span class="material-symbols-outlined">inventory_2</span></div>
        <h4>Dessert Tasting Trays</h4>
        <p>Curated boxes of cookies, brownies, and mini treats.</p>
      </div>
      <div class="svc-card">
        <div class="svc-ico"><span class="material-symbols-outlined">celebration</span></div>
        <h4>Office and Party Catering</h4>
        <p>Bulk trays, dessert bars, and on-time delivery for teams.</p>
      </div>
    </div>
  </section>

  <section class="cta">
    <div class="cta-box">
      <div>
        <div class="sec-kicker">Ready for delivery in Rushden?</div>
        <div class="sec-title" style="font-size:2rem;">Pick a slot and we will handle the rest.</div>
      </div>
      <div class="ctas">
        <a class="btn-fill" href="{{ route('cart.index') }}"><span>Order Now</span><span class="arr">?</span></a>
        <a class="btn-ghost" href="{{ route('contact') }}">Ask a Question</a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
    const cur = document.getElementById('cur');
    const cring = document.getElementById('cring');
    window.addEventListener('mousemove', (e) => {
      cur.style.left = e.clientX + 'px';
      cur.style.top = e.clientY + 'px';
      cring.style.left = e.clientX + 'px';
      cring.style.top = e.clientY + 'px';
    });
    document.querySelectorAll('a, button').forEach(el => {
      el.addEventListener('mouseenter', () => { cring.style.width='54px'; cring.style.height='54px'; cring.style.opacity='.25'; });
      el.addEventListener('mouseleave', () => { cring.style.width='34px'; cring.style.height='34px'; cring.style.opacity='.45'; });
    });
  </script>
@endpush




