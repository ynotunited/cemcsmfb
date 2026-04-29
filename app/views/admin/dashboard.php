<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-5);">
    <h2 style="margin: 0; color: var(--blue-dark);">System Dashboard</h2>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <a href="<?= APP_URL ?>/admin/export-leads" class="btn btn-primary" style="font-size: 0.85rem;">
            <svg style="width:16px;height:16px;vertical-align:middle;margin-right:8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Export All Data (CSV)
        </a>
        <form method="POST" action="<?= APP_URL ?>/admin/followups/run">
            <?= CsrfHelper::field() ?>
            <button class="btn btn-outline" style="font-size:0.85rem;" type="submit">Run Follow-Ups</button>
        </form>
    </div>
</div>

<?php if (!empty($flash)): ?>
    <div style="margin-bottom:var(--space-4);padding:var(--space-3);border-radius:var(--radius-md);background:<?= $flash['type'] === 'success' ? 'rgba(21,128,61,0.1)' : 'rgba(217,35,46,0.1)' ?>;color:<?= $flash['type'] === 'success' ? '#15803D' : 'var(--red-primary)' ?>;">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<?php $analytics = $analytics ?? []; ?>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:var(--space-4);margin-bottom:var(--space-6);">
    <div class="card" style="border-top:4px solid #0EA5E9;text-align:center;">
        <h4 style="color:var(--neutral-500);text-transform:uppercase;font-size:0.78rem;">Chat Resolution Proxy</h4>
        <h1 style="color:#0EA5E9;margin:var(--space-2) 0;"><?= number_format((float) ($analytics['executive']['chat_resolution_proxy'] ?? 0), 1) ?>%</h1>
    </div>
    <div class="card" style="border-top:4px solid #16A34A;text-align:center;">
        <h4 style="color:var(--neutral-500);text-transform:uppercase;font-size:0.78rem;">Lead Conversion Proxy</h4>
        <h1 style="color:#16A34A;margin:var(--space-2) 0;"><?= number_format((float) ($analytics['executive']['lead_conversion_proxy'] ?? 0), 1) ?>%</h1>
    </div>
    <div class="card" style="border-top:4px solid #B45309;text-align:center;">
        <h4 style="color:var(--neutral-500);text-transform:uppercase;font-size:0.78rem;">FAQ Draft Backlog</h4>
        <h1 style="color:#B45309;margin:var(--space-2) 0;"><?= (int) ($analytics['faqDrafts'] ?? 0) ?></h1>
    </div>
    <div class="card" style="border-top:4px solid #DC2626;text-align:center;">
        <h4 style="color:var(--neutral-500);text-transform:uppercase;font-size:0.78rem;">Stale Pages (&gt;120d)</h4>
        <h1 style="color:#DC2626;margin:var(--space-2) 0;"><?= count($analytics['stalePages'] ?? []) ?></h1>
    </div>
</div>

<div style="display:grid;grid-template-columns:1.1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-6);">
    <div class="card">
        <h3 style="margin-bottom:var(--space-3);">Next Best Actions</h3>
        <?php if (empty($analytics['actions'])): ?>
            <p style="color:var(--neutral-500);">No urgent actions right now.</p>
        <?php else: ?>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <?php foreach ($analytics['actions'] as $action): ?>
                    <a href="<?= APP_URL . htmlspecialchars($action['link']) ?>" style="display:block;background:var(--neutral-100);padding:10px;border-radius:8px;">
                        <div style="font-weight:700;color:var(--neutral-900);"><?= htmlspecialchars($action['label']) ?></div>
                        <div style="font-size:0.84rem;color:var(--neutral-600);"><?= htmlspecialchars($action['detail']) ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card">
        <h3 style="margin-bottom:var(--space-3);">Top Priority Leads</h3>
        <?php if (empty($analytics['topLeads'])): ?>
            <p style="color:var(--neutral-500);">Lead scores will appear after applications are submitted.</p>
        <?php else: ?>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <?php foreach ($analytics['topLeads'] as $lead): ?>
                    <div style="background:var(--neutral-100);padding:10px;border-radius:8px;">
                        <div style="font-weight:700;color:var(--neutral-900);">
                            <?= strtoupper(htmlspecialchars($lead['entity_type'])) ?> #<?= (int) $lead['entity_id'] ?>
                            <span style="font-size:0.78rem;color:<?= ($lead['priority'] ?? 'low') === 'high' ? '#DC2626' : (($lead['priority'] ?? 'low') === 'medium' ? '#B45309' : '#15803D') ?>;">
                                (<?= strtoupper(htmlspecialchars($lead['priority'] ?? 'LOW')) ?>)
                            </span>
                        </div>
                        <div style="font-size:0.84rem;color:var(--neutral-600);">Score: <?= (int) $lead['score'] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--space-4);margin-bottom:var(--space-6);">
    <div class="card">
        <h3 style="margin-bottom:var(--space-3);">Intent Mix</h3>
        <?php if (empty($analytics['intentBreakdown'])): ?>
            <p style="color:var(--neutral-500);">Intent analytics will appear after chatbot usage.</p>
        <?php else: ?>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <?php foreach ($analytics['intentBreakdown'] as $row): ?>
                    <div style="display:flex;justify-content:space-between;background:var(--neutral-100);padding:8px 10px;border-radius:8px;">
                        <span style="font-weight:600;"><?= htmlspecialchars((string) ($row['intent'] ?? 'general')) ?></span>
                        <span style="color:var(--neutral-600);"><?= (int) ($row['total'] ?? 0) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card">
        <h3 style="margin-bottom:var(--space-3);">Knowledge Freshness Monitor</h3>
        <?php if (empty($analytics['stalePages'])): ?>
            <p style="color:#15803D;">Great news: no stale pages older than 120 days.</p>
        <?php else: ?>
            <div style="display:flex;flex-direction:column;gap:8px;max-height:240px;overflow:auto;">
                <?php foreach (array_slice($analytics['stalePages'], 0, 8) as $page): ?>
                    <div style="background:var(--neutral-100);padding:8px 10px;border-radius:8px;">
                        <div style="font-weight:700;"><?= htmlspecialchars($page['page']) ?></div>
                        <div style="font-size:0.82rem;color:var(--neutral-600);">
                            <?= (int) $page['days_old'] ?> days old · last updated <?= htmlspecialchars($page['last_modified']) ?> · route <?= htmlspecialchars($page['route']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-4); margin-bottom: var(--space-6);">
    <div class="card" style="border-top: 4px solid var(--blue-primary); text-align: center;">
        <h4 style="color: var(--neutral-500); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Total Accounts</h4>
        <h1 style="color: var(--blue-dark); margin: var(--space-2) 0;"><?= number_format($totalAccounts ?? 0) ?></h1>
        <span style="color: #15803D; font-size: 0.8rem; font-weight: 600;">All applications</span>
    </div>
    <div class="card" style="border-top: 4px solid var(--red-primary); text-align: center;">
        <h4 style="color: var(--neutral-500); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Active Loan Apps</h4>
        <h1 style="color: var(--blue-dark); margin: var(--space-2) 0;"><?= number_format($activeLoanApps ?? 0) ?></h1>
        <span style="color: var(--red-primary); font-size: 0.8rem; font-weight: 600;">Requires Review</span>
    </div>
    <div class="card" style="border-top: 4px solid var(--neutral-900); text-align: center;">
        <h4 style="color: var(--neutral-500); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">Contact Messages</h4>
        <h1 style="color: var(--blue-dark); margin: var(--space-2) 0;"><?= number_format($unreadMessages ?? 0) ?></h1>
        <span style="color: var(--neutral-500); font-size: 0.8rem;">Support & Inquiries</span>
    </div>
    <div class="card" style="border-top: 4px solid #7C3AED; text-align: center;">
        <h4 style="color: var(--neutral-500); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.05em;">CV Applications</h4>
        <h1 style="color: var(--blue-dark); margin: var(--space-2) 0;"><?= number_format($totalCvApps ?? 0) ?></h1>
        <a href="<?= APP_URL ?>/admin/careers" style="color:#7C3AED;font-size:0.8rem;font-weight:600;">View All</a>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom: var(--space-4);">Recent Applications</h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 2px solid var(--neutral-100);">
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Ref ID</th>
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Applicant</th>
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Type</th>
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Date</th>
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Status</th>
                    <th style="padding: var(--space-2); color: var(--neutral-500); font-size: 0.85rem; text-transform: uppercase;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentApplications)): ?>
                    <tr>
                        <td colspan="6" style="padding: var(--space-5); text-align: center; color: var(--neutral-500);">No applications yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recentApplications as $app): ?>
                        <?php
                            $isLoan   = $app['_type'] === 'Loan Request';
                            $refId    = $isLoan
                                ? 'L-' . str_pad($app['id'], 5, '0', STR_PAD_LEFT)
                                : 'ACC-' . str_pad($app['id'], 4, '0', STR_PAD_LEFT);
                            $name     = htmlspecialchars($app['full_name'] ?? '—');
                            $status   = $app['status'] ?? 'new';
                            $date     = date('M j, Y', strtotime($app['created_at']));

                            $statusColors = [
                                'new'         => ['bg' => 'rgba(217,35,46,0.1)',   'color' => 'var(--red-primary)',  'label' => 'New'],
                                'review'      => ['bg' => 'rgba(234,179,8,0.1)',   'color' => '#B45309',             'label' => 'In Review'],
                                'approved'    => ['bg' => 'rgba(21,128,61,0.1)',   'color' => '#15803D',             'label' => 'Approved'],
                                'rejected'    => ['bg' => 'rgba(100,100,100,0.1)', 'color' => 'var(--neutral-500)',  'label' => 'Rejected'],
                                'contacted'   => ['bg' => 'rgba(26,130,196,0.1)',  'color' => 'var(--blue-primary)', 'label' => 'Contacted'],
                            ];
                            $sc = $statusColors[$status] ?? $statusColors['new'];
                        ?>
                        <tr style="border-bottom: 1px solid var(--neutral-100);">
                            <td style="padding: var(--space-3) var(--space-2); font-weight: 600; color: var(--blue-primary);"><?= $refId ?></td>
                            <td style="padding: var(--space-3) var(--space-2);"><?= $name ?></td>
                            <td style="padding: var(--space-3) var(--space-2);"><?= htmlspecialchars($app['_type']) ?></td>
                            <td style="padding: var(--space-3) var(--space-2); color: var(--neutral-500); font-size: 0.9rem;"><?= $date ?></td>
                            <td style="padding: var(--space-3) var(--space-2);">
                                <span style="background: <?= $sc['bg'] ?>; color: <?= $sc['color'] ?>; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                    <?= $sc['label'] ?>
                                </span>
                            </td>
                            <td style="padding: var(--space-3) var(--space-2);">
                                <a class="btn btn-outline" style="padding: 4px 10px; font-size: 0.8rem;" href="<?= APP_URL ?>/admin/application?type=<?= $isLoan ? 'loan' : 'account' ?>&id=<?= (int) $app['id'] ?>">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
