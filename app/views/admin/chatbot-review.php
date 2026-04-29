<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);gap:12px;flex-wrap:wrap;">
    <h2 style="margin:0;color:var(--blue-dark);">Chatbot Review Queue</h2>
    <span style="font-size:0.85rem;color:var(--neutral-500);"><?= count($logs) ?> recent interaction<?= count($logs) !== 1 ? 's' : '' ?></span>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:var(--space-4);margin-bottom:var(--space-5);">
    <div class="card" style="text-align:center;border-top:4px solid var(--blue-primary);">
        <h4 style="font-size:0.78rem;color:var(--neutral-500);text-transform:uppercase;">Total Logs</h4>
        <h1 style="margin:var(--space-2) 0;color:var(--blue-dark);"><?= (int) ($summary['total'] ?? 0) ?></h1>
    </div>
    <div class="card" style="text-align:center;border-top:4px solid var(--red-primary);">
        <h4 style="font-size:0.78rem;color:var(--neutral-500);text-transform:uppercase;">Needs Help</h4>
        <h1 style="margin:var(--space-2) 0;color:var(--red-primary);"><?= (int) ($summary['unanswered_or_handoff'] ?? 0) ?></h1>
    </div>
    <div class="card" style="text-align:center;border-top:4px solid #B45309;">
        <h4 style="font-size:0.78rem;color:var(--neutral-500);text-transform:uppercase;">New</h4>
        <h1 style="margin:var(--space-2) 0;color:#B45309;"><?= (int) ($summary['new'] ?? 0) ?></h1>
    </div>
    <div class="card" style="text-align:center;border-top:4px solid #15803D;">
        <h4 style="font-size:0.78rem;color:var(--neutral-500);text-transform:uppercase;">Resolved</h4>
        <h1 style="margin:var(--space-2) 0;color:#15803D;"><?= (int) ($summary['resolved'] ?? 0) ?></h1>
    </div>
</div>

<div class="card" style="margin-bottom:var(--space-5);">
    <h3 style="margin-bottom:var(--space-3);">Top Unresolved Questions</h3>
    <?php if (empty($topQuestions)): ?>
        <p style="color:var(--neutral-500);">No unresolved questions yet.</p>
    <?php else: ?>
        <div style="display:grid;grid-template-columns:1fr;gap:8px;">
            <?php foreach ($topQuestions as $item): ?>
                <div style="background:var(--neutral-100);padding:10px 12px;border-radius:8px;display:flex;justify-content:space-between;gap:12px;align-items:flex-start;">
                    <div style="font-size:0.92rem;color:var(--neutral-900);"><?= htmlspecialchars($item['question']) ?></div>
                    <span style="font-size:0.8rem;color:var(--red-primary);font-weight:700;white-space:nowrap;"><?= (int) $item['total_hits'] ?> hit<?= ((int) $item['total_hits']) !== 1 ? 's' : '' ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php if (empty($logs)): ?>
    <div class="card" style="text-align:center;padding:var(--space-8);color:var(--neutral-500);">
        No chatbot activity logged yet.
    </div>
<?php else: ?>
<div class="card" style="padding:0;overflow:hidden;">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;min-width:1250px;">
            <thead>
                <tr style="border-bottom:2px solid var(--neutral-100);background:var(--neutral-100);">
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Time</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Question</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Answer</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Source</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Signals</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Intent Prefill</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Review Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr style="border-bottom:1px solid var(--neutral-100);">
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.8rem;color:var(--neutral-500);white-space:nowrap;">
                            <?= date('M j, Y H:i', strtotime($log['created_at'])) ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.9rem;max-width:260px;">
                            <?= htmlspecialchars($log['question']) ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.88rem;color:var(--neutral-700);max-width:360px;">
                            <?= htmlspecialchars((string) ($log['answer_text'] ?? '')) ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.85rem;max-width:200px;">
                            <?php if (!empty($log['source_url'])): ?>
                                <a href="<?= htmlspecialchars($log['source_url']) ?>" target="_blank" rel="noopener" style="color:var(--blue-primary);text-decoration:underline;">
                                    <?= htmlspecialchars($log['source_title'] ?: 'Related Page') ?>
                                </a>
                            <?php else: ?>
                                <span style="color:var(--neutral-500);">None</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.82rem;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <span style="color:<?= (int) $log['answered'] === 1 ? '#15803D' : 'var(--red-primary)' ?>;">
                                    <?= (int) $log['answered'] === 1 ? 'Answered' : 'Unanswered' ?>
                                </span>
                                <span style="color:<?= (int) $log['handoff_whatsapp'] === 1 ? 'var(--red-primary)' : 'var(--neutral-500)' ?>;">
                                    <?= (int) $log['handoff_whatsapp'] === 1 ? 'WhatsApp Handoff' : 'No Handoff' ?>
                                </span>
                                <span style="color:var(--neutral-500);">IP: <?= htmlspecialchars((string) ($log['user_ip'] ?? 'N/A')) ?></span>
                            </div>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);font-size:0.82rem;max-width:200px;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <span style="font-weight:700;color:var(--neutral-800);"><?= htmlspecialchars((string) ($log['intent'] ?? 'general')) ?></span>
                                <?php if (!empty($log['prefill_url'])): ?>
                                    <a href="<?= htmlspecialchars($log['prefill_url']) ?>" target="_blank" rel="noopener" style="color:var(--blue-primary);text-decoration:underline;">Open Prefill</a>
                                <?php else: ?>
                                    <span style="color:var(--neutral-500);">No prefill</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);min-width:260px;">
                            <form method="POST" action="<?= APP_URL ?>/admin/chatbot-review/status" style="display:flex;flex-direction:column;gap:6px;">
                                <?= CsrfHelper::field() ?>
                                <input type="hidden" name="id" value="<?= (int) $log['id'] ?>">
                                <input type="hidden" name="redirect_to" value="/admin/chatbot-review">
                                <select name="status" class="form-control" style="padding:6px 8px;height:auto;font-size:0.82rem;" required>
                                    <?php foreach (['new' => 'New', 'reviewed' => 'Reviewed', 'resolved' => 'Resolved', 'escalated' => 'Escalated'] as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= ($log['status'] ?? 'new') === $value ? 'selected' : '' ?>><?= $label ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" name="review_note" class="form-control" style="padding:6px 8px;height:auto;font-size:0.82rem;" placeholder="Review note (optional)" value="<?= htmlspecialchars((string) ($log['review_note'] ?? '')) ?>">
                                <button type="submit" class="btn btn-primary" style="padding:5px 10px;font-size:0.76rem;">Save</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
