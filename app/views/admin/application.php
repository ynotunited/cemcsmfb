<?php
$isAccount = $type === 'account';
$isLoan    = $type === 'loan';
$isCv      = $type === 'cv';

$ref = $isAccount
    ? 'ACC-' . str_pad($record['id'], 4, '0', STR_PAD_LEFT)
    : ($isLoan ? 'L-' . str_pad($record['id'], 5, '0', STR_PAD_LEFT) : 'CV-' . str_pad($record['id'], 4, '0', STR_PAD_LEFT));

$statusEndpoint = $isAccount ? '/admin/accounts/status' : ($isLoan ? '/admin/loans/status' : '/admin/careers/status');
$statusOptions  = $isAccount
    ? ['new' => 'New', 'contacted' => 'Contacted', 'approved' => 'Approved', 'rejected' => 'Rejected']
    : ($isLoan
        ? ['new' => 'New', 'review' => 'In Review', 'approved' => 'Approved', 'rejected' => 'Rejected']
        : ['new' => 'New', 'reviewed' => 'Reviewed', 'shortlisted' => 'Shortlisted', 'rejected' => 'Rejected']);

$backPath = $isAccount ? '/admin/accounts' : ($isLoan ? '/admin/loans' : '/admin/careers');
?>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);gap:16px;flex-wrap:wrap;">
    <div>
        <h2 style="margin:0;color:var(--blue-dark);">Application Details</h2>
        <p style="margin-top:4px;color:var(--neutral-500);font-size:0.9rem;"><?= htmlspecialchars($ref) ?></p>
    </div>
    <a href="<?= APP_URL . $backPath ?>" class="btn btn-outline">Back to List</a>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<div class="card" style="margin-bottom:var(--space-5);">
    <h3 style="margin-bottom:var(--space-4);">Status Control</h3>
    <form method="POST" action="<?= APP_URL . $statusEndpoint ?>" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <?= CsrfHelper::field() ?>
        <input type="hidden" name="id" value="<?= (int) $record['id'] ?>">
        <input type="hidden" name="redirect_to" value="<?= htmlspecialchars('/admin/application?type=' . $type . '&id=' . (int) $record['id']) ?>">
        <select name="status" class="form-control" style="max-width:240px;" required>
            <?php foreach ($statusOptions as $value => $label): ?>
                <option value="<?= $value ?>" <?= ($record['status'] ?? '') === $value ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>

<div class="card">
    <h3 style="margin-bottom:var(--space-4);">Submitted Data</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:var(--space-4);">
        <?php foreach ($record as $key => $value): ?>
            <?php if ($key === 'id'): ?>
                <?php continue; ?>
            <?php endif; ?>
            <div style="background:var(--neutral-100);padding:var(--space-3);border-radius:var(--radius-md);">
                <div style="font-size:0.75rem;color:var(--neutral-500);text-transform:uppercase;letter-spacing:.04em;margin-bottom:4px;"><?= htmlspecialchars(str_replace('_', ' ', $key)) ?></div>
                <div style="font-size:0.95rem;color:var(--neutral-900);word-break:break-word;">
                    <?php if ($key === 'cv_file' && $isCv): ?>
                        <a href="<?= APP_URL ?>/uploads/cv/<?= htmlspecialchars((string) $value) ?>" target="_blank" rel="noopener">Download CV</a>
                    <?php else: ?>
                        <?= nl2br(htmlspecialchars((string) $value)) ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
