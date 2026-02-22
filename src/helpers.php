<?php

declare(strict_types=1);

/**
 * @template TDefault
 *
 * @param  array<string, mixed>  $data
 * @param  TDefault  $default
 * @return mixed|TDefault
 */
function data_get_value(array $data, string $key, mixed $default = null): mixed
{
    return array_key_exists($key, $data) && $data[$key] !== null
        ? $data[$key]
        : $default;
}

/**
 * @param  array<string, mixed>  $data
 */
function data_get_str(array $data, string $key, ?string $default = null): ?string
{
    $value = data_get_value($data, $key, $default);

    return is_string($value) ? trim($value) : $default;
}

/**
 * @param  array<string, mixed>  $data
 */
function data_get_int(array $data, string $key, int $default = 0): int
{
    $value = data_get_value($data, $key, $default);

    return is_numeric($value) ? (int) $value : $default;
}

/**
 * @param  array<string, mixed>  $data
 */
function data_get_bool(array $data, string $key, bool $default = false): bool
{
    $value = data_get_value($data, $key, $default);

    if (is_bool($value)) {
        return $value;
    }

    // Handle common truthy/falsy string representations
    if (is_string($value)) {
        return match (strtolower(trim($value))) {
            'true', '1', 'yes', 'on' => true,
            'false', '0', 'no', 'off' => false,
            default => $default,
        };
    }

    if (is_int($value)) {
        return match ($value) {
            1 => true,
            0 => false,
            default => $default,
        };
    }

    return $default;
}
