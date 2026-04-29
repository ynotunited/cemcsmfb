<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation:pulse 2s infinite;"></span>
          <span class="label">E-Banking</span>
        </div>
        <h1 class="page-title reveal d1">Debit<br/><span class="text-gradient">Cards</span></h1>
      </div>
      <p class="page-desc">The passport to your lifestyle. Secure, smart and accepted nationwide.</p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About Our Card</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Your CEMCS MFB Verve Card — always on the move.</h2>
        <p class="body-lg" style="margin-bottom:var(--s8);">
          The CEMCS MFB Verve Debit Card is your passport to a convenient lifestyle. It provides immediate access to your account from any ATM or POS terminal nationwide, keeping you protected and on the move 24/7.
        </p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="<?= APP_URL ?>/contact" class="btn btn-primary btn-lg">Get Your Card</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- How to Apply -->
        <div style="margin-top:var(--s10);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">How to Apply</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php $steps = [
              'Contact our office directly',
              'Complete the form and drop it at our office',
              'Pick up your card at a specified date',
            ]; foreach($steps as $step): ?>
            <div style="display:flex;gap:var(--s3);align-items:flex-start;">
              <div style="width:20px;height:20px;background:var(--brand-blue-light);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-base);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($step) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Right -->
      <div class="reveal d1">

        <!-- Features & Benefits card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Features &amp; Benefits</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php $items = [
              'Unlimited access nationwide',
              'Provides a secure and smart payment system',
              'Immediate access to your account from any ATM or POS terminal',
              'CEMCS MFB Verve Card keeps you on the move and protected 24/7',
              'Accepted at all Verve-enabled ATMs and POS terminals across Nigeria',
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
          <p class="label" style="margin-bottom:var(--s2);">Card Type</p>
          <p style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;color:var(--txt-1);margin-bottom:var(--s4);">CEMCS MFB Verve Card</p>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);">For card enquiries, visit any of our branches or call +234 808 799 5012</p>
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
        ['Mobile Banking','/mobile-banking'],
        ['Instant Payment','/instant-payment'],
        ['Payments & Deposits','/payments-deposits'],
      ] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
