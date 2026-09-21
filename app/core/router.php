<?php
/**
 * includes/router.php
 * Maps clean URLs to controller methods and sets $activeNav for the sidebar.
 */

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/InfoBoardController.php';
require_once __DIR__ . '/../controllers/TreasuryController.php';
require_once __DIR__ . '/../controllers/MemberController.php';

function route(string $uri): void
{
    $path = parse_url($uri, PHP_URL_PATH);
    $path = trim($path, '/');
    
    // [controllerClass, method, activeNavKey]
    $routes = [
        '' => ['DashboardController', 'index', 'dashboard'],
        'dashboard' => ['DashboardController', 'index', 'dashboard'],
        'info-board' => ['InfoBoardController', 'index', 'info-board'],
        'treasury' => ['TreasuryController', 'index', 'treasury'],
        'members' => ['MemberController', 'index', 'members'],
        'login' => ['AuthController', 'login', null],
        'logout' => ['AuthController', 'logout', null],
    ];

    if (!array_key_exists($path, $routes)) {
        http_response_code(404);
        require __DIR__ . '/../public/pages/404.php';
        return;
    }

    [$controllerName, $method, $activeNav] = $routes[$path];
    
    if (!class_exists($controllerName) || !method_exists($controllerName, $method)) {
        http_response_code(500);
        echo "Controller or method not found: $controllerName::$method";
        return;
    }

    // Read by includes/components/sidebar.php when a view includes it.
    $GLOBALS['activeNav'] = $activeNav;

    $controller = new $controllerName();
    $controller->$method();
}
