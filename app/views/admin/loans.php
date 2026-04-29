<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);">
    <h2 style="margin:0;color:var(--blue-dark);">Loan Applications</h2>
    <span style="font-size:0.85rem;color:var(--neutral-500);"><?= count($applications) ?> total</span>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<?php if (empty($applications)): ?>
    <div class="card" style="text-align:center;padding:var(--space-8);color:var(--neutral-500);">
        No loan applications yet.
    </div>
<?php else: ?>
<div class="card" style="padding:0;overflow:hidden;">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;min-width:980px;">
            <thead>
                <tr style="border-bottom:2px solid var(--neutral-100);background:var(--neutral-100);">
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">REF</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Loan Type</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Amount</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Duration</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Employment</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Lead Score</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Status</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr style="border-bottom:1px solid var(--neutral-100);">
                        <td style="padding:var(--space-3) var(--space-4);font-weight:600;color:var(--blue-primary);">L-<?= str_pad($app['id'], 5, '0', STR_PAD_LEFT) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);"><?= htmlspecialchars(ucfirst($app['loan_type'])) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);">₦<?= number_format((float) $app['amount'], 2) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);"><?= (int) $app['duration'] ?> months</td>
                        <td style="padding:var(--space-3) var(--space-4);"><?= htmlspecialchars($app['employment_status']) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);">
                            <?php if ($app['_lead_score'] !== null): ?>
                                <span style="font-weight:700;color:<?= ($app['_lead_priority'] ?? 'low') === 'high' ? '#DC2626' : (($app['_lead_priority'] ?? 'low') === 'medium' ? '#B45309' : '#15803D') ?>;">
                                    <?= (int) $app['_lead_score'] ?> (<?= strtoupper(htmlspecialchars($app['_lead_priority'] ?? 'LOW')) ?>)
                                </span>
                            <?php else: ?>
                                <span style="color:var(--neutral-500);">Not scored</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);"><?= htmlspecialchars(ucfirst($app['status'])) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);">
                            <div style="display:flex;gap:8px;align-items:center;">
                                <a class="btn btn-outline" style="padding:4px 10px;font-size:0.75rem;" href="<?= APP_URL ?>/admin/application?type=loan&id=<?= (int) $app['id'] ?>">View</a>
                                <form method="POST" action="<?= APP_URL ?>/admin/loans/status" style="display:flex;gap:6px;align-items:center;">
                                    <?= CsrfHelper::field() ?>
                                    <input type="hidden" name="id" value="<?= (int) $app['id'] ?>">
                                    <input type="hidden" name="redirect_to" value="/admin/loans">
                                    <select name="status" class="form-control" style="padding:4px 8px;height:auto;font-size:0.8rem;" required>
                                        <?php foreach (['new' => 'New', 'review' => 'In Review', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label): ?>
                                            <option value="<?= $value ?>" <?= $app['status'] === $value ? 'selected' : '' ?>><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary" style="padding:4px 10px;font-size:0.75rem;">Save</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
