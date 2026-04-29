<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Deposit Products</span>
        </div>
        <h1 class="page-title reveal d1">Joint Savings<br/><span class="text-gradient">Account</span></h1>
      </div>
      <p class="page-desc">
        Aimed at satisfying spouses, friends, colleagues and groups with common financial goals.
      </p>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <!-- Left -->
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Account</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Save together toward a common goal.</h2>
        <p class="body-lg" style="margin-bottom:var(--s6);">
          The CEMCS MFB Joint Savings Account is designed for spouses, friends, colleagues and groups who share common financial objectives. It enables multiple account holders to pool resources, save collectively and work toward shared goals with full banking convenience.
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
              'Copies of acceptable means of identification for all account holders (Driver\'s Licence, International Passport, National ID Card, or any other acceptable identification document)',
              'Two passport photographs per account holder',
              'Two (2) duly completed and suitable reference forms',
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

        <!-- How to open -->
        <div style="margin-top:var(--s8);background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s3);">How to Open a Joint Savings Account</h3>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s5);">
            Download the Joint Savings Account Form, complete it with all account holders' details, print and submit at our office — or open online.
          </p>
          <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
            <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary">Open Online</a>
            <a href="<?= APP_URL ?>/contact" class="btn btn-ghost">Visit a Branch</a>
          </div>
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
              'Enables customers to save toward achieving common objectives',
              'Attractive interest rate on joint savings',
              'CEMCS MFB intra-account and interbank transfer facilities',
              'ATM Cards and Internet Banking facility available for all holders',
              'SMS and email alerts to all account stakeholders',
              'Allows monthly savings through salary standing order, cash lodgements and CEMCS deposit transfer',
              'Cash lodgement at any First Bank branch',
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

        <!-- Who is it for -->
        <div style="margin-top:var(--s6);background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;color:var(--brand-blue-dark);margin-bottom:var(--s4);">Who is this account for?</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php foreach (['Married couples saving for shared goals', 'Friends saving for a joint project or investment', 'Colleagues contributing to a group fund', 'Community groups and cooperative members'] as $who): ?>
            <div style="display:flex;gap:var(--s3);align-items:center;">
              <div style="width:6px;height:6px;background:var(--brand-blue);border-radius:50%;flex-shrink:0;"></div>
              <p style="font-size:var(--t-sm);color:var(--brand-blue-dark);font-weight:500;"><?= htmlspecialchars($who) ?></p>
            </div>
            <?php endforeach; ?>
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
        ['Savings Account',          '/savings-account'],
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
