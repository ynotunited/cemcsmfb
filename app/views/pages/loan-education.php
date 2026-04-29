<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Loan Products</span>
        </div>
        <h1 class="page-title reveal d1">Education Support<br/><span class='text-gradient'>Loan</span></h1>
      </div>
      <p class="page-desc">Fund your education or your children's schooling. Exclusively for CNL employees.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:start;">

      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">About This Loan</p>
        <h2 class="h-lg" style="margin-bottom:var(--s6);">Invest in education without financial stress.</h2>
        <p class="body-lg" style="margin-bottom:var(--s6);">The CEMCS MFB Education Support Loan is exclusively for CNL employees. It provides financial support to cover school fees, educational materials, and other academic expenses for you or your dependants — ensuring that education is never put on hold due to financial constraints.</p>

        <!-- Eligibility -->
        <div style="display:inline-flex;align-items:center;gap:var(--s3);background:var(--brand-blue-light);border:1px solid var(--brand-blue-mid);border-radius:var(--r-md);padding:var(--s3) var(--s5);margin-bottom:var(--s8);">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--brand-blue)" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          <div>
            <div style="font-family:var(--f-mono);font-size:var(--t-xs);color:var(--brand-blue);letter-spacing:.08em;text-transform:uppercase;">Eligibility</div>
            <div style="font-size:var(--t-sm);font-weight:600;color:var(--brand-blue-dark);">CNL Employees Only</div>
          </div>
        </div>

        <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="<?= APP_URL ?>/loans" class="btn btn-primary btn-lg">Apply for a Loan</a>
          <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg">Contact Us</a>
        </div>

        <!-- Requirements -->
        <div style="margin-top:var(--s10);">
          <h3 style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s5);">Requirements</h3>
          <div style="display:flex;flex-direction:column;gap:var(--s3);">
            <?php foreach([
              'Completed loan application form',
              'Valid means of identification (Driver\'s Licence, International Passport, National ID Card)',
              'Two passport photographs',
              'Proof of employment / salary slip (last 3 months)',
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
              'Exclusively for CNL employees',
              'Cover school fees and educational expenses',
              'Available for self or dependants\' education',
              'Competitive interest rates',
              'Flexible repayment aligned with salary cycle',
              'Quick approval and disbursement',
              'No collateral required for eligible employees',
            ];
            foreach($features as $i => $feat): ?>
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
          <h3 style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;margin-bottom:var(--s3);">How to Apply</h3>
          <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s5);">Download the Loan Application Form, complete it, print and submit at our office — or apply online.</p>
          <div style="display:flex;gap:var(--s3);flex-wrap:wrap;">
            <a href="<?= APP_URL ?>/loans" class="btn btn-primary">Apply Online</a>
            <a href="<?= APP_URL ?>/contact" class="btn btn-ghost">Visit a Branch</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="section-sm" style="background:var(--n-50);border-top:1px solid var(--border);">
  <div class="wrap">
    <p class="label" style="margin-bottom:var(--s4);">Other Loan Products</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:var(--s3);">
      <?php foreach([
        ['10-14-24 No Story Loan','/loan-no-story'],
        ['Home Improvement Loan','/loan-home-improvement'],
        ['Micro Housing Loan','/loan-housing'],
        ['Education Support Loan','/loan-education'],
        ['Target Loans & Advances','/loan-target'],
        ['Spy Police Special Loan','/loan-spy-police'],
        ['Short Term/Overdraft','/loan-short-term'],
      ] as [$label,$path]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md);padding:var(--s4) var(--s5);font-size:var(--t-sm);font-weight:600;color:var(--txt-1);text-decoration:none;" onmouseenter="this.style.borderColor='var(--brand-blue)';this.style.boxShadow='var(--s-2)'" onmouseleave="this.style.borderColor='var(--border)';this.style.boxShadow='none'"><?= htmlspecialchars($label) ?> →</a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(max-width:1024px){section.section>.wrap>div[style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}}</style>
