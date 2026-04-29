<section style="padding-top: calc(var(--nav-h) + var(--s16)); padding-bottom: var(--s24); background: var(--bg);">
  <div class="wrap" style="max-width: 720px;">
    <p class="label" style="margin-bottom: var(--s3);">Coming Soon</p>
    <h1 class="h-lg" style="margin-bottom: var(--s4);"><?= htmlspecialchars($page_title ?? $title ?? 'Page') ?></h1>
    <p class="body-lg" style="margin-bottom: var(--s8);"><?= htmlspecialchars($page_desc ?? 'This page is currently under construction. Please check back soon.') ?></p>
    <a href="<?= APP_URL ?>/" class="btn btn-primary btn-lg"><span class="btn-label">Return to Home</span></a>
  </div>
</section>
