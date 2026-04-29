<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Deposit Products</span>
        </div>
        <h1 class="page-title reveal d1">Smart Salary<br/><span class="text-gradient">Account</span></h1>
      </div>
      <p class="page-desc">Designed for personal and third-party day-to-day transactions with unlimited access to your money.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Account</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Your salary. Your account. Your freedom.</h2>
        <p class="body-lg" style="margin-bottom:var(--s6);">CEMCS MFB Smart Salary Account provides you with unlimited access to your money at all times. You can manage your business, execute your payments and receive your salary through this account. It is available to both individuals and corporate bodies.</p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;margin-top:var(--s8);">
          <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Open an Account</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Zero balance highlight -->
        <div style="margin-top:var(--s8);background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s6);">
          <p class="label" style="margin-bottom:var(--s2);">Key Highlight</p>
          <div style="font-family:var(--f-display);font-size:var(--t-2xl);font-weight:800;color:var(--brand-blue);letter-spacing:-.02em;">Zero Opening Balance</div>
          <p style="font-size:var(--t-sm);color:var(--brand-blue-dark);margin-top:var(--s2);">Open your account with no minimum deposit required.</p>
        </div>

        <!-- Requirements -->
        <div style="margin-top:var(--s10);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">Requirements</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php foreach ([
              'Copies of acceptable means of identification (Driver\'s Licence, International Passport, National ID Card, or any other acceptable identification document)',
              'Two passport photographs',
              'Two (2) duly completed and suitable reference forms',
              'Utility bill issued within the last 3 months',
            ] as $req): ?>
            <div style="display:flex;gap:var(--s3);align-items:flex-start;">
              <div style="width:20px;height:20px;background:var(--brand-blue-light);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <p style="font-size:var(--t-base);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($req) ?></p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="reveal d1">
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--s-2);">
          <div style="background:var(--brand-blue);padding:var(--s6) var(--s8);">
            <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;color:#fff;margin:0;">Features &amp; Benefits</h3>
          </div>
          <div style="padding:var(--s6) var(--s8);">
            <?php
            $features = [
              'Funds transfer to all commercial banks in Nigeria',
              'Internal transfers free of charge',
              'Encashment of cheques',
              'Standing order transfers and payments',
              'Free statement of account',
              'Transparent transactions',
              'Clearing cheque book',
              'SMS and email alerts',
              'Payment can be made from any commercial bank into your CEMCS account',
              'ATM Cards, Mobile and Internet Banking facilities available',
              'Allows monthly savings through salary standing order, cheque/cash lodgements and CEMCS deposit transfer',
              'Zero opening balance',
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

        <div style="margin-top:var(--s6);background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6) var(--s8);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s3);">How to Open</h3>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s5);">Download the Smart Salary Account Form, complete it, print and submit at our office — or open online.</p>
          <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
            <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary">Open Online</a>
            <a href="<?= APP_URL ?>/contact" class="btn btn-ghost">Visit a Branch</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="section-sm" style="background:var(--n-50);border-top:1px solid var(--border);">
  <div class="wrap">
    <p class="label" style="margin-bottom:var(--s4);">Other Deposit Products</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:var(--s3);">
      <?php foreach ([['Current Account','/current-account'],['Savings Account','/savings-account'],['Joint Savings Account','/joint-savings'],['Cash Plan Savings Account','/cashplan-savings'],['Fixed Deposit Account','/fixed-deposit']] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
