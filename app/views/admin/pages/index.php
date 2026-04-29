<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);">
    <h2 style="margin:0;color:var(--blue-dark);">Page Manager</h2>
    <a href="<?= APP_URL ?>/admin/pages/new" class="btn btn-primary" style="font-size:0.85rem;">+ New Page</a>
</div>

<?php if (!empty($flash)): ?>
<div style="padding:var(--space-3) var(--space-4);border-radius:var(--radius-md);margin-bottom:var(--space-4);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;font-weight:600;">
    <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<div class="card" style="padding:0;overflow:hidden;">
    <?php if (empty($pages)): ?>
    <div style="padding:var(--space-8);text-align:center;color:var(--neutral-500);">
        No pages yet. <a href="<?= APP_URL ?>/admin/pages/new" style="color:var(--blue-primary);">Create your first page →</a>
    </div>
    <?php else: ?>
    <table style="width:100%;border-collapse:collapse;text-align:left;">
        <thead>
            <tr style="border-bottom:2px solid var(--neutral-100);background:var(--neutral-100);">
                <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Title</th>
                <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Slug</th>
                <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Status</th>
                <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Last Updated</th>
                <th style="padding:var(--space-3) var(--space-4);font-size:0.8rem;text-transform:uppercase;color:var(--neutral-500);letter-spacing:.05em;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $p): ?>
            <tr style="border-bottom:1px solid var(--neutral-100);">
                <td style="padding:var(--space-3) var(--space-4);font-weight:600;"><?= htmlspecialchars($p['title']) ?></td>
                <td style="padding:var(--space-3) var(--space-4);font-family:monospace;font-size:0.85rem;color:var(--blue-primary);">
                    <a href="<?= APP_URL . htmlspecialchars($p['slug']) ?>" target="_blank" style="color:var(--blue-primary);"><?= htmlspecialchars($p['slug']) ?></a>
                </td>
                <td style="padding:var(--space-3) var(--space-4);">
                    <?php if ($p['status'] === 'published'): ?>
                    <span style="background:rgba(21,128,61,0.1);color:#15803D;padding:3px 10px;border-radius:4px;font-size:0.8rem;font-weight:600;">Published</span>
                    <?php else: ?>
                    <span style="background:rgba(234,179,8,0.1);color:#B45309;padding:3px 10px;border-radius:4px;font-size:0.8rem;font-weight:600;">Draft</span>
                    <?php endif; ?>
                </td>
                <td style="padding:var(--space-3) var(--space-4);color:var(--neutral-500);font-size:0.85rem;"><?= date('M j, Y H:i', strtotime($p['updated_at'])) ?></td>
                <td style="padding:var(--space-3) var(--space-4);">
                    <div style="display:flex;gap:6px;">
                        <a href="<?= APP_URL ?>/admin/pages/edit?id=<?= $p['id'] ?>" class="btn btn-primary" style="padding:4px 12px;font-size:0.8rem;">Edit</a>
                        <form method="POST" action="<?= APP_URL ?>/admin/pages/delete" onsubmit="return confirm('Delete this page permanently?');" style="display:inline;">
                            <?= CsrfHelper::field() ?>
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button type="submit" class="btn btn-outline" style="padding:4px 12px;font-size:0.8rem;color:var(--red-primary);border-color:var(--red-primary);">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
