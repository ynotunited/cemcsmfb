<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Downloads</span>
        </div>
        <h1 class="page-title reveal d1">Banking<br/><span class="text-gradient">Forms</span></h1>
      </div>
      <p class="page-desc">All your banking forms in one place. Download, fill and submit at any of our branches.</p>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section-sm" style="background:var(--surface);border-bottom:1px solid var(--border);">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:center;">
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">Getting Started Online</p>
        <h2 class="h-lg" style="margin-bottom:var(--s4);">Four simple steps.</h2>
        <p class="body-lg">From account opening forms to updates and service requests, this is your one-stop hub for all the forms required to complete your banking applications.</p>
      </div>
      <div class="reveal d1">
        <div style="display:flex;flex-direction:column;gap:var(--s4);">
          <?php
          $steps = [
            ['01', 'Choose a form from the categories below.'],
            ['02', 'Download the PDF version on your computer, phone or tablet.'],
            ['03', 'Fill the fields with the appropriate information and attach additional documents (e.g. passport photographs) where necessary.'],
            ['04', 'Send a scanned copy of your correctly-filled form to us or walk into our office to complete your application.'],
          ];
          foreach ($steps as [$num, $text]): ?>
          <div style="display:flex;gap:var(--s4);align-items:flex-start;">
            <div style="font-family:var(--f-mono);font-size:var(--t-xs);font-weight:700;color:var(--brand-blue);min-width:28px;padding-top:2px;letter-spacing:.06em;"><?= $num ?></div>
            <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($text) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FORMS GRID -->
<section class="section">
  <div class="wrap">
    <p class="label" style="margin-bottom:var(--s3);">Account Opening Forms</p>
    <h2 class="h-lg" style="margin-bottom:var(--s10);">Select the Form You Need</h2>

    <div class="forms-grid reveal">

      <?php
      $forms = [
        [
          'title'    => 'Corporate Account Opening Form',
          'desc'     => 'For companies, businesses and corporate entities opening a CEMCS MFB account.',
          'file'     => 'corporate-account-opening.pdf',
          'category' => 'Corporate',
          'icon'     => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
        ],
        [
          'title'    => 'Individual Account Opening Form',
          'desc'     => 'For individual customers opening a personal savings or current account.',
          'file'     => 'individual-account-opening.pdf',
          'category' => 'Individual',
          'icon'     => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        ],
        [
          'title'    => 'Account Opening Form',
          'desc'     => 'General account opening form for all standard CEMCS MFB account types.',
          'file'     => 'account-opening.pdf',
          'category' => 'General',
          'icon'     => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>',
        ],
        [
          'title'    => 'Association Account Opening Form',
          'desc'     => 'For associations, clubs, societies and non-profit organisations.',
          'file'     => 'association-account-opening.pdf',
          'category' => 'Association',
          'icon'     => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        ],
        [
          'title'    => 'Account Opening Mandate Form',
          'desc'     => 'Mandate form required for account signatories and authorised representatives.',
          'file'     => 'account-opening-mandate.pdf',
          'category' => 'Mandate',
          'icon'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        ],
        [
          'title'    => 'Account Opening Reference Form',
          'desc'     => 'Reference form to be completed by an existing CEMCS MFB account holder.',
          'file'     => 'account-opening-reference.pdf',
          'category' => 'Reference',
          'icon'     => '<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>',
        ],
      ];
      foreach ($forms as $i => $form):
        $delay = ['', 'd1', 'd2', '', 'd1', 'd2'][$i];
      ?>
      <div class="form-card reveal <?= $delay ?>">
        <div class="form-card-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?= $form['icon'] ?></svg>
        </div>
        <div class="form-card-body">
          <span class="form-card-cat"><?= htmlspecialchars($form['category']) ?></span>
          <h3 class="form-card-title"><?= htmlspecialchars($form['title']) ?></h3>
          <p class="form-card-desc"><?= htmlspecialchars($form['desc']) ?></p>
        </div>
        <a href="<?= APP_URL ?>/assets/forms/<?= $form['file'] ?>" download class="btn btn-primary" style="width:100%;justify-content:center;gap:var(--s2);">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Download PDF
        </a>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- Note -->
    <div class="reveal" style="margin-top:var(--s12);background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s6) var(--s8);display:flex;gap:var(--s5);align-items:flex-start;">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <div>
        <p style="font-size:var(--t-sm);font-weight:600;color:var(--brand-blue-dark);margin-bottom:var(--s1);">Need help completing a form?</p>
        <p style="font-size:var(--t-sm);color:var(--brand-blue-dark);line-height:var(--lh-relaxed);">
          Visit any of our branches or call us on <strong>+234 808 799 5012</strong>. You can also email us at
          <a href="mailto:helpdesk@cemcsmfb.com" style="color:var(--brand-blue);font-weight:600;">helpdesk@cemcsmfb.com</a>
        </p>
      </div>
    </div>

  </div>
</section>

<style>
.forms-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--s6);
}
@media (max-width: 1024px) { .forms-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px)  { .forms-grid { grid-template-columns: 1fr; } }

.form-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--r-lg);
  padding: var(--s8);
  display: flex;
  flex-direction: column;
  gap: var(--s5);
  transition: box-shadow var(--t-base) var(--ease-o), transform var(--t-base) var(--ease-o), border-color var(--t-base) var(--ease-o);
}
.form-card:hover {
  box-shadow: var(--s-3);
  transform: translateY(-3px);
  border-color: var(--brand-blue-mid);
}
.form-card-icon {
  width: 48px; height: 48px;
  background: var(--brand-blue-light);
  border-radius: var(--r-md);
  display: flex; align-items: center; justify-content: center;
  color: var(--brand-blue);
  flex-shrink: 0;
}
.form-card-body { flex: 1; }
.form-card-cat {
  font-family: var(--f-mono);
  font-size: var(--t-xs);
  font-weight: 500;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--brand-blue);
  display: block;
  margin-bottom: var(--s2);
}
.form-card-title {
  font-family: var(--f-display);
  font-size: var(--t-lg);
  font-weight: 700;
  letter-spacing: -.01em;
  color: var(--txt-1);
  line-height: var(--lh-snug);
  margin-bottom: var(--s3);
}
.form-card-desc {
  font-size: var(--t-sm);
  color: var(--txt-2);
  line-height: var(--lh-relaxed);
}

@media (max-width: 1024px) {
  section.section-sm > .wrap > div[style*="grid-template-columns:1fr 1fr"] {
    grid-template-columns: 1fr !important;
  }
}
</style>
