@php
 $cms = $cms ?? \App\Models\SiteContent::allKeyed();
 $v = fn(string $key, string $default = ''): string => filled($cms[$key] ?? null) ? (string) $cms[$key] : $default;

 $logoPath = $cms['logo_image'] ?? null;
 $logoSrc = $logoPath
   ? (\Illuminate\Support\Str::startsWith($logoPath, 'http')
      ? $logoPath
      : route('media.public', ['path' => $logoPath], false))
   : asset('images/logo-1536x635.png');

 $menuLinks = [
  ['text' => $v('footer_menu_link1_text', 'Brownies'),    'url' => $v('footer_menu_link1_url', route('menu.show', 'brownies'))],
  ['text' => $v('footer_menu_link2_text', 'Cookies'),     'url' => $v('footer_menu_link2_url', route('menu.show', 'cookies'))],
  ['text' => $v('footer_menu_link3_text', 'Tres Leches'), 'url' => $v('footer_menu_link3_url', route('menu.show', 'tres-leches'))],
  ['text' => $v('footer_menu_link4_text', 'Drinks'),      'url' => $v('footer_menu_link4_url', route('menu.show', 'drinks'))],
  ['text' => $v('footer_menu_link5_text', 'Gift Boxes'),  'url' => $v('footer_menu_link5_url', route('menu.show', 'boxes'))],
 ];

 $infoLinks = [
  ['text' => $v('footer_info_link1_text', 'About Us'),             'url' => $v('footer_info_link1_url', route('about'))],
  ['text' => $v('footer_info_link2_text', 'Allergen Info'),        'url' => $v('footer_info_link2_url', route('allergen-info'))],
  ['text' => $v('footer_info_link3_text', 'Delivery & Shipping'),  'url' => $v('footer_info_link3_url', route('delivery-shipping'))],
  ['text' => $v('footer_info_link4_text', 'Contact Us'),           'url' => $v('footer_info_link4_url', route('contact'))],
 ];

 $legalLinks = [
  ['text' => $v('footer_legal_link1_text', 'Privacy Policy'),   'url' => $v('footer_legal_link1_url', route('privacy-policy'))],
  ['text' => $v('footer_legal_link2_text', 'Terms of Service'), 'url' => $v('footer_legal_link2_url', route('terms-of-service'))],
  ['text' => $v('footer_legal_link3_text', 'Refund Policy'),    'url' => $v('footer_legal_link3_url', route('refunds-returns'))],
  ['text' => $v('footer_legal_link4_text', 'Sitemap'),          'url' => $v('footer_legal_link4_url', 'https://currentcravings.co.uk/sitemap.xml')],
 ];

 $instagramUrl = $v('instagram_url', 'https://www.instagram.com/currentcravings_uk');
 $tiktokUrl = $v('tiktok_url', 'https://www.tiktok.com/@currentcravings_uk');
 $pinterestUrl = $v('footer_pinterest_url', '#');
 $waDigits = preg_replace('/\D+/', '', $v('whatsapp_number', '+447534738441')) ?: '';
 $whatsappUrl = $waDigits !== '' ? 'https://wa.me/'.$waDigits : '#';
@endphp

<!-- FOOTER -->
<footer class="new-footer"><div class="site-shell">
 <div class="nf-blob" style="width:400px;height:400px;background:#fdd4e0;top:-100px;right:-80px"></div>
 <div class="nf-blob" style="width:350px;height:350px;background:#FCD47E;bottom:-100px;left:-60px;opacity:0.12"></div>
 <div class="nf-blob" style="width:250px;height:250px;background:#bef458;top:30%;left:45%;transform:translate(-50%,-50%);opacity:0.1"></div>
 <div class="footer-sprinkles-container" id="footerSprinkles"></div>
 <div class="footer-wave-wrapper">
  <svg class="footer-wave-svg" viewBox="0 0 1440 72" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
   <path class="fw-layer1" d="M0,36 C80,6 160,66 240,36 C320,6 400,66 480,36 C560,6 640,66 720,36 C800,6 880,66 960,36 C1040,6 1120,66 1200,36 C1280,6 1360,66 1440,36 L1440,72 L0,72 Z"/>
   <path class="fw-layer2" d="M0,44 C90,14 180,70 270,44 C360,18 450,70 540,44 C630,18 720,70 810,44 C900,18 990,70 1080,44 C1170,18 1260,70 1350,44 L1440,44 L1440,72 L0,72 Z"/>
   <path class="fw-layer3" d="M0,50 C60,20 120,70 180,50 C240,30 300,70 360,50 C420,30 480,70 540,50 C600,30 660,70 720,50 C780,30 840,70 900,50 C960,30 1020,70 1080,50 C1140,30 1200,70 1260,50 C1320,30 1380,70 1440,50 L1440,72 L0,72 Z"/>
  </svg>
 </div>
 <div class="nf-inner">
  <div>
   <div class="nf-tagline"><img src="{{ $logoSrc }}" alt="Current Cravings" style="height:70px;width:auto;mix-blend-mode:multiply;object-fit:contain;max-width:200px;"></div>
   <p class="nf-desc">{{ $v('footer_text', 'Current Cravings is a home bakery in Kettering serving freshly crafted desserts - no preservatives, no shortcuts, just pure happiness in every bite.') }}</p>
   <div class="nf-social">
    <a href="{{ $instagramUrl }}" class="nf-social-btn" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
    <a href="{{ $tiktokUrl }}" class="nf-social-btn" aria-label="TikTok" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.27 8.27 0 004.84 1.55V6.79a4.85 4.85 0 01-1.07-.1z"/></svg></a>
    <a href="{{ $pinterestUrl }}" class="nf-social-btn" aria-label="Pinterest" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg></a>
    <a href="{{ $whatsappUrl }}" class="nf-social-btn" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.999 0C5.373 0 0 5.372 0 11.999c0 2.117.554 4.1 1.523 5.819L.052 23.77l6.104-1.597A11.955 11.955 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 11.999 0zm.001 21.818a9.813 9.813 0 01-5.003-1.366l-.358-.213-3.724.976.996-3.628-.234-.374A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg></a>
   </div>
   <div class="nf-badges">
    <div class="nf-badge"><span class="ndot"></span>100% Halal</div>
    <div class="nf-badge"><span class="ndot"></span>Zero Preservatives</div>
    <div class="nf-badge"><span class="ndot"></span>Freshly Baked Daily</div>
   </div>
  </div>
  <div>
   <div class="nf-col-title">{{ $v('footer_menu_title', 'Menu') }}</div>
   <ul class="nf-links">
    @foreach($menuLinks as $link)
     <li><a href="{{ $link['url'] }}">{{ $link['text'] }} <span class="nfarr">&#8594;</span></a></li>
    @endforeach
   </ul>
  </div>
  <div>
   <div class="nf-col-title">{{ $v('footer_info_title', 'Info') }}</div>
   <ul class="nf-links">
    @foreach($infoLinks as $link)
     <li><a href="{{ $link['url'] }}">{{ $link['text'] }} <span class="nfarr">&#8594;</span></a></li>
    @endforeach
   </ul>
  </div>
 </div>
 <div class="nf-giant" style="text-align:center;"><span>Current</span><span>Cravings</span></div>
 <div class="nf-pastry-strip"><span style="animation-delay:0s">&#127850;</span> <span style="animation-delay:0.1s">&#127849;</span> <span style="animation-delay:0.2s">&#129473;</span> <span style="animation-delay:0.3s">&#127856;</span> <span style="animation-delay:0.4s">&#127851;</span> <span style="animation-delay:0.5s">&#127852;</span> <span style="animation-delay:0.6s">&#127846;</span> <span style="animation-delay:0.7s">&#129383;</span> <span style="animation-delay:0.8s">&#127849;</span> <span style="animation-delay:0.9s">&#127850;</span> <span style="animation-delay:1s">&#129473;</span> <span style="animation-delay:1.1s">&#127856;</span></div>
 <div class="nf-divider"></div>
 <div class="nf-bottom">
  <p class="nf-copy">{{ $v('footer_copy', '(c) '.date('Y').' Current Cravings - King Street, Kettering NN16 8JF') }}</p>
  <div class="nf-legal">
   @foreach($legalLinks as $link)
    <a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
   @endforeach
  </div>
  <div class="nf-stamp">
   <div class="nf-stamp-icon">&#10084;</div>
   {{ $v('footer_stamp_text', 'Baked for Every Craving.') }}
  </div>
 </div>
</div></footer>
