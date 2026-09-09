<?php
/**
 * includes/components/topbar.php
 * Optional page header. Expects $pageTitle and $pageSubtitle from the
 * controller, e.g.: $pageTitle = 'Dashboard'; $pageSubtitle = 'Welcome back, ' . $currentUser['name'];
 */
?>
<header class="cd-topbar">
    <!-- Left Group: Title + Subtitle wrapped together -->
    <div>
        <h1 class="cd-topbar__title">
            <?= htmlspecialchars($pageTitle ?? 'Dashboard') ?>
        </h1>
        
        <?php if (!empty($pageSubtitle)): ?>
            <p class="cd-topbar__subtitle">
                <?= htmlspecialchars($pageSubtitle) ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Right Group: Actions Wrapper -->
    <?php if (!empty($pageActions)): ?>
        <div class="cd-topbar__actions">
            <?php foreach ($pageActions as $action): ?>
                <a href="<?= htmlspecialchars($action['url']) ?>" 
                   class="cd-btn <?= htmlspecialchars($action['class'] ?? 'cd-btn--primary') ?>">
                    <?= htmlspecialchars($action['label']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</header>
