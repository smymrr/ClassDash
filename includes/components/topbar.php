<?php

/**
 * includes/components/topbar.php
 * Expects $pageTitle, $pageSubtitle, and optional $pageActions from controller/view.
 */
?>
<header class="cd-topbar">
    <!-- Left Group: Mobile Toggle + Title + Subtitle -->
    <div class="cd-topbar__left">
        <div class="cd-topbar__titles">
            <h1 class="cd-topbar__title">
                <?= htmlspecialchars($pageTitle ?? 'Dashboard') ?>
            </h1>
            
            <?php if (!empty($pageSubtitle)): ?>
                <p class="cd-topbar__subtitle">
                    <?= htmlspecialchars($pageSubtitle) ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right Group: Actions Wrapper -->
    <?php if (!empty($pageActions)): ?>
        <div class="cd-topbar__actions">
            <?php foreach ($pageActions as $action): ?>
                <button
                    type="button"
                    class="cd-btn <?= htmlspecialchars($action['class']) ?>"
                    data-modal-target="<?= htmlspecialchars($action['action']) ?>"
                    onclick="openModal('<?= htmlspecialchars($action['action']) ?>')">
                    <?= htmlspecialchars($action['label']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</header>