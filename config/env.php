<?php
/**
 * Convenience getter with a default fallback.
 */
function env(string $key, ?string $default = null): ?string
{
    if (array_key_exists($key, $_ENV)) {
        return $_ENV[$key];
    }

    $value = getenv($key);
    return $value !== false ? $value : $default;
}