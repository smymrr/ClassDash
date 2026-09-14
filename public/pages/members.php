<?php
$styles = ['../assets/css/pages/members.css'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

<table class="cd-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Unpaid Debt</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['fullname']) ?></td>
                <td><?= htmlspecialchars($m['role']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td>Rp <?= htmlspecialchars(number_format((int) $m['unpaid_total'], 0, ',', '.')) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($members)): ?>
            <tr>
                <td colspan="4">PLACEHOLDER_NO_MEMBERS_MESSAGE_SIDEBAR</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require dirname(__DIR__, 2) . '/includes/layouts/footer.php'; ?>