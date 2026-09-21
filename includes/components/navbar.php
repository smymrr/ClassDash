<?php 
require_once dirname(__DIR__, 2) . '/app/core/auth.php';

$scripts = ['/assets/js/components/sidebar.js'];

$currentUser = classdash_get_current_user($pdo ?? null);
$userInitial = get_initial($currentUser['name']);
?>

<header class="cd-navbar">
    <div class="cd-navbar__left">
        <button type="button" onclick="console.log('clicked')" id="cdSidebarToggle" class="cd-navbar__toggle" aria-label="Open sidebar menu">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>
    
    <div class="cd-navbar__user">
        <div class="cd-avatar">
            <?= htmlspecialchars($userInitial ?? 'A') ?>
        </div>
    </div>
</header>