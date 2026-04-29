<?php
$recaptcha_site_key = $recaptcha_site_key ?? 'YOUR_RECAPTCHA_SITE_KEY';
?>

<!-- PAGE HEADER -->
<div class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge">
          <span class="badge-dot"></span>
          <span class="label">Response within 2 business hours</span>
        </div>
        <h1 class="page-title">Contact Us</h1>
      </div>
      <p class="page-desc">
        Questions about your account, loan eligibility, or membership? Our team is available Monday through Friday.
      </p>
    </div>
  </div>
</div>

<!-- CHANNEL ROW -->
<div class="channels">
  <a class="channel" href="tel:+2348087995012">
    <span class="ch-label">Phone</span>
    <span class="ch-value">+234 808 799 5012</span>
    <span class="ch-sub">Mon – Fri, 8am – 5pm</span>
    <span class="ch-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg></span>
  </a>
  <a class="channel" href="mailto:helpdesk@cemcsmfb.com">
    <span class="ch-label">Support Email</span>
    <span class="ch-value">helpdesk@cemcsmfb.com</span>
    <span class="ch-sub">Technical & Banking Support</span>
    <span class="ch-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg></span>
  </a>
  <a class="channel" href="mailto:info@cemcsmfb.com">
    <span class="ch-label">General Info</span>
    <span class="ch-value">info@cemcsmfb.com</span>
    <span class="ch-sub">General inquiries & feedback</span>
    <span class="ch-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg></span>
  </a>
  <div class="channel" style="cursor:default;">
    <span class="ch-label">Head Office</span>
    <span class="ch-value">Lekki, Lagos</span>
    <span class="ch-sub">Nigeria</span>
    <span class="ch-arrow"></span>
  </div>
</div>

<!-- MAIN CONTACT LAYOUT -->
<div class="wrap">
  <div class="contact-layout">

    <!-- LEFT: Info & Branches -->
    <div class="contact-left reveal">
      <div class="cl-section">
        <p class="label" style="margin-bottom:var(--s2)">Direct Contact</p>
        <div style="margin-top: var(--s4);">
            <div style="margin-bottom: var(--s6);">
                <p class="body-sm" style="margin-bottom: 2px;">Alternative Phone</p>
                <p class="h-sm" style="color: var(--txt-1);">+234 1-277 2222</p>
            </div>
            <div style="margin-bottom: var(--s6);">
                <p class="body-sm" style="margin-bottom: 2px;">Careers & Partnerships</p>
                <p class="h-sm" style="color: var(--txt-1);"><a href="mailto:teams@cemcsmfb.com">teams@cemcsmfb.com</a></p>
                <p class="body-sm" style="margin-top: 4px;">Would you like to join our growing team?</p>
            </div>
        </div>
      </div>

      <div class="cl-section">
        <p class="label" style="margin-bottom:var(--s2)">Branches</p>
        <p class="body-sm">All CEMCS MFB locations serve walk-in members during banking hours.</p>
        <div class="branch-list">
          <div class="branch selected">
            <div>
              <div class="branch-name">Head Office — Lekki</div>
              <div class="branch-address">6, Udeco Medical Road, Chevyview Estate, Off Chevron Drive, Lekki, Lagos</div>
              <span class="branch-status open"><span class="status-pip"></span>Open now</span>
            </div>
          </div>
        </div>
      </div>

      <div class="cl-section">
        <p class="label" style="margin-bottom:var(--s4)">Banking Hours</p>
        <div class="hours-grid">
          <div class="hours-row"><span>Monday – Friday</span><b>8:00am – 4:00pm</b></div>
          <div class="hours-row"><span>Saturday</span><b>9:00am – 1:00pm</b></div>
          <div class="hours-row"><span>Sunday &amp; Public Holidays</span><b>Closed</b></div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Form -->
    <div class="contact-right reveal d1">
      <div id="contact-form-wrap">
        <h2 class="h-md form-title">Send a message</h2>
        <p class="form-desc">Fill out the form below and our representative will get back to you shortly.</p>

        <form class="form" id="contact-form">
          <?= CsrfHelper::field() ?>
          <input type="hidden" name="g-recaptcha-response" id="contact-recaptcha-token">
          
          <div class="field-row">
            <div class="field">
              <label class="field-label">Full Name</label>
              <input type="text" name="name" required placeholder="John Doe"/>
            </div>
            <div class="field">
              <label class="field-label">Email Address</label>
              <input type="email" name="email" required placeholder="john@chevron.com"/>
            </div>
          </div>

          <div class="field">
            <label class="field-label">Inquiry Category</label>
            <select name="category" required>
              <option value="general">General Inquiry</option>
              <option value="loans">Loan Application</option>
              <option value="savings">Savings & Investments</option>
              <option value="technical">Technical Support</option>
              <option value="complaint">Complaint / Feedback</option>
            </select>
          </div>

          <div class="field">
            <label class="field-label">How can we help?</label>
            <textarea name="message" required placeholder="Describe your request in detail..."></textarea>
          </div>

          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-lg" id="contact-submit-btn">
              <span class="btn-label">Submit Message</span>
            </button>
            <p class="form-note">By submitting, you agree to our privacy policy and terms of service.</p>
          </div>
          <div id="form-feedback" style="margin-top: var(--s4); font-size: var(--t-sm); display: none;"></div>
        </form>
      </div>

      <!-- SUCCESS STATE (Hidden by default) -->
      <div class="success" id="success-state">
        <div class="success-mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h3 class="h-md">Message received</h3>
        <p>Thank you for reaching out. We have received your inquiry and a member of our team will respond within 2 business hours.</p>
        <button class="btn btn-ghost" onclick="location.reload()">Send another message</button>
      </div>
    </div>

  </div>
</div>

<!-- MAP SECTION -->
<section class="location-section">
  <div class="wrap">
    <div class="location-grid">
      <div class="map-frame">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.717647248149!2d3.5414571749921473!3d6.430335393560738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf724602f060d%3A0x673966567f818987!2s6%20Udeco%20Medical%20Rd%2C%20Chevy%20View%20Estate%20106104%2C%20Lekki%2C%20Lagos!5e0!3m2!1sen!2sng!4v1713770000000!5m2!1sen!2sng" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="loc-info">
        <p class="label" style="margin-bottom:var(--s2)">Location</p>
        <h2 class="h-lg">Visit our Head Office</h2>
        <p class="body-lg" style="margin-top:var(--s4)">Our headquarters is located within the Chevy View Estate, directly opposite the Chevron Nigeria Limited office.</p>
        
        <div class="loc-detail-list">
          <div class="loc-detail">
            <div class="loc-detail-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div>
              <div class="loc-lbl">Address</div>
              <div class="loc-val">6, Udeco Medical Road, Chevyview Estate, Off Chevron Drive, Lekki, Lagos, Nigeria</div>
            </div>
          </div>
          <div class="loc-detail">
            <div class="loc-detail-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.81 12.81 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg></div>
            <div>
              <div class="loc-lbl">Phone</div>
              <div class="loc-val">+234 808 799 5012</div>
            </div>
          </div>
          <div class="loc-detail">
            <div class="loc-detail-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div>
              <div class="loc-lbl">Email</div>
              <div class="loc-val">info@cemcsmfb.com</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form      = this;
        const submitBtn = document.getElementById('contact-submit-btn');
        const feedback  = document.getElementById('form-feedback');
        const siteKey   = '<?= htmlspecialchars($recaptcha_site_key ?? '') ?>';

        submitBtn.setAttribute('data-loading', '');
        submitBtn.disabled = true;
        feedback.style.display = 'none';

        function doSubmit(token) {
            if (token) document.getElementById('contact-recaptcha-token').value = token;

            fetch('<?= APP_URL ?>/api/contact', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.removeAttribute('data-loading');
                if (data.success) {
                    document.getElementById('contact-form-wrap').style.display = 'none';
                    document.getElementById('success-state').classList.add('show');
                } else {
                    feedback.textContent   = 'Error: ' + (data.error || 'Something went wrong.');
                    feedback.style.color   = 'var(--brand-red)';
                    feedback.style.display = 'block';
                    submitBtn.disabled     = false;
                }
            })
            .catch(() => {
                submitBtn.removeAttribute('data-loading');
                feedback.textContent   = 'A network error occurred. Please try again.';
                feedback.style.color   = 'var(--brand-red)';
                feedback.style.display = 'block';
                submitBtn.disabled     = false;
            });
        }

        if (siteKey && siteKey !== 'YOUR_RECAPTCHA_SITE_KEY' && typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                grecaptcha.execute(siteKey, { action: 'contact' }).then(doSubmit);
            });
        } else {
            doSubmit('');
        }
    });
</script>
