<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation:pulse 2s infinite;"></span>
          <span class="label">E-Banking</span>
        </div>
        <h1 class="page-title reveal d1">Payments &amp;<br/><span class="text-gradient">Cash Deposits</span></h1>
      </div>
      <p class="page-desc">Convenient, secure and cashless banking — transfer funds to any commercial bank in Nigeria.</p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Service</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Fast, low-cost and secure fund transfers.</h2>
        <p class="body-lg" style="margin-bottom:var(--s6);">
          CEMCS MFB offers its clients a fast, low cost, and secure way of transferring their funds to any commercial bank within Nigeria. Transfer money directly to your business partners, friends and family members using the CEMCS MFB funds transfer service — beneficiaries receive the money right into their accounts within 2–4 hours.
        </p>
        <p class="body-lg" style="margin-bottom:var(--s8);">
          To transfer funds using this channel, simply walk into any of our branches for more enquiries.
        </p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="<?= APP_URL ?>/branches" class="btn btn-primary btn-lg">Visit a Branch</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Pricing -->
        <div style="margin-top:var(--s10);">
          <div style="background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
            <p class="label" style="margin-bottom:var(--s3);">Pricing</p>
            <p style="font-size:var(--t-sm);color:var(--brand-blue-dark);line-height:var(--lh-relaxed);">For current pricing and rates, kindly contact our office directly or visit any of our branches.</p>
          </div>
        </div>
      </div>

      <!-- Right -->
      <div class="reveal d1">

        <!-- Features card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Features</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php $items = [
              'Transfer of funds to all commercial banks in Nigeria',
              'Useful for business owners, travelers and school children',
              'Avoid cash-less charges',
              'Fast and convenient',
              'Low cost rates',
            ]; foreach($items as $i => $item): ?>
            <div style="display:flex;gap:var(--s4);align-items:flex-start;padding:var(--s3) 0;<?= $i < count($items)-1 ? 'border-bottom:1px solid var(--border-sub);' : '' ?>">
              <div style="width:24px;height:24px;background:var(--brand-blue-light);border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($item) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Benefits card -->
        <div style="margin-top:var(--s6);background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">Benefits</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php $benefits = [
              'Fast and secure transfers',
              'Immediate value',
              'Conforms to the Central Bank\'s cashless policy',
              'Available at all CEMCS MFB branches',
            ]; foreach($benefits as $benefit): ?>
            <div style="display:flex;gap:var(--s3);align-items:flex-start;">
              <div style="width:20px;height:20px;background:var(--brand-blue-light);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-base);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($benefit) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- OTHER E-BANKING NAV BAND -->
<section class="section-sm" style="background:var(--n-50);border-top:1px solid var(--border);">
  <div class="wrap">
    <p class="label" style="margin-bottom:var(--s4);">Other E-Banking Services</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:var(--s3);">
      <?php foreach([
        ['Debit Cards','/debit-cards'],
        ['Mobile Banking','/mobile-banking'],
        ['Instant Payment','/instant-payment'],
      ] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
