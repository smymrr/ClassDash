<?php
/**
 * includes/components/sidebar.php
 * Included by page views. Expects $pdo (from config) and $activeNav
 * (set by includes/router.php) to already be in scope.
 */

require_once dirname(__DIR__, 2) . '/app/core/auth.php';

$currentUser = classdash_get_current_user($pdo ?? null);
$userInitial = get_initial($currentUser['name']);


// Fallback if a view is rendered without going through the router.
$activeNav = $GLOBALS['activeNav'] ?? '';

$navItems = [
    ['key' => 'dashboard',  'label' => 'Dashboard',  'href' => '/dashboard',   'icon' => 'grid'],
    ['key' => 'treasury',   'label' => 'Treasury',   'href' => '/treasury',    'icon' => 'wallet'],
    ['key' => 'info-board', 'label' => 'Info Board', 'href' => '/info-board',  'icon' => 'clipboard'],
    ['key' => 'members',    'label' => 'Members',    'href' => '/members',     'icon' => 'users'],
];

function get_nav_item_href(string $path): string
{
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        return $path;
    }

    $baseUrl = $_SERVER['SCRIPT_NAME'];
    if (str_ends_with($baseUrl, '/index.php')) {
        $baseUrl = substr($baseUrl, 0, -strlen('/index.php'));
    }

    return $baseUrl . '/' . ltrim($path, '/');
}

function classdash_icon(string $name): string
{
    $icons = [
        'grid' => '<path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/>',
        'wallet' => '<path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3H5"/><path d="M3 7v11a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-4a2 2 0 1 0 0 4h5"/>',
        'clipboard' => '<rect x="6" y="3" width="12" height="4" rx="1"/><path d="M6 5H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1"/><path d="M9 12h6M9 16h6"/>',
        'users' => '<circle cx="9" cy="8" r="3"/><path d="M2 20c0-3.3 3.1-6 7-6s7 2.7 7 6"/><circle cx="17" cy="9" r="2.5"/><path d="M22 20c0-2.6-2-4.7-5-5.4"/>',
        'settings' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/>',
        'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>',
        'close' => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
    ];

    return $icons[$name] ?? '';
}
?>

<!-- Backdrop for mobile drawer blur/overlay -->
<div class="cd-sidebar-backdrop" id="cdSidebarBackdrop" aria-hidden="true"></div>

<aside class="cd-sidebar" id="cdSidebar">
    <div class="cd-brand">
        <div class="cd-brand-main">
            <span class="cd-brand-mark">&#8722;</span>
            <span class="cd-brand-text">Class<strong>Dash</strong></span>
        </div>
        
        <!-- Mobile close button -->
        <button type="button" class="cd-sidebar__close" id="cdSidebarClose" aria-label="Close menu">
            <svg class="cd-sidebar__nav-icon" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <?= classdash_icon('close') ?>
            </svg>
        </button>
    </div>

    <div class="cd-sidebar__user">
        <div class="cd-avatar">
            <?= htmlspecialchars($userInitial) ?>
        </div>
        <div class="cd-sidebar__user-info">
            <div class="cd-sidebar__user-name">
                <?= htmlspecialchars($currentUser['name']) ?>
            </div>
            <span class="cd-sidebar__user-role">
                <?= htmlspecialchars($currentUser['role']) ?>
            </span>
        </div>
    </div>

    <nav class="cd-sidebar__nav">
        <ul>
            <?php foreach ($navItems as $item): ?>
                <li>
                    <a
                        href="<?= htmlspecialchars(get_nav_item_href($item['href'])) ?>"
                        class="cd-sidebar__nav-link <?= $activeNav === $item['key'] ? ' is-active' : '' // Add current page marker ?>" 
                        <?= $activeNav === $item['key'] ? 'aria-current="page"' : '' ?>
                    >
                        <svg class="cd-sidebar__nav-icon" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <?= classdash_icon($item['icon']) ?>
                        </svg>
                        <span><?= htmlspecialchars($item['label']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="cd-sidebar__footer">
        <a href="<?= htmlspecialchars(get_nav_item_href('/account')) ?>" class="cd-sidebar__nav-link">
            <svg class="cd-sidebar__nav-icon" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <?= classdash_icon('settings') ?>
            </svg>
            <span>Account</span>
        </a>
        <a href="<?= htmlspecialchars(get_nav_item_href('/logout')) ?>" class="cd-sidebar__nav-link cd-sidebar__nav-link--danger">
            <svg class="cd-sidebar__nav-icon" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <?= classdash_icon('logout') ?>
            </svg>
            <span>Log out</span>
        </a>
    </div>
</aside>