<?php

declare(strict_types=1);

it('returns value when key exists', function (): void {
    $data = ['name' => 'John', 'email' => 'john@example.com'];

    expect(data_get($data, 'name'))->toBe('John')
        ->and(data_get($data, 'email'))->toBe('john@example.com');
});

it('returns default when key does not exist', function (): void {
    $data = ['name' => 'John'];

    expect(data_get($data, 'email'))->toBeNull()
        ->and(data_get($data, 'email', 'default'))->toBe('default');
});

it('returns default when value is null', function (): void {
    $data = ['name' => null];

    expect(data_get($data, 'name'))->toBeNull()
        ->and(data_get($data, 'name', 'default'))->toBe('default');
});

it('returns default when value is empty string', function (): void {
    $data = ['name' => ''];

    expect(data_get($data, 'name'))->toBeNull()
        ->and(data_get($data, 'name', 'default'))->toBe('default');
});

it('trims string values', function (): void {
    $data = ['name' => '  John  '];

    expect(data_get($data, 'name'))->toBe('John');
});

it('returns default when trimmed value is empty', function (): void {
    $data = ['name' => '   '];

    expect(data_get($data, 'name'))->toBeNull()
        ->and(data_get($data, 'name', 'default'))->toBe('default');
});

it('returns non-string values as-is', function (): void {
    $data = [
        'count' => 42,
        'active' => true,
        'items' => ['a', 'b'],
        'price' => 19.99,
    ];

    expect(data_get($data, 'count'))->toBe(42)
        ->and(data_get($data, 'active'))->toBeTrue()
        ->and(data_get($data, 'items'))->toBe(['a', 'b'])
        ->and(data_get($data, 'price'))->toBe(19.99);
});

it('returns default for missing nested keys', function (): void {
    $data = ['user' => ['name' => 'John']];

    expect(data_get($data, 'email', 'missing'))->toBe('missing');
});
