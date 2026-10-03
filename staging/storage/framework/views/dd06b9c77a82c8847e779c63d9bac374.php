<?php if (! $__env->hasRenderedOnce('0c59d78f-35c4-4e26-8236-9d8fadffa16e')): $__env->markAsRenderedOnce('0c59d78f-35c4-4e26-8236-9d8fadffa16e'); ?>
<style>
  .glass-nav {
    background: transparent !important;
    border-bottom: none !important;
    transition: all 0.35s ease;
    overflow: visible;
  }
  .glass-nav.scrolled {
    background: transparent !important;
    box-shadow: none !important;
    border-bottom: none !important;
  }
  #main-header {
    top: calc(var(--marquee-h, 0px) + var(--cc-header-top-gap, 12px)) !important;
    left: 0;
    right: 0;
    margin-top: 0 !important;
    padding-top: 0 !important;
    overflow: visible;
  }
  .logo-img {
    display: block;
    object-fit: contain;
    transition: transform 0.3s ease;
  }
  .logo-img:hover { transform: scale(1.05); }
  .logo-img-nav { height: 60px; width: auto; max-width: 180px; }
  .logo-link-nav { display: inline-block; line-height: 0; }
  .cc-header-shell {
    padding-top: 0;
    margin-top: 0 !important;
    position: relative;
    z-index: 5;
    overflow: visible;
  }
  .cc-header-bar {
    min-height: 78px;
    margin-top: 0 !important;
    padding: 0 22px 0 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    position: relative;
    border-radius: 26px;
    background: linear-gradient(135deg, rgba(255,251,255,0.76) 0%, rgba(253,249,239,0.84) 36%, rgba(251,182,200,0.20) 72%, rgba(190,244,88,0.12) 100%);
    backdrop-filter: blur(28px) saturate(190%);
    -webkit-backdrop-filter: blur(28px) saturate(190%);
    border: 1px solid rgba(255,255,255,0.74);
    border-top: 1px solid rgba(255,255,255,0.96);
    box-shadow:
      inset 0 2px 0 rgba(255,255,255,0.88),
      inset 0 -1px 0 rgba(242,125,153,0.08),
      0 22px 70px rgba(242,125,153,0.12),
      0 8px 22px rgba(57,56,50,0.08);
    transform-style: preserve-3d;
    transition: transform 0.18s ease, box-shadow 0.3s ease, background 0.3s ease, border-color 0.3s ease;
    overflow: visible;
  }
  .cc-header-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 32px;
    right: 32px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,1), rgba(251,182,200,0.9), rgba(252,212,126,0.8), transparent);
    border-radius: 999px;
    pointer-events: none;
  }
  .cc-header-bar::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: radial-gradient(ellipse at var(--cc-glow-x,50%) var(--cc-glow-y,50%), rgba(242,125,153,0.14) 0%, rgba(252,212,126,0.10) 38%, rgba(190,244,88,0.08) 58%, transparent 74%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
  }
  .cc-header-bar.is-glowing::after { opacity: 1; }
  .cc-logo-link {
    flex-shrink: 0;
    position: relative;
    z-index: 2;
  }
  .cc-logo-link .logo-img-nav {
    height: 46px;
    max-width: 190px;
    filter: drop-shadow(0 8px 16px rgba(242,125,153,0.14));
  }
  .cc-nav-desktop {
    flex: 1;
    min-width: 0;
    align-items: center;
    justify-content: center;
    gap: 3px;
    position: relative;
    z-index: 2;
  }
  .cc-nav-item { position: relative; }
  /* Hover bridge: prevents accidental close while moving cursor to dropdown */
  .cc-nav-item::after {
    content: '';
    position: absolute;
    top: 100%;
    left: -18px;
    right: -18px;
    height: 18px;
  }
  .cc-nav-link,
  .cc-nav-btn {
    border: none;
    background: transparent;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 10px 14px;
    border-radius: 14px;
    color: rgba(57,56,50,0.78);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.01em;
    white-space: nowrap;
    position: relative;
    transition: color 0.22s ease, background 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease;
  }
  .cc-nav-link:hover,
  .cc-nav-btn:hover,
  .cc-nav-link.is-active,
  .cc-nav-btn.is-active {
    color: #e8627d;
    background: rgba(242,125,153,0.08);
  }
  .cc-nav-link.is-active,
  .cc-nav-btn.is-active {
    font-weight: 800;
    box-shadow: inset 0 0 0 1px rgba(242,125,153,0.08);
  }
  .cc-nav-link.is-active::after,
  .cc-nav-btn.is-active::after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: 5px;
    width: 20px;
    height: 2px;
    border-radius: 999px;
    transform: translateX(-50%);
    background: linear-gradient(90deg, #f27d99, #FCD47E);
  }
  .cc-caret {
    font-size: 17px;
    color: rgba(143,60,91,0.54);
    transition: transform 0.28s ease, color 0.28s ease;
  }
  .cc-nav-item:hover .cc-caret,
  .cc-nav-item:focus-within .cc-caret {
    transform: rotate(180deg);
    color: #e8627d;
  }
  .cc-mega {
    position: absolute;
    top: calc(100% + 6px);
    left: 50%;
    transform: translateX(-50%) translateY(8px);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.28s ease, transform 0.32s cubic-bezier(0.23, 1, 0.32, 1), visibility 0.28s ease;
    z-index: 30;
  }
  .cc-nav-item:hover .cc-mega,
  .cc-nav-item:focus-within .cc-mega {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateX(-50%) translateY(0);
  }
  .cc-mega-panel {
    position: relative;
    overflow: hidden;
    border-radius: 22px;
    background:
      linear-gradient(145deg, rgba(255,255,255,0.97) 0%, rgba(253,249,239,0.96) 38%, rgba(251,182,200,0.18) 72%, rgba(190,244,88,0.14) 100%);
    backdrop-filter: blur(38px) saturate(185%);
    -webkit-backdrop-filter: blur(38px) saturate(185%);
    border: 1px solid rgba(255,255,255,0.94);
    border-top: 1px solid rgba(255,255,255,0.96);
    box-shadow:
      inset 0 2px 0 rgba(255,255,255,0.96),
      0 28px 80px rgba(242,125,153,0.16),
      0 10px 32px rgba(57,56,50,0.12);
  }
  .cc-mega-panel::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 14% 18%, rgba(242,125,153,0.10) 0%, transparent 34%), radial-gradient(circle at 84% 16%, rgba(252,212,126,0.12) 0%, transparent 28%), radial-gradient(circle at 78% 82%, rgba(190,244,88,0.10) 0%, transparent 32%);
    pointer-events: none;
  }
  .cc-mega-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 24px;
    right: 24px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,1), rgba(251,182,200,0.75), transparent);
  }
  .cc-mega-menu { width: min(1040px, calc(100vw - 60px)); }
  .cc-mega-menu .cc-mega-panel { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); }
  .cc-mega-card {
    display: block;
    position: relative;
    z-index: 1;
    overflow: hidden;
    padding: 22px 18px 20px;
    text-decoration: none;
    border-right: 1px solid rgba(242,125,153,0.09);
    background: linear-gradient(135deg, rgba(255,236,242,0.98) 0%, rgba(255,245,249,0.96) 30%, rgba(253,231,184,0.44) 68%, rgba(220,247,162,0.38) 100%);
    transition: transform 0.24s ease, box-shadow 0.24s ease, background 0.24s ease;
  }
  .cc-mega-card:last-child { border-right: none; }
  .cc-mega-card:hover {
    transform: translateY(-1px);
    box-shadow: inset 0 0 0 1px rgba(242,125,153,0.08);
  }
  .cc-mega-card img {
    width: 100%;
    height: 92px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 12px;
    border: 1px solid rgba(255,255,255,0.86);
    box-shadow: 0 8px 18px rgba(242,125,153,0.12);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
  }
  .cc-mega-card:hover img { transform: scale(1.03); box-shadow: 0 14px 30px rgba(242,125,153,0.18); }
  .cc-mega-title { font-family: 'Noto Serif', serif; font-size: 14px; font-weight: 700; color: #3a3526; margin-bottom: 4px; }
  .cc-mega-desc { font-size: 11px; line-height: 1.55; color: rgba(102,100,94,0.82); }
  .cc-mega-areas { width: min(560px, calc(100vw - 50px)); }
  .cc-mega-areas .cc-mega-panel { padding: 22px; }
  .cc-mega-label {
    font-family: 'Noto Serif', serif;
    font-size: 11px;
    font-style: italic;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #f27d99;
    margin-bottom: 15px;
    padding-bottom: 11px;
    border-bottom: 1px solid rgba(242,125,153,0.14);
  }
  .cc-areas-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px; }
  .cc-area-link {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 10px 11px;
    border-radius: 14px;
    text-decoration: none;
    border: 1px solid transparent;
    transition: background 0.22s ease, border-color 0.22s ease, transform 0.22s ease;
  }
  .cc-area-link:hover { background: rgba(242,125,153,0.07); border-color: rgba(242,125,153,0.16); transform: translateX(3px); }
  .cc-area-thumb {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(242,125,153,0.16), rgba(252,212,126,0.88));
    border: 1px solid rgba(255,255,255,0.78);
    box-shadow: 0 6px 14px rgba(242,125,153,0.10);
    color: #7a1535;
    font-family: 'Epilogue', sans-serif;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: 0.04em;
  }
  .cc-area-name { display: block; margin-bottom: 1px; color: #3a3526; font-size: 13px; font-weight: 700; }
  .cc-area-sub { display: block; color: rgba(102,100,94,0.76); font-size: 10.5px; }

  .cc-mega-blog { width: min(1060px, calc(100vw - 56px)); }
  .cc-mega-blog .cc-mega-panel {
    display: grid;
    grid-template-columns: 210px minmax(0, 1fr);
    gap: 14px;
    padding: 14px;
    border-radius: 24px;
    background:
      radial-gradient(circle at 14% 18%, rgba(242,125,153,0.14) 0%, transparent 34%),
      radial-gradient(circle at 82% 14%, rgba(252,212,126,0.2) 0%, transparent 30%),
      linear-gradient(145deg, rgba(255,251,255,0.98) 0%, rgba(253,249,239,0.98) 58%, rgba(247,243,233,0.98) 100%);
    border: 1px solid rgba(242,125,153,0.24);
    box-shadow:
      inset 0 1px 0 rgba(255,255,255,0.9),
      0 28px 80px rgba(242,125,153,0.18),
      0 12px 36px rgba(57,56,50,0.12);
  }
  .cc-blog-side {
    padding: 8px;
    border-radius: 16px;
    background: rgba(255,255,255,0.66);
    border: 1px solid rgba(242,125,153,0.16);
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .cc-blog-side-link {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 12px 12px;
    border-radius: 12px;
    text-decoration: none;
    color: #393832;
    border: 1px solid rgba(242,125,153,0.2);
    background: rgba(255,255,255,0.88);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    font-weight: 700;
    transition: all 0.24s ease;
  }
  .cc-blog-side-link .material-symbols-outlined { font-size: 17px; }
  .cc-blog-side-link:hover,
  .cc-blog-side-link.is-active {
    background: linear-gradient(135deg, rgba(242,125,153,0.2), rgba(252,212,126,0.24));
    border-color: rgba(242,125,153,0.46);
    color: #7a1535;
    transform: translateX(2px);
  }
  .cc-blog-side-link.is-disabled {
    opacity: 0.62;
    cursor: default;
    pointer-events: none;
  }
  .cc-blog-main { min-width: 0; }
  .cc-blog-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin: 2px 2px 10px;
  }
  .cc-blog-kicker {
    margin: 0;
    color: #f27d99;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.16em;
    font-family: 'Be Vietnam Pro', sans-serif;
  }
  .cc-blog-viewall {
    color: #8f3c5b;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 700;
    transition: color 0.2s ease;
  }
  .cc-blog-viewall:hover { color: #e8627d; }
  .cc-blog-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px;
  }
  .cc-blog-card {
    display: block;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(242,125,153,0.2);
    background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(253,249,239,0.94));
    text-decoration: none;
    transition: transform 0.24s ease, border-color 0.24s ease, box-shadow 0.24s ease;
  }
  .cc-blog-card:hover {
    transform: translateY(-2px);
    border-color: rgba(242,125,153,0.56);
    box-shadow: 0 14px 28px rgba(242,125,153,0.2);
  }
  .cc-blog-card-media {
    height: 92px;
    background: #fff2f7;
    border-bottom: 1px solid rgba(242,125,153,0.16);
  }
  .cc-blog-card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .cc-blog-card-copy { padding: 10px 11px 11px; }
  .cc-blog-card-title {
    margin: 0;
    color: #393832;
    font-family: 'Epilogue', sans-serif;
    font-size: 15px;
    font-weight: 800;
    line-height: 1.25;
    letter-spacing: -0.01em;
  }
  .cc-blog-card-meta {
    margin-top: 7px;
    color: #8f3c5b;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.01em;
  }
  .cc-blog-card-cta {
    min-height: 162px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: linear-gradient(160deg, #f27d99 0%, #f7b3c5 48%, #fcd47e 100%);
    border-color: rgba(242,125,153,0.5);
  }
  .cc-blog-card-cta span {
    display: block;
    color: #7a1535;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.16em;
    margin-bottom: 8px;
    font-family: 'Be Vietnam Pro', sans-serif;
  }
  .cc-blog-card-cta strong {
    color: #fff;
    font-family: 'Epilogue', sans-serif;
    font-size: 28px;
    line-height: 1;
    letter-spacing: -0.02em;
  }
  .cc-blog-card-empty {
    min-height: 162px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px;
    text-align: center;
    color: #66645e;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.55;
    background: rgba(255,245,249,0.96);
  }

  .cc-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
  }
  .cc-icon-btn {
    width: 40px;
    height: 40px;
    border-radius: 13px;
    border: 1px solid rgba(242,125,153,0.18);
    background: rgba(255,255,255,0.52);
    color: rgba(102,100,94,0.92);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 19px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, color 0.22s ease, background 0.22s ease;
  }
  .cc-icon-btn:hover { transform: translateY(-1px); background: rgba(242,125,153,0.10); border-color: rgba(242,125,153,0.34); color: #e8627d; box-shadow: 0 10px 24px rgba(242,125,153,0.14); }
  .cc-divider { width: 1px; height: 18px; background: rgba(242,125,153,0.18); }
  .cc-cart-wrap { position: relative; }
  .cc-cart-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    min-width: 17px;
    height: 17px;
    padding: 0 4px;
    border-radius: 999px;
    background: linear-gradient(135deg, #f27d99, #FCD47E);
    color: #fff;
    font-size: 9px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid #fffbff;
  }
  .cc-order-btn {
    padding: 10px 18px;
    border-radius: 14px;
    background: linear-gradient(135deg, #f27d99 0%, #f69ab0 42%, #f7c57a 100%);
    color: #fff;
    text-decoration: none;
    align-items: center;
    gap: 6px;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.02em;
    box-shadow: 0 12px 28px rgba(242,125,153,0.2);
    border: 1px solid rgba(255,255,255,0.22);
    transition: transform 0.24s ease, box-shadow 0.24s ease, filter 0.24s ease;
  }
  .cc-order-btn:hover { transform: translateY(-2px); box-shadow: 0 18px 36px rgba(242,125,153,0.28); filter: saturate(1.05); }
  .cc-order-btn .material-symbols-outlined { font-size: 18px; font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 20; }
  .cc-mobile-menu {
    position: absolute;
    top: calc(100% + 14px);
    left: 0;
    right: 0;
    margin-top: 14px;
    padding: 18px;
    flex-direction: column;
    gap: 14px;
    border-radius: 24px;
    background: linear-gradient(180deg, rgba(255,251,255,0.96) 0%, rgba(247,243,233,0.98) 100%);
    border: 1px solid rgba(255,255,255,0.86);
    box-shadow: 0 22px 56px rgba(242,125,153,0.14);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    z-index: 70;
    max-height: min(calc(100vh - 110px), 78svh);
    overflow-y: auto;
    overscroll-behavior: contain;
    -webkit-overflow-scrolling: touch;
  }
  #mobile-menu.flex { display: flex !important; }
  .cc-mobile-menu::-webkit-scrollbar { width: 8px; }
  .cc-mobile-menu::-webkit-scrollbar-thumb {
    background: rgba(242,125,153,0.28);
    border-radius: 999px;
  }
  .cc-mobile-link {
    display: block;
    padding: 11px 14px;
    border-radius: 14px;
    text-decoration: none;
    color: #393832;
    background: rgba(255,255,255,0.55);
    border: 1px solid rgba(242,125,153,0.08);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
  }
  .cc-mobile-link:hover,
  .cc-mobile-link.is-active { color: #e8627d; border-color: rgba(242,125,153,0.22); background: rgba(242,125,153,0.08); transform: translateX(2px); }
  .cc-mobile-group { padding: 14px; border-radius: 18px; background: rgba(255,255,255,0.58); border: 1px solid rgba(242,125,153,0.10); }
  .cc-mobile-toggle {
    width: 100%;
    padding: 0;
    border: none;
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    text-align: left;
    cursor: pointer;
  }
  .cc-mobile-toggle-copy { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
  .cc-mobile-toggle-title {
    color: #393832;
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .cc-mobile-toggle-sub {
    color: rgba(102,100,94,0.78);
    font-size: 11px;
    line-height: 1.4;
  }
  .cc-mobile-chevron {
    flex-shrink: 0;
    color: rgba(143,60,91,0.54);
    font-size: 20px;
    transition: transform 0.24s ease, color 0.24s ease;
  }
  .cc-mobile-group.is-open .cc-mobile-chevron {
    transform: rotate(180deg);
    color: #e8627d;
  }
  .cc-mobile-panel {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.24s ease;
  }
  .cc-mobile-panel-inner {
    overflow: hidden;
    padding-top: 0;
    transition: padding-top 0.24s ease;
  }
  .cc-mobile-group.is-open .cc-mobile-panel { grid-template-rows: 1fr; }
  .cc-mobile-group.is-open .cc-mobile-panel-inner { padding-top: 12px; }
  .cc-mobile-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px; }
  .cc-mobile-chip {
    display: block;
    padding: 10px 12px;
    border-radius: 12px;
    text-decoration: none;
    background: #fdf9ef;
    color: #66645e;
    border: 1px solid rgba(242,125,153,0.10);
    font-size: 12px;
    font-weight: 700;
    transition: all 0.2s ease;
  }
  .cc-mobile-chip.is-active { color: #e8627d; border-color: rgba(242,125,153,0.24); background: rgba(242,125,153,0.08); }
  .cc-mobile-chip:hover { color: #e8627d; border-color: rgba(242,125,153,0.24); background: rgba(242,125,153,0.08); }
  .cc-mobile-cta { width: 100%; justify-content: center; }
  #mobile-menu-btn { display: inline-flex; }
  @media (min-width: 1024px) {
    #mobile-menu-btn { display: none !important; }
  }
  @media (max-width: 1279px) {
    .cc-nav-link,
    .cc-nav-btn { padding: 10px 11px; font-size: 12px; }
    .cc-order-btn { padding-left: 15px; padding-right: 15px; }
    .cc-mega-blog { width: min(920px, calc(100vw - 44px)); }
    .cc-mega-blog .cc-mega-panel { grid-template-columns: 180px minmax(0, 1fr); }
    .cc-blog-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .cc-blog-card-cta strong { font-size: 24px; }
  }
  @media (max-width: 1023px) {
    .cc-header-shell { padding-top: 0; }
    .cc-header-bar { min-height: 72px; padding: 0 16px; border-radius: 22px; }
    .cc-header-bar::after { display: none; }
    .cc-logo-link .logo-img-nav { height: 42px; max-width: 170px; }
    .cc-header-actions { gap: 6px; }
    .cc-order-btn.hidden { display: none !important; }
  }
  @media (max-width: 767px) {
    #main-header { top: calc(var(--marquee-h, 0px) + var(--cc-header-top-gap, 8px)) !important; }
    .cc-header-shell { padding-top: 0; }
    .cc-header-bar { min-height: 68px; gap: 12px; padding: 0 14px; border-radius: 20px; }
    .cc-header-bar::before { left: 22px; right: 22px; }
    .cc-icon-btn { width: 38px; height: 38px; border-radius: 12px; }
    .cc-divider { display: none; }
    .cc-mobile-menu {
      top: calc(100% + 10px);
      margin-top: 0;
      padding: 14px;
      border-radius: 20px;
      max-height: min(calc(100vh - 96px), 80svh);
    }
    .cc-mobile-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 480px) {
    .cc-logo-link .logo-img-nav { height: 38px; max-width: 148px; }
    .cc-header-bar { padding: 0 12px; gap: 8px; }
    .cc-header-actions { gap: 5px; }
    .cc-mobile-grid { grid-template-columns: 1fr; }
  }
</style>
<?php endif; ?>

<!-- PASTRY ELEMENTS -->
<div class="pastry-fixed left-pastry" id="globalLeftPastry">
 <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
  <circle cx="50" cy="50" r="38" fill="#f7c5d5" stroke="#f27d99" stroke-width="2"/>
  <circle cx="50" cy="50" r="16" fill="#fffbff"/>
  <ellipse cx="50" cy="26" rx="18" ry="10" fill="#fbb6c8" opacity="0.9"/>
  <ellipse cx="68" cy="36" rx="8" ry="12" fill="#fbb6c8" opacity="0.7"/>
  <ellipse cx="32" cy="34" rx="7" ry="10" fill="#fbb6c8" opacity="0.7"/>
  <rect x="40" y="20" width="6" height="2.5" rx="1.2" fill="#bef458" transform="rotate(30 43 21)"/>
  <rect x="56" y="22" width="6" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(-20 59 23)"/>
  <rect x="48" y="17" width="5" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(60 50 18)"/>
  <rect x="35" y="26" width="5" height="2.5" rx="1.2" fill="#fbb6c8" transform="rotate(-40 37 27)"/>
  <rect x="62" y="28" width="5" height="2.5" rx="1.2" fill="#bef458" transform="rotate(15 64 29)"/>
 </svg>
</div>
<div class="pastry-fixed right-pastry" id="globalRightPastry">
 <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
  <circle cx="50" cy="50" r="38" fill="#FCD47E" stroke="#e8a020" stroke-width="2"/>
  <circle cx="50" cy="50" r="16" fill="#fffbff"/>
  <path d="M32 38 Q50 18 68 38 Q75 50 68 62 Q50 55 32 62 Q25 50 32 38Z" fill="#8B4513" opacity="0.7"/>
  <rect x="38" y="24" width="7" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(45 41 25)"/>
  <rect x="54" y="22" width="7" height="2.5" rx="1.2" fill="#bef458" transform="rotate(-30 57 23)"/>
  <rect x="46" y="20" width="5" height="2.5" rx="1.2" fill="#fbb6c8" transform="rotate(70 48 21)"/>
  <rect x="62" y="32" width="5" height="2.5" rx="1.2" fill="#f27d99" transform="rotate(-50 64 33)"/>
  <rect x="33" y="32" width="5" height="2.5" rx="1.2" fill="#FCD47E" transform="rotate(20 35 33)"/>
 </svg>
</div>
<div id="sprinkles-container" aria-hidden="true" style="position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden;"></div>

<?php
 $cartItems = session('cart', ['items' => []])['items'] ?? [];
 $cartCount = collect($cartItems)->sum(function ($item) { return (int) ($item['quantity'] ?? 0); });
 $cartTotal = collect($cartItems)->sum(function ($item) {
   return (float) ($item['price'] ?? 0) * (int) ($item['quantity'] ?? 0);
  });
 $headerBlogPosts = collect();
 if (class_exists(\App\Models\BlogPost::class) && \Illuminate\Support\Facades\Schema::hasTable('blog_posts')) {
  $headerBlogPosts = \App\Models\BlogPost::query()
   ->published()
   ->orderByDesc('published_at')
   ->orderByDesc('id')
   ->limit(5)
   ->get();
 }
?>

<header class="fixed top-0 w-full z-50 glass-nav" id="main-header"><div class="site-shell cc-header-shell">
 <nav class="cc-header-bar max-w-7xl mx-auto" id="ccHeaderBar" aria-label="Main navigation">
  <a href="<?php echo e(route('home')); ?>" class="logo-link-nav cc-logo-link" aria-label="Current Cravings home">
   <img src="<?php echo e(asset('images/logo-1536x635.png')); ?>" alt="Current Cravings" class="logo-img logo-img-nav">
  </a>

  <div class="cc-nav-desktop hidden lg:flex">
   <a class="cc-nav-link <?php echo e(request()->routeIs('home') ? 'is-active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>

   <div class="cc-nav-item">
    <a href="<?php echo e(route('menu.index')); ?>" class="cc-nav-btn <?php echo e(request()->routeIs('menu.*') ? 'is-active' : ''); ?>">
     <span>Menu</span>
     <span class="material-symbols-outlined cc-caret">expand_more</span>
    </a>
    <div class="cc-mega cc-mega-menu">
     <div class="cc-mega-panel">
      <a href="<?php echo e(route('menu.show', 'cookies')); ?>" class="cc-mega-card">
       <img src="<?php echo e(asset('images/3.jpg')); ?>" alt="Cookies">
       <div class="cc-mega-title">Cookies</div>
       <div class="cc-mega-desc">Soft centers, crisp edges, and the signature bakes your regulars keep coming back for.</div>
      </a>
      <a href="<?php echo e(route('menu.show', 'brownies')); ?>" class="cc-mega-card">
       <img src="<?php echo e(asset('images/2.jpg')); ?>" alt="Brownies">
       <div class="cc-mega-title">Brownies</div>
       <div class="cc-mega-desc">Rich Belgian chocolate bakes with that indulgent Current Cravings finish.</div>
      </a>
      <a href="<?php echo e(route('menu.show', 'tres-leches')); ?>" class="cc-mega-card">
       <img src="<?php echo e(asset('images/saffron.png')); ?>" alt="Tres Leches">
       <div class="cc-mega-title">Tres Leches</div>
       <div class="cc-mega-desc">Moist, celebration-ready cakes layered with the soft floral and creamy notes you are known for.</div>
      </a>
      <a href="<?php echo e(route('menu.show', 'drinks')); ?>" class="cc-mega-card">
       <img src="<?php echo e(asset('images/1.jpg')); ?>" alt="Drinks">
       <div class="cc-mega-title">Drinks</div>
       <div class="cc-mega-desc">Iced matcha, coffee picks, and refreshing sips designed to pair perfectly with your desserts.</div>
      </a>
     </div>
    </div>
   </div>

   <a class="cc-nav-link <?php echo e(request()->routeIs('about') ? 'is-active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a>

   <div class="cc-nav-item">
    <!--<button type="button" class="cc-nav-btn <?php echo e(request()->routeIs('area.*') ? 'is-active' : ''); ?>">-->
    <!-- <span>Areas</span>-->
    <!-- <span class="material-symbols-outlined cc-caret">expand_more</span>-->
    <!--</button>-->
    <!--<div class="cc-mega cc-mega-areas">-->
    <!-- <div class="cc-mega-panel">-->
    <!--  <div class="cc-mega-label">Sweet Deliveries Across Northamptonshire</div>-->
    <!--  <div class="cc-areas-grid">-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.kettering')); ?>"><span class="cc-area-thumb">KE</span><span><span class="cc-area-name">Kettering</span><span class="cc-area-sub">Home base</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.wellingborough')); ?>"><span class="cc-area-thumb">WE</span><span><span class="cc-area-name">Wellingborough</span><span class="cc-area-sub">Daily dessert drops</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.rushden')); ?>"><span class="cc-area-thumb">RU</span><span><span class="cc-area-name">Rushden</span><span class="cc-area-sub">Weekend favourites</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.northampton')); ?>"><span class="cc-area-thumb">NO</span><span><span class="cc-area-name">Northampton</span><span class="cc-area-sub">Popular party orders</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.irthlingborough')); ?>"><span class="cc-area-thumb">IR</span><span><span class="cc-area-name">Irthlingborough</span><span class="cc-area-sub">Freshly baked runs</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.corby')); ?>"><span class="cc-area-thumb">CO</span><span><span class="cc-area-name">Corby</span><span class="cc-area-sub">Gift box favourites</span></span></a>-->
    <!--   <a class="cc-area-link" href="<?php echo e(route('area.brackley')); ?>"><span class="cc-area-thumb">BR</span><span><span class="cc-area-name">Brackley</span><span class="cc-area-sub">Special occasion orders</span></span></a>-->
    <!--  </div>-->
    <!-- </div>-->
    <!--</div>-->
   </div>

   <div class="cc-nav-item">
    <a href="<?php echo e(route('blog.index')); ?>" class="cc-nav-btn <?php echo e(request()->routeIs('blog.*') ? 'is-active' : ''); ?>">
     <span>Blog</span>
     <span class="material-symbols-outlined cc-caret">expand_more</span>
    </a>
    <div class="cc-mega cc-mega-blog">
     <div class="cc-mega-panel">
      <div class="cc-blog-side">
       <a href="<?php echo e(route('blog.index')); ?>" class="cc-blog-side-link is-active">
        <span class="material-symbols-outlined">edit_square</span>
        <span>Blog</span>
       </a>
       <!--<span class="cc-blog-side-link is-disabled">-->
       <!-- <span class="material-symbols-outlined">menu_book</span>-->
       <!-- <span>Case Studies</span>-->
       <!--</span>-->
      </div>

      <div class="cc-blog-main">
       <div class="cc-blog-head">
        <p class="cc-blog-kicker">Latest From The Blog</p>
        <a href="<?php echo e(route('blog.index')); ?>" class="cc-blog-viewall">
         <span>View all posts</span>
         <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
        </a>
       </div>

       <div class="cc-blog-grid">
        <?php $__empty_1 = true; $__currentLoopData = $headerBlogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headerBlog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
         <?php
          $headerBlogImg = $headerBlog->featured_image_url ?: asset('images/main image redesign.png');
          $headerBlogDate = optional($headerBlog->published_at)->format('M d, Y') ?? $headerBlog->created_at->format('M d, Y');
         ?>
         <a href="<?php echo e(route('blog.show', $headerBlog->slug)); ?>" class="cc-blog-card">
          <div class="cc-blog-card-media">
           <img src="<?php echo e($headerBlogImg); ?>" alt="<?php echo e($headerBlog->title); ?>">
          </div>
          <div class="cc-blog-card-copy">
           <h3 class="cc-blog-card-title"><?php echo e(\Illuminate\Support\Str::limit($headerBlog->title, 66)); ?></h3>
           <div class="cc-blog-card-meta"><?php echo e($headerBlog->category); ?> &bull; <?php echo e($headerBlogDate); ?></div>
          </div>
         </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
         <div class="cc-blog-card cc-blog-card-empty">
          No published blog posts yet. Add one from admin to populate this dropdown.
         </div>
        <?php endif; ?>

        <a href="<?php echo e(route('blog.index')); ?>" class="cc-blog-card cc-blog-card-cta">
         <div>
          <span><?php echo e(max(6, $headerBlogPosts->count())); ?>+ Articles</span>
          <strong>Blogs</strong>
         </div>
        </a>
       </div>
      </div>
     </div>
    </div>
   </div>
   <a class="cc-nav-link <?php echo e(request()->routeIs('contact') ? 'is-active' : ''); ?>" href="<?php echo e(route('contact')); ?>">Contact Us</a>
  </div>

  <div class="cc-header-actions">
   <button type="button" class="cc-icon-btn material-symbols-outlined" aria-label="Search" onclick="openSearch()">search</button>
   <div class="cc-divider"></div>
   <div class="cc-cart-wrap">
    <button type="button" class="cc-icon-btn material-symbols-outlined" aria-label="Cart" onclick="openCart()">shopping_bag</button>
    <span class="cc-cart-badge badge-bounce"
          data-cart-count
          style="<?php echo e($cartCount > 0 ? '' : 'display:none;'); ?>"><?php echo e($cartCount); ?></span>
   </div>
   <a href="<?php echo e(route('cart.index')); ?>" class="cc-order-btn hidden lg:inline-flex">
    <span class="material-symbols-outlined">storefront</span>
    <span>Order Now</span>
   </a>
   <button type="button" class="cc-icon-btn material-symbols-outlined lg:hidden" id="mobile-menu-btn" aria-label="Toggle menu" onclick="toggleMobileMenu()">menu</button>
  </div>
 </nav>

 <div id="mobile-menu" class="cc-mobile-menu lg:hidden hidden">
  <a class="cc-mobile-link <?php echo e(request()->routeIs('home') ? 'is-active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
  <div class="cc-mobile-group <?php echo e(request()->routeIs('menu.*') ? 'is-open' : ''); ?>" data-mobile-group>
   <button type="button" class="cc-mobile-toggle" data-mobile-toggle aria-expanded="<?php echo e(request()->routeIs('menu.*') ? 'true' : 'false'); ?>">
    <span class="cc-mobile-toggle-copy">
     <span class="cc-mobile-toggle-title">Menu</span>
     <span class="cc-mobile-toggle-sub">Browse categories and favourites</span>
    </span>
    <span class="material-symbols-outlined cc-mobile-chevron">expand_more</span>
   </button>
   <div class="cc-mobile-panel">
    <div class="cc-mobile-panel-inner">
     <div class="cc-mobile-grid">
      <a class="cc-mobile-chip <?php echo e(request()->routeIs('menu.index') ? 'is-active' : ''); ?>" href="<?php echo e(route('menu.index')); ?>">All Menu</a>
      <a class="cc-mobile-chip <?php echo e(request()->routeIs('menu.show') && request()->route('slug') === 'cookies' ? 'is-active' : ''); ?>" href="<?php echo e(route('menu.show', 'cookies')); ?>">Cookies</a>
      <a class="cc-mobile-chip <?php echo e(request()->routeIs('menu.show') && request()->route('slug') === 'brownies' ? 'is-active' : ''); ?>" href="<?php echo e(route('menu.show', 'brownies')); ?>">Brownies</a>
      <a class="cc-mobile-chip <?php echo e(request()->routeIs('menu.show') && request()->route('slug') === 'tres-leches' ? 'is-active' : ''); ?>" href="<?php echo e(route('menu.show', 'tres-leches')); ?>">Tres Leches</a>
      <a class="cc-mobile-chip <?php echo e(request()->routeIs('menu.show') && request()->route('slug') === 'boxes' ? 'is-active' : ''); ?>" href="<?php echo e(route('menu.show', 'boxes')); ?>">Gift Boxes</a>
     </div>
    </div>
   </div>
  </div>
  <a class="cc-mobile-link <?php echo e(request()->routeIs('about') ? 'is-active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a>

  <div class="cc-mobile-group <?php echo e(request()->routeIs('area.*') ? 'is-open' : ''); ?>" data-mobile-group>
   <!--<button type="button" class="cc-mobile-toggle" data-mobile-toggle aria-expanded="<?php echo e(request()->routeIs('area.*') ? 'true' : 'false'); ?>">-->
   <!-- <span class="cc-mobile-toggle-copy">-->
   <!--  <span class="cc-mobile-toggle-title">Areas</span>-->
   <!--  <span class="cc-mobile-toggle-sub">Check delivery locations</span>-->
   <!-- </span>-->
   <!-- <span class="material-symbols-outlined cc-mobile-chevron">expand_more</span>-->
   <!--</button>-->
   <!--<div class="cc-mobile-panel">-->
   <!-- <div class="cc-mobile-panel-inner">-->
   <!--  <div class="cc-mobile-grid">-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.kettering') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.kettering')); ?>">Kettering</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.wellingborough') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.wellingborough')); ?>">Wellingborough</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.rushden') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.rushden')); ?>">Rushden</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.northampton') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.northampton')); ?>">Northampton</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.irthlingborough') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.irthlingborough')); ?>">Irthlingborough</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.corby') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.corby')); ?>">Corby</a>-->
   <!--   <a class="cc-mobile-chip <?php echo e(request()->routeIs('area.brackley') ? 'is-active' : ''); ?>" href="<?php echo e(route('area.brackley')); ?>">Brackley</a>-->
   <!--  </div>-->
   <!-- </div>-->
   <!--</div>-->
  </div>

  <a class="cc-mobile-link <?php echo e(request()->routeIs('blog.*') ? 'is-active' : ''); ?>" href="<?php echo e(route('blog.index')); ?>">Blog</a>
  <a class="cc-mobile-link <?php echo e(request()->routeIs('contact') ? 'is-active' : ''); ?>" href="<?php echo e(route('contact')); ?>">Contact Us</a>
  <a href="<?php echo e(route('cart.index')); ?>" class="cc-order-btn cc-mobile-cta inline-flex">
   <span class="material-symbols-outlined">storefront</span>
   <span>Order Now</span>
  </a>
 </div>
</div></header>

<!-- SEARCH POPUP -->
<div class="search-overlay" id="searchOverlay" onclick="closeSearch()"></div>
<div class="search-modal" id="searchModal" role="dialog" aria-modal="true" aria-labelledby="searchTitle">
 <div class="search-modal-inner" onclick="event.stopPropagation()">
  <div class="search-head">
   <div class="search-title" id="searchTitle">Search the Menu</div>
   <button class="search-close" type="button" onclick="closeSearch()" aria-label="Close search"></button>
  </div>
  <form class="search-form" id="searchForm" action="<?php echo e(route('menu.index')); ?>" method="GET">
   <input class="search-input" id="searchInput" type="text" placeholder="Search cookies, brownies, cakes..." autocomplete="off" autocapitalize="off" spellcheck="false" autofocus />
   <button class="search-btn" type="submit">Search</button>
  </form>
  <div class="search-hint">Tip: Try &ldquo;brownies&rdquo; or &ldquo;tres leches&rdquo;.</div>
  <div class="search-cats">
   <a class="search-cat" href="<?php echo e(route('menu.show', 'cookies')); ?>"><span class="dot"></span> Cookies</a>
   <a class="search-cat" href="<?php echo e(route('menu.show', 'brownies')); ?>"><span class="dot"></span> Brownies</a>
   <a class="search-cat" href="<?php echo e(route('menu.show', 'tres-leches')); ?>"><span class="dot"></span> Tres Leches</a>
   <a class="search-cat" href="<?php echo e(route('menu.show', 'drinks')); ?>"><span class="dot"></span> Drinks</a>
   <a class="search-cat" href="<?php echo e(route('menu.show', 'boxes')); ?>"><span class="dot"></span> Gift Boxes</a>
  </div>
 </div>
</div>
<!-- CART -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-panel" id="cartPanel">
 <div class="cart-panel-head">
  <div class="cart-panel-title">
   <span class="material-symbols-outlined" style="font-size:22px;color:#f27d99">shopping_bag</span>
   Your Cart
   <span class="cart-count-badge" id="cartCountBadge"><?php echo e($cartCount); ?></span>
  </div>
  <div class="cart-head-actions">
   <button class="cart-ai-btn" onclick="toggleSuggest()">
    <span class="material-symbols-outlined" style="font-size:18px">auto_awesome</span>
    <span>Suggestions</span>
   </button>
   <button class="cart-close-btn" onclick="closeCart()">
    <span class="material-symbols-outlined" style="font-size:20px">close</span>
   </button>
  </div>
 </div>
 <div class="cart-items" id="cartItems">
  <?php if(empty($cartItems)): ?>
    <div class="cart-empty">
      <div class="cart-empty-icon">Cart</div>
      <p>Your cart is empty.<br>Add something sweet!</p>
      <a class="cart-empty-cta" href="<?php echo e(route('menu.index')); ?>" onclick="closeCart()">Browse Menu</a>
    </div>
  <?php else: ?>
    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $itemName = $item['name'] ?? 'Item';
        $itemPrice = (float) ($item['price'] ?? 0);
        $itemQty = (int) ($item['quantity'] ?? 1);
        $itemImage = $item['image'] ?? asset('images/image.png');
        $itemCategory = $item['category_slug'] ?? 'other';
      ?>
      <div class="cart-item" id="cart-item-<?php echo e($item['key']); ?>" data-key="<?php echo e($item['key']); ?>" data-price="<?php echo e($itemPrice); ?>" data-category="<?php echo e($itemCategory); ?>">
        <img class="cart-item-img" src="<?php echo e($itemImage); ?>" alt="<?php echo e($itemName); ?>">
        <div class="cart-item-info">
          <div class="cart-item-name"><?php echo e($itemName); ?></div>
          <div class="cart-item-variant"><?php echo e(str_replace('-', ' ', $itemCategory)); ?></div>
          <div class="cart-item-row">
            <span class="cart-item-price">&pound;<?php echo e(number_format($itemPrice, 2)); ?></span>
            <div class="cart-item-qty">
              <button class="cart-qty-btn" onclick="cartQty('<?php echo e($item['key']); ?>',-1)">-</button>
              <span class="cart-qty-val" id="<?php echo e($item['key']); ?>-qty"><?php echo e($itemQty); ?></span>
              <button class="cart-qty-btn" onclick="cartQty('<?php echo e($item['key']); ?>',1)">+</button>
            </div>
          </div>
        </div>
        <button class="cart-item-remove" onclick="removeCartItem('<?php echo e($item['key']); ?>')"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
 </div>
 <div class="cart-footer">
  <div class="cart-promo">
   <input type="text" placeholder="Promo code" id="promoInput">
   <button class="cart-promo-btn" onclick="applyPromo()">Apply</button>
  </div>
  <?php
    $shipRemaining = max(0, 100 - $cartTotal);
    $shipPct = min(100, $cartTotal > 0 ? ($cartTotal / 100) * 100 : 0);
  ?>
  <div class="cart-free-ship">
   <span>Ship</span>
   <span id="shipMsg">
     <?php if($shipRemaining <= 0): ?>
       <strong style="color:#4d6e00">Free shipping unlocked!</strong>
     <?php else: ?>
       Add <strong>&pound;<?php echo e(number_format($shipRemaining, 2)); ?></strong> more for free shipping!
     <?php endif; ?>
   </span>
   <div class="bar"><div class="bar-fill" id="shipBar" style="width:<?php echo e($shipPct); ?>%"></div></div>
  </div>
  <div class="cart-subtotal">
   <span>Subtotal (<span id="cartItemCount"><?php echo e($cartCount); ?></span> items)</span>
   <strong id="cartTotal">&pound;<?php echo e(number_format($cartTotal, 2)); ?></strong>
  </div>
  <a class="cart-checkout-btn" id="cartCheckoutBtn" href="<?php echo e(route('checkout.index')); ?>">Checkout <span class="material-symbols-outlined" style="font-size:20px">arrow_forward</span></a>
 </div>
</div>

<div class="suggest-panel" id="suggestPanel">
 <div class="cart-suggest">
  <div class="cart-suggest-head">
   <div class="cart-suggest-title"><span class="material-symbols-outlined" style="font-size:18px;color:#f27d99">auto_awesome</span>Suggestions</div>
   <span class="cart-suggest-pill">For You</span>
  </div>
    <div class="cart-suggest-list">
   <div class="cart-suggest-card">
    <img class="cart-suggest-img" src="<?php echo e(asset('images/Layer-4.webp')); ?>" alt="Saffron Rose">
    <div class="cart-suggest-name">Saffron Rose</div>
    <div class="cart-suggest-price">&pound;14.00</div>
    <button class="cart-suggest-add"
            data-add-to-cart="1"
            data-open-cart="1"
            data-name="Saffron Rose"
            data-price="14.00"
            data-category="tres-leches"
            data-image="<?php echo e(asset('images/Layer-4.webp')); ?>">Add</button>
   </div>
   <div class="cart-suggest-card">
    <img class="cart-suggest-img" src="<?php echo e(asset('images/2.jpg')); ?>" alt="Vanilla Bean Cloud">
    <div class="cart-suggest-name">Vanilla Bean Cloud</div>
    <div class="cart-suggest-price">&pound;11.50</div>
    <button class="cart-suggest-add"
            data-add-to-cart="1"
            data-open-cart="1"
            data-name="Vanilla Bean Cloud"
            data-price="11.50"
            data-category="tres-leches"
            data-image="<?php echo e(asset('images/2.jpg')); ?>">Add</button>
   </div>
   <div class="cart-suggest-card">
    <img class="cart-suggest-img" src="<?php echo e(asset('images/3.jpg')); ?>" alt="Hazelnut Crunch">
    <div class="cart-suggest-name">Hazelnut Crunch</div>
    <div class="cart-suggest-price">&pound;6.75</div>
    <button class="cart-suggest-add"
            data-add-to-cart="1"
            data-open-cart="1"
            data-name="Hazelnut Crunch"
            data-price="6.75"
            data-category="brownies"
            data-image="<?php echo e(asset('images/3.jpg')); ?>">Add</button>
   </div>
  </div>
 </div>
</div>

<script>
(function(){
 const cartPanel = document.getElementById('cartPanel');
 const cartOverlay = document.getElementById('cartOverlay');
 const suggestPanel = document.getElementById('suggestPanel');
 const searchOverlay = document.getElementById('searchOverlay');
 const searchModal = document.getElementById('searchModal');
 const searchForm = document.getElementById('searchForm');
 const tokenEl = document.querySelector('meta[name="csrf-token"]');
 const csrfToken = tokenEl ? tokenEl.getAttribute('content') : '';
 const updateUrl = '<?php echo e(route('cart.update', ['itemId' => '__ITEM__'], false)); ?>';
 const removeUrl = '<?php echo e(route('cart.remove', ['itemId' => '__ITEM__'], false)); ?>';

 function getRows(){
  return Array.from(document.querySelectorAll('.cart-item[data-key]'));
 }

 function openCart(){
  if (!cartPanel || !cartOverlay) return;
  cartPanel.classList.add('open');
  cartOverlay.classList.add('open');
  if (suggestPanel) suggestPanel.classList.add('open');
  document.body.style.overflow = 'hidden';
  updateCartTotals();
 }

 function closeCart(){
  if (!cartPanel || !cartOverlay) return;
  cartPanel.classList.remove('open');
  cartOverlay.classList.remove('open');
  if (suggestPanel) suggestPanel.classList.remove('open');
  document.body.style.overflow = '';
 }

 function toggleSuggest(){
  if (!suggestPanel) return;
  suggestPanel.classList.toggle('open');
 }

 function openSearch(){
  if (!searchOverlay || !searchModal) return;
  searchOverlay.classList.add('open');
  searchModal.classList.add('open');
  document.body.style.overflow = 'hidden';
  const input = searchModal.querySelector('.search-input');
  if (input) setTimeout(() => input.focus(), 50);
 }

 function closeSearch(){
  if (!searchOverlay || !searchModal) return;
  searchOverlay.classList.remove('open');
  searchModal.classList.remove('open');
  document.body.style.overflow = '';
 }

 if (searchForm) {
  searchForm.addEventListener('submit', function (e) {
   e.preventDefault();
   const input = document.getElementById('searchInput');
   const q = (input && input.value ? input.value : '').trim().toLowerCase();
   const fallbackUrl = <?php echo json_encode(route('menu.index'), 15, 512) ?>;
   const redirects = [
    { url: <?php echo json_encode(route('menu.show', 'cookies'), 512) ?>, keywords: ['cookie', 'cookies'] },
    { url: <?php echo json_encode(route('menu.show', 'brownies'), 512) ?>, keywords: ['brownie', 'brownies'] },
    { url: <?php echo json_encode(route('menu.show', 'tres-leches'), 512) ?>, keywords: ['tres', 'leches', 'tres leches'] },
    { url: <?php echo json_encode(route('menu.show', 'drinks'), 512) ?>, keywords: ['drink', 'drinks'] },
    { url: <?php echo json_encode(route('menu.show', 'boxes'), 512) ?>, keywords: ['box', 'boxes', 'gift'] }
   ];

   let target = fallbackUrl;
   for (const item of redirects) {
    if (item.keywords.some(function (word) { return q.includes(word); })) {
     target = item.url;
     break;
    }
   }

   window.location.href = target;
  });
 }

 function ensureEmptyState(){
  const container = document.getElementById('cartItems');
  if (!container) return;
  if (getRows().length > 0) return;
  container.innerHTML = `
    <div class="cart-empty">
      <div class="cart-empty-icon">Cart</div>
      <p>Your cart is empty.<br>Add something sweet!</p>
      <a class="cart-empty-cta" href="<?php echo e(route('menu.index')); ?>">Browse Menu</a>
    </div>
  `;
 }

 function updateCartTotals(){
  let total = 0;
  let count = 0;
  getRows().forEach(row => {
    const price = parseFloat(row.dataset.price || '0');
    const qtyEl = row.querySelector('.cart-qty-val');
    const qty = parseInt(qtyEl ? qtyEl.textContent : '0', 10) || 0;
    total += price * qty;
    count += qty;
  });

  const totalEl = document.getElementById('cartTotal');
  const countEl = document.getElementById('cartItemCount');
  const badgeEl = document.getElementById('cartCountBadge');
  const shipMsg = document.getElementById('shipMsg');
  const shipBar = document.getElementById('shipBar');
  const checkoutBtn = document.getElementById('cartCheckoutBtn');
  if (totalEl) totalEl.textContent = '\u00A3' + total.toFixed(2);
  if (countEl) countEl.textContent = count;
  if (badgeEl) badgeEl.textContent = count;

  document.querySelectorAll('[data-cart-count]').forEach(el => {
    if (count > 0) {
      el.textContent = count;
      el.style.display = '';
    } else {
      el.textContent = '0';
      el.style.display = 'none';
    }
  });

  const remaining = Math.max(0, 100 - total);
  const pct = Math.min(100, total > 0 ? (total / 100) * 100 : 0);
  if (shipBar) shipBar.style.width = pct + '%';
  if (shipMsg) {
    shipMsg.innerHTML = remaining <= 0
      ? '<strong style="color:#4d6e00">Free shipping unlocked!</strong>'
      : 'Add <strong>\u00A3' + remaining.toFixed(2) + '</strong> more for free shipping!';
  }

  if (checkoutBtn) {
    const disabled = count === 0;
    checkoutBtn.dataset.disabled = disabled ? '1' : '0';
    checkoutBtn.style.pointerEvents = disabled ? 'none' : '';
    checkoutBtn.style.opacity = disabled ? '0.55' : '';
    checkoutBtn.style.filter = disabled ? 'grayscale(0.2)' : '';
    checkoutBtn.setAttribute('aria-disabled', disabled ? 'true' : 'false');
    if (disabled) checkoutBtn.setAttribute('tabindex', '-1');
    else checkoutBtn.removeAttribute('tabindex');
  }
 }

 function cartQty(id, delta){
  const row = document.querySelector('.cart-item[data-key="' + id + '"]');
  if (!row) return;
  const qtyEl = row.querySelector('.cart-qty-val');
  if (!qtyEl) return;
  const prevQty = parseInt(qtyEl.textContent || '1', 10) || 1;
  const category = (row.dataset.category || '').toLowerCase();
  const minQty = (category === 'cookies' || category === 'brownies') ? 4 : 1;
  const nextQty = Math.max(minQty, prevQty + delta);
  qtyEl.textContent = nextQty;
  qtyEl.style.transform = 'scale(1.4)';
  setTimeout(function(){ qtyEl.style.transform = 'scale(1)'; }, 200);

  fetch(updateUrl.replace('__ITEM__', encodeURIComponent(id)), {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    credentials: 'same-origin',
    body: JSON.stringify({ quantity: nextQty })
  })
    .then(res => res.json())
    .then(() => updateCartTotals())
    .catch(() => {
      qtyEl.textContent = prevQty;
      updateCartTotals();
    });
 }

 function removeCartItem(id){
  const row = document.querySelector('.cart-item[data-key="' + id + '"]');
  if (!row) return;
  row.style.opacity = '0';
  row.style.transform = 'translateX(40px)';
  row.style.transition = 'all .3s ease';
  fetch(removeUrl.replace('__ITEM__', encodeURIComponent(id)), {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    credentials: 'same-origin'
  })
    .then(() => {
      setTimeout(function(){
        row.remove();
        updateCartTotals();
        ensureEmptyState();
      }, 320);
    })
    .catch(() => {
      row.style.opacity = '';
      row.style.transform = '';
    });
 }

 function applyPromo(){
  var inp = document.getElementById('promoInput');
  if (!inp) return;
  var btn = inp.nextElementSibling;
  var v = inp.value.trim().toUpperCase();
  if (v === 'SWEET10') {
    btn.textContent = 'Applied';
    btn.style.background = '#8DC63F';
    btn.style.color = 'white';
    inp.value = 'SWEET10 10% off';
    inp.disabled = true;
  } else {
    btn.textContent = 'Invalid';
    btn.style.background = '#fb5151';
    btn.style.color = 'white';
    setTimeout(function(){ btn.textContent = 'Apply'; btn.style.background = ''; btn.style.color = ''; }, 1800);
  }
 }

 window.openCart = openCart;
 window.closeCart = closeCart;
 window.toggleSuggest = toggleSuggest;
 window.openSearch = openSearch;
 window.closeSearch = closeSearch;
 window.cartQty = cartQty;
 window.removeCartItem = removeCartItem;
 window.applyPromo = applyPromo;
 window.ccUpdateCartTotals = updateCartTotals;

 document.addEventListener('keydown', function(e){
  if (e.key === 'Escape') {
   closeCart();
   closeSearch();
  }
 });
 updateCartTotals();
})();

function toggleMobileMenu(){
 const menu=document.getElementById('mobile-menu');
 const btn=document.getElementById('mobile-menu-btn');
 if(!menu || !btn) return;
 const isOpen=!menu.classList.contains('hidden');
 if(isOpen){
  menu.classList.add('hidden');
  menu.classList.remove('flex');
  btn.textContent='menu';
  btn.setAttribute('aria-expanded','false');
  document.body.style.overflow = '';
 } else {
  menu.classList.remove('hidden');
  menu.classList.add('flex');
  btn.textContent='close';
  btn.setAttribute('aria-expanded','true');
  if (window.innerWidth < 1024) document.body.style.overflow = 'hidden';
 }
}

window.addEventListener('resize', function () {
 const menu = document.getElementById('mobile-menu');
 const btn = document.getElementById('mobile-menu-btn');
 if (!menu || !btn || window.innerWidth >= 1024) return;
 if (menu.classList.contains('hidden')) return;
 document.body.style.overflow = 'hidden';
});

document.addEventListener('click', function (event) {
 const menu = document.getElementById('mobile-menu');
 const btn = document.getElementById('mobile-menu-btn');
 if (!menu || !btn || window.innerWidth >= 1024) return;
 const toggle = event.target.closest('[data-mobile-toggle]');
 if (toggle) {
  const group = toggle.closest('[data-mobile-group]');
  if (!group) return;
  const willOpen = !group.classList.contains('is-open');
  group.classList.toggle('is-open', willOpen);
  toggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
  return;
 }
 if (menu.classList.contains('hidden')) return;

 if (menu.contains(event.target) || btn.contains(event.target)) return;

 menu.classList.add('hidden');
 menu.classList.remove('flex');
 btn.textContent = 'menu';
 btn.setAttribute('aria-expanded', 'false');
 document.body.style.overflow = '';
});

(function () {
 const headerBar = document.getElementById('ccHeaderBar');
 if (!headerBar) return;
 if (window.matchMedia('(pointer: coarse)').matches) return;

 let frame = null;

 function resetHeader() {
  headerBar.classList.remove('is-glowing');
  headerBar.style.transform = 'perspective(1400px) rotateX(0deg) rotateY(0deg)';
 }

 headerBar.addEventListener('mousemove', function (e) {
  if (window.innerWidth < 1024) return;
  const rect = headerBar.getBoundingClientRect();
  const px = ((e.clientX - rect.left) / rect.width) * 100;
  const py = ((e.clientY - rect.top) / rect.height) * 100;
  const rx = (((e.clientY - rect.top) / rect.height) - 0.5) * 2.5;
  const ry = (((e.clientX - rect.left) / rect.width) - 0.5) * -3.6;

  headerBar.style.setProperty('--cc-glow-x', px.toFixed(1) + '%');
  headerBar.style.setProperty('--cc-glow-y', py.toFixed(1) + '%');
  headerBar.classList.add('is-glowing');

  if (frame) cancelAnimationFrame(frame);
  frame = requestAnimationFrame(function () {
   headerBar.style.transform = 'perspective(1400px) rotateX(' + rx.toFixed(2) + 'deg) rotateY(' + ry.toFixed(2) + 'deg)';
  });
 });

 headerBar.addEventListener('mouseleave', function () {
  if (frame) cancelAnimationFrame(frame);
  resetHeader();
 });

 window.addEventListener('resize', function () {
  if (window.innerWidth < 1024) resetHeader();
 });
})();
</script>
<?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/layouts/header.blade.php ENDPATH**/ ?>