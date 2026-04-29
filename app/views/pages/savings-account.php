<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Deposit Products</span>
        </div>
        <h1 class="page-title reveal d1">Savings<br/><span class="text-gradient">Account</span></h1>
      </div>
      <p class="page-desc">
        A secure and rewarding savings account designed to help you grow your money while keeping it accessible.
      </p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left: description + CTA -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Account</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Earn 4.2% p.a. while keeping your funds accessible.</h2>
        <p class="body-lg" style="margin-bottom:var(--s6);">
          The CEMCS MFB Savings Account is designed for individuals who want to save regularly and earn competitive interest on their deposits. With a minimum opening balance of just ₦1,000, it is accessible to everyone in the Chevron community and beyond.
        </p>
        <p class="body-lg" style="margin-bottom:var(--s6);">
          Enjoy all charge-free mobile banking services including instant fund transfer, bill payment, utility bills, school fees, airtime top-up, and balance enquiry.
        </p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;margin-top:var(--s8);">
          <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Open an Account</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Requirements -->
        <div style="margin-top:var(--s12);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">Requirements</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php
            $requirements = [
              'A valid means of identification (Driver\'s Licence, International Passport, National ID Card, or Permanent Voter\'s Card)',
              'Minimum opening balance of ₦1,000',
              'Two passport photographs',
              'Utility bill issued within the last 3 months',
            ];
            foreach ($requirements as $req): ?>
            <div style="display:flex;gap:var(--s3);align-items:flex-start;">
              <div style="width:20px;height:20px;background:var(--brand-blue-light);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-base);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($req) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Interest rate highlight -->
        <div style="margin-top:var(--s8);background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s6);">
          <p class="label" style="margin-bottom:var(--s2);">Current Interest Rate</p>
          <div style="font-family:var(--f-display);font-size:var(--t-4xl);font-weight:800;color:var(--brand-blue);letter-spacing:-.03em;line-height:1;">4.2%</div>
          <p style="font-size:var(--t-sm);color:var(--brand-blue-dark);margin-top:var(--s2);">Per annum on savings balance</p>
        </div>
      </div>

      <!-- Right: features & benefits -->
      <div class="reveal d1">
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Features &amp; Benefits</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php
            $features = [
              'Competitive interest rate of 4.2% per annum',
              'Minimum opening balance of ₦1,000',
              'Free mobile banking — instant transfers, bill payments, airtime top-up',
              'SMS and email transaction alerts',
              'ATM Card, Mobile and Internet Banking access',
              'Funds transfer to all commercial banks in Nigeria',
              'Internal transfers free of charge',
              'Free statement of account',
              'Deposits can be made from any commercial bank in Nigeria',
              'Zero COT (Cost of Transaction) on all transactions',
              'Transparent and straightforward account management',
            ];
            foreach ($features as $i => $feat): ?>
            <div style="display:flex;gap:var(--s4);align-items:flex-start;padding:var(--s3) 0;<?= $i < count($features) - 1 ? 'border-bottom:1px solid var(--border-sub);' : '' ?>">
              <div style="width:24px;height:24px;background:var(--brand-blue-light);border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($feat) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- How to open -->
        <div style="margin-top:var(--s6);background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s3);">How to Open a Savings Account</h3>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s5);">
            Open your account online in minutes or visit any of our branches with your valid ID and passport photograph.
          </p>
          <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
            <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary">Open Online</a>
            <a href="<?= APP_URL ?>/contact" class="btn btn-ghost">Visit a Branch</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- OTHER ACCOUNTS BAND -->
<section class="section-sm" style="background:var(--n-50);border-top:1px solid var(--border);">
  <div class="wrap">
    <p class="label" style="margin-bottom:var(--s4);">Other Deposit Products</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:var(--s3);">
      <?php
      $accounts = [
        ['Current Account',          '/current-account'],
        ['Joint Savings Account',    '/joint-savings'],
        ['Cash Plan Savings Account','/cashplan-savings'],
        ['Fixed Deposit Account',    '/fixed-deposit'],
        ['Smart Salary Account',     '/smart-salary'],
      ];
      foreach ($accounts as [$label, $path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;transition:border-color var(--t-fast) var(--ease-o),box-shadow var(--t-fast) var(--ease-o);" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
        <?= htmlspecialchars($label) ?> →
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  @media (max-width: 1024px) {
    section.section > .wrap > div[style*="grid-template-columns:1fr 1fr"] {
      grid-template-columns: 1fr !important;
    }
  }
</style>
