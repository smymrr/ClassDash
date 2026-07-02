<?php
/**
 * includes/components/topbar.php
 * Optional page header. Expects $pageTitle and $pageSubtitle from the
 * controller, e.g.: $pageTitle = 'Dashboard'; $pageSubtitle = 'Welcome back, ' . $currentUser['name'];
 */
?>
<header class="cd-topbar">
    <div>
        <h1 class="cd-topbar__title">
            <?= htmlspecialchars($pageTitle ?? 'PLACEHOLDER_PAGE_TITLE_SIDEBAR', ENT_QUOTES, 'UTF-8') ?>
        </h1>
        <?php if (!empty($pageSubtitle)): ?>
            <p class="cd-topbar__subtitle">
                <?= htmlspecialchars($pageSubtitle, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>
    </div>
</header>
