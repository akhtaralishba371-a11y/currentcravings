
<?php $__env->startSection('title', filled($post->meta_title ?? null) ? $post->meta_title : (($post->title ?? 'Blog') . ' | Current Cravings')); ?>
<?php $__env->startSection('meta_description', $post->meta_description ?? ''); ?>
<?php $__env->startSection('canonical_url', filled($post->canonical_url ?? null) ? $post->canonical_url : route('blog.show', $post->slug)); ?>
<?php $__env->startSection('meta_robots', ($post->is_index ?? true) ? 'index, follow' : 'noindex, nofollow'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.blog-show-page {
  background: linear-gradient(160deg, #fff0f4 0%, #fffbff 45%, #f7f3e9 100%);
  min-height: 100vh;
}
.blog-show-shell {
  max-width: 1360px;
  margin: 0 auto;
  padding: 36px 24px 72px;
}
.blog-meta-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: #c04060;
  background: rgba(242, 125, 153, 0.12);
  border: 1px solid rgba(242, 125, 153, 0.25);
  border-radius: 999px;
  padding: 6px 14px;
}
.blog-main-card {
  background: #fff;
  border-radius: 28px;
  border: 1.5px solid rgba(242, 125, 153, 0.14);
  box-shadow: 0 18px 52px rgba(242, 125, 153, 0.09);
  overflow: hidden;
}
.blog-featured-img {
  width: 100%;
  height: auto;
  max-height: 460px;
  object-fit: cover;
  display: block;
}
.blog-article-wrap {
  padding: 32px;
}
.blog-title {
  font-family: "Epilogue", sans-serif;
  font-size: clamp(2rem, 5vw, 3rem);
  line-height: 1.05;
  font-weight: 900;
  letter-spacing: -0.03em;
  color: #2a1a22;
  margin: 0 0 14px;
}
.blog-sub {
  color: #66645e;
  font-size: 15px;
  line-height: 1.8;
  margin: 0 0 24px;
}
.blog-content {
  color: #3a3526;
  font-size: 15px;
  line-height: 1.85;
}
.blog-content h1,
.blog-content h2,
.blog-content h3,
.blog-content h4 {
  font-family: "Epilogue", sans-serif;
  color: #2a1a22;
  font-weight: 900;
  line-height: 1.3;
  margin: 1.2em 0 0.6em;
  scroll-margin-top: 110px;
}
.blog-content h2 {
  font-size: 1.6rem;
}
.blog-content h3 {
  font-size: 1.2rem;
  color: #f27d99;
}
.blog-content p {
  margin: 0 0 1em;
}
.blog-content ul,
.blog-content ol {
  margin: 0 0 1em;
  padding-left: 1.25rem;
}
.blog-content ul {
  list-style: disc !important;
}
.blog-content ol {
  list-style: decimal !important;
}
.blog-content li {
  display: list-item !important;
  margin: 0.3em 0;
}
.blog-content a {
  color: #e8627d !important;
  text-decoration: underline !important;
  text-underline-offset: 3px;
  text-decoration-thickness: 1.5px;
  font-weight: 700;
  word-break: break-word;
}
.blog-content a:hover {
  color: #c04060 !important;
}
.blog-content img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
}
.blog-content blockquote {
  margin: 1em 0;
  padding: 10px 14px;
  border-left: 4px solid #f27d99;
  background: #fff5f8;
  color: #7c3f52;
}
.blog-recent-card {
  display: block;
  text-decoration: none;
  background: #fff;
  border: 1.5px solid rgba(242, 125, 153, 0.12);
  border-radius: 18px;
  overflow: hidden;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.blog-recent-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 36px rgba(242, 125, 153, 0.14);
}
.blog-recent-title {
  color: #2a1a22;
  font-weight: 800;
  font-size: 0.95rem;
  line-height: 1.35;
}
.blog-recent-meta {
  color: #9c9385;
  font-size: 12px;
}
.blog-back-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: #f27d99;
  font-weight: 800;
  font-size: 13px;
}
.blog-back-link:hover {
  color: #e8627d;
}
.blog-toc-card {
  position: relative;
  background: linear-gradient(145deg, #fff8fb 0%, #ffffff 55%, #fff7ef 100%);
  border: 1.5px solid rgba(242, 125, 153, 0.22);
  border-radius: 22px;
  padding: 16px;
  margin-bottom: 12px;
  box-shadow: 0 14px 34px rgba(242, 125, 153, 0.14);
  overflow: hidden;
}
.blog-toc-card::before {
  content: "";
  position: absolute;
  width: 170px;
  height: 170px;
  right: -64px;
  top: -70px;
  background: radial-gradient(circle, rgba(242, 125, 153, 0.22), rgba(242, 125, 153, 0));
  pointer-events: none;
}
.blog-toc-head {
  position: relative;
  z-index: 1;
  margin-bottom: 12px;
}
.blog-toc-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 10px;
  font-weight: 900;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #c04060;
  background: rgba(242, 125, 153, 0.13);
  border: 1px solid rgba(242, 125, 153, 0.24);
  border-radius: 999px;
  padding: 5px 10px;
}
.blog-side-title {
  font-family: "Epilogue", sans-serif;
  font-size: 1.05rem;
  font-weight: 900;
  color: #2a1a22;
  margin: 10px 0 0;
}
.blog-toc-list {
  position: relative;
  z-index: 1;
  display: grid;
  gap: 7px;
  counter-reset: toc;
}
.blog-toc-link {
  display: flex;
  align-items: center;
  gap: 8px;
  justify-content: space-between;
  font-size: 12px;
  font-weight: 700;
  color: #574f44;
  line-height: 1.35;
  background: rgba(255, 255, 255, 0.8);
  border: 1px solid rgba(242, 125, 153, 0.12);
  border-radius: 12px;
  padding: 8px 10px;
  cursor: pointer;
  transition: transform 0.22s ease, border-color 0.22s ease, background 0.22s ease, box-shadow 0.22s ease, color 0.22s ease;
}
.blog-toc-link::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 999px;
  background: rgba(242, 125, 153, 0.6);
  flex-shrink: 0;
}
.blog-toc-link:not(.level-3):not(.level-4)::before {
  counter-increment: toc;
  content: counter(toc, decimal-leading-zero);
  width: auto;
  height: auto;
  font-size: 10px;
  font-weight: 900;
  letter-spacing: 0.08em;
  color: #e8627d;
  background: rgba(242, 125, 153, 0.12);
  border: 1px solid rgba(242, 125, 153, 0.25);
  border-radius: 999px;
  padding: 3px 7px;
}
.blog-toc-link.level-3::before,
.blog-toc-link.level-4::before {
  background: #f27d99;
}
.blog-toc-label {
  flex: 1;
  min-width: 0;
}
.blog-toc-link:hover {
  color: #e8627d;
  border-color: rgba(232, 98, 125, 0.45);
  background: #fff;
  box-shadow: 0 8px 20px rgba(242, 125, 153, 0.16);
}
.blog-toc-link.is-active {
  color: #e8627d;
  border-color: rgba(232, 98, 125, 0.58);
  background: #fff;
  box-shadow: 0 10px 24px rgba(242, 125, 153, 0.2);
}
.blog-toc-link.level-3 {
  margin-left: 12px;
}
.blog-toc-link.level-4 {
  margin-left: 24px;
}
.blog-layout {
  display: grid;
  gap: 22px;
  align-items: start;
}
.blog-layout.has-toc {
  grid-template-columns: 260px minmax(0, 1fr) 260px;
}
.blog-layout.no-toc {
  grid-template-columns: minmax(0, 1fr) 280px;
}
.blog-main-card { text-align: left; }
.blog-side-column {
  position: sticky;
  top: calc(var(--cc-header-offset, 88px) + 12px);
  align-self: start;
}
.blog-toc-aside.blog-side-column {
  position: sticky;
  top: calc(var(--cc-header-offset, 88px) + 12px);
  align-self: start;
  max-height: none;
  overflow: visible;
  padding-right: 0;
}
@media (max-width: 768px) {
  .blog-layout {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .blog-show-shell {
    padding: 28px 14px 54px;
  }
  .blog-article-wrap {
    padding: 22px 18px;
  }
  .blog-layout .blog-toc-aside,
  .blog-layout .blog-recent-aside,
  .blog-side-column {
    position: static !important;
    max-height: none;
    overflow: visible;
  }
  .blog-main-card { order: 1; }
  .blog-toc-aside { order: 2; }
  .blog-recent-aside { order: 3; }
  .blog-toc-link {
    padding: 9px 10px;
  }
  .blog-toc-link.level-3,
  .blog-toc-link.level-4 {
    margin-left: 0;
  }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $recentPosts = $recentPosts ?? collect();
  $heroImage = $post->featured_image_url ?: asset('images/main image redesign.png');
  $publishedLabel = optional($post->published_at)->format('F d, Y') ?? $post->created_at?->format('F d, Y');
  $readMinutes = max(1, (int) ceil(str_word_count(strip_tags((string) $post->content)) / 200));
  $categoryLabel = filled($post->category) ? $post->category : 'Blog';
  $renderedContent = (string) $post->content;
  $toc = [];
  $tocSlugCount = [];

  $renderedContent = preg_replace_callback('/<h([2-4])([^>]*)>(.*?)<\/h\1>/is', function ($m) use (&$toc, &$tocSlugCount) {
    $level = (int) $m[1];
    $attrs = $m[2];
    $inner = $m[3];

    if (preg_match('/\sid=(["\'])(.*?)\1/i', $attrs, $idMatch)) {
      $id = $idMatch[2];
    } else {
      $base = \Illuminate\Support\Str::slug(trim(preg_replace('/\s+/', ' ', strip_tags($inner))));
      if ($base === '') {
        $base = 'section';
      }
      $tocSlugCount[$base] = ($tocSlugCount[$base] ?? 0) + 1;
      $id = $tocSlugCount[$base] > 1 ? $base . '-' . $tocSlugCount[$base] : $base;
      $attrs .= ' id="' . $id . '"';
    }

    $title = trim(preg_replace('/\s+/', ' ', strip_tags($inner)));
    if ($title !== '') {
      $toc[] = ['id' => $id, 'title' => $title, 'level' => $level];
    }

    return "<h{$level}{$attrs}>{$inner}</h{$level}>";
  }, $renderedContent);
  $hasToc = count($toc) > 0;
?>

<section class="blog-show-page page-hero-under-header">
  <div class="blog-show-shell">
    <div style="margin-bottom: 16px;">
      <a href="<?php echo e(route('blog.index')); ?>" class="blog-back-link">
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span>
        Back to Blog
      </a>
    </div>

    <div class="blog-layout <?php echo e($hasToc ? 'has-toc' : 'no-toc'); ?>">
      <?php if($hasToc): ?>
        <aside class="blog-toc-aside blog-side-column">
          <div class="blog-toc-card">
            <div class="blog-toc-head">
              <span class="blog-toc-chip">
                <span class="material-symbols-outlined" style="font-size:12px;">menu_book</span>
                On this page
              </span>
              <h2 class="blog-side-title">Table of Contents</h2>
            </div>
            <div class="blog-toc-list">
              <?php $__currentLoopData = $toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-toc-link level-<?php echo e($item['level']); ?>" data-toc-link="<?php echo e($item['id']); ?>" role="button" tabindex="0" aria-label="Jump to <?php echo e($item['title']); ?>">
                  <span class="blog-toc-label"><?php echo e($item['title']); ?></span>
                  <span class="material-symbols-outlined" style="font-size:14px;opacity:.62;">check_small</span>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </aside>
      <?php endif; ?>

      <article class="blog-main-card">
        <img src="<?php echo e($heroImage); ?>" alt="<?php echo e($post->title); ?>" class="blog-featured-img">
        <div class="blog-article-wrap">
          <div style="display:flex;flex-wrap:wrap;gap:8px 10px;margin-bottom:14px;">
            <span class="blog-meta-pill"><?php echo e($categoryLabel); ?></span>
            <span class="blog-meta-pill"><?php echo e($publishedLabel); ?></span>
            <span class="blog-meta-pill"><?php echo e($readMinutes); ?> min read</span>
            <span class="blog-meta-pill"><?php echo e((int) $post->views); ?> views</span>
          </div>

          <h1 class="blog-title"><?php echo e($post->title); ?></h1>

          <?php if(filled($post->excerpt)): ?>
            <p class="blog-sub"><?php echo e($post->excerpt); ?></p>
          <?php endif; ?>

          <div class="blog-content"><?php echo $renderedContent; ?></div>
        </div>
      </article>

      <aside class="blog-recent-aside blog-side-column">
        <div style="background:#fff;border:1.5px solid rgba(242,125,153,0.14);border-radius:20px;padding:16px;">
          <h2 style="font-family:'Epilogue',sans-serif;font-size:1.05rem;font-weight:900;color:#2a1a22;margin:0 0 12px;">
            Recent Posts
          </h2>

          <div style="display:grid;gap:12px;">
            <?php $__empty_1 = true; $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <?php
                $recentImg = $recent->featured_image_url ?: asset('images/main image redesign.png');
                $recentDate = optional($recent->published_at)->format('M d, Y') ?? $recent->created_at?->format('M d, Y');
              ?>
              <a href="<?php echo e(route('blog.show', $recent->slug)); ?>" class="blog-recent-card">
                <img src="<?php echo e($recentImg); ?>" alt="<?php echo e($recent->title); ?>" style="width:100%;height:140px;object-fit:cover;display:block;">
                <div style="padding:10px 12px;">
                  <div class="blog-recent-title"><?php echo e(\Illuminate\Support\Str::limit($recent->title, 70)); ?></div>
                  <div class="blog-recent-meta" style="margin-top:6px;"><?php echo e($recentDate); ?></div>
                </div>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <p style="font-size:13px;color:#9c9385;margin:0;">No recent posts found.</p>
            <?php endif; ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php if(count($toc)): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tocLinks = Array.from(document.querySelectorAll('[data-toc-link]'));
  if (!tocLinks.length) return;

  const setActive = function (id) {
    tocLinks.forEach(function (link) {
      link.classList.toggle('is-active', link.dataset.tocLink === id);
    });
  };

  const headings = tocLinks
    .map(function (link) { return document.getElementById(link.dataset.tocLink); })
    .filter(Boolean);

  if (!headings.length) return;

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        setActive(entry.target.id);
      }
    });
  }, { rootMargin: '-30% 0px -58% 0px', threshold: [0, 1] });

  headings.forEach(function (heading) { observer.observe(heading); });

  const scrollToHeading = function (id) {
    const target = document.getElementById(id);
    if (!target) return;
    const offset = 102;
    const top = target.getBoundingClientRect().top + window.scrollY - offset;
    window.scrollTo({ top: top, behavior: 'smooth' });
    setActive(id);
  };

  tocLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      scrollToHeading(link.dataset.tocLink);
    });

    link.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        scrollToHeading(link.dataset.tocLink);
      }
    });
  });

  setActive(headings[0].id);
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u589377733/domains/currentcravings.co.uk/public_html/resources/views/website/blog-show.blade.php ENDPATH**/ ?>