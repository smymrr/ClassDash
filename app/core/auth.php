<?php

/**
 * includes/components/auth.php
 * Auth/user-data helpers shared across controllers and views.
 */

/**
 * Returns the currently logged-in user's sidebar-relevant data.
 * Falls back to placeholders if not logged in or the query fails.
 *
 * @return array{id:?int,name:string,role:string}
 */
function classdash_get_current_user(?PDO $pdo): array
{
    $default = [
        'id'   => null,
        'name' => 'PLACEHOLDER_USER_NAME_SIDEBAR',
        'role' => 'PLACEHOLDER_USER_ROLE_SIDEBAR',
    ];

    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId || !$pdo) {
        return $default;
    }

    try {
        $stmt = $pdo->prepare(
            'SELECT id, fullname, role
             FROM users
             WHERE id = :id
             LIMIT 1'
        );
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch();

        if (!$user) {
            return $default;
        }

        return [
            'id'   => (int) $user['id'],
            'name' => $user['fullname'] ?: $default['name'],
            'role' => $user['role'] ?: $default['role'],
        ];
    } catch (PDOException $e) {
        error_log('classdash_get_current_user failed: ' . $e->getMessage());
        return $default;
    }
}

/**
 * Count of announcements posted this calendar month (for badges).
 */
function classdash_get_announcements_this_month_count(?PDO $pdo): int
{
    if (!$pdo) {
        return 0;
    }

    try {
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) AS total
             FROM announcements
             WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
               AND YEAR(created_at) = YEAR(CURRENT_DATE())"
        );
        $stmt->execute();
        $row = $stmt->fetch();
        return (int) ($row['total'] ?? 0);
    } catch (PDOException $e) {
        error_log('classdash_get_announcements_this_month_count failed: ' . $e->getMessage());
        return 0;
    }
}

/**
 * Guard for protected routes. Call at the top of a controller method.
 */
function classdash_require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
}

/**
 * Guard for role-restricted routes, using the permission levels in
 * config/constants.php (lower number = higher permission).
 */
function classdash_require_permission(string $minRole): void
{
    classdash_require_login();

    $userRole = $_SESSION['user_role'] ?? null;

    $userLevel = ROLE_PERMISSION_LEVELS[$userRole] ?? PHP_INT_MAX;
    $requiredLevel = ROLE_PERMISSION_LEVELS[$minRole] ?? PHP_INT_MAX;

    if ($userLevel > $requiredLevel) {
        http_response_code(403);
        require __DIR__ . '/../../public/pages/403.php';
        exit;
    }
}

function get_initial(string $fullName): string
{
    $userInitial = $fullName !== ''
        ? strtoupper(mb_substr($fullName, 0, 1))
        : 'P';
    return $userInitial;
}
