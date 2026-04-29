<?php if (!empty($meta_description)): ?>
<!-- Meta description injected via layout -->
<?php endif; ?>

<section style="padding-top:calc(var(--nav-h) + var(--s16));padding-bottom:var(--s24);">
  <div class="wrap" style="max-width:900px;">
    <div class="managed-content">
      <?= $managed_content ?>
    </div>
  </div>
</section>

<style>
  .managed-content { font-family: var(--f-body); font-size: var(--t-base); line-height: var(--lh-relaxed); color: var(--txt-1); }
  .managed-content h1 { font-family: var(--f-display); font-size: clamp(32px,4.5vw,var(--t-4xl)); font-weight: 700; letter-spacing: -.025em; line-height: var(--lh-tight); margin-bottom: var(--s6); }
  .managed-content h2 { font-family: var(--f-display); font-size: var(--t-2xl); font-weight: 700; letter-spacing: -.02em; margin-top: var(--s10); margin-bottom: var(--s4); }
  .managed-content h3 { font-family: var(--f-display); font-size: var(--t-xl); font-weight: 700; margin-top: var(--s8); margin-bottom: var(--s3); }
  .managed-content h4 { font-family: var(--f-display); font-size: var(--t-lg); font-weight: 700; margin-top: var(--s6); margin-bottom: var(--s2); }
  .managed-content p  { font-size: var(--t-base); color: var(--txt-2); line-height: var(--lh-relaxed); margin-bottom: var(--s4); }
  .managed-content ul, .managed-content ol { padding-left: var(--s8); margin-bottom: var(--s4); color: var(--txt-2); }
  .managed-content li { margin-bottom: var(--s2); line-height: var(--lh-relaxed); }
  .managed-content a  { color: var(--brand-blue); text-decoration: underline; }
  .managed-content a:hover { color: var(--brand-blue-dark); }
  .managed-content img { max-width: 100%; border-radius: var(--r-md); margin: var(--s6) 0; }
  .managed-content blockquote { border-left: 3px solid var(--brand-blue); padding: var(--s4) var(--s6); background: var(--brand-blue-light); border-radius: 0 var(--r-md) var(--r-md) 0; margin: var(--s6) 0; color: var(--txt-1); font-style: italic; }
  .managed-content table { width: 100%; border-collapse: collapse; margin: var(--s6) 0; }
  .managed-content th { background: var(--brand-blue); color: #fff; padding: var(--s3) var(--s4); text-align: left; font-family: var(--f-display); font-size: var(--t-sm); }
  .managed-content td { padding: var(--s3) var(--s4); border-bottom: 1px solid var(--border); font-size: var(--t-sm); color: var(--txt-2); }
  .managed-content tr:hover td { background: var(--n-50); }
  .managed-content hr { border: none; border-top: 1px solid var(--border); margin: var(--s10) 0; }
</style>
