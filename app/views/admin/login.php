<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--blue-deep);">
    <div class="card" style="width: 100%; max-width: 400px; padding: var(--space-6);">
        <div style="text-align: center; margin-bottom: var(--space-5);">
            <img src="<?= APP_URL ?>/assets/images/cemcs-logo-colored-255x68.png" alt="Chevron CEMCS MFB" style="height:44px;width:auto;margin:0 auto var(--space-4);">
            <h2 style="color: var(--blue-dark); margin-bottom: var(--space-1);">Admin Access</h2>
            <p style="color: var(--neutral-500); font-size: 0.9rem;">Please sign in to continue.</p>
        </div>
        
        <?php if(!empty($error)): ?>
            <div style="background: rgba(217, 35, 46, 0.1); color: var(--red-primary); padding: var(--space-3); border-radius: var(--radius-md); margin-bottom: var(--space-4); text-align: center; font-size: 0.9rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/login">
            <?= CsrfHelper::field() ?>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label class="form-label">Secure Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: var(--space-2);">Authenticate</button>
        </form>
        <p style="text-align: center; font-size: 0.8rem; color: var(--neutral-400); margin-top: var(--space-5);">
            Restricted System. Unauthorized access is meticulously monitored.
        </p>
    </div>
</div>
