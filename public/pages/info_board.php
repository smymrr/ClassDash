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
    <link rel="stylesheet" href="../assets/css/pages/info_board.css">
</head>
<body>
    <div class="cd-layout">
        <?php require __DIR__ . '/../../includes/components/sidebar.php'; ?>

        <main class="cd-main">
            <?php require __DIR__ . '/../../includes/components/topbar.php'; ?>

            <ul class="cd-announcement-list cd-announcement-list--full">
                <?php foreach ($announcements as $a): ?>
                    <li>
                        <span class="cd-tag"><?= htmlspecialchars($a['tag']) ?></span>
                        <strong><?= htmlspecialchars($a['title']) ?></strong>
                        <p><?= htmlspecialchars($a['body']) ?></p>
                    </li>
                <?php endforeach; ?>
                <?php if (empty($announcements)): ?>
                    <li>PLACEHOLDER_NO_ANNOUNCEMENTS_MESSAGE_SIDEBAR</li>
                <?php endif; ?>
            </ul>
        </main>
    </div>
</body>
</html>
