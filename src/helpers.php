<?php

declare(strict_types=1);

/**
 * @template TDefault
 *
 * @param  array<string, mixed>  $data
 * @param  TDefault  $default
 * @return string|TDefault
 */
function data_get_str(array $data, string $key, mixed $default = null): mixed
{
    if (! array_key_exists($key, $data) || $data[$key] === null) {
        return $default;
    }

    $value = $data[$key];

    if (is_string($value)) {
        $value = trim($value);

        return $value !== '' ? $value : $default;
    }

    return $value;
}
