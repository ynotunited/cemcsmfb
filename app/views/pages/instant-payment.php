<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation:pulse 2s infinite;"></span>
          <span class="label">E-Banking</span>
        </div>
        <h1 class="page-title reveal d1">NIBSS Instant<br/><span class="text-gradient">Payment</span></h1>
      </div>
      <p class="page-desc">No more queues. Send money from any bank in Nigeria directly to your CEMCS MFB account instantly.</p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About NIP</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Instant transfers to your CEMCS MFB account.</h2>
        <p class="body-lg" style="margin-bottom:var(--s8);">
          With the Nigerian Inter Bank Settlement System Instant Payment (NIBSS NIP), you can send money from your account in any bank in Nigeria instantaneously to your CEMCS MFB beneficiary account and receive value. This service is available 24 hours a day.
        </p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Open an Account</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- How It Works -->
        <div style="margin-top:var(--s10);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">How NIBSS Instant Payment Works</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php $steps = [
              'Launch your Internet or Mobile Banking App of any bank',
              'Navigate to "Send Money / Funds Transfer"',
              'Select Instant Transfer',
              'Select "CEMCS Microfinance Bank" or "CEMCS MFB" from the dropdown list',
              'Input your CEMCS MFB beneficiary account number',
              'Populate transaction data',
              'Enter your PIN and send money to CEMCS MFB',
              'Receive value at CEMCS MFB beneficiary account',
            ]; foreach($steps as $i => $step): ?>
            <div style="display:flex;gap:var(--s3);align-items:flex-start;">
              <div style="width:28px;height:20px;flex-shrink:0;margin-top:2px;display:flex;align-items:center;">
                <span style="font-family:var(--f-mono,monospace);font-size:var(--t-xs);font-weight:700;color:var(--brand-blue);"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></span>
              </div>
              <p style="font-size:var(--t-base);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($step) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Right -->
      <div class="reveal d1">

        <!-- Benefits card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Benefits</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php $items = [
              'Fast and secure transfers',
              'Immediate value — funds received instantly',
              'Available 24 hours a day, 7 days a week',
              'Conforms to the Central Bank\'s cashless policy',
              'Send from any bank in Nigeria to CEMCS MFB',
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

        <!-- Info card -->
        <div style="margin-top:var(--s6);background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <p class="label" style="margin-bottom:var(--s2);">Service</p>
          <p style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;color:var(--txt-1);margin-bottom:var(--s4);">NIBSS NIP (Instant Payment)</p>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);">Available from all commercial banks in Nigeria. No need to visit a branch.</p>
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
        ['Payments & Deposits','/payments-deposits'],
      ] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
