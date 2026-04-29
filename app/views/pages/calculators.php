<div style="background: var(--blue-deep); padding: var(--space-6) 0 var(--space-8); color: var(--white);">
    <div class="container">
        <h1 style="color: var(--white); margin: 0;">Financial Calculators</h1>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.8); margin-top: var(--space-2);">Plan your financial future with our instant member tools.</p>
    </div>
</div>

<section style="padding: var(--space-8) 0; background: var(--off-white);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: var(--space-6);">
            
            <!-- Loan Calculator -->
            <div class="card" style="border-top: 3px solid var(--blue-primary);">
                <h3 style="color: var(--blue-dark); margin-bottom: var(--space-4);">Loan Repayment Calculator</h3>
                <div class="form-group">
                    <label class="form-label">Loan Amount (₦)</label>
                    <input type="number" id="loan-amount" class="form-control" value="1000000">
                </div>
                <div class="form-group">
                    <label class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" id="loan-rate" class="form-control" value="15">
                </div>
                <div class="form-group" style="position: relative;">
                    <label class="form-label">Duration (Months)</label>
                    <input type="range" id="loan-duration" class="form-control" min="6" max="60" value="12" style="padding: 0; box-shadow: none; border: none; height: auto;" oninput="document.getElementById('loan-dur-val').innerText = this.value + ' months'">
                    <div style="text-align: right; font-size: 0.85rem; color: var(--blue-primary); font-weight: 600;" id="loan-dur-val">12 months</div>
                </div>
                <div style="background: var(--neutral-100); padding: var(--space-4); border-radius: var(--radius-md); text-align: center; margin-top: var(--space-4);">
                    <p style="font-size: 0.9rem; color: var(--neutral-500); margin-bottom: var(--space-1); text-transform: uppercase; letter-spacing: 0.1em;">Monthly Repayment (EMI)</p>
                    <h2 id="loan-emi-result" style="color: var(--red-primary); margin: 0;">₦ 0.00</h2>
                    <p style="font-size: 0.8rem; color: var(--neutral-500); margin-top: var(--space-2);">Total Repayment: <strong id="loan-total-result">₦ 0.00</strong></p>
                </div>
                <!-- Mini Dynamic Visual Bar -->
                <div style="height: 6px; width: 100%; display: flex; overflow: hidden; border-radius: 4px; margin-top: var(--space-3);" title="Principal vs Interest Ratio">
                    <div id="loan-bar-principal" style="background: var(--blue-primary); width: 80%; transition: width var(--trans-base);"></div>
                    <div id="loan-bar-interest" style="background: var(--red-primary); width: 20%; transition: width var(--trans-base);"></div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 10px; text-transform: uppercase; margin-top: 4px; color: var(--neutral-500); letter-spacing: 0.05em;">
                    <span style="color: var(--blue-primary);">Principal</span>
                    <span style="color: var(--red-primary);">Interest</span>
                </div>
            </div>

            <!-- Savings Calculator -->
            <div class="card" style="border-top: 3px solid var(--red-primary);">
                <h3 style="color: var(--blue-dark); margin-bottom: var(--space-4);">Savings Projection</h3>
                <div class="form-group">
                    <label class="form-label">Monthly Deposit (₦)</label>
                    <input type="number" id="save-monthly" class="form-control" value="50000">
                </div>
                <div class="form-group">
                    <label class="form-label">Annual Interest Rate (%)</label>
                    <input type="number" id="save-rate" class="form-control" value="10">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration (Months)</label>
                    <input type="range" id="save-duration" class="form-control" min="6" max="120" value="24" style="padding: 0; box-shadow: none; border: none; height: auto;" oninput="document.getElementById('save-dur-val').innerText = this.value + ' months'">
                    <div style="text-align: right; font-size: 0.85rem; color: var(--blue-primary); font-weight: 600;" id="save-dur-val">24 months</div>
                </div>
                <div style="background: var(--neutral-100); padding: var(--space-4); border-radius: var(--radius-md); text-align: center; margin-top: var(--space-4);">
                    <p style="font-size: 0.9rem; color: var(--neutral-500); margin-bottom: var(--space-1); text-transform: uppercase; letter-spacing: 0.1em;">Future Value (FV)</p>
                    <h2 id="save-fv-result" style="color: var(--blue-primary); margin: 0;">₦ 0.00</h2>
                    <p style="font-size: 0.8rem; color: var(--neutral-500); margin-top: var(--space-2);">Total Deposited: <strong id="save-total-dep">₦ 0.00</strong></p>
                </div>
                <!-- Mini Dynamic Visual Bar -->
                <div style="height: 6px; width: 100%; display: flex; overflow: hidden; border-radius: 4px; margin-top: var(--space-3);" title="Deposits vs Accumulated Interest">
                    <div id="save-bar-deposit" style="background: var(--blue-primary); width: 80%; transition: width var(--trans-base);"></div>
                    <div id="save-bar-interest" style="background: var(--red-primary); width: 20%; transition: width var(--trans-base);"></div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 10px; text-transform: uppercase; margin-top: 4px; color: var(--neutral-500); letter-spacing: 0.05em;">
                    <span style="color: var(--blue-primary);">Deposits</span>
                    <span style="color: var(--red-primary);">Interest Gained</span>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const formatCurrency = (val) => new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(val);

    const calcLoan = () => {
        let P = parseFloat(document.getElementById('loan-amount').value) || 0;
        let r_annual = parseFloat(document.getElementById('loan-rate').value) || 0;
        let n = parseInt(document.getElementById('loan-duration').value) || 1;
        
        let r = (r_annual / 100) / 12; 
        
        let M = 0;
        let total = 0;
        
        if (r > 0) {
            let x = Math.pow(1 + r, n);
            M = P * r * x / (x - 1);
            total = M * n;
        } else {
            M = P / n;
            total = P;
        }
        
        let interest = total - P;
        let pRatio = total > 0 ? (P / total) * 100 : 100;
        let iRatio = total > 0 ? (interest / total) * 100 : 0;
        
        document.getElementById('loan-bar-principal').style.width = pRatio + '%';
        document.getElementById('loan-bar-interest').style.width = iRatio + '%';

        document.getElementById('loan-emi-result').innerText = formatCurrency(M);
        document.getElementById('loan-total-result').innerText = formatCurrency(total);
    };

    const calcSavings = () => {
        let P = parseFloat(document.getElementById('save-monthly').value) || 0;
        let r_annual = parseFloat(document.getElementById('save-rate').value) || 0;
        let n = parseInt(document.getElementById('save-duration').value) || 1;
        
        let r = (r_annual / 100) / 12; 
        
        let FV = 0;
        let totalDep = P * n;
        
        if (r > 0) {
            FV = P * ((Math.pow(1 + r, n) - 1) / r) * (1 + r); // Assuming deposit at start of month
        } else {
            FV = totalDep;
        }
        
        let interest = FV - totalDep;
        let pRatio = FV > 0 ? (totalDep / FV) * 100 : 100;
        let iRatio = FV > 0 ? (interest / FV) * 100 : 0;
        
        document.getElementById('save-bar-deposit').style.width = pRatio + '%';
        document.getElementById('save-bar-interest').style.width = iRatio + '%';

        document.getElementById('save-fv-result').innerText = formatCurrency(FV);
        document.getElementById('save-total-dep').innerText = formatCurrency(totalDep);
    };

    ['loan-amount', 'loan-rate', 'loan-duration'].forEach(id => {
        document.getElementById(id).addEventListener('input', calcLoan);
    });

    ['save-monthly', 'save-rate', 'save-duration'].forEach(id => {
        document.getElementById(id).addEventListener('input', calcSavings);
    });

    // Initial calculation triggers
    calcLoan();
    calcSavings();

});
</script>
