<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);">
    <h2 style="margin:0;color:var(--blue-dark);">CV Applications</h2>
    <span style="font-size:0.85rem;color:var(--neutral-500);"><?= count($applications) ?> total submission<?= count($applications) !== 1 ? 's' : '' ?></span>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<?php if (empty($applications)): ?>
    <div class="card" style="text-align:center;padding:var(--space-8);color:var(--neutral-500);">
        No CV applications received yet.
    </div>
<?php else: ?>
<div class="card" style="padding:0;overflow:hidden;">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;min-width:900px;">
            <thead>
                <tr style="border-bottom:2px solid var(--neutral-100);background:var(--neutral-100);">
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">#</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Applicant</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Position</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Contact</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">CV</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Date</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Status</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                <?php
                    $statusColors = [
                        'new'         => ['bg' => 'rgba(217,35,46,0.1)',  'color' => 'var(--red-primary)', 'label' => 'New'],
                        'reviewed'    => ['bg' => 'rgba(234,179,8,0.1)',  'color' => '#B45309',            'label' => 'Reviewed'],
                        'shortlisted' => ['bg' => 'rgba(21,128,61,0.1)',  'color' => '#15803D',            'label' => 'Shortlisted'],
                        'rejected'    => ['bg' => 'rgba(100,100,100,0.1)','color' => 'var(--neutral-500)', 'label' => 'Rejected'],
                    ];
                    $sc = $statusColors[$app['status']] ?? $statusColors['new'];
                    $whatsappNum = preg_replace('/[^0-9]/', '', $app['whatsapp'] ?? '');
                    $waLink = $whatsappNum ? 'https://wa.me/' . $whatsappNum . '?text=' . urlencode('Hello ' . $app['full_name'] . ', regarding your application for ' . $app['position'] . ' at CEMCS MFB.') : '';
                    $mailSubject = urlencode('Re: Your Application for ' . $app['position'] . ' — CEMCS MFB');
                ?>
                <tr style="border-bottom:1px solid var(--neutral-100);">
                    <td style="padding:var(--space-3) var(--space-4);font-weight:600;color:var(--blue-primary);font-size:0.85rem;">CV-<?= str_pad($app['id'], 4, '0', STR_PAD_LEFT) ?></td>
                    <td style="padding:var(--space-3) var(--space-4);">
                        <div style="font-weight:600;"><?= htmlspecialchars($app['full_name']) ?></div>
                        <?php if ($app['cover_note']): ?>
                        <div style="font-size:0.75rem;color:var(--neutral-500);margin-top:2px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?= htmlspecialchars($app['cover_note']) ?>">
                            <?= htmlspecialchars($app['cover_note']) ?>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td style="padding:var(--space-3) var(--space-4);font-size:0.9rem;"><?= htmlspecialchars($app['position']) ?></td>
                    <td style="padding:var(--space-3) var(--space-4);">
                        <div style="font-size:0.85rem;margin-bottom:2px;">
                            <a href="mailto:<?= htmlspecialchars($app['email']) ?>?subject=<?= $mailSubject ?>" style="color:var(--blue-primary);" title="Send Email">
                                ✉ <?= htmlspecialchars($app['email']) ?>
                            </a>
                        </div>
                        <?php if ($app['phone']): ?>
                        <div style="font-size:0.8rem;color:var(--neutral-500);">📞 <?= htmlspecialchars($app['phone']) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($app['whatsapp'])): ?>
                        <div style="font-size:0.8rem;margin-top:2px;">
                            <a href="<?= $waLink ?>" target="_blank" style="color:#25D366;font-weight:600;" title="Send WhatsApp">
                                💬 <?= htmlspecialchars($app['whatsapp']) ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td style="padding:var(--space-3) var(--space-4);">
                        <a href="<?= APP_URL ?>/uploads/cv/<?= htmlspecialchars($app['cv_file']) ?>" target="_blank" class="btn btn-outline" style="padding:4px 10px;font-size:0.8rem;">
                            ⬇ Download CV
                        </a>
                    </td>
                    <td style="padding:var(--space-3) var(--space-4);color:var(--neutral-500);font-size:0.85rem;"><?= date('M j, Y', strtotime($app['created_at'])) ?></td>
                    <td style="padding:var(--space-3) var(--space-4);">
                        <span style="background:<?= $sc['bg'] ?>;color:<?= $sc['color'] ?>;padding:4px 8px;border-radius:4px;font-size:0.8rem;font-weight:600;">
                            <?= $sc['label'] ?>
                        </span>
                    </td>
                    <td style="padding:var(--space-3) var(--space-4);">
                        <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                            <a href="<?= APP_URL ?>/admin/application?type=cv&id=<?= (int) $app['id'] ?>"
                               class="btn btn-outline" style="padding:4px 10px;font-size:0.75rem;">
                                View
                            </a>
                            <a href="mailto:<?= htmlspecialchars($app['email']) ?>?subject=<?= $mailSubject ?>" 
                               class="btn btn-primary" style="padding:4px 10px;font-size:0.75rem;">
                                ✉ Email
                            </a>
                            <?php if ($waLink): ?>
                            <a href="<?= $waLink ?>" target="_blank"
                               class="btn" style="padding:4px 10px;font-size:0.75rem;background:#25D366;color:#fff;">
                                💬 WhatsApp
                            </a>
                            <?php endif; ?>
                            <form method="POST" action="<?= APP_URL ?>/admin/careers/status" style="display:flex;gap:6px;align-items:center;">
                                <?= CsrfHelper::field() ?>
                                <input type="hidden" name="id" value="<?= (int) $app['id'] ?>">
                                <input type="hidden" name="redirect_to" value="/admin/careers">
                                <select name="status" class="form-control" style="padding:4px 8px;height:auto;font-size:0.8rem;" required>
                                    <?php foreach (['new' => 'New', 'reviewed' => 'Reviewed', 'shortlisted' => 'Shortlisted', 'rejected' => 'Rejected'] as $value => $label): ?>
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
