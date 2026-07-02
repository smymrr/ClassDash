<?php
/**
 * config/env.php
 * Tiny .env loader. Reads KEY=VALUE lines from a .env file at the project
 * root and exposes them via getenv()/$_ENV so config.php can read them.
 *
 * Not a full parser — handles the common cases (quoted values, comments,
 * blank lines). If your needs grow, swap this for vlucas/phpdotenv via
 * Composer and delete this file.
 */

function classdash_load_env(string $path): void
{
    if (!is_readable($path)) {
        // In production you may want to fail loudly instead of silently
        // falling back to defaults. Left permissive here for local setup.
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        if (!str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Strip matching surrounding quotes, if present.
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        // Don't overwrite real environment variables (e.g. set by the host/CI).
        if (getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

/**
 * Convenience getter with a default fallback.
 */
function env(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    return $value !== false ? $value : $default;
}
