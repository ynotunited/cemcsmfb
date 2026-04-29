<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation:pulse 2s infinite;"></span>
          <span class="label">E-Banking</span>
        </div>
        <h1 class="page-title reveal d1">Mobile<br/><span class="text-gradient">Banking</span></h1>
      </div>
      <p class="page-desc">Your CEMCS MFB account is accessible from your mobile phone — free, fast and secure.</p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About Mobile Banking</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Bank anywhere, anytime — completely free.</h2>
        <p class="body-lg" style="margin-bottom:var(--s8);">
          CEMCS MFB Mobile Banking App is FREE. Every client can perform all available transactions free of charge. The app is fast, secure and convenient, enabling you to execute basic banking transactions from your CEMCS MFB bank account through your mobile phone.
        </p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="https://play.google.com/store/apps/details?id=com.cemcsmfb.cemcsmfbmobile" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Download the App</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Getting Started -->
        <div style="margin-top:var(--s10);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">Getting Started</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php $steps = [
              'Contact our office directly',
              'Download the form or get it from our branches',
              'Complete the form and drop it at our office',
              'Download CEMCS Mobile App, activate your account and start transacting',
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

        <!-- Features card -->
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Features</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php $items = [
              'Send and receive money',
              'Transfer funds',
              'Loan repayment',
              'Bill payment',
              'Airtime top-up',
              'Mini-statement',
              'Balance enquiry',
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
              'Your account is accessible 24/7 from your phone',
              'Your mobile app is password secured, preventing unauthorized use',
              'All transactions are authorized via your private PIN',
              'Pay your bills directly from your bank account',
              'View statement anytime, anywhere',
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
        ['Instant Payment','/instant-payment'],
        ['Payments & Deposits','/payments-deposits'],
      ] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
