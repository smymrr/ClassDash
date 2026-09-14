<?php
// Set up
$styles = ['../assets/css/pages/dashboard.css'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

<section class="cd-cards">
    <div class="cd-card cd-card--accent-blue">
        <span class="cd-card__label">Current Balance</span>
        <div class="cd-card__value">
            Rp <?= htmlspecialchars(number_format($currentBalance, 0, ',', '.')) ?>
        </div>
    </div>
    <div class="cd-card cd-card--accent-orange">
        <span class="cd-card__label">Total Unpaid Debts</span>
        <div class="cd-card__value">
            Rp <?= htmlspecialchars(number_format($totalUnpaidDebts, 0, ',', '.')) ?>
        </div>
    </div>
    <div class="cd-card cd-card--accent-green">
        <span class="cd-card__label">Announcements This Month</span>
        <div class="cd-card__value"><?= (int) $announcementsCount ?></div>
    </div>
</section>

<section class="cd-panels">
    <div class="cd-panel">
        <h2>Recent Transactions</h2>
        <ul class="cd-transaction-list">
            <?php foreach ($recentTransactions as $tx): ?>
                <li>
                    <span><?= htmlspecialchars($tx['title']) ?></span>
                    <span><?= htmlspecialchars($tx['amount']) ?></span>
                </li>
            <?php endforeach; ?>
            <?php if (empty($recentTransactions)): ?>
                <li>PLACEHOLDER_NO_TRANSACTIONS_MESSAGE_SIDEBAR</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="cd-panel">
        <h2>Info Board</h2>
        <ul class="cd-announcement-list">
            <?php foreach ($recentAnnouncements as $a): ?>
                <li>
                    <span class="cd-tag"><?= htmlspecialchars($a['tag']) ?></span>
                    <strong><?= htmlspecialchars($a['title']) ?></strong>
                </li>
            <?php endforeach; ?>
            <?php if (empty($recentAnnouncements)): ?>
                <li>PLACEHOLDER_NO_ANNOUNCEMENTS_MESSAGE_SIDEBAR</li>
            <?php endif; ?>
        </ul>
    </div>
</section>

<?php require dirname(__DIR__, 2) . '/includes/layouts/footer.php'; ?>