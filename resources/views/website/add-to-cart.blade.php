@extends('layouts.app')
@section('title', 'Current Cravings | Chocolate Cookies')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;0,9..144,900;1,9..144,400;1,9..144,700&family=DM+Sans:wght@300;400;500;600&family=Epilogue:wght@700;800;900&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
/* ============================================
   RESET & ROOT
============================================ */
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
:root{
  --pink:#EC71A1;
  --pink-light:#F9C8DC;
  --pink-pale:#FEF0F5;
  --pink-deep:#d44d88;
  --green:#D7F793;
  --green-deep:#8DC63F;
  --cream:#FFFAF5;
  --dark:#1A1018;
  --mid:#4A3545;
  --muted:#8A7080;
  --white:#FFFFFF;
  --gold:#F0C040;
  --radius-sm:10px;
  --radius-md:16px;
  --radius-lg:24px;
  --radius-xl:32px;
}
body{
  font-family:'DM Sans',sans-serif;
  background:var(--cream);
  color:var(--dark);
  overflow-x:hidden;
}

/* ============================================
   CUSTOM CURSOR
============================================ */
.cursor-dot{
  position:fixed;
  width:12px;height:12px;border-radius:50%;
  background:var(--pink);
  pointer-events:none;
  z-index:2147483647;
  transform:translate(-50%,-50%);
  opacity:0;
  transition:opacity .2s,width .2s,height .2s,background .2s;
  will-change:left,top;
}
.cursor-ring{
  position:fixed;
  width:38px;height:38px;border-radius:50%;
  border:2px solid var(--pink);
  pointer-events:none;
  z-index:2147483646;
  transform:translate(-50%,-50%);
  opacity:0;
  transition:opacity .2s,width .3s cubic-bezier(.22,1,.36,1),height .3s cubic-bezier(.22,1,.36,1),border-color .3s;
  will-change:left,top;
}

/* ============================================
   SCROLL PROGRESS
============================================ */
#scroll-progress{
  position:fixed;top:0;left:0;height:3px;z-index:9999;
  background:linear-gradient(90deg,var(--pink),var(--green),var(--pink));
  background-size:200%;
  width:0%;
  transition:width .08s linear;
  animation:progGrad 3s linear infinite;
  box-shadow:0 0 12px rgba(236,113,161,.6);
}
@keyframes progGrad{0%{background-position:0%}100%{background-position:200%}}

.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;font-size:22px}

/* ============================================
   FLOATING PARTICLES (background)
============================================ */
#particles-bg{position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden}
@keyframes particleDrift{
  0%{transform:translateY(100vh) rotate(0deg) scale(0);opacity:0}
  5%{opacity:.18;transform:translateY(90vh) rotate(30deg) scale(1)}
  95%{opacity:.1}
  100%{transform:translateY(-60px) rotate(720deg) scale(.3);opacity:0}
}
.bg-particle{position:absolute;border-radius:50%;animation:particleDrift linear infinite;will-change:transform}

/* ============================================
   HERO SECTION
============================================ */
.hero-section{
  max-width:1280px;margin:0 auto;
  padding:calc(var(--header-h, 0px) + 32px) 40px 48px;
  display:grid;
  grid-template-columns:420px 1fr;
  gap:44px;
  align-items:start;
  position:relative;z-index:2;
}

/* Decorative blobs */
.hero-blob{
  position:absolute;border-radius:50%;filter:blur(80px);
  pointer-events:none;z-index:0;animation:blobDrift ease-in-out infinite alternate;
}
@keyframes blobDrift{from{transform:translate(0,0) scale(1)}to{transform:translate(20px,-20px) scale(1.08)}}

/* ============================================
   GALLERY
============================================ */
.gallery-wrap{position:relative;z-index:2}
.main-img-frame{
  position:relative;border-radius:var(--radius-xl);overflow:hidden;
  aspect-ratio:4/3;
  background:linear-gradient(135deg,#FEE2F0,#FDF0F8);
  border:1px solid rgba(236,113,161,.14);
  box-shadow:
    0 30px 70px rgba(236,113,161,.22),
    0 0 0 1px rgba(236,113,161,.06),
    inset 0 1px 0 rgba(255,255,255,.6);
}
.main-img-frame img{
  width: 100%;height:100%;object-fit:cover;
  transition:transform .8s cubic-bezier(.4,0,.2,1),opacity .3s;
  will-change:transform;
}
.main-img-frame:hover img{transform:scale(1.05)}

/* Shimmer overlay on image */
.main-img-frame::after{
  content:'';position:absolute;inset:0;
  background:linear-gradient(105deg,transparent 40%,rgba(255,255,255,.18) 50%,transparent 60%);
  background-size:200% 100%;
  animation:shimmer 4s ease-in-out infinite;
  pointer-events:none;
}
@keyframes shimmer{0%,100%{background-position:200% 0}50%{background-position:-200% 0}}

.img-tag{
  position:absolute;z-index:10;
  padding:6px 14px;border-radius:999px;
  font-size:10px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;
  backdrop-filter:blur(12px);
  animation:tagFloat ease-in-out infinite;
  box-shadow:0 4px 20px rgba(0,0,0,.08);
}
@keyframes tagFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
.img-tag.halal{
  top:18px;left:18px;animation-duration:3.8s;
  background:rgba(215,247,147,.92);color:#1a3a00;
  border:1px solid rgba(141,198,63,.35);
}
.img-tag.fresh{
  bottom:18px;right:18px;animation-duration:4.8s;animation-delay:.9s;
  background:rgba(255,255,255,.92);color:var(--mid);
  border:1px solid rgba(236,113,161,.22);
}

.gallery-nav-btn{
  position:absolute;top:50%;transform:translateY(-50%);z-index:6;
  width:42px;height:42px;border-radius:50%;border:none;cursor:inherit;
  background:rgba(255,255,255,.92);backdrop-filter:blur(12px);
  box-shadow:0 4px 20px rgba(0,0,0,.12);color:var(--dark);
  display:flex;align-items:center;justify-content:center;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);
}
.gallery-nav-btn:hover{
  background:var(--pink);color:white;
  transform:translateY(-50%) scale(1.12);
  box-shadow:0 8px 32px rgba(236,113,161,.45);
}
.gallery-nav-btn.prev{left:14px}
.gallery-nav-btn.next{right:14px}

/* Dot indicators */
.img-dots{
  display:flex;justify-content:center;gap:6px;margin-top:10px;
}
.img-dot{
  width:6px;height:6px;border-radius:50%;
  background:rgba(236,113,161,.25);cursor:pointer;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);border:none;
}
.img-dot.active{
  background:var(--pink);width:20px;border-radius:4px;
}

.thumbs-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:10px}
.thumb{
  border-radius:var(--radius-md);overflow:hidden;aspect-ratio:1;
  cursor:pointer;border:2.5px solid transparent;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);position:relative;
}
.thumb img{width: 100%;height:100%;object-fit:cover;transition:transform .4s}
.thumb:hover img{transform:scale(1.1)}
.thumb.active{border-color:var(--pink);box-shadow:0 0 0 3px rgba(236,113,161,.22)}
.thumb:not(.active){border-color:rgba(236,113,161,.12)}
.thumb:not(.active):hover{border-color:rgba(236,113,161,.45);transform:scale(1.04)}

/* ============================================
   PRODUCT DETAILS
============================================ */
.product-details{
  position:relative;z-index:2;
  display:flex;flex-direction:column;gap:18px;
  padding-top:4px;
}

/* Animated entrance for detail items */
.product-details > *{
  opacity:0;transform:translateY(24px);
  animation:detailIn .7s cubic-bezier(.22,1,.36,1) forwards;
}
@keyframes detailIn{to{opacity:1;transform:translateY(0)}}
.product-details > *:nth-child(1){animation-delay:.1s}
.product-details > *:nth-child(2){animation-delay:.18s}
.product-details > *:nth-child(3){animation-delay:.25s}
.product-details > *:nth-child(4){animation-delay:.32s}
.product-details > *:nth-child(5){animation-delay:.38s}
.product-details > *:nth-child(6){animation-delay:.44s}
.product-details > *:nth-child(7){animation-delay:.5s}
.product-details > *:nth-child(8){animation-delay:.55s}
.product-details > *:nth-child(9){animation-delay:.6s}
.product-details > *:nth-child(10){animation-delay:.64s}

.product-tag{
  display:inline-flex;align-items:center;gap:6px;
  background:var(--green);color:#1a3a00;
  font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  padding:5px 14px;border-radius:999px;width:fit-content;
}
.product-tag::before{
  content:'';width:6px;height:6px;background:var(--green-deep);
  border-radius:50%;animation:tagDot 2s ease-in-out infinite;
}
@keyframes tagDot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.8)}}

h1.product-title{
  font-family:'Fraunces',serif;
  font-size:clamp(2.2rem,4vw,3.2rem);
  font-weight:900;line-height:.88;
  letter-spacing:-.05em;color:var(--dark);
}
h1.product-title .pink{color:var(--pink)}
h1.product-title em{font-style:italic;color:var(--pink-deep)}

/* Animated underline on title */
.title-line{
  display:inline-block;position:relative;
}
.title-line::after{
  content:'';position:absolute;left:0;bottom:-4px;
  height:3px;width:0;background:linear-gradient(90deg,var(--pink),var(--green-deep));
  border-radius:2px;animation:titleUnderline 1s cubic-bezier(.22,1,.36,1) 1s forwards;
}
@keyframes titleUnderline{to{width:100%}}

.stars-row{display:flex;align-items:center;gap:10px}
.stars{display:flex;gap:2px}
.stars span{color:var(--gold);font-size:18px}
.review-count{font-size:12px;color:var(--muted);font-weight:500}
.review-count b{color:var(--dark)}
.review-link{
  color:var(--pink);font-size:12px;font-weight:600;text-decoration:none;
  border-bottom:1px solid rgba(236,113,161,.3);transition:border-color .2s;
}
.review-link:hover{border-color:var(--pink)}

.product-desc{font-size:.88rem;color:var(--muted);line-height:1.75;max-width:420px}

/* Price */
.price-row{display:flex;align-items:baseline;gap:12px}
.price-main{
  font-family:'Fraunces',serif;font-size:2.4rem;font-weight:900;
  color:var(--pink);letter-spacing:-.05em;line-height:1;
  position:relative;
}
.price-main::after{
  content:'';position:absolute;inset:-6px -10px;
  background:rgba(236,113,161,.07);border-radius:10px;z-index:-1;
}
.price-old{font-size:1.1rem;color:var(--muted);text-decoration:line-through}
.price-badge{
  background:var(--green);color:#1a3a00;
  font-size:10px;font-weight:700;padding:4px 10px;border-radius:999px;
  animation:badgeBounce 3s ease-in-out infinite;
}
@keyframes badgeBounce{0%,100%{transform:scale(1)}50%{transform:scale(1.06)}}

/* Options */
.options-label{
  font-size:11px;font-weight:700;letter-spacing:.1em;
  text-transform:uppercase;color:var(--muted);margin-bottom:10px;
}
.options-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px}
.option-btn{
  display:flex;justify-content:space-between;align-items:center;
  padding:12px 16px;border-radius:var(--radius-sm);
  border:2px solid rgba(236,113,161,.12);
  background:white;cursor:pointer;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);
  font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;color:var(--dark);
  box-shadow:0 2px 12px rgba(0,0,0,.04);
  position:relative;overflow:hidden;
}
.option-btn::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(236,113,161,.06),transparent);
  opacity:0;transition:opacity .3s;
}
.option-btn:hover{border-color:var(--pink);transform:translateY(-2px);box-shadow:0 8px 28px rgba(236,113,161,.18)}
.option-btn:hover::before{opacity:1}
.option-btn.selected{border-color:var(--pink);background:var(--pink-pale);box-shadow:0 4px 20px rgba(236,113,161,.2)}
.option-btn .opt-price{font-family:'Fraunces',serif;font-weight:700;color:var(--pink)}
.option-btn.selected .opt-price{color:var(--pink-deep)}

/* Qty */
.custom-row{
  display:flex;align-items:center;justify-content:space-between;
  padding:12px 16px;border-radius:var(--radius-sm);
  border:1.5px solid rgba(236,113,161,.14);
  background:rgba(236,113,161,.03);
}
.custom-label .name{font-weight:600;font-size:14px;color:var(--dark)}
.custom-label .hint{font-size:11px;color:var(--muted);margin-top:2px}
.qty-control{
  display:flex;align-items:center;gap:14px;
  background:white;border-radius:var(--radius-sm);
  padding:6px 12px;border:1.5px solid rgba(236,113,161,.14);
}
.qty-btn{
  width:32px;height:32px;border-radius:50%;border:none;cursor:inherit;
  background:var(--pink-pale);color:var(--pink);
  font-size:18px;font-weight:700;display:flex;align-items:center;justify-content:center;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);
}
.qty-btn:hover{background:var(--pink);color:white;transform:scale(1.18)}
.qty-val{
  font-family:'Fraunces',serif;font-size:20px;font-weight:700;
  color:var(--dark);min-width:24px;text-align:center;
}

/* CTA */
.cta-btn{
  width: 100%;padding:15px;border-radius:var(--radius-md);border:none;cursor:inherit;
  background:linear-gradient(135deg,var(--pink) 0%,var(--pink-deep) 100%);
  color:white;font-family:'Fraunces',serif;font-size:1rem;font-weight:700;
  letter-spacing:.02em;
  display:flex;align-items:center;justify-content:center;gap:10px;
  transition:all .4s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 8px 30px rgba(236,113,161,.38);
  position:relative;overflow:hidden;
}
.cta-btn::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.2) 0%,transparent 55%);
  transform:translateX(-110%) skewX(-12deg);transition:transform .55s ease;
}
.cta-btn::after{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 50% 50%,rgba(255,255,255,.12),transparent 70%);
  opacity:0;transition:opacity .4s;
}
.cta-btn:hover::before{transform:translateX(110%) skewX(-12deg)}
.cta-btn:hover::after{opacity:1}
.cta-btn:hover{
  transform:translateY(-4px) scale(1.01);
  box-shadow:0 20px 60px rgba(236,113,161,.55);
}
.cta-btn:active{transform:scale(.99)}
.cta-btn .cta-icon{font-size:20px;transition:transform .35s cubic-bezier(.34,1.56,.64,1)}
.cta-btn:hover .cta-icon{transform:translateX(6px)}

/* Wishlist */
.wishlist-btn{
  width: 100%;padding:11px;border-radius:var(--radius-sm);
  border:1.5px solid rgba(236,113,161,.22);background:transparent;
  color:var(--pink);font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;
  cursor:inherit;display:flex;align-items:center;justify-content:center;gap:8px;
  transition:all .3s;position:relative;overflow:hidden;
}
.wishlist-btn::before{
  content:'';position:absolute;inset:0;
  background:var(--pink-pale);transform:scaleX(0);transform-origin:left;
  transition:transform .35s cubic-bezier(.22,1,.36,1);
}
.wishlist-btn:hover::before{transform:scaleX(1)}
.wishlist-btn:hover{border-color:var(--pink)}
.wishlist-btn span{position:relative;z-index:1}

/* Accordion */
.accordion-item{border-top:1px solid rgba(236,113,161,.1)}
.accordion-btn{
  width: 100%;padding:12px 0;display:flex;justify-content:space-between;align-items:center;
  background:transparent;border:none;cursor:inherit;text-align:left;
  font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;color:var(--dark);
  transition:color .3s;
}
.accordion-btn:hover{color:var(--pink)}
.accordion-btn .acc-icon{transition:transform .35s cubic-bezier(.34,1.56,.64,1);color:var(--pink)}
.accordion-btn.open .acc-icon{transform:rotate(180deg)}
.accordion-body{
  max-height:0;overflow:hidden;transition:max-height .4s cubic-bezier(.22,1,.36,1),padding .3s;
  font-size:13px;color:var(--muted);line-height:1.7;
}
.accordion-body.open{max-height:300px;padding-bottom:14px}

/* Trust badges */
.trust-row{display:flex;gap:12px;flex-wrap:wrap}
.trust-badge{
  display:flex;align-items:center;gap:6px;
  font-size:11px;font-weight:600;color:var(--muted);
  padding:5px 10px;border-radius:999px;
  border:1px solid rgba(141,198,63,.2);background:rgba(215,247,147,.15);
  transition:all .25s;
}
.trust-badge:hover{background:rgba(215,247,147,.4);border-color:var(--green-deep);color:var(--dark)}
.trust-badge .t-icon{font-size:14px;color:var(--green-deep)}

/* ============================================
   SECTION COMMONS
============================================ */
.section-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;
  color:var(--pink);margin-bottom:10px;
}
.section-eyebrow::before{content:'';display:block;width:24px;height:2px;background:var(--pink);border-radius:2px}
.section-title{
  font-family:'Fraunces',serif;font-size:clamp(1.6rem,3vw,2.4rem);
  font-weight:900;line-height:.95;letter-spacing:-.04em;
}

/* ============================================
   SCROLL REVEAL
============================================ */
.reveal{opacity:0;transform:translateY(40px);transition:opacity .8s cubic-bezier(.22,1,.36,1),transform .8s cubic-bezier(.22,1,.36,1)}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-60px);transition:opacity .8s cubic-bezier(.22,1,.36,1),transform .8s cubic-bezier(.22,1,.36,1)}
.reveal-left.visible{opacity:1;transform:translateX(0)}
.reveal-right{opacity:0;transform:translateX(60px);transition:opacity .8s cubic-bezier(.22,1,.36,1),transform .8s cubic-bezier(.22,1,.36,1)}
.reveal-right.visible{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(.92);transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1)}
.reveal-scale.visible{opacity:1;transform:scale(1)}
.d1{transition-delay:.08s!important}.d2{transition-delay:.16s!important}
.d3{transition-delay:.24s!important}.d4{transition-delay:.32s!important}
.d5{transition-delay:.4s!important}

/* ============================================
   RECOMMENDATIONS
============================================ */
.recs-section{
  padding:48px 40px;
  position:relative;overflow:hidden;
}
.recs-bg-text{
  position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
  font-family:'Fraunces',serif;font-size:22vw;font-weight:900;
  color:transparent;-webkit-text-stroke:1px rgba(236,113,161,.05);
  pointer-events:none;white-space:nowrap;user-select:none;
  animation:bgTextDrift 12s ease-in-out infinite alternate;
}
@keyframes bgTextDrift{from{transform:translate(-50%,-50%) scale(1)}to{transform:translate(-50%,-52%) scale(1.03)}}
.recs-inner{max-width:1280px;margin:0 auto;position:relative;z-index:2}
.recs-header{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:24px}
.recs-nav{display:flex;gap:8px}
.rec-nav-btn{
  width:44px;height:44px;border-radius:50%;
  border:1.5px solid rgba(236,113,161,.2);background:white;cursor:inherit;
  display:flex;align-items:center;justify-content:center;color:var(--mid);
  transition:all .3s cubic-bezier(.34,1.56,.64,1);
}
.rec-nav-btn:hover{background:var(--pink);color:white;border-color:var(--pink);transform:scale(1.12)}

/* CARDS GRID */
.cards-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.p-card{
  background:white;border-radius:var(--radius-xl);overflow:hidden;
  border:1px solid rgba(236,113,161,.08);
  box-shadow:0 4px 24px rgba(0,0,0,.04);
  display:flex;flex-direction:column;
  transition:all .5s cubic-bezier(.34,1.56,.64,1);
  position:relative;cursor:pointer;
}
.p-card:hover{
  transform:translateY(-18px) scale(1.01);
  box-shadow:0 36px 70px rgba(236,113,161,.2);
  border-color:rgba(236,113,161,.3);
}
.p-card-img-wrap{position:relative;aspect-ratio:4/3;overflow:hidden}
.p-card-img-wrap img{
  width: 100%;height:100%;object-fit:cover;
  transition:transform .7s cubic-bezier(.4,0,.2,1);
}
.p-card:hover .p-card-img-wrap img{transform:scale(1.1)}
.p-card-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(236,113,161,.25),transparent 55%);
  opacity:0;transition:opacity .4s;
}
.p-card:hover .p-card-overlay{opacity:1}
.fav-btn{
  position:absolute;top:12px;right:12px;width:36px;height:36px;
  border-radius:50%;background:rgba(255,255,255,.9);backdrop-filter:blur(8px);
  border:none;cursor:inherit;display:flex;align-items:center;justify-content:center;
  color:var(--muted);transition:all .3s cubic-bezier(.34,1.56,.64,1);
}
.fav-btn:hover{background:var(--pink);color:white;transform:scale(1.18)}
.fav-btn.active{background:var(--pink);color:white}
.p-card-body{padding:14px 16px 8px;flex:1}
.p-card-body h3{
  font-family:'Fraunces',serif;font-size:1rem;font-weight:700;
  color:var(--dark);margin-bottom:4px;transition:color .3s;line-height:1.3;
}
.p-card:hover .p-card-body h3{color:var(--pink)}
.p-card-body p{
  font-size:12px;color:var(--muted);line-height:1.55;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
}
.p-card-footer{
  display:flex;justify-content:space-between;align-items:center;
  padding:0 16px 16px;
}
.p-card-footer .price{
  font-family:'Fraunces',serif;font-size:1.25rem;font-weight:700;color:var(--dark);
}
.card-add-btn{
  padding:8px 18px;border-radius:10px;border:none;cursor:inherit;
  background:linear-gradient(135deg,var(--pink),var(--pink-deep));color:white;
  font-family:'DM Sans',sans-serif;font-size:12px;font-weight:600;
  transition:all .3s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 4px 14px rgba(236,113,161,.28);
  position:relative;overflow:hidden;
}
.card-add-btn::before{
  content:'';position:absolute;inset:0;
  background:rgba(255,255,255,.2);transform:translateX(-110%) skewX(-12deg);
  transition:transform .4s ease;
}
.card-add-btn:hover::before{transform:translateX(110%) skewX(-12deg)}
.card-add-btn:hover{transform:translateY(-2px) scale(1.04);box-shadow:0 8px 28px rgba(236,113,161,.45)}

/* ============================================
   PROMO GRID
============================================ */
.promo-grid-section{max-width:1280px;margin:0 auto 32px;padding:0 40px}
.promo-grid{
  display:grid;grid-template-columns:1fr 1fr;
  border-radius:var(--radius-xl);overflow:hidden;
  box-shadow:0 28px 64px rgba(0,0,0,.12);height:340px;
}
.promo-images{display:grid;grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr}
.promo-img-cell{overflow:hidden;position:relative}
.promo-img-cell img{
  width: 100%;height:100%;object-fit:cover;
  transition:transform .7s cubic-bezier(.4,0,.2,1);
}
.promo-img-cell:hover img{transform:scale(1.08)}
.promo-img-cell.span2{grid-column:1/-1}
.promo-content{
  background:linear-gradient(145deg,#FBE8F3 0%,#FDF5FA 40%,#EEF7FF 100%);
  padding:28px 36px;display:flex;flex-direction:column;
  justify-content:center;position:relative;overflow:hidden;
}
.promo-content::before{
  content:'\\2605';position:absolute;font-size:160px;
  bottom:-40px;right:-20px;opacity:.06;
  animation:promoBlob 8s ease-in-out infinite alternate;
}
@keyframes promoBlob{from{transform:rotate(-10deg) scale(1)}to{transform:rotate(10deg) scale(1.2)}}
.promo-tag{
  display:inline-flex;align-items:center;gap:6px;
  background:var(--pink-pale);border:1px solid rgba(236,113,161,.28);
  color:var(--pink);font-size:10px;font-weight:700;letter-spacing:.1em;
  text-transform:uppercase;padding:5px 14px;border-radius:999px;
  margin-bottom:14px;width:fit-content;
}
.promo-content h2{
  font-family:'Fraunces',serif;
  font-size:clamp(1.6rem,2.5vw,2.4rem);font-weight:900;
  line-height:.95;letter-spacing:-.04em;color:var(--dark);margin-bottom:10px;
}
.promo-content h2 .pink{color:var(--pink)}
.promo-content p{font-size:.85rem;color:var(--muted);line-height:1.65;margin-bottom:12px}
.promo-off{
  font-family:'Fraunces',serif;font-size:1.2rem;
  font-weight:900;color:var(--dark);margin-bottom:18px;
}
.promo-off .num{color:var(--pink)}
.promo-cta{
  display:inline-flex;align-items:center;gap:10px;
  padding:13px 26px;border-radius:var(--radius-md);border:none;cursor:inherit;
  background:linear-gradient(135deg,var(--pink),var(--pink-deep));color:white;
  font-family:'Fraunces',serif;font-size:.95rem;font-weight:700;
  transition:all .4s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 10px 36px rgba(236,113,161,.38);width:fit-content;
  position:relative;overflow:hidden;
}
.promo-cta::before{
  content:'';position:absolute;inset:0;
  background:rgba(255,255,255,.2);transform:translateX(-110%) skewX(-12deg);
  transition:transform .5s ease;
}
.promo-cta:hover::before{transform:translateX(110%) skewX(-12deg)}
.promo-cta:hover{transform:translateY(-4px);box-shadow:0 20px 56px rgba(236,113,161,.55)}

/* ============================================
   LIFESTYLE / MOMENTS
============================================ */
.lifestyle-section{
  background:white;padding:48px 40px;
  position:relative;overflow:hidden;
}
.lifestyle-section::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 80% 60% at 50% 110%,rgba(236,113,161,.05),transparent);
  pointer-events:none;
}
.lifestyle-inner{max-width:1280px;margin:0 auto}
.lifestyle-header{text-align:center;margin-bottom:28px}
.lifestyle-sub{
  font-size:11px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;
  color:var(--pink);margin-bottom:10px;
}
.moments-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.moment-card{display:flex;flex-direction:column;align-items:center;cursor:pointer}
.moment-img-wrap{
  width: 100%;aspect-ratio:1;border-radius:var(--radius-xl);overflow:hidden;
  margin-bottom:12px;position:relative;
  border:1px solid rgba(236,113,161,.1);
  box-shadow:0 4px 16px rgba(0,0,0,.05);
  transition:all .5s cubic-bezier(.34,1.56,.64,1);
}
.moment-card:hover .moment-img-wrap{
  transform:translateY(-14px);
  box-shadow:0 28px 60px rgba(236,113,161,.22);
}
.moment-img-wrap img{width: 100%;height:100%;object-fit:cover;transition:transform .7s ease}
.moment-card:hover .moment-img-wrap img{transform:scale(1.08)}
.moment-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to bottom,transparent 40%,rgba(236,113,161,.65) 100%);
  opacity:0;transition:opacity .4s;border-radius:inherit;
  display:flex;align-items:flex-end;padding:18px;
}
.moment-card:hover .moment-overlay{opacity:1}
.moment-cta{color:white;font-size:12px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
.moment-label{
  font-family:'Fraunces',serif;font-size:.95rem;font-weight:700;
  color:var(--dark);transition:color .3s;
}
.moment-card:hover .moment-label{color:var(--pink)}

/* ============================================
   BOTTOM PROMO (GREEN BANNER)
============================================ */
.bottom-promo{padding:0 40px 48px}
.bottom-promo-inner{
  max-width:1280px;margin:0 auto;
  background:linear-gradient(135deg,#D7F793 0%,#c8f07a 100%);
  border-radius:var(--radius-xl);padding:40px 48px;
  text-align:center;position:relative;overflow:hidden;
  box-shadow:0 24px 60px rgba(141,198,63,.22);
}
.bp-deco{position:absolute;border-radius:50%}
.bp-deco-1{width:200px;height:200px;background:rgba(255,255,255,.25);top:-60px;left:-60px;animation:decoFloat 7s ease-in-out infinite alternate}
.bp-deco-2{width:150px;height:150px;background:rgba(236,113,161,.12);bottom:-40px;right:-40px;animation:decoFloat 9s ease-in-out infinite alternate-reverse}
.bp-deco-3{width:80px;height:80px;background:rgba(236,113,161,.15);top:40px;right:140px;animation:decoFloat 6s ease-in-out infinite alternate}
@keyframes decoFloat{from{transform:translate(0,0) scale(1)}to{transform:translate(18px,-14px) scale(1.1)}}
.bp-float-img{
  position:absolute;border-radius:50%;overflow:hidden;
  border:4px solid white;box-shadow:0 8px 30px rgba(0,0,0,.1);
}
.bp-float-1{width:100px;height:100px;left:44px;top:50%;animation:imgFloat1 5s ease-in-out infinite alternate}
.bp-float-2{width:72px;height:72px;right:64px;top:22px;animation:imgFloat2 7s ease-in-out infinite alternate}
@keyframes imgFloat1{from{transform:translateY(-50%) rotate(-5deg)}to{transform:translateY(calc(-50% - 18px)) rotate(5deg)}}
@keyframes imgFloat2{from{transform:rotate(10deg) scale(1)}to{transform:rotate(-10deg) scale(1.1) translateY(-12px)}}
.bp-float-img img{width: 100%;height:100%;object-fit:cover}
.bp-eyebrow{
  display:inline-block;font-size:11px;font-weight:700;letter-spacing:.14em;
  text-transform:uppercase;color:#1a3a00;
  background:rgba(255,255,255,.7);padding:5px 14px;
  border-radius:999px;margin-bottom:14px;
}
.bp-title{
  font-family:'Fraunces',serif;font-size:clamp(1.6rem,3vw,2.4rem);
  font-weight:900;color:#1a2a0a;letter-spacing:-.04em;line-height:1;margin-bottom:10px;
}
.bp-desc{
  font-size:.88rem;color:#2a4010;line-height:1.65;
  max-width:480px;margin:0 auto 20px;
}
.bp-cta{
  display:inline-flex;align-items:center;gap:10px;
  padding:15px 32px;border-radius:999px;border:none;cursor:inherit;
  background:white;color:var(--dark);
  font-family:'Fraunces',serif;font-size:.95rem;font-weight:700;
  transition:all .4s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 12px 40px rgba(0,0,0,.12);
  position:relative;z-index:2;overflow:hidden;
}
.bp-cta::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,var(--pink),var(--pink-deep));
  transform:scaleX(0);transform-origin:left;
  transition:transform .4s cubic-bezier(.22,1,.36,1);z-index:-1;
}
.bp-cta:hover::before{transform:scaleX(1)}
.bp-cta:hover{color:white;transform:translateY(-5px) scale(1.03);box-shadow:0 24px 60px rgba(0,0,0,.18)}

/* ============================================
   CART SIDEPANEL
============================================ */
.cart-overlay{
  position:fixed;inset:0;background:rgba(26,16,24,.45);
  backdrop-filter:blur(4px);z-index:1000;
  opacity:0;pointer-events:none;
  transition:opacity .35s ease;
}
.cart-overlay.open{opacity:1;pointer-events:all;}

.cart-panel{
  position:fixed;top:0;right:0;bottom:0;
  width:min(420px,100vw);
  background:#fffbff;
  z-index:1001;
  display:flex;flex-direction:column;
  transform:translateX(100%);
  transition:transform .4s cubic-bezier(.22,1,.36,1);
  box-shadow:-24px 0 80px rgba(242,125,153,.12);
}
.cart-panel.open{transform:translateX(0);}

.cart-panel-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:20px 24px 16px;
  border-bottom:1px solid rgba(242,125,153,.12);
  background:#fffbff;
}
.cart-panel-title{
  font-family:'Fraunces',serif;font-size:1.3rem;font-weight:900;
  color:var(--dark);letter-spacing:-.03em;
  display:flex;align-items:center;gap:10px;
}
.cart-count-badge{
  background:var(--pink);color:white;
  font-family:'DM Sans',sans-serif;font-size:11px;font-weight:700;
  width:22px;height:22px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
}
.cart-close-btn{
  width:38px;height:38px;border-radius:50%;border:none;
  background:rgba(242,125,153,.08);color:var(--mid);
  display:flex;align-items:center;justify-content:center;
  cursor:inherit;transition:all .3s cubic-bezier(.34,1.56,.64,1);
}
.cart-close-btn:hover{background:var(--pink);color:white;transform:scale(1.1) rotate(90deg);}

.cart-items{
  flex:1;overflow-y:auto;padding:16px 24px;
  display:flex;flex-direction:column;gap:14px;
}
.cart-items::-webkit-scrollbar{width:4px;}
.cart-items::-webkit-scrollbar-track{background:transparent;}
.cart-items::-webkit-scrollbar-thumb{background:rgba(242,125,153,.3);border-radius:4px;}

.cart-item{
  display:flex;gap:14px;align-items:center;
  padding:14px;border-radius:16px;
  background:white;border:1px solid rgba(242,125,153,.1);
  box-shadow:0 2px 12px rgba(242,125,153,.06);
  animation:cartItemIn .4s cubic-bezier(.22,1,.36,1) both;
}
@keyframes cartItemIn{
  from{opacity:0;transform:translateX(30px)}
  to{opacity:1;transform:translateX(0)}
}
.cart-item-img{
  width:72px;height:72px;border-radius:12px;object-fit:cover;
  flex-shrink:0;border:1px solid rgba(242,125,153,.1);
}
.cart-item-info{flex:1;min-width:0;}
.cart-item-name{
  font-family:'Fraunces',serif;font-size:.95rem;font-weight:700;
  color:var(--dark);margin-bottom:3px;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.cart-item-variant{font-size:11px;color:var(--muted);margin-bottom:8px;}
.cart-item-row{display:flex;align-items:center;justify-content:space-between;}
.cart-item-price{
  font-family:'Fraunces',serif;font-size:1rem;font-weight:700;color:var(--pink);
}
.cart-item-qty{
  display:flex;align-items:center;gap:8px;
  background:#fdf9ef;border-radius:8px;padding:4px 8px;
  border:1px solid rgba(242,125,153,.15);
}
.cart-qty-btn{
  width:22px;height:22px;border-radius:50%;border:none;
  background:rgba(242,125,153,.12);color:var(--pink);
  font-size:14px;font-weight:700;display:flex;align-items:center;
  justify-content:center;cursor:inherit;
  transition:all .25s cubic-bezier(.34,1.56,.64,1);
}
.cart-qty-btn:hover{background:var(--pink);color:white;transform:scale(1.15);}
.cart-qty-val{font-size:13px;font-weight:700;color:var(--dark);min-width:16px;text-align:center;}
.cart-item-remove{
  width:28px;height:28px;border-radius:50%;border:none;
  background:transparent;color:rgba(138,112,128,.4);
  display:flex;align-items:center;justify-content:center;
  cursor:inherit;transition:all .25s;flex-shrink:0;
}
.cart-item-remove:hover{background:rgba(251,81,81,.1);color:#c0262d;transform:scale(1.1);}

.cart-empty{
  flex:1;display:flex;flex-direction:column;
  align-items:center;justify-content:center;gap:12px;
  padding:40px 24px;text-align:center;
}
.cart-empty-icon{font-size:56px;opacity:.25;}
.cart-empty p{font-size:.9rem;color:var(--muted);line-height:1.6;}
.cart-empty-cta{
  margin-top:8px;padding:12px 28px;border-radius:999px;border:none;
  background:linear-gradient(135deg,var(--pink),var(--pink-deep));
  color:white;font-family:'Fraunces',serif;font-size:.9rem;font-weight:700;
  cursor:inherit;transition:all .3s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 6px 20px rgba(236,113,161,.3);
}
.cart-empty-cta:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(236,113,161,.45);}

.cart-footer{
  padding:16px 24px 24px;
  border-top:1px solid rgba(242,125,153,.12);
  background:#fffbff;
}
.cart-promo{
  display:flex;gap:8px;margin-bottom:16px;
}
.cart-promo input{
  flex:1;padding:10px 14px;border-radius:10px;
  border:1.5px solid rgba(242,125,153,.2);
  background:#fdf9ef;font-size:13px;font-family:'DM Sans',sans-serif;
  color:var(--dark);outline:none;
  transition:border-color .2s;
}
.cart-promo input:focus{border-color:var(--pink);}
.cart-promo input::placeholder{color:rgba(138,112,128,.5);}
.cart-promo-btn{
  padding:10px 16px;border-radius:10px;border:none;
  background:rgba(242,125,153,.1);color:var(--pink);
  font-size:12px;font-weight:700;cursor:inherit;
  transition:all .25s;
}
.cart-promo-btn:hover{background:var(--pink);color:white;}
.cart-subtotal{
  display:flex;justify-content:space-between;align-items:center;
  margin-bottom:6px;
}
.cart-subtotal span{font-size:.85rem;color:var(--muted);}
.cart-subtotal strong{
  font-family:'Fraunces',serif;font-size:1.1rem;font-weight:900;color:var(--dark);
}
.cart-free-ship{
  font-size:11px;color:var(--muted);margin-bottom:14px;
  display:flex;align-items:center;gap:5px;
}
.cart-free-ship .bar{
  flex:1;height:4px;background:rgba(242,125,153,.15);
  border-radius:4px;overflow:hidden;
}
.cart-free-ship .bar-fill{
  height:100%;background:linear-gradient(90deg,var(--pink),var(--green-deep));
  border-radius:4px;transition:width .5s ease;
}
.cart-checkout-btn{
  width: 100%;padding:16px;border-radius:14px;border:none;
  background:linear-gradient(135deg,var(--pink),var(--pink-deep));
  color:white;font-family:'Fraunces',serif;font-size:1rem;font-weight:700;
  cursor:inherit;display:flex;align-items:center;justify-content:center;gap:10px;
  transition:all .4s cubic-bezier(.34,1.56,.64,1);
  box-shadow:0 8px 28px rgba(236,113,161,.35);
  position:relative;overflow:hidden;
}
.cart-checkout-btn::before{
  content:'';position:absolute;inset:0;
  background:rgba(255,255,255,.18);transform:translateX(-110%) skewX(-12deg);
  transition:transform .5s ease;
}
.cart-checkout-btn:hover::before{transform:translateX(110%) skewX(-12deg);}
.cart-checkout-btn:hover{transform:translateY(-3px);box-shadow:0 16px 48px rgba(236,113,161,.5);}

/* ============================================
   RIPPLE EFFECT
============================================ */
@keyframes rippleAnim{to{transform:scale(4);opacity:0}}
@keyframes burstParticle{to{transform:translate(var(--bx),var(--by)) scale(0);opacity:0}}
@keyframes spinAnim{to{transform:rotate(360deg)}}

/* ============================================
   PAGE LOAD ANIMATION
============================================ */
@keyframes pageIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
main{animation:pageIn .6s ease forwards}

/* ============================================
   MAGNETIC HOVER (cards)
============================================ */
.p-card{transform-style:preserve-3d}

/* ============================================
   RESPONSIVE
============================================ */
@media(max-width:1100px){
  .cards-grid{grid-template-columns:repeat(2,1fr)}
}
    @media(max-width:900px){
  .hero-section{grid-template-columns:1fr;gap:32px;padding:calc(var(--header-h, 0px) + 20px) 24px 36px}
  .promo-grid{grid-template-columns:1fr;height:auto}
  .moments-grid{grid-template-columns:repeat(2,1fr)}
  .bottom-promo-inner{padding:40px 28px}
  .bp-float-1,.bp-float-2{display:none}
}
    @media(max-width:600px){
  .cards-grid{grid-template-columns:1fr}
  .recs-section,.bottom-promo,.promo-grid-section,.lifestyle-section{padding-left:20px;padding-right:20px}
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
  </style>
@endpush

@section('content')

<!-- CURSOR -->
<div class="cursor-dot" id="cursorDot" style="opacity:0"></div>
<div class="cursor-ring" id="cursorRing" style="opacity:0"></div>

<!-- BACKGROUND PARTICLES -->
<div id="particles-bg" aria-hidden="true"></div>

<!-- ============ HERO ============ -->
<section class="hero-section">
  <!-- Blobs -->
  <div class="hero-blob" style="width:500px;height:500px;background:rgba(236,113,161,.07);top:-80px;right:-100px;animation-duration:9s"></div>
  <div class="hero-blob" style="width:300px;height:300px;background:rgba(215,247,147,.1);bottom:-40px;left:-60px;animation-duration:7s;animation-delay:2s"></div>

  <!-- GALLERY (left) -->
  <div class="gallery-wrap reveal-left">
    <div class="main-img-frame" id="mainImgWrap">
      <img id="mainImg"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF"
        alt="Chocolate Cookies Stack">
      <button class="gallery-nav-btn prev" id="prevBtn"><span class="material-symbols-outlined">chevron_left</span></button>
      <button class="gallery-nav-btn next" id="nextBtn"><span class="material-symbols-outlined">chevron_right</span></button>
      <div class="img-tag halal">✓ 100% Halal</div>
      <div class="img-tag fresh">&#127807; Fresh Today</div>
    </div>

    <!-- Dot nav -->
    <div class="img-dots" id="imgDots">
      <button class="img-dot active" data-i="0"></button>
      <button class="img-dot" data-i="1"></button>
      <button class="img-dot" data-i="2"></button>
      <button class="img-dot" data-i="3"></button>
    </div>

    <!-- Thumbnails -->
    <div class="thumbs-grid">
      <div class="thumb active" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF" alt="T1">
      </div>
      <div class="thumb" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQ-RQlfiu-_7uYSDdK99dnQqKc98yIdorwJyDIUDJXxXKfPqbbnw7Domjik1rPvBq9egI6lfGYTqGLWekGaiuCbyDz4DbjMC0_EDT1ARbXYN8dmKshJ6KYmQIRnpcuqlVnWKwafh0bz1NNtlsqvCzs205mJ5USLHC4RJ4cQgF3iZaTd1G1ILpCuSw6KwppwqpA9rrJbjgWQbgeIdOlFC8yqVq1rAB-6XyoOO5Ny48EhwJWADQPuPJInfBysM1LI4Rs8MjqDKQ_Z88k">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQ-RQlfiu-_7uYSDdK99dnQqKc98yIdorwJyDIUDJXxXKfPqbbnw7Domjik1rPvBq9egI6lfGYTqGLWekGaiuCbyDz4DbjMC0_EDT1ARbXYN8dmKshJ6KYmQIRnpcuqlVnWKwafh0bz1NNtlsqvCzs205mJ5USLHC4RJ4cQgF3iZaTd1G1ILpCuSw6KwppwqpA9rrJbjgWQbgeIdOlFC8yqVq1rAB-6XyoOO5Ny48EhwJWADQPuPJInfBysM1LI4Rs8MjqDKQ_Z88k" alt="T2">
      </div>
      <div class="thumb" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuCl3psVZ0QLGCAKebeUWYSCKbe-ndO0de711_MVEwVExiY6rE-fG1p0t12Mxfk97fyJXcfYQQCccpzoXBcSaA4v0dv6RUa8vtf4Tl8Ti50YvtvblRHrbBC0OEV1PmYOL1A2klcY8tYZlV9BV0samVDFb6edXVQ73mVyG9bDln2dt7QG5-tD1LwYv0qChBdg9DXx1Eumar9gB70v2UZYOFQH0CpXMcWg5-uHEdzdeoseOH2FFO1lhtW3OXninM6SMNxj6YFBrRfYUqK1">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCl3psVZ0QLGCAKebeUWYSCKbe-ndO0de711_MVEwVExiY6rE-fG1p0t12Mxfk97fyJXcfYQQCccpzoXBcSaA4v0dv6RUa8vtf4Tl8Ti50YvtvblRHrbBC0OEV1PmYOL1A2klcY8tYZlV9BV0samVDFb6edXVQ73mVyG9bDln2dt7QG5-tD1LwYv0qChBdg9DXx1Eumar9gB70v2UZYOFQH0CpXMcWg5-uHEdzdeoseOH2FFO1lhtW3OXninM6SMNxj6YFBrRfYUqK1" alt="T3">
      </div>
      <div class="thumb" data-src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6GvtXen73iDaUkadBnE73K1Yll92TlU0MKEIdS2wq8dUHLjRlNq4h6gu52BGmcnYDggnwz5P7jyP-XVwG538Pe8-Z-hQMVRQdPbxi_6lzhisioK0aDDif77zeyaRjj7-QPI7t4ScAtiI33Rkenpw1Byi0VOXAwmVkCILJwaj4j8Er-_zXBLzxJQlkHtxAUuBDLdWnSOlcrzVi2iJCvE98cmlkGSrv5dhxwCPjbuQWacTe_W7YbKqI38d92ZXcj0G2XDU7zYYlG9e-">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6GvtXen73iDaUkadBnE73K1Yll92TlU0MKEIdS2wq8dUHLjRlNq4h6gu52BGmcnYDggnwz5P7jyP-XVwG538Pe8-Z-hQMVRQdPbxi_6lzhisioK0aDDif77zeyaRjj7-QPI7t4ScAtiI33Rkenpw1Byi0VOXAwmVkCILJwaj4j8Er-_zXBLzxJQlkHtxAUuBDLdWnSOlcrzVi2iJCvE98cmlkGSrv5dhxwCPjbuQWacTe_W7YbKqI38d92ZXcj0G2XDU7zYYlG9e-" alt="T4">
      </div>
    </div>
  </div>

  <!-- PRODUCT DETAILS (right) -->
  <div class="product-details">
    <div class="product-tag">New Arrival</div>

    <h1 class="product-title">
      <span class="title-line">Chocolate</span><br>
      <em>Cookies</em>
    </h1>

    <div class="stars-row">
      <div class="stars">
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;color:#F0C040;font-size:20px">star</span>
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;color:#F0C040;font-size:20px">star</span>
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;color:#F0C040;font-size:20px">star</span>
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;color:#F0C040;font-size:20px">star</span>
        <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;color:#F0C040;font-size:20px">star</span>
      </div>
      <span class="review-count"><b>5.0</b> &middot; 15 reviews</span>
      <a href="#reviews" class="review-link">Read reviews</a>
    </div>

    <p class="product-desc">Our crunchy, chewy riff on the classic chocolate chip cookie, packed full of caramelized cornflakes and gooey marshmallows in a deep vanilla base.</p>

    <div class="price-row">
      <span class="price-main" id="priceMain">$12.99</span>
      <span class="price-old">$17.99</span>
      <span class="price-badge">Save 28%</span>
    </div>

    <div>
      <p class="options-label">Choose your pack</p>
      <div class="options-grid">
        <button class="option-btn selected" onclick="selectOption(this,'$12.99')">
          <span>Pack of 4</span><span class="opt-price">$12.99</span>
        </button>
        <button class="option-btn" onclick="selectOption(this,'$16.99')">
          <span>Pack of 6</span><span class="opt-price">$16.99</span>
        </button>
      </div>
      <div class="custom-row">
        <div class="custom-label">
          <div class="name">Custom Order</div>
          <div class="hint">Minimum 4 cookies</div>
        </div>
        <div class="qty-control">
          <button class="qty-btn" onclick="changeQty(-1)">−</button>
          <span class="qty-val" id="qtyVal">4</span>
          <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:10px">
      <button class="cta-btn" id="ctaBtn" onclick="addToCart(this)">
        Add To Cart — <span id="ctaPrice">$12.99</span>
        <span class="material-symbols-outlined cta-icon">arrow_forward</span>
      </button>
      <button class="wishlist-btn" onclick="toggleWishlist(this)">
        <span class="material-symbols-outlined" style="font-size:18px">favorite_border</span>
        <span>Save to Wishlist</span>
      </button>
    </div>

    <div>
      <div class="accordion-item">
        <button class="accordion-btn" onclick="toggleAcc(this)">
          Product & Storage Details
          <span class="material-symbols-outlined acc-icon">expand_more</span>
        </button>
        <div class="accordion-body">Best consumed within 5 days. Store in an airtight container at room temperature. For longer freshness, refrigerate up to 2 weeks or freeze up to 3 months. Each cookie is approximately 80g.</div>
      </div>
      <div class="accordion-item">
        <button class="accordion-btn" onclick="toggleAcc(this)">
          Ingredients
          <span class="material-symbols-outlined acc-icon">expand_more</span>
        </button>
        <div class="accordion-body">Flour, butter, brown sugar, caster sugar, eggs, dark chocolate chips, vanilla extract, caramelized cornflakes, marshmallows, baking soda, salt. Contains: gluten, dairy, eggs.</div>
      </div>
      <div class="accordion-item" id="reviews">
        <button class="accordion-btn" onclick="toggleAcc(this)">
          Reviews (15)
          <span class="material-symbols-outlined acc-icon">expand_more</span>
        </button>
        <div class="accordion-body">⭐⭐⭐⭐⭐ "Absolutely unreal — the marshmallow pockets are everything!" — Sarah M.<br><br>⭐⭐⭐⭐⭐ "Best cookies I've had. Crispy edges, gooey center. 10/10." — James K.</div>
      </div>
    </div>

    <div class="trust-row">
      <div class="trust-badge"><span class="material-symbols-outlined t-icon" style="font-size:14px">local_shipping</span> Free over $100</div>
      <div class="trust-badge"><span class="material-symbols-outlined t-icon" style="font-size:14px">verified</span> 100% Halal</div>
      <div class="trust-badge"><span class="material-symbols-outlined t-icon" style="font-size:14px">eco</span> No Preservatives</div>
      <div class="trust-badge"><span class="material-symbols-outlined t-icon" style="font-size:14px">replay</span> Easy Returns</div>
    </div>
  </div>
</section>

<!-- ============ RECOMMENDATIONS ============ -->
<section class="recs-section">
  <div class="recs-bg-text">ALSO LIKE</div>
  <div class="recs-inner">
    <div class="recs-header reveal">
      <div>
        <div class="section-eyebrow">Curated for You</div>
        <h2 class="section-title">You May Also<br><span style="color:var(--pink);font-style:italic">Love</span></h2>
      </div>
      <div class="recs-nav">
        <button class="rec-nav-btn"><span class="material-symbols-outlined">west</span></button>
        <button class="rec-nav-btn"><span class="material-symbols-outlined">east</span></button>
      </div>
    </div>
    <div class="cards-grid">

      <div class="p-card reveal d1">
        <div class="p-card-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDb0HagkPIrr_uI59tb9aaHjKbn1FIolsV_SpSQeSfEyZ0h8LaD3ZE_EOhrhp-RnfLHWR513gJmyiSbnTuXu5uj7oBx3jXBgxB3y0eklBRznlqrBTTFwAqW5wNBj2rJsZykmBtB7l0PUsn1Y2S6sl73eAeKobF3U2KmkUXrYwcYbIAg9j5xAVes74jcgvyPSzesi_btkhBrddiLtcN2JOADNNkJjHorJg2LLAo0uh3t8__lbWUIfkfIaOcwBstQS5NGWLdNRxMpJZgi" alt="Red Velvet Cake"/>
          <div class="p-card-overlay"></div>
          <button class="fav-btn" onclick="this.classList.toggle('active');this.querySelector('span').textContent=this.classList.contains('active')?'favorite':'favorite_border'">
            <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0">favorite_border</span>
          </button>
          <div style="position:absolute;top:12px;left:12px;background:var(--pink);color:white;font-size:10px;font-weight:700;padding:4px 12px;border-radius:999px;letter-spacing:.06em;text-transform:uppercase">Bestseller</div>
        </div>
        <div class="p-card-body">
          <h3>3-Tier Red Velvet Cake</h3>
          <p>Signature red velvet layers with smooth cream cheese frosting.</p>
        </div>
        <div class="p-card-footer">
          <span class="price">45.90 €</span>
          <button class="card-add-btn">Add to Cart</button>
        </div>
      </div>

      <div class="p-card reveal d2">
        <div class="p-card-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDArNQKfl3_8tz5gzb0aOKHeZc3OhPu-exUrl1ZfNwHh_yTaxnfMoBxdLn6RNzBxrn7JTYwD_S5Lfy8OnCdjimiZ5q6vC_kF_xnFoYFnWS-7s7I2lV1gLJUxTrvAYDBGIER35e1IvaTV78es7-j4EhWKcMRxJQdrOIn2stCVRlEXSoMtmNZLNunRGp0jxzDe199dHJTWdqQ9kR8l7ZfhAjLMK5hK6e4n6y6DwhuR09H7Ajynp1gkV8Euhy8FfNSiTkk3GH-qhJb39gE" alt="Macarons"/>
          <div class="p-card-overlay"></div>
          <button class="fav-btn" onclick="this.classList.toggle('active');this.querySelector('span').textContent=this.classList.contains('active')?'favorite':'favorite_border'">
            <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0">favorite_border</span>
          </button>
        </div>
        <div class="p-card-body">
          <h3>Pastel Macaron Box</h3>
          <p>A beautiful assortment of our finest French macarons in pastel hues.</p>
        </div>
        <div class="p-card-footer">
          <span class="price">32.00 €</span>
          <button class="card-add-btn">Add to Cart</button>
        </div>
      </div>

      <div class="p-card reveal d3">
        <div class="p-card-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChn_D5vrwtG_LbPDPEynFYPlUttT3t9mNXGNtw5gYxSlripyg_ZioMb_Xpf4ycb5_PRDcr7ti2KwR1Lj_GpANWIEVpl_jXNEd2LnM5KJ-GD-RhUfpVtKNasTAq5-bGxU5HbEXtiJmj_k8jZTrm6xjhd0B28PZ-aHEmxeFZ3SzcxVZbcLD5Z-rkvOdUSi8Q-F-akTelNyYkzcpl9qG2lelnEPt_z6dg6eLBg_RgzxkbogHjKuZncByJ5BlPUuSsWZcgGYmZwJMrPcn_" alt="Croissants"/>
          <div class="p-card-overlay"></div>
          <button class="fav-btn" onclick="this.classList.toggle('active');this.querySelector('span').textContent=this.classList.contains('active')?'favorite':'favorite_border'">
            <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0">favorite_border</span>
          </button>
          <div style="position:absolute;top:12px;left:12px;background:var(--green);color:#1a3a00;font-size:10px;font-weight:700;padding:4px 12px;border-radius:999px;letter-spacing:.06em;text-transform:uppercase">New</div>
        </div>
        <div class="p-card-body">
          <h3>Morning Pastry Kit</h3>
          <p>Freshly baked flaky croissants and artisan pastries for your morning.</p>
        </div>
        <div class="p-card-footer">
          <span class="price">28.00 €</span>
          <button class="card-add-btn">Add to Cart</button>
        </div>
      </div>

      <div class="p-card reveal d4">
        <div class="p-card-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6GvtXen73iDaUkadBnE73K1Yll92TlU0MKEIdS2wq8dUHLjRlNq4h6gu52BGmcnYDggnwz5P7jyP-XVwG538Pe8-Z-hQMVRQdPbxi_6lzhisioK0aDDif77zeyaRjj7-QPI7t4ScAtiI33Rkenpw1Byi0VOXAwmVkCILJwaj4j8Er-_zXBLzxJQlkHtxAUuBDLdWnSOlcrzVi2iJCvE98cmlkGSrv5dhxwCPjbuQWacTe_W7YbKqI38d92ZXcj0G2XDU7zYYlG9e-" alt="Dipping Kit"/>
          <div class="p-card-overlay"></div>
          <button class="fav-btn" onclick="this.classList.toggle('active');this.querySelector('span').textContent=this.classList.contains('active')?'favorite':'favorite_border'">
            <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 0">favorite_border</span>
          </button>
        </div>
        <div class="p-card-body">
          <h3>Cookie Dipping Kit</h3>
          <p>The ultimate cozy moment with our thickest cookies and milk chocolate dip.</p>
        </div>
        <div class="p-card-footer">
          <span class="price">35.00 €</span>
          <button class="card-add-btn">Add to Cart</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ============ MOTHER'S DAY PROMO ============ -->
<div class="promo-grid-section reveal">
  <div class="promo-grid">
    <div class="promo-images">
      <div class="promo-img-cell">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDb0HagkPIrr_uI59tb9aaHjKbn1FIolsV_SpSQeSfEyZ0h8LaD3ZE_EOhrhp-RnfLHWR513gJmyiSbnTuXu5uj7oBx3jXBgxB3y0eklBRznlqrBTTFwAqW5wNBj2rJsZykmBtB7l0PUsn1Y2S6sl73eAeKobF3U2KmkUXrYwcYbIAg9j5xAVes74jcgvyPSzesi_btkhBrddiLtcN2JOADNNkJjHorJg2LLAo0uh3t8__lbWUIfkfIaOcwBstQS5NGWLdNRxMpJZgi" alt="Cake">
      </div>
      <div class="promo-img-cell">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCl3psVZ0QLGCAKebeUWYSCKbe-ndO0de711_MVEwVExiY6rE-fG1p0t12Mxfk97fyJXcfYQQCccpzoXBcSaA4v0dv6RUa8vtf4Tl8Ti50YvtvblRHrbBC0OEV1PmYOL1A2klcY8tYZlV9BV0samVDFb6edXVQ73mVyG9bDln2dt7QG5-tD1LwYv0qChBdg9DXx1Eumar9gB70v2UZYOFQH0CpXMcWg5-uHEdzdeoseOH2FFO1lhtW3OXninM6SMNxj6YFBrRfYUqK1" alt="Cookies">
      </div>
      <div class="promo-img-cell span2">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZiu3FadPpx6s_XkAjfE1B3MW8oR3HGrswxydd4S8X8RqG6PCA1CjtXACcSapfZay9ZThHPTIEObKlnqqb4-8iaS7t5YLbs6DIXnqTT5zl4TkNjGpA25rBTk7DPsJQZiaMcffYi1mk_l2U780YL3y3iYvzNgQHJiVBdhRTC2VJPTalVEMD7gGo34zm5LzWmd5EnQmV6shSmyA4Rnntx0wS5LQRyCZiRz8B4y_1z_5taurnM62qavnYM7WnOmGgL7gRre2HcV1FP4q" alt="Brownie">
      </div>
    </div>
    <div class="promo-content">
      <div class="promo-tag">&#127803; Mother's Day Special</div>
      <h2>#1 Dessert For<br><span class="pink">#1 Mom</span></h2>
      <p>Don't wait — Mom absolutely deserves the best treats this Mother's Day! Handcrafted with love, delivered with care.</p>
      <div class="promo-off">Get <span class="num">30% OFF</span> on Mother's Day specials!</div>
      <button class="promo-cta">
        Order Now
        <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span>
      </button>
    </div>
  </div>
</div>

<!-- ============ LIFESTYLE MOMENTS ============ -->
<section class="lifestyle-section">
  <div class="lifestyle-inner">
    <div class="lifestyle-header reveal">
      <div class="lifestyle-sub">Lifestyle</div>
      <h2 class="section-title" style="color:var(--pink)">Cravings <em>Moments</em></h2>
    </div>
    <div class="moments-grid">
      <div class="moment-card reveal d1">
        <div class="moment-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOJrll1HnTH8GqHcKHPJ9lJwj3s29EU4SSynTLxh58ExWN7az8FXEorc9AOIvCJ75hq-7Lm1EwUEgsMiixADEu36GjTrHwNxnVLrfa1VDqsFI7lmtF0kPUSqa8emuEcpLmgDTI4MHqFZSQ4iPHE2qFQ0RIIAoFnwy65lS1isDnGAcSVYFOxmI41Yr7YAWku1K_OzENQPzZfsUb-HnO5E1LyWrVBkmSHFy6PCNGH_J2BxBdtzOQwEjZjkbIXT0EILFToaxdYlvLBOdl" alt="Birthday"/>
          <div class="moment-overlay"><span class="moment-cta">Shop Now →</span></div>
        </div>
        <span class="moment-label">Birthday</span>
      </div>
      <div class="moment-card reveal d2">
        <div class="moment-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWgWwEvUkAZfQgV0bXdrUi1VpSU7pwYa74_STHgJeSvU4KToPDSe-Xy6O1y5vJUmmbMQlTEqsjcdWj_BmF04jERAAnjfIPteLoOnFGMz-TxOgLxSHU9FnAwO4UzSGBEOoWb9fKsJ2YqhdGCP6ngLYeGJSJ_zbtaIWcjnpxPoFgZKzRxGCuv0DKIt2EYuuXYKJJD1xCBR0QwZHxusA3Py2GLKht8PoPoa86gEjJ7n2poTUxOCsCdgJJvI5ZuWHneGNBv7-QT_pg7fnT" alt="Wedding"/>
          <div class="moment-overlay"><span class="moment-cta">Shop Now →</span></div>
        </div>
        <span class="moment-label">Wedding</span>
      </div>
      <div class="moment-card reveal d3">
        <div class="moment-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOjrVGAyiMCY5jeMJglhG6Eqx_dBuFSfvl0m48Thr7-bwar-MieiSsPUlS3carpSisudTopkGHo0oWJpgivy5vcyblnQNy5eFUE9WSxdVsMTGDLt5oLhkAeeMuFMWs7lQycb2M7jSKKG79uAGksLPoqHVLv99luzXx8GkWJT9rAawp3D0am7qMNnRTPgt8OMeDLZg4XoEeFI6E-FApCCzGjDLznYQXndev5NbxJ-o4Gk1H2CC_uGgaS5HKwZErZp4zvrjuXiYuhCVL" alt="Congratulations"/>
          <div class="moment-overlay"><span class="moment-cta">Shop Now →</span></div>
        </div>
        <span class="moment-label">Congratulations</span>
      </div>
      <div class="moment-card reveal d4">
        <div class="moment-img-wrap">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnG3HxC76eWfTldDWa_uQ5JccKYbqO6CpoWZaSNMoriTblD2o7aXtUTiurEIy-1t1-6MEcpqqbH34CgWiTxJcMsIE9JHQY0uozP-pLACC66Ke3nElc9AUwgcfG6VouqDxa_zCd2hdg6vHxvEYZP7RFXc2RjfnAV3sGCKdi-A4Jwmbutcva91-xGo5IH0RFW3zkFlfVjt0uv9UCEmS6ZfVrncAX0Ia9m8atxGeeqKwC7s7LudKiXE757cUOcqui3DpaN2ctP5-4DjUB" alt="Anniversary"/>
          <div class="moment-overlay"><span class="moment-cta">Shop Now →</span></div>
        </div>
        <span class="moment-label">Anniversary</span>
      </div>
    </div>
  </div>
</section>

<!-- ============ BOTTOM PROMO ============ -->
<section class="bottom-promo">
  <div class="bottom-promo-inner reveal">
    <div class="bp-deco bp-deco-1"></div>
    <div class="bp-deco bp-deco-2"></div>
    <div class="bp-deco bp-deco-3"></div>
    <div class="bp-float-img bp-float-1">
      <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF" alt="cookie">
    </div>
    <div class="bp-float-img bp-float-2">
      <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChn_D5vrwtG_LbPDPEynFYPlUttT3t9mNXGNtw5gYxSlripyg_ZioMb_Xpf4ycb5_PRDcr7ti2KwR1Lj_GpANWIEVpl_jXNEd2LnM5KJ-GD-RhUfpVtKNasTAq5-bGxU5HbEXtiJmj_k8jZTrm6xjhd0B28PZ-aHEmxeFZ3SzcxVZbcLD5Z-rkvOdUSi8Q-F-akTelNyYkzcpl9qG2lelnEPt_z6dg6eLBg_RgzxkbogHjKuZncByJ5BlPUuSsWZcgGYmZwJMrPcn_" alt="pastry">
    </div>
    <div style="position:relative;z-index:2">
      <span class="bp-eyebrow">Share Love</span>
      <h2 class="bp-title">One Bite<br>At A Time</h2>
      <p class="bp-desc">Current Cravings is a homemade dessert shop where your cravings are met with love and care. From gooey brownies and freshly baked cookies to rich, creamy Tres Leches.</p>
      <button class="bp-cta">
        Gather, Share & Make It Delicious
        <span class="material-symbols-outlined" style="font-size:20px">favorite</span>
      </button>
    </div>
  </div>
</section>

<!-- ============ CART SIDEPANEL ============ -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-panel" id="cartPanel">

  <div class="cart-panel-head">
    <div class="cart-panel-title">
      <span class="material-symbols-outlined" style="font-size:22px;color:var(--pink)">shopping_bag</span>
      Your Cart
      <span class="cart-count-badge" id="cartCountBadge">3</span>
    </div>
    <button class="cart-close-btn" onclick="closeCart()">
      <span class="material-symbols-outlined" style="font-size:20px">close</span>
    </button>
  </div>

  <div class="cart-items" id="cartItems">
    <!-- Item 1 -->
    <div class="cart-item" id="ci-1">
      <img class="cart-item-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF" alt="Chocolate Cookies">
      <div class="cart-item-info">
        <div class="cart-item-name">Chocolate Cookies</div>
        <div class="cart-item-variant">Pack of 4</div>
        <div class="cart-item-row">
          <span class="cart-item-price">$12.99</span>
          <div class="cart-item-qty">
            <button class="cart-qty-btn" onclick="cartQty('ci-1',-1,12.99)">−</button>
            <span class="cart-qty-val" id="ci-1-qty">1</span>
            <button class="cart-qty-btn" onclick="cartQty('ci-1',1,12.99)">+</button>
          </div>
        </div>
      </div>
      <button class="cart-item-remove" onclick="removeCartItem('ci-1',12.99)">
        <span class="material-symbols-outlined" style="font-size:16px">delete</span>
      </button>
    </div>
    <!-- Item 2 -->
    <div class="cart-item" id="ci-2">
      <img class="cart-item-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDb0HagkPIrr_uI59tb9aaHjKbn1FIolsV_SpSQeSfEyZ0h8LaD3ZE_EOhrhp-RnfLHWR513gJmyiSbnTuXu5uj7oBx3jXBgxB3y0eklBRznlqrBTTFwAqW5wNBj2rJsZykmBtB7l0PUsn1Y2S6sl73eAeKobF3U2KmkUXrYwcYbIAg9j5xAVes74jcgvyPSzesi_btkhBrddiLtcN2JOADNNkJjHorJg2LLAo0uh3t8__lbWUIfkfIaOcwBstQS5NGWLdNRxMpJZgi" alt="Red Velvet Cake">
      <div class="cart-item-info">
        <div class="cart-item-name">Red Velvet Cake</div>
        <div class="cart-item-variant">1 slice</div>
        <div class="cart-item-row">
          <span class="cart-item-price">$45.90</span>
          <div class="cart-item-qty">
            <button class="cart-qty-btn" onclick="cartQty('ci-2',-1,45.90)">−</button>
            <span class="cart-qty-val" id="ci-2-qty">1</span>
            <button class="cart-qty-btn" onclick="cartQty('ci-2',1,45.90)">+</button>
          </div>
        </div>
      </div>
      <button class="cart-item-remove" onclick="removeCartItem('ci-2',45.90)">
        <span class="material-symbols-outlined" style="font-size:16px">delete</span>
      </button>
    </div>
    <!-- Item 3 -->
    <div class="cart-item" id="ci-3">
      <img class="cart-item-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDArNQKfl3_8tz5gzb0aOKHeZc3OhPu-exUrl1ZfNwHh_yTaxnfMoBxdLn6RNzBxrn7JTYwD_S5Lfy8OnCdjimiZ5q6vC_kF_xnFoYFnWS-7s7I2lV1gLJUxTrvAYDBGIER35e1IvaTV78es7-j4EhWKcMRxJQdrOIn2stCVRlEXSoMtmNZLNunRGp0jxzDe199dHJTWdqQ9kR8l7ZfhAjLMK5hK6e4n6y6DwhuR09H7Ajynp1gkV8Euhy8FfNSiTkk3GH-qhJb39gE" alt="Macaron Box">
      <div class="cart-item-info">
        <div class="cart-item-name">Pastel Macaron Box</div>
        <div class="cart-item-variant">Box of 12</div>
        <div class="cart-item-row">
          <span class="cart-item-price">$32.00</span>
          <div class="cart-item-qty">
            <button class="cart-qty-btn" onclick="cartQty('ci-3',-1,32.00)">−</button>
            <span class="cart-qty-val" id="ci-3-qty">1</span>
            <button class="cart-qty-btn" onclick="cartQty('ci-3',1,32.00)">+</button>
          </div>
        </div>
      </div>
      <button class="cart-item-remove" onclick="removeCartItem('ci-3',32.00)">
        <span class="material-symbols-outlined" style="font-size:16px">delete</span>
      </button>
    </div>
  </div>

  <div class="cart-footer">
    <div class="cart-promo">
      <input type="text" placeholder="Promo code" id="promoInput">
      <button class="cart-promo-btn" onclick="applyPromo()">Apply</button>
    </div>
    <div class="cart-free-ship">
      <span>&#128666;</span>
      <span id="shipMsg">Add <strong>$9.11</strong> more for free shipping!</span>
      <div class="bar"><div class="bar-fill" id="shipBar" style="width:91%"></div></div>
    </div>
    <div class="cart-subtotal">
      <span>Subtotal (<span id="cartItemCount">3</span> items)</span>
      <strong id="cartTotal">$90.89</strong>
    </div>
    <button class="cart-checkout-btn" onclick="checkout()">
      Checkout
      <span class="material-symbols-outlined" style="font-size:20px">arrow_forward</span>
    </button>
  </div>

</div>

@endsection

@push('scripts')
<script>
/* ============ CURSOR ============ */
(function(){
  const dot  = document.getElementById('cursorDot');
  const ring = document.getElementById('cursorRing');
  if(!dot || !ring) return;

  let mx=0,my=0,rx=0,ry=0,visible=false;

  document.addEventListener('mousemove', e=>{
    mx=e.clientX; my=e.clientY;
    dot.style.left=mx+'px'; dot.style.top=my+'px';
    if(!visible){
      visible=true;
      dot.style.opacity='1';
      ring.style.opacity='1';
      document.body.style.cursor='none';
    }
  });

  document.addEventListener('mouseleave',()=>{
    visible=false;
    dot.style.opacity='0'; ring.style.opacity='0';
    document.body.style.cursor='';
  });

  (function loop(){
    rx+=(mx-rx)*.13; ry+=(my-ry)*.13;
    ring.style.left=rx+'px'; ring.style.top=ry+'px';
    requestAnimationFrame(loop);
  })();

  document.querySelectorAll('a,button').forEach(el=>{
    el.addEventListener('mouseenter',()=>{
      dot.style.width='6px'; dot.style.height='6px';
      dot.style.background='var(--green-deep)';
      ring.style.width='54px'; ring.style.height='54px';
      ring.style.borderColor='var(--green-deep)';
      ring.style.opacity='.5';
    });
    el.addEventListener('mouseleave',()=>{
      dot.style.width='12px'; dot.style.height='12px';
      dot.style.background='var(--pink)';
      ring.style.width='38px'; ring.style.height='38px';
      ring.style.borderColor='var(--pink)';
      ring.style.opacity='1';
    });
  });
})();

/* ============ SCROLL PROGRESS + HEADER ============ */
const bar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
  const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100;
  bar.style.width = pct + '%';
}, { passive: true });

/* ============ SCROLL REVEAL ============ */
const revealEls = document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale');
const ro = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); ro.unobserve(e.target); } });
}, { threshold: .1, rootMargin: '0px 0px -40px 0px' });
revealEls.forEach(el => ro.observe(el));

/* ============ GALLERY ============ */
const imgSrcs = [
  'https://lh3.googleusercontent.com/aida-public/AB6AXuDBAGl4qTxdwP7FTrvWQDjCWBFx8x44j_vdEOVYrNGX0jPGQ9jub-EpaHYF4hPsiJSoKq6TKEWfmxQDrJYCfQSUAZ0nQXU3lI8nM5R9CW822AX4q3x45KIW622GSQVl-9k1A3rcr8FpzHei0sBEK-T0haYoqHf3iUh1TSs1lK-twSMsZQA3oQql2JvJqyq_xbqz954iVi6TOEbqO2gGzJvqHxpKcgZJmwgTXzGa-yt2My2ZsTEZOJaeHFDLZTMppYX8Rog8Ql6YbPMF',
  'https://lh3.googleusercontent.com/aida-public/AB6AXuAQ-RQlfiu-_7uYSDdK99dnQqKc98yIdorwJyDIUDJXxXKfPqbbnw7Domjik1rPvBq9egI6lfGYTqGLWekGaiuCbyDz4DbjMC0_EDT1ARbXYN8dmKshJ6KYmQIRnpcuqlVnWKwafh0bz1NNtlsqvCzs205mJ5USLHC4RJ4cQgF3iZaTd1G1ILpCuSw6KwppwqpA9rrJbjgWQbgeIdOlFC8yqVq1rAB-6XyoOO5Ny48EhwJWADQPuPJInfBysM1LI4Rs8MjqDKQ_Z88k',
  'https://lh3.googleusercontent.com/aida-public/AB6AXuCl3psVZ0QLGCAKebeUWYSCKbe-ndO0de711_MVEwVExiY6rE-fG1p0t12Mxfk97fyJXcfYQQCccpzoXBcSaA4v0dv6RUa8vtf4Tl8Ti50YvtvblRHrbBC0OEV1PmYOL1A2klcY8tYZlV9BV0samVDFb6edXVQ73mVyG9bDln2dt7QG5-tD1LwYv0qChBdg9DXx1Eumar9gB70v2UZYOFQH0CpXMcWg5-uHEdzdeoseOH2FFO1lhtW3OXninM6SMNxj6YFBrRfYUqK1',
  'https://lh3.googleusercontent.com/aida-public/AB6AXuB6GvtXen73iDaUkadBnE73K1Yll92TlU0MKEIdS2wq8dUHLjRlNq4h6gu52BGmcnYDggnwz5P7jyP-XVwG538Pe8-Z-hQMVRQdPbxi_6lzhisioK0aDDif77zeyaRjj7-QPI7t4ScAtiI33Rkenpw1Byi0VOXAwmVkCILJwaj4j8Er-_zXBLzxJQlkHtxAUuBDLdWnSOlcrzVi2iJCvE98cmlkGSrv5dhxwCPjbuQWacTe_W7YbKqI38d92ZXcj0G2XDU7zYYlG9e-'
];
let currImg = 0;
const mainImg = document.getElementById('mainImg');
const thumbs = document.querySelectorAll('.thumb');
const dots = document.querySelectorAll('.img-dot');

function switchImg(i) {
  currImg = i;
  mainImg.style.opacity = '0';
  mainImg.style.transform = 'scale(.96)';
  mainImg.style.transition = 'opacity .28s ease,transform .28s ease';
  setTimeout(() => {
    mainImg.src = imgSrcs[i];
    mainImg.style.opacity = '1';
    mainImg.style.transform = 'scale(1)';
  }, 260);
  thumbs.forEach((t, j) => t.classList.toggle('active', j === i));
  dots.forEach((d, j) => d.classList.toggle('active', j === i));
}

thumbs.forEach((t, i) => t.addEventListener('click', () => switchImg(i)));
dots.forEach((d) => d.addEventListener('click', () => switchImg(+d.dataset.i)));
document.getElementById('prevBtn').addEventListener('click', () => switchImg((currImg - 1 + imgSrcs.length) % imgSrcs.length));
document.getElementById('nextBtn').addEventListener('click', () => switchImg((currImg + 1) % imgSrcs.length));

/* Auto-advance gallery */
setInterval(() => switchImg((currImg + 1) % imgSrcs.length), 5000);

/* ============ OPTIONS / QTY ============ */
let selectedPrice = '$12.99';
function selectOption(btn, price) {
  document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
  btn.classList.add('selected');
  selectedPrice = price;
  document.getElementById('ctaPrice').textContent = price;
  document.getElementById('priceMain').textContent = price;
}

let qty = 4;
function changeQty(d) {
  qty = Math.max(4, qty + d);
  const el = document.getElementById('qtyVal');
  el.style.transform = 'scale(1.3)';
  el.style.transition = 'transform .2s cubic-bezier(.34,1.56,.64,1)';
  el.textContent = qty;
  setTimeout(() => { el.style.transform = 'scale(1)'; }, 200);
}

/* ============ ACCORDION ============ */
function toggleAcc(btn) {
  const body = btn.nextElementSibling;
  const isOpen = btn.classList.contains('open');
  document.querySelectorAll('.accordion-btn.open').forEach(b => {
    b.classList.remove('open');
    b.nextElementSibling.classList.remove('open');
  });
  if (!isOpen) { btn.classList.add('open'); body.classList.add('open'); }
}

/* ============ ADD TO CART ============ */
function addToCart(btn) {
  if (btn.disabled) return;
  const orig = btn.innerHTML;
  btn.style.pointerEvents = 'none';
  btn.innerHTML = '<span class="material-symbols-outlined" style="animation:spinAnim .5s linear infinite;font-size:22px">autorenew</span>&nbsp;Adding...';
  setTimeout(() => {
    btn.innerHTML = '<span class="material-symbols-outlined" style="font-size:22px">check_circle</span>&nbsp;Added to Cart!';
    btn.style.background = 'linear-gradient(135deg,#6acd3f,#4a9d20)';
    btn.style.boxShadow = '0 8px 30px rgba(106,205,63,.4)';
    /* confetti burst */
    for (let i = 0; i < 20; i++) {
      const p = document.createElement('div');
      const cols = ['#EC71A1','#D7F793','#F9C8DC','#F0C040','#8DC63F'];
      const angle = (i / 20) * 360;
      const dist = 60 + Math.random() * 80;
      const rect = btn.getBoundingClientRect();
      p.style.cssText = `position:fixed;pointer-events:none;z-index:9999;width:9px;height:9px;border-radius:${Math.random()>.5?'50%':'3px'};background:${cols[i%5]};left:${rect.left+rect.width/2}px;top:${rect.top}px;--bx:${Math.cos(angle*Math.PI/180)*dist}px;--by:${Math.sin(angle*Math.PI/180)*dist - 40}px;animation:burstParticle .75s ease-out forwards;`;
      document.body.appendChild(p);
      setTimeout(() => p.remove(), 800);
    }
    setTimeout(() => {
      btn.innerHTML = orig;
      btn.style.background = '';
      btn.style.boxShadow = '';
      btn.style.pointerEvents = '';
    }, 2400);
  }, 750);
}

/* ============ WISHLIST ============ */
function toggleWishlist(btn) {
  const icon = btn.querySelector('.material-symbols-outlined');
  const text = btn.querySelector('span:last-child');
  if (icon.textContent === 'favorite_border') {
    icon.textContent = 'favorite';
    icon.style.fontVariationSettings = "'FILL' 1";
    icon.style.color = 'var(--pink)';
    text.textContent = 'Saved!';
    btn.style.background = 'var(--pink-pale)';
    btn.style.borderColor = 'var(--pink)';
  } else {
    icon.textContent = 'favorite_border';
    icon.style.fontVariationSettings = "'FILL' 0";
    icon.style.color = '';
    text.textContent = 'Save to Wishlist';
    btn.style.background = '';
    btn.style.borderColor = '';
  }
}

/* ============ RIPPLE EFFECT ============ */
const styleEl = document.createElement('style');
styleEl.textContent = `
@keyframes rippleAnim{to{transform:scale(4);opacity:0}}
@keyframes burstParticle{to{transform:translate(var(--bx),var(--by)) scale(0);opacity:0}}
@keyframes spinAnim{to{transform:rotate(360deg)}}
`;
document.head.appendChild(styleEl);
document.querySelectorAll('button').forEach(btn => {
  if (btn.style.position !== 'absolute') btn.style.position = 'relative';
  btn.style.overflow = 'hidden';
  btn.addEventListener('click', function(e) {
    const r = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const sz = Math.max(rect.width, rect.height);
    r.style.cssText = `position:absolute;border-radius:50%;pointer-events:none;width:${sz}px;height:${sz}px;left:${e.clientX-rect.left-sz/2}px;top:${e.clientY-rect.top-sz/2}px;background:rgba(255,255,255,.28);transform:scale(0);animation:rippleAnim .6s ease-out;`;
    this.appendChild(r); setTimeout(() => r.remove(), 650);
  });
});

/* ============ CARD TILT ============ */
document.querySelectorAll('.p-card').forEach(card => {
  card.addEventListener('mousemove', e => {
    const r = card.getBoundingClientRect();
    const x = (e.clientX - r.left) / r.width - .5;
    const y = (e.clientY - r.top) / r.height - .5;
    card.style.transform = `perspective(900px) rotateY(${x*10}deg) rotateX(${-y*10}deg) translateY(-18px) scale(1.01)`;
  });
  card.addEventListener('mouseleave', () => { card.style.transform = ''; });
});

/* ============ MOUSE TRAIL SPARKLES ============ */
const trailColors = ['#EC71A1','#D7F793','#F9C8DC','#F0C040','#8DC63F'];
document.addEventListener('mousemove', e => {
  if (Math.random() > .88) {
    const t = document.createElement('div');
    t.style.cssText = `position:fixed;pointer-events:none;z-index:9990;width:5px;height:5px;border-radius:50%;background:${trailColors[Math.floor(Math.random()*5)]};left:${e.clientX}px;top:${e.clientY}px;opacity:.75;transition:transform .7s ease,opacity .7s ease;`;
    document.body.appendChild(t);
    requestAnimationFrame(() => {
      t.style.transform = `translate(${(Math.random()-.5)*50}px,${-30-Math.random()*50}px) scale(0)`;
      t.style.opacity = '0';
    });
    setTimeout(() => t.remove(), 750);
  }
});

const isMobile = window.matchMedia('(max-width: 767px)').matches;

/* ============ BG PARTICLES ============ */
const pbg = document.getElementById('particles-bg');
if (!isMobile && pbg) {
const pcols = ['#EC71A1','#D7F793','#F9C8DC','#FEF0F5','rgba(141,198,63,.5)'];
for (let i = 0; i < 12; i++) {
  const p = document.createElement('div');
  p.className = 'bg-particle';
  const sz = 4 + Math.random() * 12;
  const isCircle = Math.random() > .4;
  p.style.cssText = `
    width:${sz}px;height:${sz}px;
    background:${pcols[Math.floor(Math.random()*5)]};
    left:${Math.random()*100}vw;
    border-radius:${isCircle?'50%':'3px'};
    animation-duration:${14+Math.random()*20}s;
    animation-delay:${Math.random()*16}s;
    opacity:.15;
  `;
  pbg.appendChild(p);
}
}

/* ============ CART SIDEPANEL ============ */
const cartPanel   = document.getElementById('cartPanel');
const cartOverlay = document.getElementById('cartOverlay');
let cartData = {
  'ci-1': { qty:1, price:12.99 },
  'ci-2': { qty:1, price:45.90 },
  'ci-3': { qty:1, price:32.00 }
};

function openCart(){
  cartPanel.classList.add('open');
  cartOverlay.classList.add('open');
  document.body.style.overflow = 'hidden';
  updateCartTotals();
}
function closeCart(){
  cartPanel.classList.remove('open');
  cartOverlay.classList.remove('open');
  document.body.style.overflow = '';
}

// Wire bag button
document.querySelector('.nav-btn .material-symbols-outlined[style*="shopping_bag"], .nav-btn:has(.material-symbols-outlined)');
document.querySelectorAll('.nav-btn').forEach(btn => {
  if(btn.querySelector('.material-symbols-outlined') &&
     btn.querySelector('.material-symbols-outlined').textContent.trim() === 'shopping_bag'){
    btn.addEventListener('click', openCart);
  }
});

function cartQty(id, delta, price){
  const item = cartData[id];
  if(!item) return;
  item.qty = Math.max(1, item.qty + delta);
  const el = document.getElementById(id + '-qty');
  if(el){
    el.style.transform = 'scale(1.4)';
    el.style.transition = 'transform .2s cubic-bezier(.34,1.56,.64,1)';
    el.textContent = item.qty;
    setTimeout(()=>{ el.style.transform='scale(1)'; }, 200);
  }
  updateCartTotals();
}

function removeCartItem(id, price){
  const el = document.getElementById(id);
  if(!el) return;
  el.style.transition = 'all .3s ease';
  el.style.opacity = '0';
  el.style.transform = 'translateX(40px)';
  setTimeout(()=>{
    el.remove();
    delete cartData[id];
    updateCartTotals();
    checkEmpty();
  }, 320);
}

function updateCartTotals(){
  let total = 0, count = 0;
  Object.values(cartData).forEach(item => {
    total += item.price * item.qty;
    count += item.qty;
  });
  const totalEl = document.getElementById('cartTotal');
  const countEl = document.getElementById('cartItemCount');
  const badgeEl = document.getElementById('cartCountBadge');
  const navBadge = document.querySelector('.cart-badge');
  const shipMsg = document.getElementById('shipMsg');
  const shipBar = document.getElementById('shipBar');
  if(totalEl) totalEl.textContent = '$' + total.toFixed(2);
  if(countEl) countEl.textContent = count;
  if(badgeEl) badgeEl.textContent = count;
  if(navBadge) navBadge.textContent = count;
  // Free shipping progress (threshold $100)
  const remaining = Math.max(0, 100 - total);
  const pct = Math.min(100, (total / 100) * 100);
  if(shipBar) shipBar.style.width = pct + '%';
  if(shipMsg){
    if(remaining <= 0){
      shipMsg.innerHTML = '<strong style="color:#4d6e00">&#128666; You have free shipping!</strong>';
    } else {
      shipMsg.innerHTML = 'Add <strong>$' + remaining.toFixed(2) + '</strong> more for free shipping!';
    }
  }
}

function checkEmpty(){
  if(Object.keys(cartData).length === 0){
    const cartItems = document.getElementById('cartItems');
    cartItems.innerHTML = `
      <div class="cart-empty">
        <div class="cart-empty-icon">&#128722;</div>
        <p>Your cart is empty.<br>Add something sweet!</p>
        <button class="cart-empty-cta" onclick="closeCart()">Browse Menu</button>
      </div>`;
  }
}

function applyPromo(){
  const input = document.getElementById('promoInput');
  const val = input.value.trim().toUpperCase();
  const btn = input.nextElementSibling;
  if(val === 'SWEET10'){
    btn.textContent = '✓ Applied!';
    btn.style.background = 'var(--green-deep)';
    btn.style.color = 'white';
    input.style.borderColor = 'var(--green-deep)';
    input.value = 'SWEET10 — 10% off';
    input.disabled = true;
  } else {
    btn.textContent = 'Invalid';
    btn.style.background = '#fb5151';
    btn.style.color = 'white';
    setTimeout(()=>{ btn.textContent='Apply'; btn.style.background=''; btn.style.color=''; }, 1800);
  }
}

function checkout(){
  const btn = document.querySelector('.cart-checkout-btn');
  btn.innerHTML = '<span class="material-symbols-outlined" style="animation:spinAnim .5s linear infinite;font-size:20px">autorenew</span> Processing...';
  setTimeout(()=>{
    btn.innerHTML = '<span class="material-symbols-outlined" style="font-size:20px">check_circle</span> Order Placed!';
    btn.style.background = 'linear-gradient(135deg,#6acd3f,#4a9d20)';
    setTimeout(()=>{ closeCart(); btn.innerHTML='Checkout <span class="material-symbols-outlined" style="font-size:20px">arrow_forward</span>'; btn.style.background=''; }, 2500);
  }, 1200);
}

// Also open cart when "Add to Cart" button is clicked
const origAddToCart = window.addToCart;
window.addToCart = function(btn){
  if(origAddToCart) origAddToCart(btn);
  setTimeout(openCart, 1200);
};

// Keyboard close
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeCart(); });

updateCartTotals();
</script>
@endpush























