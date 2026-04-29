<style>
    .step-content { display: none; animation: fadeIn var(--trans-base); }
    .step-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .progress-bar { height: 4px; background: var(--neutral-100); border-radius: 2px; overflow: hidden; margin-bottom: var(--space-6); }
    .progress-fill { height: 100%; background: var(--blue-primary); width: 0%; transition: width 0.4s ease; }
    .step-indicator { display: flex; justify-content: space-between; margin-bottom: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
    .step-indicator span.active { color: var(--blue-primary); }
</style>

<div style="background: var(--blue-deep); padding: var(--space-6) 0 var(--space-8); color: var(--white);">
    <div class="container">
        <h1 style="color: var(--white); margin: 0;">Open an Account</h1>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.8); margin-top: var(--space-2);">Join the cooperative family in less than 5 minutes.</p>
    </div>
</div>

<section style="padding: var(--space-8) 0; background: var(--off-white); min-height: 500px;">
    <div class="container" style="max-width: 700px;">
        <div class="card" style="padding: var(--space-6);">
            
            <div class="step-indicator">
                <span id="label-step-1" class="active">1. Personal Details</span>
                <span id="label-step-2">2. Employment</span>
                <span id="label-step-3">3. Verification</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill" style="width: 33%;"></div>
            </div>

            <form id="open-account-form" method="POST" action="<?= APP_URL ?>/api/open-account">
                <?= CsrfHelper::field() ?>
                <input type="hidden" name="g-recaptcha-response" id="account-recaptcha-token">
                
                <!-- STEP 1 -->
                <div class="step-content active" id="step-1">
                    <h3 style="margin-bottom: var(--space-4);">Personal Details</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-4);">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div style="text-align: right; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Continue to Employment <svg style="width:16px;height:16px;vertical-align:middle;margin-left:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step-content" id="step-2">
                    <h3 style="margin-bottom: var(--space-4);">Employment Information</h3>
                    <div class="form-group">
                        <label class="form-label">Chevron Employee ID (Optional)</label>
                        <input type="text" class="form-control" name="employee_id">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department / Division</label>
                        <input type="text" class="form-control" name="department" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Monthly Income Band</label>
                        <select class="form-control" name="income_band">
                            <option value="">Select a band</option>
                            <option value="tier1">Less than ₦500,000</option>
                            <option value="tier2">₦500,000 - ₦1,000,000</option>
                            <option value="tier3">Above ₦1,000,000</option>
                        </select>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-outline" onclick="prevStep(1)"><svg style="width:16px;height:16px;vertical-align:middle;margin-right:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Continue to Verification <svg style="width:16px;height:16px;vertical-align:middle;margin-left:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="step-content" id="step-3">
                    <h3 style="margin-bottom: var(--space-4);">Identity Verification</h3>
                    <p style="color: var(--neutral-700); font-size: 0.95rem; margin-bottom: var(--space-4);">Please provide your Bank Verification Number (BVN) to secure your account. Your BVN will only be used for identity confirmation as required by the CBN.</p>
                    <div class="form-group">
                        <label class="form-label">11-Digit BVN</label>
                        <input type="text" class="form-control" name="bvn" required pattern="\d{11}" maxlength="11" placeholder="e.g. 22200011122">
                    </div>
                    <div class="form-group" style="margin-top: var(--space-4);">
                        <label style="display: flex; gap: 12px; align-items: flex-start; cursor: pointer;">
                            <input type="checkbox" required style="margin-top: 5px;">
                            <span style="font-size: 0.9rem; color: var(--neutral-700);">I confirm that the information provided is accurate and I agree to the <a href="#" style="color: var(--blue-primary);">Terms and Conditions</a> of CEMCS MFB.</span>
                        </label>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-outline" onclick="prevStep(2)"><svg style="width:16px;height:16px;vertical-align:middle;margin-right:8px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg> Back</button>
                        <button type="submit" class="btn" style="background: var(--red-primary); color: white; border: none;">Submit Application</button>
                    </div>
                </div>

            </form>

            <!-- Success State -->
            <div id="success-state" style="display: none; text-align: center; padding: var(--space-4) 0;">
                <div style="width: 64px; height: 64px; background: rgba(21, 128, 61, 0.1); color: #15803D; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4);">
                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                </div>
                <h3 style="color: var(--neutral-900);">Application Received!</h3>
                <p style="color: var(--neutral-700); font-size: 1.1rem; max-width: 400px; margin: var(--space-3) auto var(--space-5);">Your account opening request has been securely transmitted. A representative will contact you shortly with your new account details.</p>
                <a href="<?= APP_URL ?>/" class="btn btn-outline">Return to Home</a>
            </div>

        </div>
    </div>
</section>

<script>
    (function applyIntentPrefill() {
        const params = new URLSearchParams(window.location.search);
        const intent = params.get('intent') || '';
        if (intent === 'open_account') {
            const note = document.createElement('p');
            note.style.cssText = 'margin:0 0 var(--space-3);font-size:0.85rem;color:var(--blue-primary);font-weight:600;';
            note.textContent = 'You were guided here by our assistant. Complete this form to continue your request.';
            const form = document.getElementById('open-account-form');
            if (form && form.parentNode) {
                form.parentNode.insertBefore(note, form);
            }
        }
    })();

    function updateProgress(step) {
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.getElementById('step-' + step).classList.add('active');
        
        document.querySelectorAll('.step-indicator span').forEach((el, index) => {
            if (index < step) {
                el.classList.add('active');
            } else {
                el.classList.remove('active');
            }
        });

        const progressMap = {1: '33%', 2: '66%', 3: '100%'};
        document.getElementById('progress-fill').style.width = progressMap[step];
    }

    function nextStep(step) {
        // Basic HTML5 validation bypass for smooth UX simulation
        const currentStepEl = document.getElementById('step-' + (step - 1));
        const inputs = currentStepEl.querySelectorAll('input[required]');
        let valid = true;
        inputs.forEach(input => {
            if(!input.value) { valid = false; input.style.borderColor = 'var(--red-primary)'; }
            else { input.style.borderColor = ''; }
        });
        
        if(valid) {
            updateProgress(step);
        }
    }

    function prevStep(step) {
        updateProgress(step);
    }

    document.getElementById('open-account-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form      = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const siteKey   = '<?= htmlspecialchars($recaptcha_site_key ?? '') ?>';

        submitBtn.textContent = 'Processing...';
        submitBtn.disabled    = true;

        function doSubmit(token) {
            if (token) document.getElementById('account-recaptcha-token').value = token;

            fetch('<?= APP_URL ?>/api/open-account', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.__accountFormSubmitted = true;
                    form.style.display = 'none';
                    document.querySelector('.step-indicator').style.display = 'none';
                    document.querySelector('.progress-bar').style.display   = 'none';
                    document.getElementById('success-state').style.display  = 'block';
                } else {
                    alert('Error: ' + (data.error || 'Something went wrong.'));
                    submitBtn.textContent = 'Submit Application';
                    submitBtn.disabled    = false;
                }
            })
            .catch(() => {
                alert('A network error occurred. Please try again.');
                submitBtn.textContent = 'Submit Application';
                submitBtn.disabled    = false;
            });
        }

        if (siteKey && siteKey !== 'YOUR_RECAPTCHA_SITE_KEY' && typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                grecaptcha.execute(siteKey, { action: 'open_account' }).then(doSubmit);
            });
        } else {
            doSubmit('');
        }
    });

    (function trackAbandonment() {
        const form = document.getElementById('open-account-form');
        if (!form || !navigator.sendBeacon) return;

        let started = false;
        let step = '1';
        const sessionKey = 'open_account_' + Date.now() + '_' + Math.random().toString(36).slice(2, 10);

        form.addEventListener('input', () => { started = true; });
        window.nextStep = (function (orig) {
            return function (s) { step = String(s); return orig(s); };
        })(window.nextStep);
        window.prevStep = (function (orig) {
            return function (s) { step = String(s); return orig(s); };
        })(window.prevStep);

        function send() {
            if (!started || window.__accountFormSubmitted) return;
            const payload = {
                form_type: 'open_account',
                session_id: sessionKey,
                current_step: step,
                full_name: [form.querySelector('[name="first_name"]')?.value || '', form.querySelector('[name="last_name"]')?.value || ''].join(' ').trim(),
                email: form.querySelector('[name="email"]')?.value || '',
                phone: form.querySelector('[name="phone"]')?.value || '',
                payload: {
                    department: form.querySelector('[name="department"]')?.value || '',
                    income_band: form.querySelector('[name="income_band"]')?.value || ''
                }
            };
            navigator.sendBeacon('<?= APP_URL ?>/api/form-abandonment', JSON.stringify(payload));
        }

        window.addEventListener('beforeunload', send);
        document.addEventListener('visibilitychange', function () {
            if (document.visibilityState === 'hidden') send();
        });
    })();
</script>
