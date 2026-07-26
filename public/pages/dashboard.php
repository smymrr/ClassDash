<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?> · ClassDash</title>
    <link rel="stylesheet" href="../assets/css/global/variables.css">
    <link rel="stylesheet" href="../assets/css/global/reset.css">
    <link rel="stylesheet" href="../assets/css/global/layout.css">
    <link rel="stylesheet" href="../assets/css/components/sidebar.css">
    <link rel="stylesheet" href="../assets/css/components/topbar.css">
    <link rel="stylesheet" href="../assets/css/components/cards.css">
    <link rel="stylesheet" href="../assets/css/pages/dashboard.css">
</head>
<body>
    <div class="cd-layout">
        <?php require __DIR__ . '/../../includes/components/sidebar.php'; ?>

        <main class="cd-main">
            <?php require __DIR__ . '/../../includes/components/topbar.php'; ?>

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
        </main>
    </div>
</body>
</html>
