<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Deposit Products</span>
        </div>
        <h1 class="page-title reveal d1">Cash Plan Savings<br/><span class="text-gradient">Account</span></h1>
      </div>
      <p class="page-desc">Save toward a future target at a special interest rate of up to 5% p.a.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Account</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Plan your savings. Earn more interest.</h2>
        <p class="body-lg" style="margin-bottom:var(--s4);">The CEMCS MFB Cash Plan Savings Account enables you to save toward a future event or target at a special interest rate above the normal savings account rate.</p>
        <p class="body-lg" style="margin-bottom:var(--s6);">To enjoy the special interest rate of 5% p.a., the minimum savings period before withdrawal is 9 months. This account can also serve as collateral for a loan.</p>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;margin-top:var(--s8);">
          <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Open an Account</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Interest highlight -->
        <div style="margin-top:var(--s8);display:grid;grid-template-columns:1fr 1fr;gap:var(--s4);">
          <div style="background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-lg);padding:var(--s5) var(--s6);text-align:center;">
            <div style="font-family:var(--f-display);font-size:var(--t-4xl);font-weight:800;color:var(--brand-blue);letter-spacing:-.03em;line-height:1;">5%</div>
            <p style="font-size:var(--t-xs);font-family:var(--f-mono);color:var(--brand-blue-dark);text-transform:uppercase;letter-spacing:.08em;margin-top:var(--s2);">Special Rate p.a.</p>
          </div>
          <div style="background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s5) var(--s6);text-align:center;">
            <div style="font-family:var(--f-display);font-size:var(--t-4xl);font-weight:800;color:var(--txt-1);letter-spacing:-.03em;line-height:1;">9</div>
            <p style="font-size:var(--t-xs);font-family:var(--f-mono);color:var(--txt-3);text-transform:uppercase;letter-spacing:.08em;margin-top:var(--s2);">Months Min. Tenor</p>
          </div>
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
              'Allows monthly savings through salary standing order, cash lodgements and CEMCS deposit transfer',
              'Attracts special interest above normal savings account rate',
              'Can serve as collateral for a loan',
              'To enjoy the special interest of 5%, minimum savings period before withdrawal is 9 months',
              'SMS and email alerts available',
              'ATM Cards, Mobile and Internet Banking available',
              'Payment can be made from any commercial bank into your CEMCS account',
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
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s5);">Download the Savings Account Form, complete it, print and submit at our office — or open online.</p>
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
      <?php foreach ([['Current Account','/current-account'],['Savings Account','/savings-account'],['Joint Savings Account','/joint-savings'],['Fixed Deposit Account','/fixed-deposit'],['Smart Salary Account','/smart-salary']] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
