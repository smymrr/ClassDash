<?php
/**
 * public/index.php
 * Every request (except real static files) is rewritten to this file
 * by .htaccess. This bootstraps config, then hands off to the router.
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/router.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// dirname(SCRIPT_NAME) gives the folder this index.php actually lives in,
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Remove the script directory from the path if it exists, so we can route cleanly.
if (str_starts_with($path, $scriptDir)) {
    $path = substr($path, strlen($scriptDir));
}

$uri = trim($path, '/');

route($uri);