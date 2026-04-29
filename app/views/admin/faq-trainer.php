<div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:var(--space-5);">
    <h2 style="margin:0;color:var(--blue-dark);">AI FAQ Trainer</h2>
    <form method="POST" action="<?= APP_URL ?>/admin/faq-trainer/generate">
        <?= CsrfHelper::field() ?>
        <button class="btn btn-primary" type="submit">Generate Drafts From Unresolved Questions</button>
    </form>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<div class="card" style="margin-bottom:var(--space-5);">
    <h3 style="margin-bottom:var(--space-3);">Top Unresolved Chatbot Questions</h3>
    <?php if (empty($topQuestions)): ?>
        <p style="color:var(--neutral-500);">No unresolved questions found right now.</p>
    <?php else: ?>
        <ol style="padding-left:1.2rem;">
            <?php foreach ($topQuestions as $q): ?>
                <li style="margin-bottom:8px;">
                    <span style="font-weight:600;"><?= htmlspecialchars($q['question']) ?></span>
                    <span style="color:var(--red-primary);font-size:0.85rem;">(<?= (int) $q['total_hits'] ?> hits)</span>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</div>

<?php if (empty($drafts)): ?>
    <div class="card" style="text-align:center;padding:var(--space-8);color:var(--neutral-500);">
        No FAQ drafts yet. Click "Generate Drafts" to create suggestions.
    </div>
<?php else: ?>
<div class="card" style="padding:0;overflow:hidden;">
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:left;min-width:980px;">
            <thead>
                <tr style="border-bottom:2px solid var(--neutral-100);background:var(--neutral-100);">
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Question</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Suggested Answer</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Source Hint</th>
                    <th style="padding:var(--space-3) var(--space-4);font-size:0.78rem;color:var(--neutral-500);">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drafts as $row): ?>
                    <tr style="border-bottom:1px solid var(--neutral-100);">
                        <td style="padding:var(--space-3) var(--space-4);max-width:260px;font-weight:600;"><?= htmlspecialchars($row['question']) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);max-width:420px;color:var(--neutral-700);"><?= htmlspecialchars($row['answer_text']) ?></td>
                        <td style="padding:var(--space-3) var(--space-4);max-width:220px;">
                            <?php if (!empty($row['source_hint'])): ?>
                                <a href="<?= htmlspecialchars($row['source_hint']) ?>" target="_blank" rel="noopener" style="color:var(--blue-primary);text-decoration:underline;">Open Source</a>
                            <?php else: ?>
                                <span style="color:var(--neutral-500);">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding:var(--space-3) var(--space-4);">
                            <form method="POST" action="<?= APP_URL ?>/admin/faq-trainer/publish">
                                <?= CsrfHelper::field() ?>
                                <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                                <button class="btn btn-primary" style="padding:6px 10px;font-size:0.78rem;" type="submit">Publish</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
