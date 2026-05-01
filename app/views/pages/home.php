
<!-- ═══════════════════════════════════════
   HERO SLIDER
═══════════════════════════════════════ -->
<?php
$hero_slides = [
  [
    // Cheerful African American woman at ATM with credit card — account / banking
    'image'    => 'https://images.unsplash.com/photo-1531746790731-6c087fecd65a?w=1600&q=80&auto=format&fit=crop',
    'badge'    => 'CBN Licensed · NDIC Insured · Tier 1 MFB',
    'title'    => 'Banking built for<br/><span class="hs-blue">every</span> Nigerian.',
    'desc'     => 'From Chevron employees to small businesses and the wider community — CEMCS MFB delivers loans, savings, and digital banking that works for you.',
    'cta_primary_label' => 'Open a Free Account',
    'cta_primary_href'  => 'https://cemcsmfb.qoreonline.com/dashboard/home',
    'cta_primary_ext'   => true,
    'cta_ghost_label'   => 'Apply for a Loan',
    'cta_ghost_href'    => APP_URL . '/loans',
  ],
  [
    // Black woman holding credit card and smartphone — savings / digital payments
    'image'    => 'https://images.unsplash.com/photo-1607863680198-23d4b2565df0?w=1600&q=80&auto=format&fit=crop',
    'badge'    => 'Up to 18% p.a. · Zero Fees on Member Transfers',
    'title'    => 'Save smarter.<br/><span class="hs-blue">Earn</span> more.',
    'desc'     => 'Six account types designed to match every savings goal — from everyday transactions to long-term fixed deposits earning up to 18% p.a.',
    'cta_primary_label' => 'Explore Accounts',
    'cta_primary_href'  => APP_URL . '/personal',
    'cta_primary_ext'   => false,
    'cta_ghost_label'   => 'Open Fixed Deposit',
    'cta_ghost_href'    => APP_URL . '/fixed-deposit',
  ],
  [
    // Black man smiling in suit — professional / loan (photo by Oladimeji Odunsi)
    'image'    => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1600&q=80&auto=format&fit=crop&fp-x=0.5&fp-y=0.35',
    'badge'    => '24-Hour Approval · Salary-Backed Loans Up to ₦10M',
    'title'    => 'The right loan<br/>for <span class="hs-blue">every</span> need.',
    'desc'     => 'Seven specialised loan products for CNL employees, contract staff, Spy Police, and businesses — with disbursement in as little as 24 hours.',
    'cta_primary_label' => 'Apply for a Loan',
    'cta_primary_href'  => APP_URL . '/loans',
    'cta_primary_ext'   => false,
    'cta_ghost_label'   => 'View All Loans',
    'cta_ghost_href'    => APP_URL . '/loans',
  ],
  [
    // Black man looking at smartphone — mobile banking
    'image'    => 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?w=1600&q=80&auto=format&fit=crop',
    'badge'    => 'Free Mobile App · NIBSS Instant Payments',
    'title'    => 'Bank from anywhere,<br/><span class="hs-blue">any time.</span>',
    'desc'     => 'Free mobile banking, NIBSS instant payments, Verve debit cards, and convenient cash deposit channels — all in one seamless experience.',
    'cta_primary_label' => 'Get the App',
    'cta_primary_href'  => 'https://play.google.com/store/apps/details?id=com.cemcsmfb.cemcsmfbmobile',
    'cta_primary_ext'   => true,
    'cta_ghost_label'   => 'Learn More',
    'cta_ghost_href'    => APP_URL . '/mobile-banking',
  ],
];
?>

<section class="hero-slider" id="heroSlider" aria-label="Hero slideshow">

  <!-- Slides -->
  <div class="hs-track" id="hsTrack">
    <?php foreach ($hero_slides as $i => $slide): ?>
    <div class="hs-slide<?= $i === 0 ? ' is-active' : '' ?>" data-index="<?= $i ?>" aria-hidden="<?= $i === 0 ? 'false' : 'true' ?>">
      <!-- Background image -->
      <div class="hs-bg" style="background-image:url('<?= htmlspecialchars($slide['image']) ?>')"></div>
      <div class="hs-overlay"></div>

      <!-- Content -->
      <div class="wrap hs-inner">
        <div class="hs-content">
          <div class="hs-badge">
            <span class="hs-badge-dot"></span>
            <span><?= htmlspecialchars($slide['badge']) ?></span>
          </div>
          <h1 class="hs-title"><?= $slide['title'] ?></h1>
          <p class="hs-desc"><?= htmlspecialchars($slide['desc']) ?></p>
          <div class="hs-actions">
            <a href="<?= htmlspecialchars($slide['cta_primary_href']) ?>"
               <?= $slide['cta_primary_ext'] ? 'target="_blank" rel="noopener"' : '' ?>
               class="btn btn-primary btn-lg">
              <span class="btn-label"><?= htmlspecialchars($slide['cta_primary_label']) ?></span>
            </a>
            <a href="<?= htmlspecialchars($slide['cta_ghost_href']) ?>"
               class="btn hs-ghost-btn btn-lg">
              <span class="btn-label"><?= htmlspecialchars($slide['cta_ghost_label']) ?></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <button class="hs-arrow hs-prev" id="hsPrev" type="button" aria-label="Previous slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <button class="hs-arrow hs-next" id="hsNext" type="button" aria-label="Next slide">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
  </button>

  <!-- Dots -->
  <div class="hs-dots" role="tablist" aria-label="Slide navigation">
    <?php foreach ($hero_slides as $i => $slide): ?>
    <button class="hs-dot<?= $i === 0 ? ' is-active' : '' ?>"
            type="button"
            role="tab"
            aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"
            aria-label="Go to slide <?= $i + 1 ?>"
            data-index="<?= $i ?>"></button>
    <?php endforeach; ?>
  </div>

  <!-- Progress bar -->
  <div class="hs-progress" aria-hidden="true">
    <div class="hs-progress-bar" id="hsProgressBar"></div>
  </div>


</section>

<style>
/* ═══════════════════════════════════════
   HERO SLIDER
═══════════════════════════════════════ */
.hero-slider {
  position: relative;
  width: 100%;
  height: 100vh;
  min-height: 600px;
  max-height: 900px;
  overflow: hidden;
  background: var(--n-900);
}

/* Track & slides */
.hs-track {
  position: relative;
  width: 100%;
  height: 100%;
}
.hs-slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: opacity 0.8s var(--ease-o);
  pointer-events: none;
}
.hs-slide.is-active {
  opacity: 1;
  pointer-events: auto;
}

/* Background image */
.hs-bg {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  transform: scale(1.06);
  transition: transform 6s linear;
}
.hs-slide.is-active .hs-bg {
  transform: scale(1);
}

/* Dark overlay */
.hs-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    105deg,
    rgba(5, 12, 28, 0.88) 0%,
    rgba(5, 12, 28, 0.70) 50%,
    rgba(5, 12, 28, 0.45) 100%
  );
}

/* Inner content layout */
.hs-inner {
  position: relative;
  z-index: 2;
  height: 100%;
  display: flex;
  align-items: center;
  padding-top: calc(var(--nav-h) + var(--s12));
  padding-bottom: var(--s20);
}
.hs-content {
  max-width: 640px;
}

/* Badge */
.hs-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--s2);
  background: rgba(255,255,255,.1);
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 999px;
  padding: 6px 14px;
  margin-bottom: var(--s6);
  backdrop-filter: blur(6px);
  opacity: 0;
  transform: translateY(12px);
  transition: opacity 0.5s var(--ease) 0.1s, transform 0.5s var(--ease) 0.1s;
}
.hs-slide.is-active .hs-badge {
  opacity: 1;
  transform: translateY(0);
}
.hs-badge-dot {
  width: 6px;
  height: 6px;
  background: #4ade80;
  border-radius: 50%;
  flex-shrink: 0;
}
.hs-badge span:last-child {
  font-family: var(--f-mono);
  font-size: var(--t-xs);
  color: rgba(255,255,255,.85);
  letter-spacing: .08em;
  text-transform: uppercase;
}

/* Title */
.hs-title {
  font-family: var(--f-display);
  font-size: clamp(36px, 5.5vw, 72px);
  font-weight: 800;
  line-height: var(--lh-tight);
  letter-spacing: -.03em;
  color: #fff;
  margin-bottom: var(--s5);
  text-shadow: 0 2px 16px rgba(0,0,0,0.45);
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s var(--ease) 0.22s, transform 0.55s var(--ease) 0.22s;
}
.hs-slide.is-active .hs-title {
  opacity: 1;
  transform: translateY(0);
}
.hs-blue { color: #60a5fa; }

/* Description */
.hs-desc {
  font-size: var(--t-md);
  line-height: var(--lh-relaxed);
  color: rgba(255,255,255,.9);
  margin-bottom: var(--s8);
  max-width: 520px;
  text-shadow: 0 1px 8px rgba(0,0,0,0.5);
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s var(--ease) 0.34s, transform 0.55s var(--ease) 0.34s;
}
.hs-slide.is-active .hs-desc {
  opacity: 1;
  transform: translateY(0);
}

/* CTA buttons */
.hs-actions {
  display: flex;
  gap: var(--s3);
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.55s var(--ease) 0.44s, transform 0.55s var(--ease) 0.44s;
}
.hs-slide.is-active .hs-actions {
  opacity: 1;
  transform: translateY(0);
}
.hs-ghost-btn {
  background: rgba(255,255,255,.1) !important;
  border: 1px solid rgba(255,255,255,.3) !important;
  color: #fff !important;
  backdrop-filter: blur(4px);
}
.hs-ghost-btn:hover {
  background: rgba(255,255,255,.2) !important;
}
.hs-ghost-btn .btn-label {
  color: #fff !important;
}

/* Arrow buttons */
.hs-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.2);
  color: #fff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(6px);
  transition: background var(--t-fast) var(--ease-o), transform var(--t-fast) var(--ease-o);
}
.hs-arrow:hover {
  background: rgba(255,255,255,.25);
  transform: translateY(-50%) scale(1.08);
}
.hs-prev { left: var(--s6); }
.hs-next { right: var(--s6); }

/* Dots */
.hs-dots {
  position: absolute;
  bottom: 32px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
  display: flex;
  gap: var(--s2);
}
.hs-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,.35);
  border: none;
  cursor: pointer;
  padding: 0;
  transition: background var(--t-base) var(--ease-o), width var(--t-base) var(--ease-o), border-radius var(--t-base) var(--ease-o);
}
.hs-dot.is-active {
  background: #fff;
  width: 28px;
  border-radius: 4px;
}

/* Progress bar */
.hs-progress {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: rgba(255,255,255,.15);
  z-index: 10;
}
.hs-progress-bar {
  height: 100%;
  background: var(--brand-blue);
  width: 0%;
  transition: width linear;
}

/* Responsive */
@media (max-width: 768px) {
  .hs-inner {
    padding-bottom: var(--s16);
  }
  .hs-arrow { display: none; }
  .hs-dots { bottom: 24px; }
}
</style>

<script>
(function () {
  const SLIDE_DURATION = 6000; // ms per slide
  const slides  = document.querySelectorAll('.hs-slide');
  const dots    = document.querySelectorAll('.hs-dot');
  const prevBtn = document.getElementById('hsPrev');
  const nextBtn = document.getElementById('hsNext');
  const bar     = document.getElementById('hsProgressBar');

  if (!slides.length) return;

  let current  = 0;
  let timer    = null;
  let barTimer = null;

  function goTo(index) {
    // Deactivate current
    slides[current].classList.remove('is-active');
    slides[current].setAttribute('aria-hidden', 'true');
    dots[current].classList.remove('is-active');
    dots[current].setAttribute('aria-selected', 'false');

    current = (index + slides.length) % slides.length;

    // Activate new
    slides[current].classList.add('is-active');
    slides[current].setAttribute('aria-hidden', 'false');
    dots[current].classList.add('is-active');
    dots[current].setAttribute('aria-selected', 'true');

    resetProgress();
  }

  function resetProgress() {
    clearTimeout(barTimer);
    if (bar) {
      bar.style.transition = 'none';
      bar.style.width = '0%';
      // Force reflow
      bar.offsetWidth;
      bar.style.transition = 'width ' + SLIDE_DURATION + 'ms linear';
      bar.style.width = '100%';
    }
  }

  function startAuto() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), SLIDE_DURATION);
  }

  function restartAuto() {
    clearInterval(timer);
    startAuto();
  }

  // Arrow controls
  if (prevBtn) prevBtn.addEventListener('click', () => { goTo(current - 1); restartAuto(); });
  if (nextBtn) nextBtn.addEventListener('click', () => { goTo(current + 1); restartAuto(); });

  // Dot controls
  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => { goTo(i); restartAuto(); });
  });

  // Touch / swipe support
  let touchStartX = 0;
  const track = document.getElementById('hsTrack');
  if (track) {
    track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', e => {
      const diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) {
        goTo(diff > 0 ? current + 1 : current - 1);
        restartAuto();
      }
    }, { passive: true });
  }

  // Pause on hover
  const slider = document.getElementById('heroSlider');
  if (slider) {
    slider.addEventListener('mouseenter', () => clearInterval(timer));
    slider.addEventListener('mouseleave', () => startAuto());
  }

  // Keyboard navigation
  document.addEventListener('keydown', e => {
    if (e.key === 'ArrowLeft')  { goTo(current - 1); restartAuto(); }
    if (e.key === 'ArrowRight') { goTo(current + 1); restartAuto(); }
  });

  // Kick off
  resetProgress();
  startAuto();
})();
</script>

<!-- MARQUEE -->
<div class="marquee-wrap">
  <div class="marquee-track" aria-hidden="true">
    <div class="marquee-item"><span class="marquee-pip"></span>CBN Licensed</div>
    <div class="marquee-item"><span class="marquee-pip"></span>NDIC Insured Deposits</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Tier 1 Microfinance Bank</div>
    <div class="marquee-item"><span class="marquee-pip"></span>24-Hour Loan Approval</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Up to 18% p.a. Savings Rate</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Zero Fees on Member Transfers</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Annual Cooperative Dividends</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Salary-Backed Loans Up to ₦10M</div>
    <div class="marquee-item"><span class="marquee-pip"></span>ISO 9001:2015 Certified</div>
    <div class="marquee-item"><span class="marquee-pip"></span>CBN Licensed</div>
    <div class="marquee-item"><span class="marquee-pip"></span>NDIC Insured Deposits</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Tier 1 Microfinance Bank</div>
    <div class="marquee-item"><span class="marquee-pip"></span>24-Hour Loan Approval</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Up to 18% p.a. Savings Rate</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Zero Fees on Member Transfers</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Annual Cooperative Dividends</div>
    <div class="marquee-item"><span class="marquee-pip"></span>Salary-Backed Loans Up to ₦10M</div>
    <div class="marquee-item"><span class="marquee-pip"></span>ISO 9001:2015 Certified</div>
  </div>
</div>

<!-- ═══════════════════════════════════════
   WHO WE SERVE
═══════════════════════════════════════ -->
<section class="section" style="background:var(--surface);border-bottom:1px solid var(--border);">
  <div class="wrap">
    <div class="feat-head reveal">
      <div>
        <p class="label" style="margin-bottom:var(--s3);">Who We Serve</p>
        <h2 class="h-lg">Financial services for<br/>every segment.</h2>
      </div>
      <p class="body-lg">Incorporated in 2009 and operational since 2012, CEMCS MFB serves Chevron employees, contractors, security personnel, corporate companies, and the wider community across Lagos State.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:var(--s4);margin-top:var(--s10);" class="reveal d1">
      <?php
      $segments = [
        ['CNL Employees', 'Exclusive salary-backed loans, education support, and the 10-14-24 No Story Loan.', '<path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
        ['Contract Staff', 'Home improvement, micro housing, and target loans with salary domiciliation.', '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>'],
        ['Spy Police', 'Dedicated Spy Police Special Loan, micro housing, and target salary advances.', '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
        ['Businesses', 'Short-term loans, overdraft facilities, and corporate account services.', '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
      ];
      foreach ($segments as $seg): ?>
      <div style="background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6);transition:box-shadow var(--t-base) var(--ease-o),transform var(--t-base) var(--ease-o);" onmouseenter="this.style.boxShadow='var(--s-3)';this.style.transform='translateY(-3px)'" onmouseleave="this.style.boxShadow='';this.style.transform=''">
        <div style="width:40px;height:40px;background:var(--brand-blue-light);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;color:var(--brand-blue);margin-bottom:var(--s4);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?= $seg[2] ?></svg>
        </div>
        <div style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;color:var(--txt-1);margin-bottom:var(--s2);"><?= htmlspecialchars($seg[0]) ?></div>
        <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);"><?= htmlspecialchars($seg[1]) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   DEPOSIT PRODUCTS
═══════════════════════════════════════ -->
<section class="section">
  <div class="wrap">
    <div class="feat-head reveal">
      <div>
        <p class="label" style="margin-bottom:var(--s3);">Deposit Products</p>
        <h2 class="h-lg">Save smarter.<br/>Earn more.</h2>
      </div>
      <p class="body-lg">Six account types designed to match every savings goal — from everyday transactions to long-term fixed deposits earning up to 18% p.a.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--s4);margin-top:var(--s10);" class="reveal d1">
      <?php
      $accounts = [
        ['Current Account',           '/current-account',    'Day-to-day transactions, cheque book, standing orders and zero COT.',                    '0',     'Opening Balance'],
        ['Savings Account',           '/savings-account',    'Earn 4.2% p.a. with free mobile banking, ATM card and instant transfers.',               '4.2%',  'Interest p.a.'],
        ['Cash Plan Savings',         '/cashplan-savings',   'Save toward a future goal and earn up to 5% p.a. after 9 months.',                       '5%',    'Special Rate p.a.'],
        ['Fixed Deposit',             '/fixed-deposit',      'Lock in ₦30,000+ for 30–360 days at negotiable competitive rates.',                      '30K',   'Minimum Amount'],
        ['Joint Savings Account',     '/joint-savings',      'Save together with a spouse, friend or group toward shared financial goals.',             '2+',    'Account Holders'],
        ['Smart Salary Account',      '/smart-salary',       'Receive your salary, manage payments and access all banking services — zero opening balance.', '₦0', 'Opening Balance'],
      ];
      foreach ($accounts as [$title, $path, $desc, $stat, $statLabel]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6);text-decoration:none;transition:box-shadow var(--t-base) var(--ease-o),transform var(--t-base) var(--ease-o),border-color var(--t-base) var(--ease-o);" onmouseenter="this.style.boxShadow='var(--s-3)';this.style.transform='translateY(-3px)';this.style.borderColor='var(--brand-blue-mid)'" onmouseleave="this.style.boxShadow='';this.style.transform='';this.style.borderColor='var(--border)'">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:var(--s4);">
          <div style="font-family:var(--f-display);font-size:var(--t-base);font-weight:700;color:var(--txt-1);letter-spacing:-.01em;"><?= htmlspecialchars($title) ?></div>
          <div style="text-align:right;flex-shrink:0;margin-left:var(--s3);">
            <div style="font-family:var(--f-display);font-size:var(--t-xl);font-weight:800;color:var(--brand-blue);letter-spacing:-.02em;line-height:1;"><?= $stat ?></div>
            <div style="font-family:var(--f-mono);font-size:9px;color:var(--txt-3);letter-spacing:.06em;text-transform:uppercase;margin-top:2px;"><?= $statLabel ?></div>
          </div>
        </div>
        <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s4);"><?= htmlspecialchars($desc) ?></p>
        <span style="font-family:var(--f-mono);font-size:var(--t-xs);color:var(--brand-blue);font-weight:500;letter-spacing:.06em;">Learn more →</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   LOAN PRODUCTS
═══════════════════════════════════════ -->
<section class="section" style="background:var(--n-900);">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s16);align-items:end;margin-bottom:var(--s12);">
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">Loan Products</p>
        <h2 class="h-lg" style="color:var(--n-0);">The right loan<br/>for every need.</h2>
      </div>
      <p class="body-lg reveal d1" style="color:rgba(255,255,255,.5);">Seven specialised loan products covering CNL employees, contract staff, Spy Police, and corporate companies — with disbursement in as little as 24 hours.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:var(--s3);" class="reveal d1">
      <?php
      $loans = [
        ['10-14-24 No Story Loan',    '/loan-no-story',         'CNL Employees',                    '24h'],
        ['Home Improvement Loan',     '/loan-home-improvement', 'CNL & Contract Staff',             'Flexible'],
        ['Micro Housing Loan',        '/loan-housing',          'Contract Staff & Spy Police',      'Affordable'],
        ['Education Support Loan',    '/loan-education',        'CNL Employees',                    'Fast'],
        ['Target Loans & Advances',   '/loan-target',           'Contract Staff & Spy Police',      'Salary-backed'],
        ['Spy Police Special Loan',   '/loan-spy-police',       'Spy Police Only',                  'Exclusive'],
        ['Short Term / Overdraft',    '/loan-short-term',       'Corporate Companies',              'Working Capital'],
        ['Apply for a Loan',          '/loans',                 'Start your application today',     '→'],
      ];
      foreach ($loans as $i => [$title, $path, $who, $tag]):
        $isApply = $i === 7;
      ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:<?= $isApply ? 'var(--brand-blue)' : 'rgba(255,255,255,.05)' ?>;border:1px solid <?= $isApply ? 'var(--brand-blue)' : 'rgba(255,255,255,.08)' ?>;border-radius:var(--r-md);padding:var(--s5);text-decoration:none;transition:background var(--t-fast) var(--ease-o),border-color var(--t-fast) var(--ease-o);" onmouseenter="this.style.background='<?= $isApply ? 'var(--brand-blue-dark)' : 'rgba(255,255,255,.1)' ?>'" onmouseleave="this.style.background='<?= $isApply ? 'var(--brand-blue)' : 'rgba(255,255,255,.05)' ?>'">
        <div style="font-family:var(--f-mono);font-size:var(--t-xs);color:<?= $isApply ? 'rgba(255,255,255,.7)' : 'var(--brand-blue)' ?>;letter-spacing:.08em;text-transform:uppercase;margin-bottom:var(--s2);"><?= htmlspecialchars($tag) ?></div>
        <div style="font-family:var(--f-display);font-size:var(--t-base);font-weight:700;color:var(--n-0);letter-spacing:-.01em;margin-bottom:var(--s2);line-height:var(--lh-snug);"><?= htmlspecialchars($title) ?></div>
        <div style="font-size:var(--t-xs);color:rgba(255,255,255,.4);"><?= htmlspecialchars($who) ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   STATS BAND
═══════════════════════════════════════ -->
<section class="section-sm">
  <div class="wrap">
    <div class="stats-band reveal">
      <div><div class="stat-mark"></div><div class="stat-num">₦4.2<b>B</b></div><div class="stat-lbl">Total loans disbursed</div></div>
      <div><div class="stat-mark"></div><div class="stat-num">18<b>K</b></div><div class="stat-lbl">Active members</div></div>
      <div><div class="stat-mark"></div><div class="stat-num">18<b>%</b></div><div class="stat-lbl">Maximum savings yield</div></div>
      <div><div class="stat-mark"></div><div class="stat-num">24<b>h</b></div><div class="stat-lbl">Loan disbursement SLA</div></div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   E-BANKING
═══════════════════════════════════════ -->
<section class="section" style="background:var(--surface);border-top:1px solid var(--border);">
  <div class="wrap">
    <div class="feat-head reveal">
      <div>
        <p class="label" style="margin-bottom:var(--s3);">E-Banking</p>
        <h2 class="h-lg">Bank from anywhere,<br/>at any time.</h2>
      </div>
      <p class="body-lg">Free mobile banking, NIBSS instant payments, Verve debit cards, and convenient cash deposit channels — all designed for a cashless, seamless experience.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:var(--s4);margin-top:var(--s10);" class="reveal d1">
      <?php
      $ebanking = [
        ['Mobile Banking',      '/mobile-banking',      'Free app for iOS & Android. Transfers, bill payments, airtime top-up and more.',  '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/>'],
        ['Debit Cards',         '/debit-cards',         'CEMCS MFB Verve Card accepted at all ATMs and POS terminals nationwide.',          '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>'],
        ['Instant Payment',     '/instant-payment',     'NIBSS NIP — send money from any Nigerian bank to your CEMCS MFB account instantly.','<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'],
        ['Payments & Deposits', '/payments-deposits',   'Transfer funds to any commercial bank in Nigeria. Fast, low-cost and secure.',      '<path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>'],
      ];
      foreach ($ebanking as [$title, $path, $desc, $icon]): ?>
      <a href="<?= APP_URL . $path ?>" style="display:block;background:var(--n-50);border:1px solid var(--border);border-radius:var(--r-lg);padding:var(--s6);text-decoration:none;transition:box-shadow var(--t-base) var(--ease-o),transform var(--t-base) var(--ease-o),border-color var(--t-base) var(--ease-o);" onmouseenter="this.style.boxShadow='var(--s-3)';this.style.transform='translateY(-3px)';this.style.borderColor='var(--brand-blue-mid)'" onmouseleave="this.style.boxShadow='';this.style.transform='';this.style.borderColor='var(--border)'">
        <div style="width:44px;height:44px;background:var(--brand-blue-light);border-radius:var(--r-md);display:flex;align-items:center;justify-content:center;color:var(--brand-blue);margin-bottom:var(--s4);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?= $icon ?></svg>
        </div>
        <div style="font-family:var(--f-display);font-size:var(--t-lg);font-weight:700;letter-spacing:-.01em;color:var(--txt-1);margin-bottom:var(--s2);"><?= htmlspecialchars($title) ?></div>
        <p style="font-size:var(--t-sm);color:var(--txt-2);line-height:var(--lh-relaxed);margin-bottom:var(--s4);"><?= htmlspecialchars($desc) ?></p>
        <span style="font-family:var(--f-mono);font-size:var(--t-xs);color:var(--brand-blue);font-weight:500;letter-spacing:.06em;">Learn more →</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   VISION & MISSION
═══════════════════════════════════════ -->
<section class="section-sm" style="background:var(--n-900);">
  <div class="wrap">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s12);">
      <div class="reveal">
        <div style="width:40px;height:2px;background:var(--brand-blue);margin-bottom:var(--s6);"></div>
        <p class="label" style="margin-bottom:var(--s3);">Our Vision</p>
        <p style="font-size:var(--t-lg);line-height:var(--lh-relaxed);color:rgba(255,255,255,.7);">To significantly improve the economic base of micro, small and medium scale businesses, Chevron employees, contractors within the Chevron community and environs.</p>
      </div>
      <div class="reveal d1">
        <div style="width:40px;height:2px;background:var(--brand-red);margin-bottom:var(--s6);"></div>
        <p class="label" style="margin-bottom:var(--s3);">Our Mission</p>
        <p style="font-size:var(--t-lg);line-height:var(--lh-relaxed);color:rgba(255,255,255,.7);">To provide sound Microfinance banking services to the unbanked economically active people through increased access to savings and lending services using excellent customer service delivery with cost-efficient methodologies.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   HOW IT WORKS
═══════════════════════════════════════ -->
<section class="section">
  <div class="wrap">
    <div class="how-grid">
      <div class="reveal">
        <p class="label" style="margin-bottom:var(--s3);">Getting Started</p>
        <h2 class="h-lg" style="margin-bottom:var(--s4);">Up and running in three steps.</h2>
        <p class="body-lg" style="margin-bottom:var(--s10);">Account opening takes under five minutes. You need your staff ID, BVN, and a valid government-issued ID.</p>
        <div class="steps">
          <div class="step">
            <div class="step-index-col"><div class="step-num">01</div><div class="step-line"></div></div>
            <div class="step-body"><div class="step-title">Create your account</div><p class="step-desc">Complete the online form or visit any branch. Staff ID verification confirms your eligibility in under two minutes.</p></div>
          </div>
          <div class="step">
            <div class="step-index-col"><div class="step-num">02</div><div class="step-line"></div></div>
            <div class="step-body"><div class="step-title">Fund your account</div><p class="step-desc">Transfer funds or set up a salary deduction. Minimum opening balance is ₦5,000. Funds reflect immediately.</p></div>
          </div>
          <div class="step">
            <div class="step-index-col"><div class="step-num">03</div></div>
            <div class="step-body"><div class="step-title">Access all services</div><p class="step-desc">Apply for loans, open fixed deposits, and manage cooperative shares from the app or web portal.</p></div>
          </div>
        </div>
        <div style="margin-top:var(--s10);display:flex;gap:var(--s3);flex-wrap:wrap;">
          <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg"><span class="btn-label">Open a Free Account</span></a>
          <a href="<?= APP_URL ?>/forms" class="btn btn-ghost btn-lg"><span class="btn-label">Download Forms</span></a>
        </div>
      </div>
      <div class="phone reveal d2">
        <div class="phone-top">
          <div><div class="phone-greeting">Good morning,</div><div class="phone-name">Adeyemi Olatunde</div></div>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" color="var(--txt-3)"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/></svg>
        </div>
        <div class="phone-bal-band">
          <div class="pbb-label">Total Balance</div>
          <div class="pbb-amount">₦2,485,000</div>
          <div class="pbb-note">Last updated 28 Dec 2024</div>
        </div>
        <div class="phone-actions">
          <div class="p-action"><div class="p-act-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg></div><div class="p-act-label">Send</div></div>
          <div class="p-action"><div class="p-act-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg></div><div class="p-act-label">Receive</div></div>
          <div class="p-action"><div class="p-act-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div><div class="p-act-label">Cards</div></div>
          <div class="p-action"><div class="p-act-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg></div><div class="p-act-label">More</div></div>
        </div>
        <div class="phone-txs-head"><span class="tx-panel-title">Transactions</span><a href="#" class="tx-link">See all</a></div>
        <div class="tx-row"><div class="tx-row-left"><div class="tx-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div><div><div class="tx-name">Salary Credit</div><div class="tx-meta">28 Dec · Chevron Nigeria</div></div></div><div class="tx-amt cr">+₦850,000</div></div>
        <div class="tx-row"><div class="tx-row-left"><div class="tx-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div><div><div class="tx-name">Loan Repayment</div><div class="tx-meta">27 Dec · Auto-debit</div></div></div><div class="tx-amt dr">-₦45,000</div></div>
        <div class="tx-row"><div class="tx-row-left"><div class="tx-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div><div><div class="tx-name">Dividend Payout</div><div class="tx-meta">26 Dec · Cooperative</div></div></div><div class="tx-amt cr">+₦22,500</div></div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════
   CTA
═══════════════════════════════════════ -->
<section class="section-sm">
  <div class="wrap">
    <div class="cta-band reveal">
      <p class="label" style="color:rgba(255,255,255,.35);margin-bottom:var(--s4);">Get Started</p>
      <h2 class="h-lg">Ready to take control<br/>of your finances?</h2>
      <p class="body-lg">Join over 18,000 members banking with CEMCS MFB. Open your account online in minutes.</p>
      <div style="margin-top:var(--s8);display:flex;gap:var(--s3);justify-content:center;flex-wrap:wrap;">
        <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-lg"><span class="btn-label">Open an Account</span></a>
        <a href="<?= APP_URL ?>/contact" class="btn btn-ghost btn-lg" style="color:#fff;border-color:rgba(255,255,255,.2);"><span class="btn-label">Talk to Us</span></a>
      </div>
      <p class="cta-caveat">CBN Licensed · NDIC Insured · ISO 9001:2015 Certified</p>
    </div>
  </div>
</section>

<style>
  @media (max-width: 1024px) {
    section > .wrap > div[style*="grid-template-columns:repeat(4,1fr)"] { grid-template-columns: repeat(2,1fr) !important; }
    section > .wrap > div[style*="grid-template-columns:repeat(3,1fr)"] { grid-template-columns: repeat(2,1fr) !important; }
  }
  @media (max-width: 640px) {
    section > .wrap > div[style*="grid-template-columns:repeat(4,1fr)"] { grid-template-columns: 1fr !important; }
    section > .wrap > div[style*="grid-template-columns:repeat(3,1fr)"] { grid-template-columns: 1fr !important; }
    section > .wrap > div[style*="grid-template-columns:repeat(2,1fr)"] { grid-template-columns: 1fr !important; }
  }
</style>
