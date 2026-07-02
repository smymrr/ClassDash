<?php
/**
 * public/index.php
 * Every request (except real static files) is rewritten to this file
 * by .htaccess. This bootstraps config, then hands off to the router.
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/router.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

route($uri);
