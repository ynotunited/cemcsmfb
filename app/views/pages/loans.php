<style>
    .loan-step { display: none; animation: slideInRight var(--trans-base); }
    .loan-step.active { display: block; }
    @keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    .loan-nav { display: flex; flex-wrap: wrap; gap: var(--space-2); margin-bottom: var(--space-4); border-bottom: 2px solid var(--neutral-100); padding-bottom: var(--space-2); }
    .loan-nav-item { flex: 1; font-weight: 600; font-size: 0.9rem; color: var(--neutral-400); text-transform: uppercase; letter-spacing: 0.05em; transition: color var(--trans-base); min-width: 120px; }
    .loan-nav-item.active { color: var(--blue-primary); }
</style>

<div style="background: var(--blue-deep); padding: var(--space-6) 0 var(--space-8); color: var(--white);">
    <div class="container">
        <h1 style="color: var(--white); margin: 0;">Loan Application</h1>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.8); margin-top: var(--space-2);">Fast, transparent credit strictly for our members.</p>
    </div>
</div>

<section style="padding: var(--space-8) 0; background: var(--off-white); min-height: 500px;">
    <div class="container" style="max-width: 800px;">
        <div class="card" style="padding: var(--space-5) var(--space-6);">
            
            <div class="loan-nav" id="loan-nav">
                <div class="loan-nav-item active" id="nav-step-1">1. Pre-Qualification</div>
                <div class="loan-nav-item" id="nav-step-2">2. Configuration</div>
                <div class="loan-nav-item" id="nav-step-3">3. Documents</div>
                <div class="loan-nav-item" id="nav-step-4">4. Finalize</div>
            </div>

            <form id="loan-form" method="POST" action="<?= APP_URL ?>/api/loan-application">
                <?= CsrfHelper::field() ?>
                <input type="hidden" name="g-recaptcha-response" id="loan-recaptcha-token">
                
                <!-- STEP 1 -->
                <div class="loan-step active" id="loan-step-1">
                    <h3 style="margin-bottom: var(--space-4);">Pre-Qualification Check</h3>
                    <p style="color: var(--neutral-700); margin-bottom: var(--space-4);">Let's verify your eligibility before we begin.</p>
                    <div class="form-group">
                        <label class="form-label">CEMCS Account Number</label>
                        <input type="text" class="form-control" name="account_number" required placeholder="10-digit account number">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employment Status</label>
                        <select class="form-control" required name="employment_status">
                            <option value="">Select...</option>
                            <option value="confirmed">Confirmed Permanent Staff</option>
                            <option value="contract">Contract Staff</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div style="text-align: right; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-primary" onclick="goToStep(2)">Verify & Continue</button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="loan-step" id="loan-step-2">
                    <h3 style="margin-bottom: var(--space-4);">Loan Configuration</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-4);">
                        <div class="form-group">
                            <label class="form-label">Loan Type</label>
                            <select class="form-control" name="loan_type" required>
                                <option value="personal">Personal Loan</option>
                                <option value="auto">Auto Finance</option>
                                <option value="mortgage">Mortgage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Requested Amount (₦)</label>
                            <input type="number" class="form-control" name="amount" required min="50000" max="10000000" placeholder="e.g. 500000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Repayment Tenor (Months)</label>
                        <select class="form-control" name="duration" required>
                            <option value="12">12 Months (1 Year)</option>
                            <option value="24">24 Months (2 Years)</option>
                            <option value="36">36 Months (3 Years)</option>
                            <option value="48">48 Months (4 Years)</option>
                        </select>
                    </div>
                    <div style="background: var(--neutral-100); padding: var(--space-4); border-radius: var(--radius-md); text-align: center; margin-top: var(--space-4);">
                         <p style="font-size: 0.9rem; color: var(--neutral-600); margin-bottom: var(--space-1);">Estimated Interest Rate</p>
                         <h3 style="color: var(--blue-primary); margin: 0;">15% P.A.</h3>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-outline" onclick="goToStep(1)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="goToStep(3)">Next: Documents</button>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="loan-step" id="loan-step-3">
                    <h3 style="margin-bottom: var(--space-4);">Document Uploads</h3>
                    <p style="color: var(--neutral-700); margin-bottom: var(--space-4);">Please upload clear copies of the following documents to support your request.</p>
                    
                    <div class="form-group" style="border: 2px dashed var(--neutral-300); padding: var(--space-4); text-align: center; border-radius: var(--radius-md); margin-bottom: var(--space-3); cursor: pointer; transition: all var(--trans-base);" onclick="document.getElementById('file-payslip').click()">
                        <div style="color: var(--blue-primary); margin-bottom: var(--space-2);"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg></div>
                        <h5 style="margin:0;">Recent Payslip (Last 3 Months)</h5>
                        <p style="font-size: 0.8rem; color: var(--neutral-500); margin: 0;">PDF or JPEG, max 2MB</p>
                        <input type="file" id="file-payslip" style="display: none;">
                    </div>

                    <div class="form-group" style="border: 2px dashed var(--neutral-300); padding: var(--space-4); text-align: center; border-radius: var(--radius-md); cursor: pointer; transition: all var(--trans-base);" onclick="document.getElementById('file-id').click()">
                        <div style="color: var(--blue-primary); margin-bottom: var(--space-2);"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg></div>
                        <h5 style="margin:0;">Work ID / Valid Passport</h5>
                        <p style="font-size: 0.8rem; color: var(--neutral-500); margin: 0;">PDF or JPEG, max 2MB</p>
                        <input type="file" id="file-id" style="display: none;">
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-outline" onclick="goToStep(2)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="goToStep(4)">Review & Finalize</button>
                    </div>
                </div>

                <!-- STEP 4 -->
                <div class="loan-step" id="loan-step-4">
                    <h3 style="margin-bottom: var(--space-4);">Finalization & Signature</h3>
                    <div style="background: var(--neutral-100); padding: var(--space-4); border-radius: var(--radius-md); border-left: 4px solid var(--red-primary); margin-bottom: var(--space-4);">
                        <h5 style="color: var(--neutral-900);">Declaration</h5>
                        <p style="font-size: 0.9rem; color: var(--neutral-700); margin-bottom: 0;">I hereby declare that all information provided is accurate and authentic. I authorize CEMCS MFB to investigate my credit history and verify my employment status.</p>
                    </div>
                    <div class="form-group">
                        <label style="display: flex; gap: 12px; align-items: flex-start; cursor: pointer;">
                            <input type="checkbox" required style="margin-top: 5px;">
                            <span style="font-size: 0.9rem; color: var(--neutral-900); font-weight: 600;">I accept the Loan Terms and Conditions, including standing order deduction protocols.</span>
                        </label>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: var(--space-5);">
                        <button type="button" class="btn btn-outline" onclick="goToStep(3)">Back</button>
                        <button type="submit" class="btn" style="background: var(--red-primary); color: white; border: none;">Submit Application Now</button>
                    </div>
                </div>

            </form>

             <!-- Success State -->
             <div id="loan-success" style="display: none; text-align: center; padding: var(--space-5) 0;">
                <div style="width: 80px; height: 80px; background: rgba(26, 130, 196, 0.1); color: var(--blue-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4);">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h2 style="color: var(--neutral-900);">Application Secured</h2>
                <p style="color: var(--neutral-700); font-size: 1.1rem; max-width: 450px; margin: var(--space-3) auto var(--space-5);">Your Reference ID is <strong>L-99014X</strong>. An underwriter will review your documents and contact you within 48 hours.</p>
                <a href="<?= APP_URL ?>/" class="btn btn-outline">Return to Home</a>
            </div>

        </div>
    </div>
</section>

<script>
    (function applyIntentPrefill() {
        const params = new URLSearchParams(window.location.search);
        const intent = params.get('intent') || '';
        if (intent === 'loan') {
            const form = document.getElementById('loan-form');
            if (!form || !form.parentNode) return;
            const note = document.createElement('p');
            note.style.cssText = 'margin:0 0 var(--space-3);font-size:0.85rem;color:var(--blue-primary);font-weight:600;';
            note.textContent = 'You were redirected by our assistant. Continue this loan request below.';
            form.parentNode.insertBefore(note, form);
        }
    })();

    function goToStep(step) {
        document.querySelectorAll('.loan-step').forEach(el => el.classList.remove('active'));
        document.getElementById('loan-step-' + step).classList.add('active');
        
        document.querySelectorAll('.loan-nav-item').forEach((el, index) => {
            if (index < step) {
                el.classList.add('active');
            } else {
                el.classList.remove('active');
            }
        });
    }

    document.getElementById('loan-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form      = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const siteKey   = '<?= htmlspecialchars($recaptcha_site_key ?? '') ?>';

        // Attach file inputs to FormData
        const formData = new FormData(form);
        const payslip  = document.getElementById('file-payslip').files[0];
        const idDoc    = document.getElementById('file-id').files[0];
        if (payslip) formData.append('payslip',     payslip);
        if (idDoc)   formData.append('id_document', idDoc);

        submitBtn.textContent = 'Uploading Securely...';
        submitBtn.disabled    = true;

        function doSubmit(token) {
            if (token) {
                formData.set('g-recaptcha-response', token);
                document.getElementById('loan-recaptcha-token').value = token;
            }

            fetch('<?= APP_URL ?>/api/loan-application', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.__loanFormSubmitted = true;
                    form.style.display = 'none';
                    document.getElementById('loan-nav').style.display = 'none';

                    const strongRef = document.querySelector('#loan-success strong');
                    if (strongRef && data.reference) strongRef.textContent = data.reference;

                    document.getElementById('loan-success').style.display = 'block';
                } else {
                    alert('Error: ' + (data.error || 'Something went wrong.'));
                    submitBtn.textContent = 'Submit Application Now';
                    submitBtn.disabled    = false;
                }
            })
            .catch(() => {
                alert('A network error occurred. Please try again.');
                submitBtn.textContent = 'Submit Application Now';
                submitBtn.disabled    = false;
            });
        }

        if (siteKey && siteKey !== 'YOUR_RECAPTCHA_SITE_KEY' && typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(() => {
                grecaptcha.execute(siteKey, { action: 'loan_application' }).then(doSubmit);
            });
        } else {
            doSubmit('');
        }
    });

    // File input UX enhancers
    document.getElementById('file-payslip').addEventListener('change', function() {
        if(this.files.length > 0) {
            this.parentElement.style.borderColor = 'var(--blue-primary)';
            this.parentElement.style.backgroundColor = 'rgba(26, 130, 196, 0.05)';
        }
    });

    document.getElementById('file-id').addEventListener('change', function() {
        if(this.files.length > 0) {
            this.parentElement.style.borderColor = 'var(--blue-primary)';
            this.parentElement.style.backgroundColor = 'rgba(26, 130, 196, 0.05)';
        }
    });

    (function trackAbandonment() {
        const form = document.getElementById('loan-form');
        if (!form || !navigator.sendBeacon) return;

        let started = false;
        let step = '1';
        const sessionKey = 'loan_' + Date.now() + '_' + Math.random().toString(36).slice(2, 10);
        form.addEventListener('input', () => { started = true; });

        window.goToStep = (function (orig) {
            return function (s) { step = String(s); return orig(s); };
        })(window.goToStep);

        function send() {
            if (!started || window.__loanFormSubmitted) return;
            const payload = {
                form_type: 'loan',
                session_id: sessionKey,
                current_step: step,
                full_name: '',
                email: '',
                phone: '',
                payload: {
                    account_number: form.querySelector('[name="account_number"]')?.value || '',
                    employment_status: form.querySelector('[name="employment_status"]')?.value || '',
                    loan_type: form.querySelector('[name="loan_type"]')?.value || '',
                    amount: form.querySelector('[name="amount"]')?.value || '',
                    duration: form.querySelector('[name="duration"]')?.value || ''
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
