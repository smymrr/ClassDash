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
    <link rel="stylesheet" href="../assets/css/pages/members.css">
</head>
<body>
    <div class="cd-layout">
        <?php require __DIR__ . '/../../includes/components/sidebar.php'; ?>

        <main class="cd-main">
            <?php require __DIR__ . '/../../includes/components/topbar.php'; ?>

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
                        <tr><td colspan="4">PLACEHOLDER_NO_MEMBERS_MESSAGE_SIDEBAR</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
