<?php // app/views/layout.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Chevron CEMCS MFB — Financial Services for Chevron Employees') ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;1,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="<?= APP_URL ?>/assets/images/cemcs-logo-favicon.png">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/globals.css">
  <style>
    /* Button safety overrides so stale cached CSS cannot hide labels or add underlines. */
    .btn,
    .btn:link,
    .btn:visited,
    .btn:hover,
    .btn:focus,
    .btn:focus-visible,
    .btn:active {
      text-decoration: none !important;
    }
    .btn .btn-label {
      color: inherit !important;
      text-decoration: none !important;
      position: relative;
      z-index: 1;
    }
    .btn-primary,
    .btn-primary .btn-label {
      color: #fff !important;
    }
    .btn-ghost,
    .btn-ghost .btn-label {
      color: var(--brand-blue) !important;
    }
    .btn-outline,
    .btn-outline .btn-label {
      color: var(--txt-2) !important;
    }
  </style>
  <?php if (!empty($recaptcha_site_key) && $recaptcha_site_key !== 'YOUR_RECAPTCHA_SITE_KEY'): ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?= htmlspecialchars($recaptcha_site_key) ?>"></script>
  <?php endif; ?>
  <style>
    /* ── PAGE BODY OFFSET ────────────────────────────── */
    .app-main { padding-top: 0; }

    /* ── MOBILE NAV ──────────────────────────────────── */
    .mobile-menu-toggle {
      display: none;
      flex-direction: column;
      justify-content: center;
      gap: 5px;
      width: 40px;
      height: 40px;
      background: none;
      border: 1px solid var(--border);
      border-radius: var(--r-md);
      cursor: pointer;
      padding: 8px;
      flex-shrink: 0;
    }
    .mobile-menu-toggle span {
      display: block;
      width: 100%;
      height: 2px;
      background: var(--txt-1);
      border-radius: 2px;
      transition: transform 0.25s var(--ease-o), opacity 0.25s var(--ease-o);
    }
    .mobile-menu-toggle.is-open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .mobile-menu-toggle.is-open span:nth-child(2) { opacity: 0; }
    .mobile-menu-toggle.is-open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    @media (max-width: 900px) {
      .nav-links { display: none !important; }
      .mobile-menu-toggle { display: flex !important; }
    }

    /* Mobile menu sheet */
    .mobile-menu-overlay {
      position: fixed; inset: 0; background: rgba(15,13,11,.5);
      z-index: 200; opacity: 0; transition: opacity .3s var(--ease-o);
    }
    .mobile-menu-overlay.open { opacity: 1; }
    .mobile-menu-sheet {
      position: fixed; top: 0; right: 0; bottom: 0;
      width: min(340px, 92vw);
      background: var(--surface);
      z-index: 201;
      transform: translateX(100%);
      transition: transform .35s var(--ease);
      overflow-y: auto;
      box-shadow: var(--s-3);
    }
    .mobile-menu-sheet.open { transform: translateX(0); }
    .mobile-menu-shell { display: flex; flex-direction: column; min-height: 100%; }
    .mobile-menu-head {
      display: flex; justify-content: space-between; align-items: center;
      padding: var(--s5) var(--s6);
      border-bottom: 1px solid var(--border);
      position: sticky; top: 0; background: var(--surface); z-index: 1;
    }
    .mobile-menu-head h2 {
      font-family: var(--f-display); font-size: var(--t-xl);
      font-weight: 700; letter-spacing: -.01em; margin: 0;
    }
    .mobile-menu-kicker {
      font-family: var(--f-mono); font-size: var(--t-xs);
      color: var(--brand-blue); letter-spacing: .1em;
      text-transform: uppercase; margin-bottom: 2px;
    }
    .mobile-menu-close {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--n-100); border: 1px solid var(--border);
      font-size: 20px; cursor: pointer; display: flex;
      align-items: center; justify-content: center; color: var(--txt-2);
      transition: background .15s, transform .2s;
    }
    .mobile-menu-close:hover { background: var(--n-200); transform: rotate(90deg); }
    .mobile-menu-hero {
      padding: var(--s6);
      background: var(--n-50);
      border-bottom: 1px solid var(--border);
      display: flex; justify-content: space-between; align-items: flex-end; gap: var(--s4);
    }
    .mobile-menu-label {
      font-family: var(--f-mono); font-size: var(--t-xs);
      color: var(--brand-blue); letter-spacing: .1em;
      text-transform: uppercase; margin-bottom: var(--s2);
    }
    .mobile-menu-hero-copy h3 {
      font-family: var(--f-display); font-size: var(--t-lg);
      font-weight: 700; letter-spacing: -.01em; margin-bottom: var(--s1);
    }
    .mobile-menu-hero-copy p { font-size: var(--t-sm); color: var(--txt-2); }
    .mobile-menu-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 1px; background: var(--border);
      border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
    }
    .mobile-menu-card {
      background: var(--surface); padding: var(--s4) var(--s5);
      text-decoration: none; display: block;
      transition: background .15s;
    }
    .mobile-menu-card:hover { background: var(--n-50); }
    .mobile-menu-card span {
      display: block; font-family: var(--f-mono); font-size: var(--t-xs);
      color: var(--txt-3); letter-spacing: .08em; text-transform: uppercase; margin-bottom: 2px;
    }
    .mobile-menu-card strong {
      display: block; font-family: var(--f-display); font-size: var(--t-base);
      font-weight: 700; color: var(--txt-1);
    }
    .mobile-menu-list { padding: var(--s4) 0; flex: 1; }
    .mobile-menu-link {
      display: block; padding: 13px var(--s6);
      font-size: var(--t-base); font-weight: 500; color: var(--txt-1);
      text-decoration: none; border-bottom: 1px solid var(--border-sub);
      transition: background .15s, color .15s;
    }
    .mobile-menu-link:hover { background: var(--n-50); color: var(--brand-blue); }
    .mobile-menu-link:last-child { border-bottom: none; }

    /* ── SMART CHATBOT WIDGET ────────────────────────── */
    .chatbot-fab {
      position: fixed;
      right: 20px;
      bottom: 20px;
      z-index: 1200;
      border: none;
      border-radius: 999px;
      background: var(--brand-blue);
      color: #fff;
      padding: 12px 16px;
      font-weight: 600;
      box-shadow: var(--s-2);
      cursor: pointer;
    }
    .chatbot-panel {
      position: fixed;
      right: 20px;
      bottom: 78px;
      width: min(360px, calc(100vw - 24px));
      max-height: min(560px, calc(100vh - 120px));
      z-index: 1200;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: var(--s-3);
      display: none;
      flex-direction: column;
      overflow: hidden;
    }
    .chatbot-panel.open { display: flex; }
    .chatbot-head {
      background: var(--blue-deep);
      color: #fff;
      padding: 12px 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .chatbot-close {
      border: none;
      background: transparent;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      line-height: 1;
    }
    .chatbot-log {
      padding: 12px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 8px;
      background: #f8fafc;
      min-height: 250px;
    }
    .chat-bubble {
      max-width: 88%;
      padding: 10px 12px;
      border-radius: 12px;
      font-size: 14px;
      line-height: 1.4;
      white-space: pre-wrap;
    }
    .chat-bot { background: #eaf2ff; color: #102441; align-self: flex-start; }
    .chat-user { background: #1A6EE0; color: #fff; align-self: flex-end; }
    .chatbot-meta {
      font-size: 12px;
      margin-top: 6px;
    }
    .chatbot-meta a { color: #1A6EE0; text-decoration: underline; }
    .chatbot-form {
      display: flex;
      gap: 8px;
      padding: 10px;
      border-top: 1px solid var(--border);
      background: #fff;
    }
    .chatbot-input {
      flex: 1;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 10px;
      font-size: 14px;
    }
    .chatbot-send {
      border: none;
      border-radius: 8px;
      background: var(--brand-blue);
      color: #fff;
      padding: 0 14px;
      font-weight: 600;
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php 
  // Simple active state detection
  $current_uri = $_GET['url'] ?? ''; 
  $current_uri = trim($current_uri, '/');
?>

<!-- NAV -->
<header class="nav" id="mainNav">
  <div class="nav-inner">
    <a href="<?= APP_URL ?>/" class="nav-logo">
      <img src="<?= APP_URL ?>/assets/images/cemcs-logo-colored-255x68.png" alt="Chevron CEMCS MFB" style="height: 44px; width: auto;">
    </a>
    <ul class="nav-links">
      <li class="has-submenu">
        <a href="<?= APP_URL ?>/about" class="<?= in_array($current_uri, ['about', 'directors', 'management', 'quality-policy', 'careers', 'help', 'contact', 'blog']) ? 'active' : '' ?>">Company</a>
        <ul class="submenu">
          <li><a href="<?= APP_URL ?>/about">About CEMCS MFB</a></li>
          <li><a href="<?= APP_URL ?>/directors">Our Directors</a></li>
          <li><a href="<?= APP_URL ?>/management">Management Team</a></li>
          <li><a href="<?= APP_URL ?>/quality-policy">Quality Policy</a></li>
          <li><a href="<?= APP_URL ?>/careers">Careers</a></li>
          <li><a href="<?= APP_URL ?>/help">FAQs</a></li>
          <li><a href="<?= APP_URL ?>/contact">Contact</a></li>
          <li><a href="<?= APP_URL ?>/blog">Blog</a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="<?= APP_URL ?>/personal" class="<?= in_array($current_uri, ['personal', 'current-account', 'savings-account', 'joint-savings', 'cashplan-savings', 'fixed-deposit', 'smart-salary']) ? 'active' : '' ?>">Accounts</a>
        <ul class="submenu">
          <li><a href="<?= APP_URL ?>/current-account">Current Account</a></li>
          <li><a href="<?= APP_URL ?>/savings-account">Savings Account</a></li>
          <li><a href="<?= APP_URL ?>/joint-savings">Joint Savings Account</a></li>
          <li><a href="<?= APP_URL ?>/cashplan-savings">Cash Plan Savings Account</a></li>
          <li><a href="<?= APP_URL ?>/fixed-deposit">Fixed Deposit Account</a></li>
          <li><a href="<?= APP_URL ?>/smart-salary">Smart Salary Account</a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="<?= APP_URL ?>/loans" class="<?= in_array($current_uri, ['loans', 'loan-no-story', 'loan-home-improvement', 'loan-housing', 'loan-education', 'loan-target', 'loan-spy-police', 'loan-short-term']) ? 'active' : '' ?>">Loan Products</a>
        <ul class="submenu">
          <li><a href="<?= APP_URL ?>/loan-no-story">10-14-24 No Story Loan</a></li>
          <li><a href="<?= APP_URL ?>/loan-home-improvement">Home Improvement Loan</a></li>
          <li><a href="<?= APP_URL ?>/loan-housing">Micro Housing Loan</a></li>
          <li><a href="<?= APP_URL ?>/loan-education">Education Support Loan</a></li>
          <li><a href="<?= APP_URL ?>/loan-target">Target Loans &amp; Advances</a></li>
          <li><a href="<?= APP_URL ?>/loan-spy-police">Spy Police Special Loan</a></li>
          <li><a href="<?= APP_URL ?>/loan-short-term">Short Term/Overdraft</a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="<?= APP_URL ?>/open-account" class="<?= in_array($current_uri, ['open-account', 'debit-cards', 'mobile-banking', 'instant-payment', 'payments-deposits']) ? 'active' : '' ?>">E-Banking</a>
        <ul class="submenu">
          <li><a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener">Open An Account</a></li>
          <li><a href="<?= APP_URL ?>/debit-cards">Debit Cards</a></li>
          <li><a href="<?= APP_URL ?>/mobile-banking">Mobile Banking</a></li>
          <li><a href="<?= APP_URL ?>/instant-payment">Instant Payment</a></li>
          <li><a href="<?= APP_URL ?>/payments-deposits">Payments &amp; Deposits</a></li>
        </ul>
      </li>

      <li><a href="<?= APP_URL ?>/forms" class="<?= $current_uri == 'forms' ? 'active' : '' ?>">Forms</a></li>
    </ul>
    <div class="nav-actions">
      <button class="mobile-menu-toggle" id="mobileMenuToggle" type="button" aria-label="Open menu" aria-controls="mobileMenu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="nav-cta">
        <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Internet Banking</a>
      </div>
    </div>
  </div>
</header>

<div class="mobile-menu-overlay" id="mobileMenuOverlay" hidden></div>
<aside class="mobile-menu-sheet" id="mobileMenu" aria-hidden="true" hidden>
  <div class="mobile-menu-shell">
    <div class="mobile-menu-head">
      <div>
        <p class="mobile-menu-kicker">Quick access</p>
        <h2>Menu</h2>
      </div>
      <button class="mobile-menu-close" id="mobileMenuClose" type="button" aria-label="Close menu">&times;</button>
    </div>

    <div class="mobile-menu-hero">
      <div class="mobile-menu-hero-copy">
        <p class="mobile-menu-label">CEMCS MFB</p>
        <h3>Banking that feels like an app.</h3>
        <p>Accounts, loans, forms, and support in one clean mobile flow.</p>
      </div>
      <a class="mobile-menu-cta btn btn-primary btn-sm" href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener">Internet Banking</a>
    </div>

    <div class="mobile-menu-grid">
      <a class="mobile-menu-card" href="<?= APP_URL ?>/current-account">
        <span>Accounts</span>
        <strong>Open & manage</strong>
      </a>
      <a class="mobile-menu-card" href="<?= APP_URL ?>/loans">
        <span>Loans</span>
        <strong>Apply now</strong>
      </a>
      <a class="mobile-menu-card" href="<?= APP_URL ?>/forms">
        <span>Forms</span>
        <strong>Downloads</strong>
      </a>
      <a class="mobile-menu-card" href="<?= APP_URL ?>/contact">
        <span>Support</span>
        <strong>Talk to us</strong>
      </a>
    </div>

    <nav class="mobile-menu-list" aria-label="Mobile navigation">
      <a href="<?= APP_URL ?>/about" class="mobile-menu-link">About CEMCS MFB</a>
      <a href="<?= APP_URL ?>/personal" class="mobile-menu-link">Accounts</a>
      <a href="<?= APP_URL ?>/loans" class="mobile-menu-link">Loan Products</a>
      <a href="<?= APP_URL ?>/forms" class="mobile-menu-link">Forms</a>
      <a href="<?= APP_URL ?>/contact" class="mobile-menu-link">Contact</a>
      <a href="<?= APP_URL ?>/branches" class="mobile-menu-link">Branch Locator</a>
    </nav>
  </div>
</aside>

<main class="app-main">
  <?= $content ?? '' ?>
</main>

<!-- FOOTER -->
<footer class="footer">
  <div class="wrap">
    <div class="footer-grid">

      <div class="footer-brand">
        <a href="<?= APP_URL ?>/" class="nav-logo">
          <img src="<?= APP_URL ?>/assets/images/cemcs-logo-sticky-mobile.png" alt="CEMCS MFB" style="height:38px;width:auto;">
        </a>
        <p>Chevron Employees Multi-purpose Cooperative Society Microfinance Bank. CBN Licensed. RC 856802.</p>
        <p style="margin-top:var(--s4);">
          <a href="https://play.google.com/store/apps/details?id=com.cemcsmfb.cemcsmfbmobile" target="_blank" rel="noopener" style="display:inline-block;">
            <img src="<?= APP_URL ?>/assets/images/google-play.png" alt="Get it on Google Play" style="height:36px;width:auto;">
          </a>
        </p>
      </div>

      <div class="footer-col">
        <h5>Deposit Products</h5>
        <a href="<?= APP_URL ?>/current-account">Current Account</a>
        <a href="<?= APP_URL ?>/savings-account">Savings Account</a>
        <a href="<?= APP_URL ?>/joint-savings">Joint Savings Account</a>
        <a href="<?= APP_URL ?>/cashplan-savings">Cash Plan Savings</a>
        <a href="<?= APP_URL ?>/fixed-deposit">Fixed Deposit</a>
        <a href="<?= APP_URL ?>/smart-salary">Smart Salary Account</a>
      </div>

      <div class="footer-col">
        <h5>Loan Products</h5>
        <a href="<?= APP_URL ?>/loan-no-story">10-14-24 No Story Loan</a>
        <a href="<?= APP_URL ?>/loan-home-improvement">Home Improvement Loan</a>
        <a href="<?= APP_URL ?>/loan-housing">Micro Housing Loan</a>
        <a href="<?= APP_URL ?>/loan-education">Education Support Loan</a>
        <a href="<?= APP_URL ?>/loan-target">Target Loans &amp; Advances</a>
        <a href="<?= APP_URL ?>/loan-spy-police">Spy Police Special Loan</a>
        <a href="<?= APP_URL ?>/loan-short-term">Short Term / Overdraft</a>
      </div>

      <div class="footer-col">
        <h5>E-Banking</h5>
        <a href="https://cemcsmfb.qoreonline.com/dashboard/home" target="_blank" rel="noopener">Open an Account</a>
        <a href="<?= APP_URL ?>/debit-cards">Debit Cards</a>
        <a href="<?= APP_URL ?>/mobile-banking">Mobile Banking</a>
        <a href="<?= APP_URL ?>/instant-payment">Instant Payment</a>
        <a href="<?= APP_URL ?>/payments-deposits">Payments &amp; Deposits</a>
        <a href="<?= APP_URL ?>/forms">Download Forms</a>
      </div>

      <div class="footer-col">
        <h5>Company</h5>
        <a href="<?= APP_URL ?>/about">About CEMCS MFB</a>
        <a href="<?= APP_URL ?>/directors">Our Directors</a>
        <a href="<?= APP_URL ?>/management">Management Team</a>
        <a href="<?= APP_URL ?>/quality-policy">Quality Policy</a>
        <a href="<?= APP_URL ?>/careers">Careers</a>
        <a href="<?= APP_URL ?>/blog">Blog</a>
        <a href="<?= APP_URL ?>/help">FAQs</a>
        <a href="<?= APP_URL ?>/branches">Branch Locator</a>
        <a href="<?= APP_URL ?>/contact">Contact Us</a>
      </div>

    </div>
    <div class="footer-base">
      <p>&copy; <?= date('Y') ?> Chevron CEMCS Microfinance Bank (RC 856802). All rights reserved. Deposits insured by NDIC.</p>
    </div>
  </div>
</footer>

<script>
  // Nav elevation on scroll
  const nav = document.getElementById('mainNav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('elevated', window.scrollY > 10);
  }, { passive: true });

  // Scroll reveal
  const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('in'); revealObs.unobserve(e.target); }
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

  // Mobile menu
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileOverlay = document.getElementById('mobileMenuOverlay');
  const mobileToggle = document.getElementById('mobileMenuToggle');
  const mobileClose = document.getElementById('mobileMenuClose');

  function setMobileMenu(open) {
    if (!mobileMenu || !mobileOverlay || !mobileToggle) return;
    if (open) {
      mobileMenu.hidden = false;
      mobileOverlay.hidden = false;
      requestAnimationFrame(() => {
        mobileMenu.classList.add('open');
        mobileOverlay.classList.add('open');
      });
    } else {
      mobileMenu.classList.remove('open');
      mobileOverlay.classList.remove('open');
      mobileMenu.hidden = true;
      mobileOverlay.hidden = true;
    }
    mobileMenu.setAttribute('aria-hidden', open ? 'false' : 'true');
    mobileToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    mobileToggle.classList.toggle('is-open', open);
    document.body.classList.toggle('menu-open', open);
  }

  if (mobileToggle && mobileMenu && mobileOverlay) {
    mobileToggle.addEventListener('click', () => setMobileMenu(!mobileMenu.classList.contains('open')));
    mobileClose?.addEventListener('click', () => setMobileMenu(false));
    mobileOverlay.addEventListener('click', () => setMobileMenu(false));
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => setMobileMenu(false));
    });
    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setMobileMenu(false);
    });
  }
</script>

<button class="chatbot-fab" id="chatbot-fab" type="button">Chat With Us</button>
<div class="chatbot-panel" id="chatbot-panel" aria-live="polite">
  <div class="chatbot-head">
    <strong>Smart Assistant</strong>
    <button class="chatbot-close" id="chatbot-close" type="button" aria-label="Close chat">&times;</button>
  </div>
  <div class="chatbot-log" id="chatbot-log"></div>
  <form class="chatbot-form" id="chatbot-form">
    <input class="chatbot-input" id="chatbot-input" name="message" type="text" placeholder="Ask about accounts, loans, forms..." maxlength="500" required>
    <button class="chatbot-send" id="chatbot-send" type="submit">Send</button>
  </form>
</div>

<script>
  (function () {
    const panel = document.getElementById('chatbot-panel');
    const fab = document.getElementById('chatbot-fab');
    const closeBtn = document.getElementById('chatbot-close');
    const log = document.getElementById('chatbot-log');
    const form = document.getElementById('chatbot-form');
    const input = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send');

    if (!panel || !fab || !log || !form || !input || !sendBtn) {
      return;
    }

    function addBubble(text, role, options = {}) {
      const item = document.createElement('div');
      item.className = 'chat-bubble ' + (role === 'user' ? 'chat-user' : 'chat-bot');
      item.textContent = text;

      if (options.sourceUrl || options.whatsappLink || options.prefillUrl) {
        const meta = document.createElement('div');
        meta.className = 'chatbot-meta';
        if (options.sourceUrl) {
          const src = document.createElement('a');
          src.href = options.sourceUrl;
          src.textContent = options.sourceTitle ? ('Source: ' + options.sourceTitle) : 'View related page';
          meta.appendChild(src);
        }
        if (options.whatsappLink) {
          if (meta.childNodes.length > 0) meta.appendChild(document.createTextNode(' · '));
          const wa = document.createElement('a');
          wa.href = options.whatsappLink;
          wa.target = '_blank';
          wa.rel = 'noopener';
          wa.textContent = 'Continue on WhatsApp';
          meta.appendChild(wa);
        }
        if (options.prefillUrl) {
          if (meta.childNodes.length > 0) meta.appendChild(document.createTextNode(' · '));
          const pf = document.createElement('a');
          pf.href = options.prefillUrl;
          pf.textContent = 'Start here';
          meta.appendChild(pf);
        }
        item.appendChild(meta);
      }

      log.appendChild(item);
      log.scrollTop = log.scrollHeight;
    }

    function setOpen(open) {
      panel.classList.toggle('open', open);
      if (open) input.focus();
    }

    fab.addEventListener('click', function () {
      const willOpen = !panel.classList.contains('open');
      setOpen(willOpen);
      if (willOpen && log.childNodes.length === 0) {
        addBubble('Hi. Ask me anything about CEMCS MFB services. If I am not confident, I will move you to WhatsApp support.');
      }
    });

    closeBtn.addEventListener('click', function () {
      setOpen(false);
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const message = input.value.trim();
      if (!message) return;

      addBubble(message, 'user');
      input.value = '';
      sendBtn.disabled = true;

      fetch('<?= APP_URL ?>/api/chatbot', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: message })
      })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (!data || data.success !== true) {
          addBubble('Sorry, I could not process that just now.');
          return;
        }
        addBubble(data.message || 'I found some information for you.', 'bot', {
          sourceUrl: data.source_url || '',
          sourceTitle: data.source_title || '',
          whatsappLink: data.handoff ? (data.whatsapp_link || '') : '',
          prefillUrl: data.prefill_url || ''
        });
      })
      .catch(function () {
        addBubble('Network issue detected. Please try again.');
      })
      .finally(function () {
        sendBtn.disabled = false;
      });
    });
  })();
</script>
</body>
</html>
