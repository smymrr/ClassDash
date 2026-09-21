<<<<<<< Updated upstream
<?php
$styles = ['../assets/css/pages/treasury.css'];
$scripts = ['../assets/js/components/modal.js'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

<div class="cd-card cd-card--accent-blue">
    <h2 class="cd-card__label">Overview</h2>
    <div class="cd-card__value">Rp 500.000</div>
    <div class="cd-card__description">Total balance in the treasury</div>
</div>

<table class="cd-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $tx): ?>
            <tr>
                <td><?= htmlspecialchars($tx['title']) ?></td>
                <td><?= htmlspecialchars($tx['category']) ?></td>
                <td><?= htmlspecialchars($tx['amount']) ?></td>
                <td><?= htmlspecialchars($tx['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($transactions)): ?>
            <tr>
                <td colspan="4">PLACEHOLDER_NO_TRANSACTIONS_MESSAGE_SIDEBAR</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
require __DIR__ . '/../../includes/modals/add_income.php';
require __DIR__ . '/../../includes/modals/add_expense.php';
require dirname(__DIR__, 2) . '/includes/layouts/footer.php'; 
?>

=======
<?php
$styles = ['../assets/css/pages/treasury.css'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

<div class="cd-card cd-card--accent-blue">
    <h2 class="cd-card__label">Overview</h2>
    <div class="cd-card__value">Rp 500.000</div>
    <div class="cd-card__description">Total balance in the treasury</div>
</div>

<table class="cd-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $tx): ?>
            <tr>
                <td><?= htmlspecialchars($tx['title']) ?></td>
                <td><?= htmlspecialchars($tx['category']) ?></td>
                <td><?= htmlspecialchars($tx['amount']) ?></td>
                <td><?= htmlspecialchars($tx['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($transactions)): ?>
            <tr>
                <td colspan="4">PLACEHOLDER_NO_TRANSACTIONS_MESSAGE_SIDEBAR</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$scripts = ['../assets/js/components/modal.js'];
require dirname(__DIR__, 2) . '/includes/modals/modal_add_income.php';
require dirname(__DIR__, 2) . '/includes/modals/modal_add_expense.php';
require dirname(__DIR__, 2) . '/includes/layouts/footer.php';
?>
>>>>>>> Stashed changes
