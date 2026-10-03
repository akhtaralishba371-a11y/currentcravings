@extends('layouts.app')

@section('content')

    <!-- HERO -->
    <section class="relative page-pad py-24 overflow-hidden page-hero-under-header" style="background:linear-gradient(135deg,#fff0f4 0%,#fffbff 50%,#f7f3e9 100%);">
      <div class="glow-orb" style="width:320px;height:320px;background:#fbb6c8;top:-80px;left:-60px;"></div>
      <div class="glow-orb two" style="width:260px;height:260px;background:#fcd47e;bottom:-60px;right:4%;"></div>
      <div class="glow-orb" style="width:160px;height:160px;background:#bef458;top:25%;right:22%;animation-delay:-4s;"></div>
      <div class="max-w-7xl mx-auto relative z-10">
        <div class="text-center max-w-3xl mx-auto" style="padding-top:20px;">
          <span class="pill inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full anim-up">
            <span class="material-symbols-outlined" style="font-size:14px;">auto_stories</span> Fresh from the Kitchen
          </span>
          <h1 class="section-title hero-title anim-up delay-1 mt-5" style="font-size:clamp(3rem,7vw,5.5rem);line-height:0.92;letter-spacing:-0.04em;">
            Sweet Stories &amp;<br><span class="gradient-headline">Baking Secrets</span>
          </h1>
          <p class="text-[#66645e] text-lg mt-6 anim-up delay-2 leading-relaxed">
            Recipes, behind-the-scenes notes, flavor drops, and the people who make our bakes unforgettable.
          </p>
          <!-- Category filter pills -->
          <div class="mt-8 flex flex-wrap justify-center gap-2 anim-up delay-3" id="filterPills">
            <button onclick="filterPosts('all',this)" class="filter-pill active-pill px-5 py-2 rounded-full text-sm font-bold transition-all">All</button>
            <button onclick="filterPosts('recipe',this)" class="filter-pill px-5 py-2 rounded-full text-sm font-bold transition-all">Recipes</button>
            <button onclick="filterPosts('tips',this)" class="filter-pill px-5 py-2 rounded-full text-sm font-bold transition-all">Tips</button>
            <button onclick="filterPosts('community',this)" class="filter-pill px-5 py-2 rounded-full text-sm font-bold transition-all">Guide</button>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURED POST -->
    <section class="page-pad py-14" style="background:#fffbff;">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 mb-6 anim-up">
          <span class="w-8 h-1 rounded-full" style="background:linear-gradient(90deg,#f27d99,#fbb6c8);"></span>
          <span class="text-xs font-bold uppercase tracking-widest text-[#f27d99]">Editor's Pick</span>
        </div>
        @if(!empty($featuredPost))
          @php
            $featuredDate = optional($featuredPost->published_at)->format('F Y') ?? $featuredPost->created_at->format('F Y');
            $featuredImg = $featuredPost->featured_image_url ?: asset('images/main image redesign.png');
            $readMinutes = max(1, (int) ceil(str_word_count(strip_tags((string) $featuredPost->content)) / 200));
          @endphp
          <div class="soft-card rounded-3xl overflow-hidden grid md:grid-cols-2 anim-up delay-1 blog-card">
            <div class="relative overflow-hidden h-72 md:h-auto">
              <img src="{{ $featuredImg }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover float-img">
              <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(242,125,153,0.15),transparent);"></div>
              <span class="absolute top-4 left-4 tag">{{ $featuredDate }}</span>
            </div>
            <div class="p-8 md:p-10 flex flex-col justify-center">
              <span class="tag inline-block mb-3" style="background:rgba(242,125,153,0.12);color:#f27d99;">Featured Story</span>
              <h2 class="section-title text-3xl md:text-4xl leading-tight">{{ $featuredPost->title }}</h2>
              <p class="text-[#66645e] mt-4 leading-relaxed">{{ $featuredPost->excerpt }}</p>
              <div class="mt-6 flex items-center gap-4">
                <div class="flex items-center gap-2">
                  <img src="{{ asset('images/profile image.jpg') }}" alt="Author" class="w-8 h-8 rounded-full object-cover border-2 border-[#fbb6c8]">
                  <span class="text-sm font-bold text-[#393832]">Current Cravings</span>
                </div>
                <span class="text-xs text-[#66645e]">• {{ $readMinutes }} min read</span>
              </div>
              <a href="{{ route('blog.show', $featuredPost->slug) }}" class="mt-6 inline-flex items-center gap-2 bg-[#f27d99] text-white px-6 py-3 rounded-full font-bold hover:scale-105 transition-transform cta-glow w-fit">
                Read the story <span class="material-symbols-outlined" style="font-size:18px;">arrow_forward</span>
              </a>
            </div>
          </div>
        @else
          <div class="soft-card rounded-3xl p-8 text-center text-[#66645e]">No featured story yet.</div>
        @endif
      </div>
    </section>

    <!-- BLOG GRID -->
    <section class="page-pad pb-20" style="background:#fffbff;" id="blogGrid">
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8 anim-up">
          <h2 class="section-title text-3xl">Latest Posts</h2>
          <span class="text-sm text-[#66645e]" id="postCount">{{ $posts->count() }} {{ $posts->count() === 1 ? 'article' : 'articles' }}</span>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="postsContainer">
          @forelse($posts as $post)
          <article class="soft-card rounded-3xl overflow-hidden blog-card anim-up post-card {{ $loop->iteration % 3 === 2 ? 'delay-1' : ($loop->iteration % 3 === 0 ? 'delay-2' : '') }}" data-cat="{{ \Illuminate\Support\Str::slug($post->category) }}">
            <div class="card-overlay"></div>
            <div class="img-wrap h-52">
              @if($post->featured_image_url)
                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
              @else
                <img src="{{ asset('images/main image redesign.png') }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
              @endif
              <div class="absolute bottom-3 left-3 right-3 z-10 flex items-end justify-between">
                <span class="tag" style="background:rgba(255,255,255,0.92);color:#f27d99;">{{ $post->category }}</span>
              </div>
            </div>
            <div class="read-bar mx-6 mt-0" style="margin-top:-1px;"></div>
            <div class="p-6 pt-4">
              <div class="flex items-center gap-2 mb-3">
                <img src="{{ asset('images/profile image.jpg') }}" alt="Author" class="w-6 h-6 rounded-full object-cover border border-[#fbb6c8]">
                <span class="text-xs font-bold text-[#393832]">Current Cravings</span>
                <span class="text-xs text-[#bcb9b1]">{{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
              </div>
              <h3 class="section-title text-xl leading-tight">{{ $post->title }}</h3>
              <p class="text-[#66645e] text-sm mt-2 leading-relaxed">{{ $post->excerpt }}</p>
              <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1 text-sm font-bold text-[#f27d99] hover:gap-2 transition-all">
                  Read more <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
                </a>
                <div class="flex items-center gap-1 text-xs text-[#bcb9b1]">
                  <span class="material-symbols-outlined" style="font-size:14px;">visibility</span> {{ $post->views }}
                </div>
              </div>
            </div>
          </article>
          @empty
          <p class="text-[#66645e] col-span-full text-center py-12">No more posts yet. Add your next story in admin.</p>
          @endforelse

        </div>
      </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="page-pad py-20" style="background:#f7f3e9;">
      <div class="max-w-3xl mx-auto text-center anim-up">
        <span class="pill inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-5">
          <span class="material-symbols-outlined" style="font-size:14px;">mail</span> Newsletter
        </span>
        <h2 class="section-title text-4xl md:text-5xl leading-tight" style="letter-spacing:-0.03em;">
          Stay in the <span class="gradient-headline">Loop</span>
        </h2>
        <p class="text-[#66645e] mt-4 text-lg leading-relaxed">New recipes, flavor drops, and behind-the-scenes updates — straight to your inbox.</p>
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center anim-up delay-1">
          <input class="rounded-full border border-[#f0c5d2] px-6 py-3.5 min-w-[260px] focus:outline-none focus:ring-2 focus:ring-[#f27d99] bg-white text-[#393832]" placeholder="your@email.com" type="email" id="nlEmail">
          <button onclick="subscribeNL()" class="bg-[#f27d99] text-white px-8 py-3.5 rounded-full font-bold hover:scale-105 transition-transform cta-glow flex items-center gap-2 justify-center">
            <span class="material-symbols-outlined" style="font-size:18px;">send</span> Subscribe
          </button>
        </div>
        <p id="nlSuccess" class="hidden mt-4 text-sm font-bold text-[#4d6e00]">&#127881; You're in! Welcome to the Current Cravings family.</p>
        <p class="text-xs text-[#bcb9b1] mt-3">No spam, ever. Unsubscribe anytime.</p>
      </div>
    </section>

  <style>
    .filter-pill { background: rgba(242,125,153,0.1); color: #66645e; border: 1.5px solid transparent; }
    .filter-pill:hover { background: rgba(242,125,153,0.18); color: #f27d99; }
    .active-pill { background: #f27d99 !important; color: white !important; border-color: #f27d99 !important; }
    .post-card { transition: all 0.3s ease; }
    .post-card.hidden-post { display: none; }
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
  <script>
    function filterPosts(cat, btn) {
      document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active-pill'));
      btn.classList.add('active-pill');
      const cards = document.querySelectorAll('.post-card');
      let count = 0;
      cards.forEach(card => {
        if (cat === 'all' || card.dataset.cat === cat) {
          card.classList.remove('hidden-post'); count++;
        } else {
          card.classList.add('hidden-post');
        }
      });
      document.getElementById('postCount').textContent = count + ' article' + (count !== 1 ? 's' : '');
    }
    function subscribeNL() {
      const el = document.getElementById('nlEmail');
      const msg = document.getElementById('nlSuccess');
      if (el && el.value) { msg.classList.remove('hidden'); el.value = ''; }
    }
    (function(){
      var cartData={'ci-1':{qty:1,price:6.50},'ci-2':{qty:1,price:8.00},'ci-3':{qty:1,price:7.50}};
      window.openCart=function(){document.getElementById('cartPanel').classList.add('open');document.getElementById('cartOverlay').classList.add('open');var sp=document.getElementById('suggestPanel');if(sp)sp.classList.add('open');document.body.style.overflow='hidden';updateCartTotals();};
      window.closeCart=function(){document.getElementById('cartPanel').classList.remove('open');document.getElementById('cartOverlay').classList.remove('open');var sp=document.getElementById('suggestPanel');if(sp)sp.classList.remove('open');document.body.style.overflow='';};
      window.toggleSuggest=function(){var sp=document.getElementById('suggestPanel');if(!sp)return;sp.classList.toggle('open');};
      window.cartQty=function(id,d){var item=cartData[id];if(!item)return;item.qty=Math.max(1,item.qty+d);var el=document.getElementById(id+'-qty');if(el){el.textContent=item.qty;}updateCartTotals();};
      window.removeCartItem=function(id){var el=document.getElementById(id);if(!el)return;el.remove();delete cartData[id];updateCartTotals();};
      function updateCartTotals(){var total=0,count=0;Object.values(cartData).forEach(function(i){total+=i.price*i.qty;count+=i.qty;});var t=document.getElementById('cartTotal'),c=document.getElementById('cartItemCount'),b=document.getElementById('cartCountBadge');if(t)t.textContent='$'+total.toFixed(2);if(c)c.textContent=count;if(b)b.textContent=count;var pct=Math.min(100,(total/100)*100);var sb=document.getElementById('shipBar');if(sb)sb.style.width=pct+'%';}
      window.applyPromo=function(){var inp=document.getElementById('promoInput');if(inp)inp.value='SWEET10 - 10% off';};
      window.cartCheckout=function(){alert('Order placed!');};
      document.querySelectorAll('button').forEach(function(btn){if(btn.textContent.trim()==='shopping_bag'){btn.addEventListener('click',openCart);}});
      document.addEventListener('keydown',function(e){if(e.key==='Escape')closeCart();});
      updateCartTotals();
    })();
  </script>
@endsection


































