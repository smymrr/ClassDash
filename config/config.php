<?php
/**
 * config/config.php
 * Loaded once by public/index.php before routing happens.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/env.php';

// Loads PROJECT/.env (one level above config/) into getenv()/$_ENV.
classdash_load_env(__DIR__ . '/../.env');

define('DB_HOST', env('DB_HOST', '127.0.0.1'));
define('DB_PORT', env('DB_PORT', '3306'));
define('DB_NAME', env('DB_NAME', ''));
define('DB_USER', env('DB_USER', ''));
define('DB_PASS', env('DB_PASS', ''));

// Fail loudly in the logs if the essentials are missing, instead of
// silently trying to connect with blank credentials.
if (DB_NAME === '' || DB_USER === '') {
    error_log('Missing DB_NAME/DB_USER — check that .env exists and is populated (see .env.example).');
}

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log('DB connection failed: ' . $e->getMessage());
    $pdo = null;
}

require_once __DIR__ . '/constants.php';
