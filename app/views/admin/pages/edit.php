<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:var(--space-5);">
    <h2 style="margin:0;color:var(--blue-dark);"><?= $page ? 'Edit Page' : 'New Page' ?></h2>
    <a href="<?= APP_URL ?>/admin/pages" class="btn btn-outline" style="font-size:0.85rem;">← Back to Pages</a>
</div>

<?php if (!empty($flash)): ?>
<div style="padding:var(--space-3) var(--space-4);border-radius:var(--radius-md);margin-bottom:var(--space-4);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;font-weight:600;">
    <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>

<form method="POST" action="<?= APP_URL ?>/admin/pages/<?= $page ? 'edit' : 'new' ?>">
    <?= CsrfHelper::field() ?>
    <?php if ($page): ?>
    <input type="hidden" name="id" value="<?= (int) $page['id'] ?>">
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-4);">
        <div class="card">
            <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:var(--space-2);">Page Title *</label>
            <input type="text" name="title" class="form-control" required
                   value="<?= htmlspecialchars($page['title'] ?? '') ?>"
                   placeholder="e.g. About CEMCS MFB">
        </div>
        <div class="card">
            <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:var(--space-2);">
                URL Slug *
                <?php if ($page): ?>
                <span style="font-weight:400;color:var(--neutral-500);font-size:0.8rem;">(cannot be changed after creation)</span>
                <?php endif; ?>
            </label>
            <?php if ($page): ?>
            <input type="text" class="form-control" value="<?= htmlspecialchars($page['slug']) ?>" disabled style="background:var(--neutral-100);color:var(--neutral-500);">
            <?php else: ?>
            <input type="text" name="slug" class="form-control" required
                   placeholder="e.g. /blog/my-post-title"
                   pattern="^\/[a-z0-9\-\/]+$"
                   title="Must start with / and contain only lowercase letters, numbers, hyphens and slashes">
            <p style="font-size:0.75rem;color:var(--neutral-500);margin-top:4px;">Start with / — e.g. /blog/post-title or /news/update</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card" style="margin-bottom:var(--space-4);">
        <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:var(--space-2);">Meta Description <span style="font-weight:400;color:var(--neutral-500);">(for SEO, max 320 chars)</span></label>
        <input type="text" name="meta_description" class="form-control" maxlength="320"
               value="<?= htmlspecialchars($page['meta_description'] ?? '') ?>"
               placeholder="Brief description shown in search engine results...">
    </div>

    <div class="card" style="margin-bottom:var(--space-4);">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:var(--space-3);margin-bottom:var(--space-3);flex-wrap:wrap;">
            <label for="page-content" style="display:block;font-weight:600;font-size:0.85rem;">Page Content *</label>
            <span style="font-size:0.78rem;color:var(--neutral-500);">Edit the full HTML source here, then check the live preview on the right.</span>
        </div>
        <div style="display:grid;grid-template-columns:1.1fr 0.9fr;gap:var(--space-4);align-items:start;">
            <textarea id="page-content" name="content" style="min-height:620px;width:100%;border:1px solid var(--neutral-200);border-radius:var(--radius-md);padding:var(--space-4);background:#fff;font-family:DM Mono, monospace;font-size:0.84rem;line-height:1.6;resize:vertical;white-space:pre;overflow:auto;"><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
            <div style="border:1px solid var(--neutral-200);border-radius:var(--radius-md);overflow:hidden;background:#fff;">
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 12px;border-bottom:1px solid var(--neutral-200);background:var(--neutral-50);">
                    <strong style="font-size:0.85rem;color:var(--blue-dark);">Live Preview</strong>
                    <a href="#" id="preview-refresh" style="font-size:0.78rem;color:var(--blue-primary);text-decoration:underline;">Refresh</a>
                </div>
                <iframe id="page-preview" style="width:100%;height:620px;border:0;background:#fff;display:block;" title="Page preview"></iframe>
            </div>
        </div>
        <p style="font-size:0.78rem;color:var(--neutral-500);margin-top:var(--space-2);">
            The preview uses the public site styles so sections, images, and embedded layout pieces stay visible.
        </p>
    </div>

    <div class="card" style="margin-bottom:var(--space-5);">
        <label style="display:block;font-weight:600;font-size:0.85rem;margin-bottom:var(--space-3);">Status</label>
        <div style="display:flex;gap:var(--space-4);">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input type="radio" name="status" value="draft" <?= ($page['status'] ?? 'draft') === 'draft' ? 'checked' : '' ?>>
                <span>Draft <span style="font-size:0.8rem;color:var(--neutral-500);">— not visible on the public site</span></span>
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input type="radio" name="status" value="published" <?= ($page['status'] ?? '') === 'published' ? 'checked' : '' ?>>
                <span>Published <span style="font-size:0.8rem;color:var(--neutral-500);">— live on the public site</span></span>
            </label>
        </div>
    </div>

    <div style="display:flex;gap:var(--space-3);">
        <button type="submit" class="btn btn-primary" style="padding:10px 28px;">
            <?= $page ? 'Save Changes' : 'Create Page' ?>
        </button>
        <?php if ($page && $page['status'] === 'published'): ?>
        <a href="<?= APP_URL . htmlspecialchars($page['slug']) ?>" target="_blank" class="btn btn-outline" style="padding:10px 20px;">
            View Live Page ↗
        </a>
        <?php endif; ?>
        <a href="<?= APP_URL ?>/admin/pages" class="btn btn-outline" style="padding:10px 20px;">Cancel</a>
    </div>
</form>

<script>
(function () {
    const textarea = document.getElementById('page-content');
    const preview = document.getElementById('page-preview');
    const refresh = document.getElementById('preview-refresh');
    const form = document.querySelector('form[method="POST"]');
    if (!textarea || !preview || !form) return;

    const initialContent = <?= json_encode($page['content'] ?? '', JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    function renderPreview() {
        const html = `
            <!doctype html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <base href="<?= APP_URL ?>/">
              <link rel="preconnect" href="https://fonts.googleapis.com">
              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
              <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;1,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
              <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/globals.css">
              <style>
                html, body { margin: 0; padding: 0; background: #fff; }
                body { overflow: hidden; }
                .preview-shell { padding: 0; }
                img { max-width: 100%; height: auto; }
              </style>
            </head>
            <body>
              <div class="preview-shell">
                ${textarea.value || '<p style="padding:24px;">No content yet.</p>'}
              </div>
            </body>
            </html>
        `;
        preview.srcdoc = html;
    }

    function resizePreview() {
        try {
            const doc = preview.contentDocument || preview.contentWindow?.document;
            if (!doc || !doc.documentElement) return;
            const height = Math.max(
                doc.documentElement.scrollHeight || 0,
                doc.body ? doc.body.scrollHeight : 0,
                620
            );
            preview.style.height = Math.min(height + 24, 2000) + 'px';
        } catch (e) {
            // Ignore cross-document timing issues; the next load/input will retry.
        }
    }

    textarea.value = initialContent || textarea.value || '';
    textarea.addEventListener('input', renderPreview);
    textarea.addEventListener('blur', renderPreview);
    if (refresh) {
        refresh.addEventListener('click', function (e) {
            e.preventDefault();
            renderPreview();
        });
    }
    preview.addEventListener('load', function () {
        resizePreview();
        setTimeout(resizePreview, 250);
        setTimeout(resizePreview, 1000);
    });
    form.addEventListener('submit', function () {
        renderPreview();
        setTimeout(resizePreview, 50);
    });
    renderPreview();
})();
</script>
