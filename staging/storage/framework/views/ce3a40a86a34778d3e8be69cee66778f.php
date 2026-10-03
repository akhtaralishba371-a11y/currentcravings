
<?php $__env->startSection('title', 'Menu | Current Cravings'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
  }
  /* ---- GLASS NAV ---- */
  .glass-nav {
  background: rgba(255, 251, 255, 0.85);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid rgba(242,125,153,0.08);
  transition: all 0.4s ease;
}
  .glass-nav.scrolled { background: transparent; box-shadow: none; }
  :root { --marquee-h: 0px; --cart-w: min(420px,100vw); }
  #main-header { top: calc(var(--marquee-h, 0px) + var(--cc-header-top-gap, 12px)) !important; }
  .marquee-wrap {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 60;
    background: #ffe6ef !important;
    border-top: 1px solid rgba(242,125,153,0.18);
    border-bottom: 1px solid rgba(242,125,153,0.18);
  }

  /* ---- LOGO ---- */
  .logo-img { display: block; mix-blend-mode: multiply; object-fit: contain; transition: transform 0.3s ease; }
  .logo-img:hover { transform: scale(1.05); }
  .logo-img-nav    { height: 80px; width: auto; }
  .logo-img-footer { height: 100px; width: auto; }
  .logo-link-nav, .logo-link-footer { display: inline-block; line-height: 0; }

  /* ---- SCROLL PROGRESS ---- */
  #scroll-progress {
    position: fixed; top: 0; left: 0; height: 3px; z-index: 9999;
    background: linear-gradient(90deg, #f27d99, #fbb6c8, #bef458);
    width: 0%; transition: width 0.1s linear;
    box-shadow: 0 0 8px rgba(242,125,153,0.7);
  }

  /* ---- MARQUEE ---- */
  @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
  .marquee-track { animation: marquee 22s linear infinite; white-space: nowrap; display: inline-flex; }
  .marquee-wrap:hover .marquee-track { animation-play-state: paused; }

  /* ---- PASTRY ANIMATIONS ---- */
  @keyframes pastrySpinEnterLeft {
    0%   { transform: translateX(-180px) translateY(-50%) rotate(-720deg) scale(0.1); opacity: 0; filter: blur(10px); }
    55%  { transform: translateX(22px)   translateY(-50%) rotate(25deg)   scale(1.18); opacity: 1; filter: blur(0); }
    75%  { transform: translateX(5px)    translateY(-50%) rotate(-7deg)   scale(0.96); opacity: 1; }
    88%  { transform: translateX(15px)   translateY(-50%) rotate(3deg)    scale(1.02); opacity: 1; }
    100% { transform: translateX(12px)   translateY(-50%) rotate(0deg)    scale(1);    opacity: 1; filter: blur(0); }
  }
  @keyframes pastrySpinEnterRight {
    0%   { transform: translateX(180px)  translateY(-50%) rotate(720deg)  scale(0.1); opacity: 0; filter: blur(10px); }
    55%  { transform: translateX(-22px)  translateY(-50%) rotate(-25deg)  scale(1.18); opacity: 1; filter: blur(0); }
    75%  { transform: translateX(-5px)   translateY(-50%) rotate(7deg)    scale(0.96); opacity: 1; }
    88%  { transform: translateX(-15px)  translateY(-50%) rotate(-3deg)   scale(1.02); opacity: 1; }
    100% { transform: translateX(-12px)  translateY(-50%) rotate(0deg)    scale(1);    opacity: 1; filter: blur(0); }
  }
  @keyframes pastrySpinExitLeft {
    0%   { transform: translateX(12px)   translateY(-50%) rotate(0deg)    scale(1);   opacity: 1; }
    25%  { transform: translateX(20px)   translateY(-50%) rotate(18deg)   scale(1.06); }
    100% { transform: translateX(-180px) translateY(-50%) rotate(-540deg) scale(0.1); opacity: 0; filter: blur(8px); }
  }
  @keyframes pastrySpinExitRight {
    0%   { transform: translateX(-12px)  translateY(-50%) rotate(0deg)    scale(1);   opacity: 1; }
    25%  { transform: translateX(-20px)  translateY(-50%) rotate(-18deg)  scale(1.06); }
    100% { transform: translateX(180px)  translateY(-50%) rotate(540deg)  scale(0.1); opacity: 0; filter: blur(8px); }
  }
  @keyframes pastryIdleLeft {
    0%,100% { transform: translateX(12px)  translateY(calc(-50% + 0px))   rotate(-2deg) scale(1); }
    33%     { transform: translateX(12px)  translateY(calc(-50% - 15px))  rotate(5deg)  scale(1.05); }
    66%     { transform: translateX(12px)  translateY(calc(-50% - 7px))   rotate(-1deg) scale(0.98); }
  }
  @keyframes pastryIdleRight {
    0%,100% { transform: translateX(-12px) translateY(calc(-50% + 0px))  rotate(2deg)  scale(1); }
    33%     { transform: translateX(-12px) translateY(calc(-50% - 15px)) rotate(-5deg) scale(1.05); }
    66%     { transform: translateX(-12px) translateY(calc(-50% - 7px))  rotate(1deg)  scale(0.98); }
  }
  .pastry-fixed {
    position: fixed; top: 50%;
    width: 90px; height: 90px;
    pointer-events: none; z-index: 5;
    filter: drop-shadow(0 10px 26px rgba(242,125,153,0.38));
    opacity: 0; will-change: transform, opacity;
  }
  .pastry-fixed.left-pastry  { left: 0; }
  .pastry-fixed.right-pastry { right: 0; }
  .pastry-fixed.spin-enter-left  { animation: pastrySpinEnterLeft  0.95s cubic-bezier(0.34,1.56,0.64,1) forwards; }
  .pastry-fixed.spin-enter-right { animation: pastrySpinEnterRight 0.95s cubic-bezier(0.34,1.56,0.64,1) forwards; animation-delay: 0.14s; }
  .pastry-fixed.spin-exit-left   { animation: pastrySpinExitLeft   0.58s ease-in forwards; }
  .pastry-fixed.spin-exit-right  { animation: pastrySpinExitRight  0.58s ease-in forwards; }
  .pastry-fixed.idle-left        { opacity: 1; animation: pastryIdleLeft  3.4s ease-in-out infinite; }
  .pastry-fixed.idle-right       { opacity: 1; animation: pastryIdleRight 3.8s ease-in-out infinite; }

  /* ---- GENERAL ANIMATIONS ---- */
  @keyframes float { 0%,100%{transform:translateY(0px) rotate(2deg)} 50%{transform:translateY(-20px) rotate(0deg)} }
  .animate-float { animation: float 6s ease-in-out infinite; }
  @keyframes float-gentle { 0%,100%{transform:translateY(0px)} 50%{transform:translateY(-10px)} }
  .animate-float-gentle { animation: float-gentle 4s ease-in-out infinite; }
  @keyframes floatSprinkle { 0%{transform:translateY(100vh) rotate(0deg);opacity:0} 10%{opacity:0.15} 90%{opacity:0.15} 100%{transform:translateY(-20px) rotate(720deg);opacity:0} }
  .sprinkle { position:absolute; pointer-events:none; border-radius:50%; animation:floatSprinkle linear infinite; opacity:0.15; }

  @keyframes fadeUp { from{opacity:0;transform:translateY(50px)} to{opacity:1;transform:translateY(0)} }
  @keyframes fadeLeft { from{opacity:0;transform:translateX(-60px)} to{opacity:1;transform:translateX(0)} }
  @keyframes fadeRight { from{opacity:0;transform:translateX(60px)} to{opacity:1;transform:translateX(0)} }
  @keyframes scaleIn { from{opacity:0;transform:scale(0.8)} to{opacity:1;transform:scale(1)} }
  @keyframes lineGrow { from{transform:scaleX(0)} to{transform:scaleX(1)} }
  @keyframes textExplosion { 0%{letter-spacing:-0.5em;opacity:0;filter:blur(8px)} 50%{filter:blur(2px)} 100%{letter-spacing:normal;opacity:1;filter:blur(0)} }
  @keyframes slideStagger { 0%{transform:translateY(80px) skewY(4deg);opacity:0} 100%{transform:translateY(0) skewY(0deg);opacity:1} }
  @keyframes bounceIn { 0%{transform:scale(0) rotate(-10deg);opacity:0} 50%{transform:scale(1.2) rotate(3deg)} 70%{transform:scale(0.95) rotate(-1deg)} 100%{transform:scale(1) rotate(0deg);opacity:1} }

  .reveal { opacity: 0; }
  .reveal.visible { animation: fadeUp 0.8s cubic-bezier(0.22,1,0.36,1) forwards; }
  .reveal-left { opacity: 0; }
  .reveal-left.visible { animation: fadeLeft 0.9s cubic-bezier(0.22,1,0.36,1) forwards; }
  .reveal-right { opacity: 0; }
  .reveal-right.visible { animation: fadeRight 0.9s cubic-bezier(0.22,1,0.36,1) forwards; }
  .reveal-scale { opacity: 0; }
  .reveal-scale.visible { animation: scaleIn 0.7s cubic-bezier(0.22,1,0.36,1) forwards; }
  .text-explosion { opacity: 0; }
  .text-explosion.visible { animation: textExplosion 0.9s cubic-bezier(0.22,1,0.36,1) forwards; }
  .slide-stagger { opacity: 0; }
  .slide-stagger.visible { animation: slideStagger 0.7s cubic-bezier(0.22,1,0.36,1) forwards; }
  .bounce-in { opacity: 0; }
  .bounce-in.visible { animation: bounceIn 0.8s cubic-bezier(0.34,1.56,0.64,1) forwards; }
  .section-line { height:3px; background:linear-gradient(90deg,#f27d99,#fbb6c8,#f27d99); transform-origin:left; transform:scaleX(0); border-radius:4px; }
  .section-line.visible { animation:lineGrow 0.8s cubic-bezier(0.22,1,0.36,1) forwards; }

  .delay-100{animation-delay:0.1s!important} .delay-200{animation-delay:0.2s!important}
  .delay-300{animation-delay:0.3s!important} .delay-400{animation-delay:0.4s!important}
  .delay-500{animation-delay:0.5s!important} .delay-600{animation-delay:0.6s!important}

  /* ---- GRADIENT & SHIMMER ---- */
  @keyframes gradientShift { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
  .gradient-headline {
    background: linear-gradient(135deg, #f27d99 0%, #e8627d 20%, #FCD47E 50%, #f27d99 80%, #fbb6c8 100%);
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 4s ease infinite;
  }
  @keyframes shimmer { 0%{background-position:-200% center} 100%{background-position:200% center} }
  .shimmer-price {
    background: linear-gradient(90deg, #f27d99 0%, #fbb6c8 40%, #f27d99 60%, #e8627d 100%);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 3s linear infinite;
  }

  /* ---- CARD EFFECTS ---- */
  .editorial-shadow { box-shadow: 0px 12px 32px rgba(57, 56, 50, 0.06); }
  .hover-scale-card { transition: all 0.5s cubic-bezier(0.4,0,0.2,1); transform-style:preserve-3d; will-change:transform; }
  .hover-scale-card:hover { transform:translateY(-12px) scale(1.03); box-shadow:0px 28px 50px rgba(242,125,153,0.18),0 0 0 1px rgba(242,125,153,0.08); }
  @keyframes holoBorder { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }
  .holo-card { position:relative; }
  .holo-card::before { content:''; position:absolute; inset:-2px; border-radius:inherit; z-index:-1; background:linear-gradient(135deg,#f27d99,#fbb6c8,#bef458,#FCD47E,#f27d99); background-size:300% 300%; opacity:0; transition:opacity 0.4s ease; animation:holoBorder 3s ease infinite; }
  .holo-card:hover::before { opacity:1; }
  .card-shine { position:absolute; inset:0; border-radius:inherit; pointer-events:none; z-index:10; background:radial-gradient(circle at var(--mx,50%) var(--my,50%),rgba(255,255,255,0.18) 0%,transparent 60%); opacity:0; transition:opacity 0.3s ease; }
  .holo-card:hover .card-shine { opacity:1; }
  .card-entry.holo-card { height:100%; display:flex; flex-direction:column; }
  .card-entry.holo-card > .p-6 { flex:1; display:flex; flex-direction:column; }
  .card-entry.holo-card > .flex.justify-between.items-center { margin-top:auto; }
  .card-entry.holo-card > .p-6 > .flex.justify-between.items-center:last-child { margin-top:auto; }

  /* ---- BUTTONS ---- */
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
  .draw-underline { position:relative; display:inline-block; }
  .draw-underline::after { content:''; position:absolute; left:0; bottom:-4px; height:3px; width:0; background:#f27d99; border-radius:4px; transition:width 0.5s cubic-bezier(0.22,1,0.36,1); }
  .draw-underline:hover::after { width: 100%; }

  /* ---- NAV ACTIVE ---- */
  .nav-active { position:relative; color:#f27d99!important; }
  .nav-active::after { content:''; position:absolute; left:0; bottom:-2px; width: 100%; height:2px; background:#f27d99; border-radius:2px; }
  .nav-dropdown { position: relative; }
  .nav-dropdown-btn {
    background: transparent; border: none; cursor: pointer;
    display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Epilogue', sans-serif; font-weight: 800;
  }
  .nav-dropdown-btn .material-symbols-outlined { font-size: 18px; transition: transform 0.25s ease; }
  .nav-dropdown:hover .nav-dropdown-btn .material-symbols-outlined,
  .nav-dropdown:focus-within .nav-dropdown-btn .material-symbols-outlined { transform: rotate(180deg); }
  .dropdown-menu {
    position: absolute; top: calc(100% + 10px); left: 50%;
    transform: translate(-50%, 8px);
    min-width: 210px; padding: 10px;
    background: #ffffff; border: 1px solid rgba(242,125,153,0.15);
    border-radius: 14px; box-shadow: 0 18px 40px rgba(242,125,153,0.18);
    opacity: 0; visibility: hidden; pointer-events: none;
    transition: all 0.25s ease;
  }
  .nav-dropdown:hover .dropdown-menu,
  .nav-dropdown:focus-within .dropdown-menu { opacity: 1; visibility: visible; pointer-events: auto; transform: translate(-50%, 0); }
  .dropdown-link {
    display: block; padding: 8px 12px; border-radius: 10px;
    font-size: 12px; font-weight: 700; letter-spacing: 0.06em;
    text-transform: uppercase; color: #66645e; transition: all 0.2s ease;
  }
  .dropdown-link:hover { background: rgba(242,125,153,0.12); color: #f27d99; }

  /* ---- BADGE BOUNCE ---- */
  @keyframes badgeBounce { 0%,100%{transform:scale(1)} 50%{transform:scale(1.35)} }
  .badge-bounce { animation: badgeBounce 1.4s ease-in-out infinite; }

  /* ---- MORPH BLOB ---- */
  @keyframes morphBlob { 0%,100%{border-radius:60% 40% 70% 30%/50% 60% 40% 50%;transform:rotate(0deg) scale(1)} 33%{border-radius:40% 60% 30% 70%/60% 40% 60% 40%;transform:rotate(120deg) scale(1.05)} 66%{border-radius:70% 30% 50% 50%/40% 70% 30% 60%;transform:rotate(240deg) scale(0.95)} }
  .morph-blob { animation: morphBlob 12s ease-in-out infinite; position: absolute; pointer-events: none; z-index: 0; opacity: 0.07; }

  /* ---- NOISE OVERLAY ---- */
  .noise-overlay::before { content:''; position:absolute; inset:0; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E"); pointer-events:none; border-radius:inherit; z-index:1; opacity:0.5; }

  /* ---- SECTION SWEEP ---- */
  @keyframes sectionSweep{0%{opacity:.18;transform:translateX(-100%) skewX(-5deg)}100%{opacity:0;transform:translateX(110%) skewX(-5deg)}}
  .section-sweep-anim::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(242,125,153,.15),transparent);animation:sectionSweep 1s ease forwards;pointer-events:none;z-index:20;border-radius:inherit}

  /* ---- TILT CARD ---- */
  .tilt-card { transition:transform 0.4s ease,box-shadow 0.4s ease; transform-style:preserve-3d; }
  .tilt-card:hover { transform:perspective(600px) rotateX(-6deg) rotateY(4deg) translateY(-8px) scale(1.04)!important; box-shadow:20px 30px 60px rgba(242,125,153,0.3); }

  /* ---- MENU HERO GRADIENT BG ---- */
  .menu-hero-bg {
    background: linear-gradient(135deg, #fff0f4 0%, #fffbff 40%, #f7f3e9 100%);
  }

  /* ---- FILTER TABS ---- */
  .filter-tab { transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1); }
  .filter-tab.active { background: #f27d99; color: #fff; box-shadow: 0 8px 24px rgba(242,125,153,0.35); transform: translateY(-2px); }
  .filter-tab:not(.active):hover { background: #fdf9ef; transform: translateY(-1px); }

  /* ---- PRODUCT CARD MENU ---- */
  .menu-card { transition: all 0.5s cubic-bezier(0.4,0,0.2,1); }
  .menu-card:hover { transform: translateY(-10px); box-shadow: 0 24px 48px rgba(242,125,153,0.16); }
  .menu-card .card-img { transition: transform 0.7s cubic-bezier(0.4,0,0.2,1); }
  .menu-card:hover .card-img { transform: scale(1.08); }

  /* ---- SPECIAL BANNER ---- */
  @keyframes wave-drift { 0%,100%{transform:translateX(0)} 50%{transform:translateX(-40px)} }
  .wave-anim { animation: wave-drift 10s ease-in-out infinite; }

  /* ---- PARTICLE CANVAS ---- */
  #particles { position:fixed; top:0; left:0; pointer-events:none; z-index:0; opacity:0.35; }

  /* ---- BURST ---- */
  @keyframes burstOut { 0%{transform:translate(0,0) scale(1);opacity:1} 100%{transform:translate(var(--bx),var(--by)) scale(0);opacity:0} }
  .burst-particle { position:fixed; pointer-events:none; z-index:9999; width:8px; height:8px; border-radius:50%; animation:burstOut 0.7s ease-out forwards; }

  body { opacity:0; animation:fadeIn 0.6s ease 0.1s forwards; }
  @keyframes fadeIn { to{opacity:1} }

  /* ---- SECTION EYEBROW (from menu.html) ---- */
  .section-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 11px; font-weight: 800; letter-spacing: 0.18em; text-transform: uppercase;
    color: #f27d99; margin-bottom: 12px;
  }
  .section-eyebrow::before { content:''; display:block; width:24px; height:2px; background:#f27d99; border-radius:2px; }
  .section-eyebrow.brown { color:#b06a00; }
  .section-eyebrow.brown::before { background:#b06a00; }
  .section-eyebrow.green { color:#5a9a10; }
  .section-eyebrow.green::before { background:#5a9a10; }

  /* ---- TRES LECHES INTRO TAG ---- */
  .tresl-intro-tag { display:inline-flex; align-items:center; gap:10px; background:rgba(242,125,153,0.08); border:1px solid rgba(242,125,153,0.2); color:#c04060; padding:7px 18px; border-radius:999px; font-size:11px; font-weight:800; letter-spacing:0.14em; text-transform:uppercase; margin-bottom:20px; }
  .tresl-intro-tag span { width:5px; height:5px; background:#f27d99; border-radius:50%; animation:livePulse 2s ease-in-out infinite; }
  #section-tresl .tresl-intro-tag span:first-child { width:5px; height:5px; background:#f27d99; border-radius:50%; animation:livePulse 2s ease-in-out infinite; }
  #section-tresl .tresl-intro-tag span:last-child { width:auto; height:auto; background:none; border-radius:0; animation:none; line-height:1.1; }
  @keyframes livePulse { 0%,100%{box-shadow:0 0 0 0 rgba(242,125,153,0.5)} 50%{box-shadow:0 0 0 8px rgba(242,125,153,0)} }
  #section-tresl .tresl-intro-tag { line-height: 1.2; padding-top: 8px; padding-bottom: 8px; }
  #section-tresl .tresl-title { line-height: 1.12; padding-top: 0.18em; }
  #section-tresl .tresl-title span { display: inline-block; }

  /* ---- BIG SECTION TITLE ---- */
  .section-big-title {
    font-family: 'Epilogue', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    font-weight: 900; line-height: 1.02; letter-spacing: -0.04em;
    margin: 0 0 12px; padding-top: 0.08em;
  }
  .cat-icon {
    width: 5rem;
    height: 5rem;
    padding: 0;
    overflow: hidden;
    flex-shrink: 0;
    transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease, border-color 0.35s ease;
  }
  .cat-icon:hover {
    transform: translateY(-4px) scale(1.08);
  }
  .cat-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transform: scale(1.16);
    transition: transform 0.45s ease;
  }
  .group:hover .cat-icon img {
    transform: scale(1.24);
  }
  @media (max-width: 767px) {
    .cat-icon {
      width: 4.35rem;
      height: 4.35rem;
    }
    .cat-icon img {
      transform: scale(1.12);
    }
    .group:hover .cat-icon img {
      transform: scale(1.18);
    }
  }

  /* ---- PROMO BANNER PULSE ---- */
  @keyframes promoPulse { 0%,100%{box-shadow:0 0 0 0 rgba(242,125,153,0.4)} 50%{box-shadow:0 0 0 12px rgba(242,125,153,0)} }
  .promo-pulse { animation: promoPulse 2.8s ease-in-out infinite; }

  /* ---- STAGGERED GRID ENTRY ---- */
  @keyframes cardEntry { from{opacity:0;transform:translateY(40px) scale(0.96)} to{opacity:1;transform:none} }
  .card-entry { opacity: 0; }
  .card-entry.visible { animation: cardEntry 0.65s cubic-bezier(0.22,1,0.36,1) forwards; }

  section { position: relative; overflow: visible; }

  /* ---- CART SIDEPANEL ---- */
  .cart-overlay{position:fixed;inset:0;background:rgba(26,16,24,.45);backdrop-filter:blur(4px);z-index:1000;opacity:0;pointer-events:none;transition:opacity .35s ease;}
  .cart-overlay.open{opacity:1;pointer-events:all;}
  .cart-panel{position:fixed;top:0;right:0;bottom:0;width:var(--cart-w);background:#fffbff;z-index:1002;display:flex;flex-direction:column;transform:translateX(100%);transition:transform .4s cubic-bezier(.22,1,.36,1);box-shadow:-24px 0 80px rgba(242,125,153,.12);}
  .cart-panel.open{transform:translateX(0);}
  .cart-panel-head{display:flex;align-items:center;justify-content:space-between;padding:20px 24px 16px;border-bottom:1px solid rgba(242,125,153,.12);background:#fffbff;}
  .cart-panel-title{font-family:'Epilogue',sans-serif;font-size:1.3rem;font-weight:900;color:#393832;letter-spacing:-.03em;display:flex;align-items:center;gap:10px;}
  .cart-count-badge{background:#f27d99;color:white;font-size:11px;font-weight:700;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;}
  .cart-head-actions{display:flex;align-items:center;gap:8px;}
  .cart-ai-btn{height:38px;border-radius:999px;border:1px solid rgba(242,125,153,.2);background:rgba(242,125,153,.08);color:#f27d99;display:flex;align-items:center;gap:6px;padding:0 12px;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;cursor:pointer;transition:all .25s cubic-bezier(.34,1.56,.64,1);}
  .cart-ai-btn:hover{background:#f27d99;color:white;transform:translateY(-1px);}
  .cart-close-btn{width:38px;height:38px;border-radius:50%;border:none;background:rgba(242,125,153,.08);color:#66645e;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s cubic-bezier(.34,1.56,.64,1);}
  .cart-close-btn:hover{background:#f27d99;color:white;transform:scale(1.1) rotate(90deg);}
  .cart-items{flex:1;overflow-y:auto;padding:16px 24px;display:flex;flex-direction:column;gap:14px;}
  .cart-items::-webkit-scrollbar{width:4px;}
  .cart-items::-webkit-scrollbar-thumb{background:rgba(242,125,153,.3);border-radius:4px;}
  .cart-item{display:flex;gap:14px;align-items:center;padding:14px;border-radius:16px;background:white;border:1px solid rgba(242,125,153,.1);box-shadow:0 2px 12px rgba(242,125,153,.06);animation:cartItemIn .4s cubic-bezier(.22,1,.36,1) both;}
  @keyframes cartItemIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:translateX(0)}}
  .cart-item-img{width:72px;height:72px;border-radius:12px;object-fit:cover;flex-shrink:0;border:1px solid rgba(242,125,153,.1);}
  .cart-item-info{flex:1;min-width:0;}
  .cart-item-name{font-family:'Epilogue',sans-serif;font-size:.95rem;font-weight:700;color:#393832;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
  .cart-item-variant{font-size:11px;color:#66645e;margin-bottom:8px;}
  .cart-item-row{display:flex;align-items:center;justify-content:space-between;}
  .cart-item-price{font-family:'Epilogue',sans-serif;font-size:1rem;font-weight:700;color:#f27d99;}
  .cart-item-qty{display:flex;align-items:center;gap:8px;background:#fdf9ef;border-radius:8px;padding:4px 8px;border:1px solid rgba(242,125,153,.15);}
  .cart-qty-btn{width:22px;height:22px;border-radius:50%;border:none;background:rgba(242,125,153,.12);color:#f27d99;font-size:14px;font-weight:700;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .25s cubic-bezier(.34,1.56,.64,1);}
  .cart-qty-btn:hover{background:#f27d99;color:white;transform:scale(1.15);}
  .cart-qty-val{font-size:13px;font-weight:700;color:#393832;min-width:16px;text-align:center;}
  .cart-item-remove{width:28px;height:28px;border-radius:50%;border:none;background:transparent;color:rgba(138,112,128,.4);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .25s;flex-shrink:0;}
  .cart-item-remove:hover{background:rgba(251,81,81,.1);color:#c0262d;transform:scale(1.1);}
  .cart-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:40px 24px;text-align:center;}
  .cart-empty-icon{font-size:56px;opacity:.25;}
  .cart-empty p{font-size:.9rem;color:#66645e;line-height:1.6;}
  .cart-empty-cta{margin-top:8px;padding:12px 28px;border-radius:999px;border:none;background:linear-gradient(135deg,#f27d99,#e8627d);color:white;font-family:'Epilogue',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:all .3s;box-shadow:0 6px 20px rgba(242,125,153,.3);}
  .cart-empty-cta:hover{transform:translateY(-3px);}
  .suggest-panel{position:fixed;top:0;right:calc(var(--cart-w) + 12px);bottom:0;width:260px;background:#fffbff;z-index:1001;display:flex;flex-direction:column;transform:translateX(20px);opacity:0;visibility:hidden;pointer-events:none;transition:transform .4s cubic-bezier(.22,1,.36,1),opacity .2s ease,visibility .2s ease;box-shadow:-16px 0 60px rgba(242,125,153,.12);border-left:1px solid rgba(242,125,153,.12);}
  .suggest-panel.open{transform:translateX(0);opacity:1;visibility:visible;pointer-events:auto;}
  .suggest-panel .cart-suggest{padding:18px 18px 12px;border-top:none;}
  .suggest-panel .cart-suggest-list{flex-direction:column;overflow-y:auto;padding-bottom:8px;}
  .suggest-panel .cart-suggest-card{min-width:unset;}
  .suggest-panel .cart-suggest-img{height:110px;}
  .suggest-panel .cart-suggest-add{width: 100%;}
  @media (max-width: 1100px){
    .suggest-panel{
      right:0;width: 100%;height:40vh;top:auto;bottom:0;
      transform:translateY(20px);
      border-left:none;border-top:1px solid rgba(242,125,153,.12);
      box-shadow:0 -16px 60px rgba(242,125,153,.12);
    }
    .suggest-panel.open{transform:translateY(0);}
  }
  .cart-suggest{padding:12px 24px 8px;border-top:1px dashed rgba(242,125,153,.18);background:#fffbff;}
  .cart-suggest-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
  .cart-suggest-title{font-family:'Epilogue',sans-serif;font-weight:900;font-size:.95rem;color:#393832;display:flex;align-items:center;gap:8px;}
  .cart-suggest-pill{font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:#f27d99;background:rgba(242,125,153,.12);padding:4px 8px;border-radius:999px;}
  .cart-suggest-list{display:flex;gap:10px;overflow-x:auto;padding-bottom:6px;}
  .cart-suggest-list::-webkit-scrollbar{height:4px;}
  .cart-suggest-list::-webkit-scrollbar-thumb{background:rgba(242,125,153,.35);border-radius:4px;}
  .cart-suggest-card{min-width:130px;background:white;border:1px solid rgba(242,125,153,.12);border-radius:14px;padding:8px;display:flex;flex-direction:column;gap:6px;box-shadow:0 4px 16px rgba(242,125,153,.08);}
  .cart-suggest-img{width: 100%;height:78px;border-radius:10px;object-fit:cover;}
  .cart-suggest-name{font-size:.8rem;font-weight:700;color:#393832;line-height:1.2;}
  .cart-suggest-price{font-size:.8rem;font-weight:800;color:#f27d99;}
  .cart-suggest-add{margin-top:auto;border:none;background:#f27d99;color:white;font-size:.75rem;font-weight:800;border-radius:999px;padding:6px 8px;cursor:pointer;transition:all .25s;}
  .cart-suggest-add:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(242,125,153,.3);}
  .cart-footer{padding:16px 24px 24px;border-top:1px solid rgba(242,125,153,.12);background:#fffbff;}
  .cart-promo{display:flex;gap:8px;margin-bottom:16px;}
  .cart-promo input{flex:1;padding:10px 14px;border-radius:10px;border:1.5px solid rgba(242,125,153,.2);background:#fdf9ef;font-size:13px;font-family:'Be Vietnam Pro',sans-serif;color:#393832;outline:none;transition:border-color .2s;}
  .cart-promo input:focus{border-color:#f27d99;}
  .cart-promo input::placeholder{color:rgba(138,112,128,.5);}
  .cart-promo-btn{padding:10px 16px;border-radius:10px;border:none;background:rgba(242,125,153,.1);color:#f27d99;font-size:12px;font-weight:700;cursor:pointer;transition:all .25s;}
  .cart-promo-btn:hover{background:#f27d99;color:white;}
  .cart-subtotal{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;}
  .cart-subtotal span{font-size:.85rem;color:#66645e;}
  .cart-subtotal strong{font-family:'Epilogue',sans-serif;font-size:1.1rem;font-weight:900;color:#393832;}
  .cart-free-ship{font-size:11px;color:#66645e;margin-bottom:14px;display:flex;align-items:center;gap:5px;}
  .cart-free-ship .bar{flex:1;height:4px;background:rgba(242,125,153,.15);border-radius:4px;overflow:hidden;}
  .cart-free-ship .bar-fill{height:100%;background:linear-gradient(90deg,#f27d99,#8DC63F);border-radius:4px;transition:width .5s ease;}
  .cart-checkout-btn{width: 100%;padding:16px;border-radius:14px;border:none;background:linear-gradient(135deg,#f27d99,#e8627d);color:white;font-family:'Epilogue',sans-serif;font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .4s cubic-bezier(.34,1.56,.64,1);box-shadow:0 8px 28px rgba(242,125,153,.35);position:relative;overflow:hidden;}
  .cart-checkout-btn::before{content:'';position:absolute;inset:0;background:rgba(255,255,255,.18);transform:translateX(-110%) skewX(-12deg);transition:transform .5s ease;}
  .cart-checkout-btn:hover::before{transform:translateX(110%) skewX(-12deg);}
  .cart-checkout-btn:hover{transform:translateY(-3px);box-shadow:0 16px 48px rgba(242,125,153,.5);}
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
      .site-shell{width:90%;margin:0 auto;}
      .site-shell nav{max-width:100% !important;}
      .site-shell .max-w-7xl{max-width:100% !important;}
    @media (max-width:1024px){.site-shell{width:94%;}}
    @media (max-width:640px){.site-shell{width:96%;}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $stockGuardRaw = strtolower(trim((string) \App\Models\SiteContent::get('stock_guard_enabled', '1')));
  $stockGuardEnabled = in_array($stockGuardRaw, ['1', 'true', 'yes', 'on'], true);
?>


  <!-- ==== 1. MENU HERO ==== -->
  <section class="relative menu-hero-bg pb-20 px-8 overflow-hidden page-hero-under-header" id="section-menu-hero">
    <div class="morph-blob w-96 h-96 bg-primary" style="top:-10%;left:-5%;"></div>
    <div class="morph-blob w-80 h-80 bg-secondary-container" style="bottom:5%;right:10%;animation-delay:4s;"></div>
    <div class="max-w-7xl mx-auto relative z-10" style="padding-top:20px;">
      <div class="text-center mb-10">
        <span class="reveal font-bold tracking-widest uppercase text-sm mb-4 block delay-100" style="color:#FCD47E;" data-cms="menu.hero.eyebrow" data-cms-label="Menu Hero Eyebrow">Artisan Bakery Since 2018</span>
        <h1 class="font-headline text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] mb-6 reveal delay-200">
          <span data-cms="menu.hero.title_before" data-cms-label="Menu Hero Title Before">Our </span><span class="gradient-headline" data-cms="menu.hero.title_highlight" data-cms-label="Menu Hero Title Highlight">Sweet</span><br><span data-cms="menu.hero.title_after" data-cms-label="Menu Hero Title After">Menu</span>
        </h1>
        <p class="text-on-surface-variant text-xl max-w-xl mx-auto mb-10 leading-relaxed reveal delay-300" data-cms="menu.hero.desc" data-cms-label="Menu Hero Description" data-cms-multiline="true">
          Every item handcrafted fresh each day. Zero preservatives, all love.
        </p>
        <!-- Filter Tabs -->
        <!-- <div class="flex flex-wrap justify-center gap-3 reveal delay-400" id="filter-tabs">
          <button class="filter-tab active px-7 py-3 rounded-full font-bold text-sm border border-primary/20 morph-btn" data-filter="all">All Treats</button>
          <button class="filter-tab px-7 py-3 rounded-full font-bold text-sm bg-surface-container-low text-on-surface-variant border border-transparent morph-btn" data-filter="cookies">Cookies</button>
          <button class="filter-tab px-7 py-3 rounded-full font-bold text-sm bg-surface-container-low text-on-surface-variant border border-transparent morph-btn" data-filter="brownies">Brownies</button>
          <button class="filter-tab px-7 py-3 rounded-full font-bold text-sm bg-surface-container-low text-on-surface-variant border border-transparent morph-btn" data-filter="cakes">Tres Leches</button>
          <button class="filter-tab px-7 py-3 rounded-full font-bold text-sm bg-surface-container-low text-on-surface-variant border border-transparent morph-btn" data-filter="drinks">Drinks</button>
          <button class="filter-tab px-7 py-3 rounded-full font-bold text-sm bg-surface-container-low text-on-surface-variant border border-transparent morph-btn" data-filter="boxes">Gift Boxes</button>
        </div> -->
      </div>

      <div class="mx-auto max-w-6xl rounded-[2rem] bg-surface-container-low/80 px-6 py-8 backdrop-blur-sm editorial-shadow reveal" id="section-cats">
        <div class="grid grid-cols-3 md:grid-cols-6 gap-6">
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-100" data-target="section-cookies">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/cookies.jpg')); ?>" alt="Cookies category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors" data-cms="menu.cat.cookies" data-cms-label="Menu Category Cookies">Cookies</span>
          </div>
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-200" data-target="section-brownies">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/brownies.jpg')); ?>" alt="Brownies category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors" data-cms="menu.cat.brownies" data-cms-label="Menu Category Brownies">Brownies</span>
          </div>
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-300" data-target="section-tresl">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/tres leche.jpg')); ?>" alt="Tres Leches category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors" data-cms="menu.cat.tresl" data-cms-label="Menu Category Tres Leches">Tres Leches</span>
          </div>
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-400" data-target="section-drinks">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/drinks.jpg')); ?>" alt="Drinks category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors" data-cms="menu.cat.drinks" data-cms-label="Menu Category Drinks">Drinks</span>
          </div>
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-500" data-target="section-boxes">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/gift box.jpg')); ?>" alt="Gift boxes category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors" data-cms="menu.cat.boxes" data-cms-label="Menu Category Boxes">Gift Boxes</span>
          </div>
          <div class="flex flex-col items-center gap-3 cursor-pointer group slide-stagger delay-600" data-target="section-cookies">
            <div class="w-16 h-16 rounded-full cat-icon editorial-shadow ring-2 ring-white/70 bg-white/70">
              <img src="<?php echo e(asset('images/special.jpg')); ?>" alt="Specials category">
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant group-hover:text-primary transition-colors">Specials</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==== 3. COOKIES SECTION ==== -->
  <section class="px-8 py-20 bg-surface-container-low" id="section-cookies">
    <div class="max-w-7xl mx-auto">
      <div class="flex justify-between items-end mb-12">
        <div>
          <div class="section-eyebrow reveal" data-cms="menu.cookies.eyebrow" data-cms-label="Menu Cookies Eyebrow">Signature Collection</div>
          <h2 class="section-big-title reveal delay-200" style="color:#2a1a22;"><span data-cms="menu.cookies.title_before" data-cms-label="Menu Cookies Title Before">Our Signature</span><br><span style="color:#f27d99;" data-cms="menu.cookies.title_highlight" data-cms-label="Menu Cookies Title Highlight">Cookies</span></h2>
          <p class="text-on-surface-variant mt-2 reveal delay-300" data-cms="menu.cookies.desc" data-cms-label="Menu Cookies Description" data-cms-multiline="true">Handcrafted with premium chocolate and real butter. Baked fresh every morning.</p>
        </div>
        <a class="btn-arrow reveal delay-300 shrink-0" href="<?php echo e(route('menu.show', 'cookies')); ?>">
          <span data-cms="menu.cookies.cta" data-cms-label="Menu Cookies CTA">View All Cookies</span>
          <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = ($featuredProducts['cookies'] ?? collect())->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $img = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png');
          $isOutOfStock = $stockGuardEnabled && !is_null($product->stock) && (int) $product->stock <= 0;
        ?>
        <div class="group bg-surface-container-lowest p-4 rounded-lg editorial-shadow hover-scale-card holo-card card-entry" style="position:relative">
          <div class="card-shine"></div>
          <div class="rounded-lg overflow-hidden mb-5 h-56 relative">
            <img class="card-img w-full h-full object-cover" src="<?php echo e($img); ?>" alt="<?php echo e($product->name); ?>">
            <?php if($product->is_bestseller): ?><div class="absolute top-3 right-3 bg-primary text-on-primary text-xs font-bold px-3 py-1 rounded-full">Bestseller</div><?php elseif($product->is_new): ?><div class="absolute top-3 right-3 bg-secondary text-on-secondary text-xs font-bold px-3 py-1 rounded-full">New</div><?php endif; ?>
          </div>
          <h3 class="font-headline text-xl font-bold mb-1"><?php echo e($product->name); ?></h3>
          <p class="text-on-surface-variant text-sm mb-4"><?php echo e(Illuminate\Support\Str::limit($product->short_description ?: strip_tags($product->description), 100)); ?></p>
          <div class="flex justify-between items-center">
            <div>
              <span class="shimmer-price font-bold text-lg">&pound;<?php echo e(number_format((float)$product->price, 2)); ?></span>
            </div>
            <button class="bg-secondary-container p-2 rounded-full material-symbols-outlined transition-all duration-300 <?php echo e($isOutOfStock ? 'text-zinc-500 cursor-not-allowed opacity-60' : 'text-on-secondary-container hover:rotate-12 hover:scale-110 active:scale-95 burst-cta'); ?>"
                    data-add-to-cart data-name="<?php echo e($product->name); ?>" data-price="<?php echo e($product->price); ?>"
                    data-category="cookies" data-image="<?php echo e($img); ?>" data-open-cart="1"
                    <?php if($isOutOfStock): echo 'disabled'; endif; ?>
                    aria-disabled="<?php echo e($isOutOfStock ? 'true' : 'false'); ?>"><?php echo e($isOutOfStock ? 'block' : 'add_shopping_cart'); ?></button>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-4 text-center text-on-surface-variant py-8">No cookies added yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==== 4. WHITE CHOCO COOKIE BANNER (from index, adapted) ==== -->
  

  <!-- ==== 5. BROWNIES SECTION ==== -->
  <section class="px-8 py-20" id="section-brownies">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
        <div>
          <div class="section-eyebrow brown reveal" data-cms="menu.brownies.eyebrow" data-cms-label="Menu Brownies Eyebrow">Premium Belgian Chocolate</div>
          <h2 class="section-big-title reveal delay-200" style="color:#2a1a08;"><span data-cms="menu.brownies.title_before" data-cms-label="Menu Brownies Title Before">Original Fudge</span><br><span style="color:#b06a00;" data-cms="menu.brownies.title_highlight" data-cms-label="Menu Brownies Title Highlight">Brownies</span></h2>
          <p class="text-on-surface-variant mt-2 reveal delay-300" data-cms="menu.brownies.desc" data-cms-label="Menu Brownies Description" data-cms-multiline="true">Rich, gooey, and made with premium Belgian chocolate.</p>
        </div>
        <a class="btn-arrow reveal delay-300 shrink-0" href="<?php echo e(route('menu.show', 'brownies')); ?>">
          <span data-cms="menu.brownies.cta" data-cms-label="Menu Brownies CTA">View All Brownies</span>
          <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
        <?php $__empty_1 = true; $__currentLoopData = ($featuredProducts['brownies'] ?? collect())->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $img = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png');
          $isOutOfStock = $stockGuardEnabled && !is_null($product->stock) && (int) $product->stock <= 0;
        ?>
        <div class="bg-surface-container-lowest rounded-xl overflow-hidden editorial-shadow hover-scale-card holo-card card-entry group" style="position:relative">
          <div class="card-shine"></div>
          <div class="h-56 overflow-hidden relative">
            <img class="card-img w-full h-full object-cover" src="<?php echo e($img); ?>" alt="<?php echo e($product->name); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          </div>
          <div class="p-6">
            <div class="flex justify-between items-start mb-2">
              <h3 class="font-headline text-xl font-bold"><?php echo e($product->name); ?></h3>
              <?php if($product->is_bestseller): ?><span class="bg-primary-container text-on-primary-container text-xs font-bold px-2 py-1 rounded-full">Bestseller</span><?php elseif($product->is_new): ?><span class="bg-secondary-container text-on-secondary-container text-xs font-bold px-2 py-1 rounded-full">New</span><?php endif; ?>
            </div>
            <p class="text-on-surface-variant text-sm mb-5"><?php echo e(Illuminate\Support\Str::limit($product->short_description ?: strip_tags($product->description), 80)); ?></p>
            <div class="flex justify-between items-center">
              <div>
                <span class="shimmer-price font-bold text-xl">&pound;<?php echo e(number_format((float)$product->price, 2)); ?></span>
              </div>
              <button class="px-5 py-2 rounded-full font-bold text-sm transition-all <?php echo e($isOutOfStock ? 'bg-zinc-300 text-zinc-600 cursor-not-allowed' : 'bg-secondary-container text-on-secondary-container hover:scale-105 burst-cta'); ?>"
                      data-add-to-cart data-name="<?php echo e($product->name); ?>" data-price="<?php echo e($product->price); ?>"
                      data-category="brownies" data-image="<?php echo e($img); ?>" data-open-cart="1"
                      <?php if($isOutOfStock): echo 'disabled'; endif; ?>
                      aria-disabled="<?php echo e($isOutOfStock ? 'true' : 'false'); ?>"><?php echo e($isOutOfStock ? 'Unavailable' : 'Add to Cart'); ?></button>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-4 text-center text-on-surface-variant py-8">No brownies added yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==== 6. KUNAFA BROWNIE BANNER (from index) ==== -->
  <!-- <section class="px-8 py-16" id="section-kunafa">
    <div class="max-w-7xl mx-auto rounded-xl overflow-hidden relative min-h-[480px] flex items-center p-12 md:p-24 group reveal">
      <div class="absolute inset-0 bg-gradient-to-r from-on-surface/80 to-transparent z-10"></div>
      <img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwW0bm4FWcJvHiFcXE4JVPMjV3nfBLD7S86Rq-nVsO6FXWAJ8_JU_A4BTNOvfdj8fasGV8lEyVo07bM1aJbEAR-Z148HnibPBeV_dBQWu6wosQ1qyQ93nhtBlmxUJCaTmXwm1odOVPQFw7F0KX5B3t1lop_PzC-30nhb_iAxpP82lGasyC9e78w9s1qx01TRiTkA8UYUcpB4CFb-K323nsDjh0ChivWIwKFQ4n6elyimeK2YAXD4IREZvX3yYML0JoOZzyAd6gOqk" alt="Kunafa Brownie">
      <div class="relative z-20 max-w-xl text-on-primary">
        <span class="bg-secondary text-on-secondary px-4 py-1 rounded-full text-xs font-bold uppercase mb-6 inline-block animate-bounce">Limited Edition</span>
        <h2 class="font-headline text-5xl md:text-6xl font-black mb-6 tracking-tighter reveal-left delay-200">Kunafa Brownie</h2>
        <p class="text-xl opacity-90 mb-10 leading-relaxed reveal delay-300">The crunch of traditional Middle Eastern Kunafa meets our fudgy dark chocolate brownie. A texture sensation like no other.</p>
        <button class="bg-primary px-8 py-4 rounded-full font-bold editorial-shadow hover:scale-110 transition-transform text-on-primary glow-btn morph-btn reveal delay-400 burst-cta">Experience the Crunch</button>
      </div>
    </div>
  </section> -->

  <!-- ==== 7. TRES LECHES ==== -->
  <section class="px-8 py-7 bg-surface-container" id="section-tresl">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
        <div>
          <div class="tresl-intro-tag reveal delay-100"><span></span><span data-cms="menu.tresl.tag" data-cms-label="Menu Tres Leches Tag">Made to Order</span></div>
          <h2 class="section-big-title reveal delay-200 tresl-title" style="color:#2a1a22;"><span data-cms="menu.tresl.title_before" data-cms-label="Menu Tres Leches Title Before">Ultimate</span><br><span style="background:linear-gradient(135deg,#f27d99,#FCD47E);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;" data-cms="menu.tresl.title_highlight" data-cms-label="Menu Tres Leches Title Highlight">Tres Leches</span></h2>
          <p class="text-on-surface-variant mt-2 reveal delay-300" data-cms="menu.tresl.desc" data-cms-label="Menu Tres Leches Description" data-cms-multiline="true">Mini cake serves 2 and large cake serves 4-5. Price range for all Tres Leches flavors: &pound;7.99 - &pound;44.99.</p>
        </div>
        <a class="btn-arrow reveal delay-300 shrink-0" href="<?php echo e(route('menu.show', 'tres-leches')); ?>">
          <span data-cms="menu.tresl.cta" data-cms-label="Menu Tres Leches CTA">View All Tres Leches</span>
          <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
        </a>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = ($featuredProducts['tres-leches'] ?? collect())->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $img = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png');
          $isOutOfStock = $stockGuardEnabled && !is_null($product->stock) && (int) $product->stock <= 0;
        ?>
        <article class="bg-surface-container-low rounded-xl overflow-hidden editorial-shadow card-entry group hover-scale-card holo-card" style="position:relative">
          <div class="card-shine"></div>
          <div class="h-52 overflow-hidden"><img class="card-img w-full h-full object-cover" src="<?php echo e($img); ?>" alt="<?php echo e($product->name); ?>"></div>
          <div class="p-6">
            <h3 class="font-headline text-xl font-bold mb-2"><?php echo e($product->name); ?></h3>
            <p class="text-on-surface-variant text-sm mb-2"><?php echo e(Illuminate\Support\Str::limit($product->short_description ?: strip_tags($product->description), 80)); ?></p>
            <p class="text-xs font-bold text-[#4d6e00] mb-4">&pound;<?php echo e(number_format((float)$product->price, 2)); ?></p>
            <div class="flex flex-col gap-3">
              <button class="px-5 py-2 rounded-full font-bold text-sm transition-all <?php echo e($isOutOfStock ? 'bg-zinc-300 text-zinc-600 cursor-not-allowed' : 'bg-[#f27d99] text-white hover:bg-[#e8627d] hover:scale-105'); ?>"
                      data-add-to-cart data-open-cart="1" data-name="<?php echo e($product->name); ?>"
                      data-price="<?php echo e($product->price); ?>" data-category="tres-leches" data-image="<?php echo e($img); ?>"
                      <?php if($isOutOfStock): echo 'disabled'; endif; ?>
                      aria-disabled="<?php echo e($isOutOfStock ? 'true' : 'false'); ?>"><?php echo e($isOutOfStock ? 'Unavailable' : 'Reserve'); ?></button>
            </div>
          </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-4 text-center text-on-surface-variant py-8">No tres leches added yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==== 8. FEATURES STRIP (from index) ==== -->
  <!-- <section class="py-16 px-6" id="section-features">
    <div class="max-w-5xl mx-auto text-center">
      <h2 class="font-headline text-3xl md:text-4xl font-bold mb-12 text-explosion">What Makes Our Desserts Unique</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="flex flex-col items-center slide-stagger delay-100">
          <div class="w-16 h-16 bg-tertiary-container rounded-full flex items-center justify-center mb-5 cat-icon">
            <span class="material-symbols-outlined text-tertiary text-3xl">eco</span>
          </div>
          <h4 class="font-headline font-bold text-xl mb-2">100% Halal</h4>
          <p class="text-on-surface-variant">We use only certified halal ingredients for your peace of mind.</p>
        </div>
        <div class="flex flex-col items-center slide-stagger delay-200">
          <div class="w-16 h-16 bg-primary-container rounded-full flex items-center justify-center mb-5 cat-icon">
            <span class="material-symbols-outlined text-primary text-3xl">fitness_center</span>
          </div>
          <h4 class="font-headline font-bold text-xl mb-2">Guilt-Free Options</h4>
          <p class="text-on-surface-variant">Selected low carb and keto-friendly treats available daily.</p>
        </div>
        <div class="flex flex-col items-center slide-stagger delay-300">
          <div class="w-16 h-16 bg-zinc-200 rounded-full flex items-center justify-center mb-5 cat-icon">
            <span class="material-symbols-outlined text-zinc-600 text-3xl">verified</span>
          </div>
          <h4 class="font-headline font-bold text-xl mb-2">Zero Preservatives</h4>
          <p class="text-on-surface-variant">Freshly made with real ingredients, just like at home.</p>
        </div>
      </div>
    </div>
  </section> -->

  <!-- ==== 9. GIFT BOXES ==== -->
  <section class="px-8 py-20 bg-surface-container-low" id="section-boxes">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14">
        <div class="section-eyebrow green reveal mx-auto" style="justify-content:center;" data-cms="menu.boxes.eyebrow" data-cms-label="Menu Boxes Eyebrow">Curated With Love</div>
        <h2 class="section-big-title reveal delay-200 text-explosion" style="color:#1a2a0a;"><span data-cms="menu.boxes.title_before" data-cms-label="Menu Boxes Title Before">Our Cravings</span><br><span style="background:linear-gradient(135deg,#5a9a10,#3a7000);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;" data-cms="menu.boxes.title_highlight" data-cms-label="Menu Boxes Title Highlight">Boxes</span></h2>
        <p class="text-on-surface-variant mt-3 max-w-xl mx-auto reveal delay-300" data-cms="menu.boxes.desc" data-cms-label="Menu Boxes Description" data-cms-multiline="true">The perfect gift for yourself or someone special. Curated boxes of happiness, delivered fresh.</p>
        <div class="mt-6 flex justify-end reveal delay-400">
          <a class="btn-arrow shrink-0" href="<?php echo e(route('menu.show', 'boxes')); ?>">
            <span data-cms="menu.boxes.cta" data-cms-label="Menu Boxes CTA">View All Boxes</span>
            <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
          </a>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-surface-container-lowest rounded-lg p-8 border-2 border-dashed border-primary/20 flex flex-col items-center text-center hover-scale-card card-entry editorial-shadow holo-card h-full" style="position:relative">
          <div class="card-shine"></div>
          <span class="material-symbols-outlined text-primary text-5xl mb-5">featured_seasonal_and_gifts</span>
          <h3 class="font-headline text-2xl font-bold mb-3">Craving Cookies Box of 6</h3>
          <p class="text-sm text-on-surface-variant mb-5">A box of 6 handcrafted cookies with a different flavour in each slot.</p>
          <span class="shimmer-price text-3xl font-black mb-7">&pound;20.99</span>
          <a href="<?php echo e(route('boxes.build')); ?>" class="block w-full py-3 rounded-full bg-secondary text-on-secondary font-bold hover:bg-secondary-dim transition-colors hover:scale-105 morph-btn burst-cta mt-auto">Gift This Box</a>
        </div>
        <div class="bg-surface-container-lowest rounded-lg p-8 border-2 border-primary flex flex-col items-center text-center hover-scale-card card-entry editorial-shadow holo-card relative h-full" style="position:relative">
          <div class="card-shine"></div>
          <div class="absolute -top-4 -right-4 bg-primary text-on-primary text-xs font-bold px-3 py-1.5 rounded-full rotate-12 editorial-shadow glow-btn">Most Popular</div>
          <span class="material-symbols-outlined text-primary text-5xl mb-5">card_giftcard</span>
          <h3 class="font-headline text-2xl font-bold mb-3">Craving Cookies Box of 4</h3>
          <p class="text-sm text-on-surface-variant mb-5">A box of 4 handcrafted cookies, each one customizable by flavour.</p>
          <span class="shimmer-price text-3xl font-black mb-7">&pound;13.99</span>
          <a href="<?php echo e(route('boxes.build')); ?>" class="block w-full py-3 rounded-full bg-primary text-on-primary font-bold hover:bg-primary-dim transition-colors hover:scale-105 morph-btn burst-cta mt-auto">Gift This Box</a>
        </div>
        <div class="bg-surface-container-lowest rounded-lg p-8 border-2 border-dashed border-primary/20 flex flex-col items-center text-center hover-scale-card card-entry editorial-shadow holo-card h-full" style="position:relative">
          <div class="card-shine"></div>
          <span class="material-symbols-outlined text-primary text-5xl mb-5">celebration</span>
          <h3 class="font-headline text-2xl font-bold mb-3">Craving Brownies Box of 6</h3>
          <p class="text-sm text-on-surface-variant mb-5">Mix box of 6 rich brownies with one base and your choice of toppings.</p>
          <span class="shimmer-price text-3xl font-black mb-7">&pound;20.99</span>
          <a href="<?php echo e(route('boxes.build')); ?>" class="block w-full py-3 rounded-full bg-secondary text-on-secondary font-bold hover:bg-secondary-dim transition-colors hover:scale-105 morph-btn burst-cta mt-auto">Gift This Box</a>
        </div>
        <div class="bg-surface-container-lowest rounded-lg p-8 border-2 border-dashed border-primary/20 flex flex-col items-center text-center hover-scale-card card-entry editorial-shadow holo-card h-full" style="position:relative">
          <div class="card-shine"></div>
          <span class="material-symbols-outlined text-primary text-5xl mb-5">breakfast_dining</span>
          <h3 class="font-headline text-2xl font-bold mb-3">Craving Brownies Box of 4</h3>
          <p class="text-sm text-on-surface-variant mb-5">Mix box of 4 fudgy brownies where you choose a topping for each piece.</p>
          <span class="shimmer-price text-3xl font-black mb-7">&pound;12.00 - &pound;13.99</span>
          <a href="<?php echo e(route('boxes.build')); ?>" class="block w-full py-3 rounded-full bg-primary text-on-primary font-bold hover:bg-primary-dim transition-colors hover:scale-105 morph-btn burst-cta mt-auto">Gift This Box</a>
        </div>
      </div>
    </div>
  </section>


  <section class="px-8 py-20" id="section-drinks">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
        <div>
          <div class="section-eyebrow reveal" data-cms="menu.drinks.eyebrow" data-cms-label="Menu Drinks Eyebrow">The Perfect Companion</div>
          <h2 class="section-big-title reveal delay-200" style="color:#2a2820;"><span data-cms="menu.drinks.title_before" data-cms-label="Menu Drinks Title Before">Our </span><span style="color:#4d6e00;" data-cms="menu.drinks.title_highlight" data-cms-label="Menu Drinks Title Highlight">Drinks</span></h2>
          <p class="text-on-surface-variant mt-2 reveal delay-300" data-cms="menu.drinks.desc" data-cms-label="Menu Drinks Description" data-cms-multiline="true">The perfect companion to your sweet treat.</p>
        </div>
        <a class="btn-arrow reveal delay-300 shrink-0" href="<?php echo e(route('menu.show', 'drinks')); ?>">
          <span data-cms="menu.drinks.cta" data-cms-label="Menu Drinks CTA">View All Drinks</span>
          <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span></span>
        </a>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = ($featuredProducts['drinks'] ?? collect())->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $img = $product->image ? route('media.public', ['path' => $product->image], false) : asset('images/main image redesign.png'); ?>
        <div class="text-center group card-entry">
          <div class="aspect-square bg-surface-container-low rounded-full mb-4 overflow-hidden editorial-shadow group-hover:scale-95 transition-transform duration-300 hover-scale-card">
            <img class="card-img w-full h-full object-cover" src="<?php echo e($img); ?>" alt="<?php echo e($product->name); ?>">
          </div>
          <h4 class="font-headline font-bold text-lg mb-1"><?php echo e($product->name); ?></h4>
          <span class="shimmer-price font-bold">&pound;<?php echo e(number_format((float)$product->price, 2)); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-4 text-center text-on-surface-variant py-8">No drinks added yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==== 11. MANGO ICED MATCHA BANNER (from index) ==== -->
  <!-- <section class="px-6 md:px-12 py-7" id="section-mango">
    <div class="max-w-7xl mx-auto bg-[#BEF458] rounded-xl overflow-hidden flex flex-col-reverse md:flex-row items-center reveal">
      <div class="md:w-1/2 p-8 md:p-11">
        <span class="text-primary font-bold tracking-widest text-sm uppercase mb-4 block">New on the Menu</span>
        <h2 class="font-headline text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter text-explosion">MANGO ICED MATCHA</h2>
        <p class="text-white text-lg mb-8 leading-relaxed">Ceremonial grade matcha whisked with fresh mango puree and oat milk. The perfect tropical refresh.</p>
        <button class="bg-primary text-white px-10 py-4 rounded-full font-bold hover:shadow-lg transition-all glow-btn morph-btn burst-cta">Sip the Freshness</button>
      </div>
      <div class="md:w-1/2 h-[500px] p-6 md:p-10 flex items-center justify-center overflow-hidden">
        <img alt="Mango Iced Matcha" class="w-full h-full object-contain transition-transform duration-700 animate-float-gentle hover:scale-105" src="<?php echo e(asset('images/image.png')); ?>"/>
      </div>
    </div>
  </section> -->


<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
// ==== PASTRY SVG LIBRARY ====
const PASTRY_SVGS = {
  donut1:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#f7c5d5" stroke="#f27d99" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><ellipse cx="50" cy="26" rx="18" ry="10" fill="#fbb6c8" opacity="0.9"/><ellipse cx="68" cy="36" rx="8" ry="12" fill="#fbb6c8" opacity="0.7"/><ellipse cx="32" cy="34" rx="7" ry="10" fill="#fbb6c8" opacity="0.7"/><rect x="40" y="20" width="6" height="2.5" rx="1.2" fill="#bef458" transform="rotate(30 43 21)"/><rect x="56" y="22" width="6" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(-20 59 23)"/><rect x="48" y="17" width="5" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(60 50 18)"/><rect x="35" y="26" width="5" height="2.5" rx="1.2" fill="#fbb6c8" transform="rotate(-40 37 27)"/><rect x="62" y="28" width="5" height="2.5" rx="1.2" fill="#bef458" transform="rotate(15 64 29)"/></svg>`,
  donut2:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#FCD47E" stroke="#e8a020" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><path d="M32 38 Q50 18 68 38 Q75 50 68 62 Q50 55 32 62 Q25 50 32 38Z" fill="#8B4513" opacity="0.7"/><rect x="38" y="24" width="7" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(45 41 25)"/><rect x="54" y="22" width="7" height="2.5" rx="1.2" fill="#bef458" transform="rotate(-30 57 23)"/><rect x="46" y="20" width="5" height="2.5" rx="1.2" fill="#fbb6c8" transform="rotate(70 48 21)"/><rect x="62" y="32" width="5" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(-50 64 33)"/><rect x="33" y="32" width="5" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(20 35 33)"/></svg>`,
  donut3:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="38" fill="#c8f0a0" stroke="#97b931" stroke-width="2"/><circle cx="50" cy="50" r="16" fill="#fffbff"/><path d="M50 12 Q70 16 82 32 Q86 50 78 64 Q65 75 50 78 Q35 75 22 64 Q14 50 18 32 Q30 16 50 12Z" fill="#f7a8b8" opacity="0.6" clip-path="url(#dc)"/><defs><clipPath id="dc"><circle cx="50" cy="50" r="38"/></clipPath></defs><rect x="42" y="16" width="7" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(25 45 17)"/><rect x="58" y="20" width="6" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(-40 61 21)"/><rect x="35" y="24" width="5" height="2.5" rx="1.2" fill="#bef458" transform="rotate(60 37 25)"/><rect x="64" y="35" width="5" height="2.5" rx="1.2" fill="#fbb6c8" transform="rotate(-15 66 36)"/></svg>`,
  croissant:`<svg viewBox="0 0 110 80" xmlns="http://www.w3.org/2000/svg"><ellipse cx="55" cy="40" rx="50" ry="20" fill="#FCD47E" transform="rotate(-15 55 40)"/><path d="M10 55 Q55 10 100 45 Q80 70 55 65 Q30 60 10 55Z" fill="#e8a020" opacity="0.5"/><path d="M15 48 Q55 15 95 50" stroke="#c07010" stroke-width="2.5" fill="none" stroke-linecap="round"/><ellipse cx="20" cy="32" rx="12" ry="8" fill="#FCD47E" transform="rotate(-30 20 32)"/><ellipse cx="90" cy="32" rx="12" ry="8" fill="#FCD47E" transform="rotate(30 90 32)"/></svg>`,
  cake:`<svg viewBox="0 0 90 100" xmlns="http://www.w3.org/2000/svg"><rect x="41" y="8" width="8" height="18" rx="2" fill="#fbb6c8"/><ellipse cx="45" cy="6" rx="4" ry="5" fill="#FCD47E"/><rect x="15" y="55" width="60" height="22" rx="4" fill="#f7c5d5"/><rect x="10" y="40" width="70" height="20" rx="4" fill="#fbb6c8"/><rect x="20" y="26" width="50" height="18" rx="4" fill="#f7a8b8"/><path d="M15 55 Q20 48 25 55 Q30 48 35 55 Q40 48 45 55 Q50 48 55 55 Q60 48 65 55 Q70 48 75 55" stroke="#fffbff" stroke-width="4" fill="none"/><circle cx="30" cy="48" r="3" fill="#bef458"/><circle cx="45" cy="45" r="3" fill="#FCD47E"/><circle cx="60" cy="48" r="3" fill="#f27d99"/></svg>`,
  macaron:`<svg viewBox="0 0 100 70" xmlns="http://www.w3.org/2000/svg"><ellipse cx="50" cy="20" rx="38" ry="18" fill="#f7a8b8"/><ellipse cx="50" cy="20" rx="38" ry="5" fill="#e8627d" opacity="0.4"/><rect x="12" y="30" width="76" height="10" rx="2" fill="#fdd4e0"/><ellipse cx="50" cy="50" rx="38" ry="18" fill="#f7a8b8"/></svg>`,
  cupcake:`<svg viewBox="0 0 90 100" xmlns="http://www.w3.org/2000/svg"><path d="M45 10 Q58 5 65 15 Q72 8 72 20 Q80 16 78 28 Q84 26 80 38 Q84 40 78 48 Q60 52 30 48 Q24 40 28 38 Q22 26 30 28 Q28 16 36 20 Q36 8 45 10Z" fill="#fbb6c8"/><ellipse cx="45" cy="48" rx="35" ry="10" fill="#f7c5d5"/><circle cx="45" cy="10" r="5" fill="#e8627d"/><path d="M10 58 L80 58 L72 95 L18 95 Z" fill="#FCD47E"/></svg>`,
  cookie:`<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="42" fill="#c8944a"/><ellipse cx="32" cy="38" rx="6" ry="5" fill="#3d1c08" transform="rotate(-15 32 38)"/><ellipse cx="58" cy="30" rx="6" ry="5" fill="#3d1c08" transform="rotate(20 58 30)"/><ellipse cx="68" cy="52" rx="6" ry="5" fill="#3d1c08" transform="rotate(-10 68 52)"/><ellipse cx="42" cy="65" rx="6" ry="5" fill="#3d1c08" transform="rotate(30 42 65)"/><ellipse cx="48" cy="44" rx="5" ry="4" fill="#3d1c08" transform="rotate(-5 48 44)"/></svg>`
};

const sectionPastryMap = [
  { id:'section-menu-hero',    left:'donut1',    right:'cupcake'   },
  { id:'section-cats',         left:'cookie',    right:'donut2'    },
  { id:'section-cookies',      left:'macaron',   right:'donut3'    },
  { id:'section-cookie-banner',left:'croissant', right:'cupcake'   },
  { id:'section-brownies',     left:'donut1',    right:'macaron'   },
  { id:'section-kunafa',       left:'cake',      right:'donut2'    },
  { id:'section-tresl',        left:'cupcake',   right:'cookie'    },
  { id:'section-features',     left:'donut3',    right:'croissant' },
  { id:'section-boxes',        left:'macaron',   right:'donut1'    },
  { id:'section-drinks',       left:'cake',      right:'cupcake'   },
  { id:'section-mango',        left:'donut3',    right:'croissant' },
];

const leftPastry  = document.getElementById('globalLeftPastry');
const rightPastry = document.getElementById('globalRightPastry');
let pastryState = 'hidden', currentLeft = 'donut1', currentRight = 'cupcake', idleTimer = null;

function setPastrySVG(side, key) {
  const el = side === 'left' ? leftPastry : rightPastry;
  el.innerHTML = PASTRY_SVGS[key] || PASTRY_SVGS.donut1;
}
function showPastries(lk, rk) {
  if (pastryState === 'entering') return;
  const changing = (lk !== currentLeft || rk !== currentRight);
  currentLeft = lk; currentRight = rk;
  if (pastryState === 'visible' && !changing) return;
  if (pastryState === 'visible' && changing) { hidePastries(() => showPastries(lk, rk)); return; }
  pastryState = 'entering';
  clearTimeout(idleTimer);
  setPastrySVG('left', lk); setPastrySVG('right', rk);
  leftPastry.className  = 'pastry-fixed left-pastry';
  rightPastry.className = 'pastry-fixed right-pastry';
  void leftPastry.offsetWidth;
  leftPastry.classList.add('spin-enter-left');
  rightPastry.classList.add('spin-enter-right');
  idleTimer = setTimeout(() => {
    if (pastryState === 'entering') {
      leftPastry.className  = 'pastry-fixed left-pastry idle-left';
      rightPastry.className = 'pastry-fixed right-pastry idle-right';
      pastryState = 'visible';
    }
  }, 1100);
}
function hidePastries(callback) {
  if (pastryState === 'hidden' || pastryState === 'exiting') { if (callback) callback(); return; }
  pastryState = 'exiting';
  clearTimeout(idleTimer);
  leftPastry.className  = 'pastry-fixed left-pastry spin-exit-left';
  rightPastry.className = 'pastry-fixed right-pastry spin-exit-right';
  setTimeout(() => {
    leftPastry.className  = 'pastry-fixed left-pastry';
    rightPastry.className = 'pastry-fixed right-pastry';
    pastryState = 'hidden';
    if (callback) callback();
  }, 620);
}
const sectionList = sectionPastryMap.map(cfg => ({ ...cfg, el: document.getElementById(cfg.id) })).filter(cfg => cfg.el);
function checkPastries() {
  const vh = window.innerHeight;
  let found = null;
  for (const cfg of sectionList) {
    const rect = cfg.el.getBoundingClientRect();
    if (rect.top < vh * 0.75 && rect.bottom > vh * 0.25) { found = cfg; break; }
  }
  found ? showPastries(found.left, found.right) : hidePastries();
}
let ticking = false;
window.addEventListener('scroll', () => { if (!ticking) { requestAnimationFrame(() => { checkPastries(); ticking = false; }); ticking = true; } }, { passive: true });

// ==== REVEAL ANIMATIONS ====
const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .section-line, .text-explosion, .bounce-in, .slide-stagger, .card-entry');
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('visible'); revealObserver.unobserve(entry.target); } });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
revealEls.forEach(el => revealObserver.observe(el));

// ==== FILTER TABS ====
document.querySelectorAll('.filter-tab').forEach(tab => {
  tab.addEventListener('click', function() {
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    this.classList.add('active');
    const filter = this.dataset.filter;
    const sectionMap = { cookies:'section-cookies', brownies:'section-brownies', cakes:'section-tresl', drinks:'section-drinks', boxes:'section-boxes' };
    if (filter !== 'all' && sectionMap[filter]) {
      document.getElementById(sectionMap[filter])?.scrollIntoView({ behavior:'smooth', block:'start' });
    }
  });
});

// ==== BACKGROUND SPRINKLES ====
const sprinkleContainer = document.getElementById('sprinkles-container');
const colors = ['#f27d99','#fbb6c8','#bef458','#FCD47E','#fdd4e0'];
function createSprinkle() {
  const s = document.createElement('div'); s.className = 'sprinkle';
  const size = 4 + Math.random() * 8;
  s.style.cssText = `width:${size}px;height:${size}px;background:${colors[Math.floor(Math.random()*colors.length)]};left:${Math.random()*100}vw;animation-duration:${10+Math.random()*18}s;animation-delay:${Math.random()*12}s;border-radius:${Math.random()>0.5?'50%':'2px'};`;
  sprinkleContainer.appendChild(s);
  setTimeout(() => s.remove(), 30000);
}
for (let i = 0; i < 18; i++) createSprinkle();
setInterval(createSprinkle, 2400);

// ==== MOUSE TRAIL ====
document.addEventListener('mousemove', (e) => {
  if (Math.random() > 0.94) {
    const dot = document.createElement('div');
    dot.style.cssText = `position:fixed;pointer-events:none;z-index:9999;width:6px;height:6px;border-radius:50%;background:${colors[Math.floor(Math.random()*colors.length)]};left:${e.clientX-3}px;top:${e.clientY-3}px;opacity:0.8;transition:transform 0.6s ease,opacity 0.6s ease;`;
    document.body.appendChild(dot);
    requestAnimationFrame(() => { dot.style.transform=`translate(${(Math.random()-0.5)*40}px,${-30-Math.random()*30}px) scale(0)`; dot.style.opacity='0'; });
    setTimeout(() => dot.remove(), 700);
  }
});

// ==== RIPPLE BUTTONS ====
const rippleStyle = document.createElement('style');
rippleStyle.textContent = '@keyframes rippleAnim { to { transform: scale(3.5); opacity: 0; } }';
document.head.appendChild(rippleStyle);
document.querySelectorAll('button, .glow-btn').forEach(btn => {
  btn.style.position = 'relative'; btn.style.overflow = 'hidden';
  btn.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    ripple.style.cssText = `position:absolute;border-radius:50%;pointer-events:none;width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;background:rgba(255,255,255,0.35);transform:scale(0);animation:rippleAnim 0.55s ease-out;`;
    this.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
  });
});

// ==== SCROLL PROGRESS BAR ====
const progressBar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
  const pct = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
  progressBar.style.width = pct + '%';
}, { passive: true });

// ==== 3D CARD TILT ====
document.querySelectorAll('.hover-scale-card').forEach(card => {
  card.addEventListener('mousemove', e => {
    const r = card.getBoundingClientRect();
    const x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
    card.style.transform = `perspective(800px) rotateX(${(y-0.5)*-14}deg) rotateY(${(x-0.5)*14}deg) translateY(-12px) scale(1.03)`;
    card.style.boxShadow = `${(x-0.5)*-20}px ${(y-0.5)*-20}px 40px rgba(242,125,153,0.2)`;
    card.style.setProperty('--mx', (x*100)+'%'); card.style.setProperty('--my', (y*100)+'%');
  });
  card.addEventListener('mouseleave', () => { card.style.transform=''; card.style.boxShadow=''; });
});

// ==== BURST CTA ====
document.querySelectorAll('.burst-cta').forEach(btn => {
  btn.addEventListener('click', e => {
    for (let i = 0; i < 16; i++) {
      const p = document.createElement('div'); p.className = 'burst-particle';
      const angle = (i/16)*360, dist = 60+Math.random()*80;
      p.style.cssText = `left:${e.clientX}px;top:${e.clientY}px;background:${colors[Math.floor(Math.random()*colors.length)]};--bx:${Math.cos(angle*Math.PI/180)*dist}px;--by:${Math.sin(angle*Math.PI/180)*dist}px;`;
      document.body.appendChild(p); setTimeout(() => p.remove(), 750);
    }
  });
});

// ==== PARTICLE CANVAS ====
(function() {
  const canvas = document.getElementById('particles');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let W, H, particles = [];
  function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
  resize(); window.addEventListener('resize', resize);
  for (let i = 0; i < 45; i++) {
    particles.push({ x:Math.random()*W, y:Math.random()*H, vx:(Math.random()-0.5)*0.4, vy:(Math.random()-0.5)*0.4, r:1+Math.random()*2, c:['#f27d99','#fbb6c8','#bef458','#FCD47E'][Math.floor(Math.random()*4)], a:0.1+Math.random()*0.25 });
  }
  function draw() {
    ctx.clearRect(0,0,W,H);
    particles.forEach(p => {
      p.x+=p.vx; p.y+=p.vy;
      if(p.x<0)p.x=W; if(p.x>W)p.x=0; if(p.y<0)p.y=H; if(p.y>H)p.y=0;
      ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
      ctx.fillStyle=p.c; ctx.globalAlpha=p.a; ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  draw();
})();

// ==== SECTION SWEEP ====
const sweepObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.position='relative'; entry.target.classList.add('section-sweep-anim');
      setTimeout(() => entry.target.classList.remove('section-sweep-anim'), 1100);
      sweepObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.2 });
['section-cookie-banner','section-kunafa','section-features','section-mango'].forEach(id => {
  const el = document.getElementById(id); if (el) sweepObserver.observe(el);
});


// ==== CATEGORY SCROLL ====
document.querySelectorAll('[data-target]').forEach(item => {
  item.addEventListener('click', function() {
    const target = document.getElementById(this.dataset.target);
    if (!target) return;
    const offset = target.getBoundingClientRect().top + window.scrollY - 100;
    window.scrollTo({ top: offset, behavior: 'smooth' });
  });
});

// ==== INIT ====
setTimeout(checkPastries, 500);
</script>

<script>
(function applyCmsContent(){
 const STORAGE_KEY = 'cc_cms_content';
 let data = {};
 try { data = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}'); } catch (e) { data = {}; }
 if (!data || typeof data !== 'object') return;
 Object.keys(data).forEach((key) => {
  const els = document.querySelectorAll(`[data-cms="${key}"]`);
  if (!els || els.length === 0) return;
  els.forEach((el) => {
   const attr = el.getAttribute('data-cms-attr');
   if (attr) { el.setAttribute(attr, data[key]); return; }
   el.textContent = data[key];
  });
 });
})();
</script>
<?php $__env->stopPush(); ?>








<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/menu.blade.php ENDPATH**/ ?>