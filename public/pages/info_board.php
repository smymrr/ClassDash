<?php 
$styles = ['../assets/css/pages/info_board.css'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

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

<?php require dirname(__DIR__, 2) . '/includes/layouts/footer.php'; ?>
