<?php

declare(strict_types=1);

describe('data_get_value', function (): void {
    it('returns value when key exists and is not null', function (): void {
        $data = ['name' => 'John', 'count' => 42];

        expect(data_get_value($data, 'name'))->toBe('John')
            ->and(data_get_value($data, 'count'))->toBe(42);
    });

    it('returns default when key does not exist', function (): void {
        $data = ['name' => 'John'];

        expect(data_get_value($data, 'email'))->toBeNull()
            ->and(data_get_value($data, 'email', 'default'))->toBe('default');
    });

    it('returns default when value is null', function (): void {
        $data = ['name' => null];

        expect(data_get_value($data, 'name'))->toBeNull()
            ->and(data_get_value($data, 'name', 'default'))->toBe('default');
    });
});

describe('data_get_str', function (): void {
    it('returns trimmed string when value is string', function (): void {
        $data = ['name' => '  John  '];

        expect(data_get_str($data, 'name'))->toBe('John');
    });

    it('returns default when key does not exist', function (): void {
        $data = ['name' => 'John'];

        expect(data_get_str($data, 'email'))->toBeNull()
            ->and(data_get_str($data, 'email', 'default'))->toBe('default');
    });

    it('returns default when value is null', function (): void {
        $data = ['name' => null];

        expect(data_get_str($data, 'name'))->toBeNull()
            ->and(data_get_str($data, 'name', 'default'))->toBe('default');
    });

    it('converts scalar values to string', function (): void {
        $data = ['count' => 42, 'active' => true, 'price' => 19.99, 'flag' => false];

        expect(data_get_str($data, 'count'))->toBe('42')
            ->and(data_get_str($data, 'active'))->toBe('1')
            ->and(data_get_str($data, 'price'))->toBe('19.99')
            ->and(data_get_str($data, 'flag'))->toBe('');
    });

    it('returns default for non-scalar values', function (): void {
        $data = ['items' => ['a', 'b'], 'obj' => new stdClass];

        expect(data_get_str($data, 'items'))->toBeNull()
            ->and(data_get_str($data, 'items', 'default'))->toBe('default')
            ->and(data_get_str($data, 'obj'))->toBeNull();
    });

    it('returns default when trimmed value is empty', function (): void {
        $data = ['name' => '   '];

        expect(data_get_str($data, 'name'))->toBe('')
            ->and(data_get_str($data, 'name', 'default'))->toBe('');
    });
});

describe('data_get_int', function (): void {
    it('returns integer when value is numeric', function (): void {
        $data = ['count' => 42, 'price' => '19.99'];

        expect(data_get_int($data, 'count'))->toBe(42)
            ->and(data_get_int($data, 'price'))->toBe(19);
    });

    it('returns default when key does not exist', function (): void {
        $data = ['name' => 'John'];

        expect(data_get_int($data, 'count'))->toBe(0)
            ->and(data_get_int($data, 'count', 10))->toBe(10);
    });

    it('returns default when value is null', function (): void {
        $data = ['count' => null];

        expect(data_get_int($data, 'count'))->toBe(0)
            ->and(data_get_int($data, 'count', 5))->toBe(5);
    });

    it('returns default when value is not numeric', function (): void {
        $data = ['name' => 'John', 'active' => true];

        expect(data_get_int($data, 'name'))->toBe(0)
            ->and(data_get_int($data, 'active'))->toBe(0);
    });

    it('handles string numbers', function (): void {
        $data = ['count' => '123'];

        expect(data_get_int($data, 'count'))->toBe(123);
    });
});

describe('data_get_bool', function (): void {
    it('returns boolean when value is bool', function (): void {
        $data = ['active' => true, 'disabled' => false];

        expect(data_get_bool($data, 'active'))->toBeTrue()
            ->and(data_get_bool($data, 'disabled'))->toBeFalse();
    });

    it('returns default when key does not exist', function (): void {
        $data = ['name' => 'John'];

        expect(data_get_bool($data, 'active'))->toBeFalse()
            ->and(data_get_bool($data, 'active', true))->toBeTrue();
    });

    it('returns default when value is null', function (): void {
        $data = ['active' => null];

        expect(data_get_bool($data, 'active'))->toBeFalse()
            ->and(data_get_bool($data, 'active', true))->toBeTrue();
    });

    it('handles truthy string representations', function (): void {
        $data = [
            'a' => 'true',
            'b' => 'TRUE',
            'c' => '1',
            'd' => 'yes',
            'e' => 'on',
        ];

        expect(data_get_bool($data, 'a'))->toBeTrue()
            ->and(data_get_bool($data, 'b'))->toBeTrue()
            ->and(data_get_bool($data, 'c'))->toBeTrue()
            ->and(data_get_bool($data, 'd'))->toBeTrue()
            ->and(data_get_bool($data, 'e'))->toBeTrue();
    });

    it('handles falsy string representations', function (): void {
        $data = [
            'a' => 'false',
            'b' => 'FALSE',
            'c' => '0',
            'd' => 'no',
            'e' => 'off',
        ];

        expect(data_get_bool($data, 'a'))->toBeFalse()
            ->and(data_get_bool($data, 'b'))->toBeFalse()
            ->and(data_get_bool($data, 'c'))->toBeFalse()
            ->and(data_get_bool($data, 'd'))->toBeFalse()
            ->and(data_get_bool($data, 'e'))->toBeFalse();
    });

    it('returns default for unrecognized string values', function (): void {
        $data = ['status' => 'maybe'];

        expect(data_get_bool($data, 'status'))->toBeFalse()
            ->and(data_get_bool($data, 'status', true))->toBeTrue();
    });

    it('handles integer values', function (): void {
        $data = ['a' => 1, 'b' => 0, 'c' => 2];

        expect(data_get_bool($data, 'a'))->toBeTrue()
            ->and(data_get_bool($data, 'b'))->toBeFalse()
            ->and(data_get_bool($data, 'c'))->toBeFalse()
            ->and(data_get_bool($data, 'c', true))->toBeTrue();
    });

    it('returns default for non-bool, non-string, non-int values', function (): void {
        $data = ['items' => ['a', 'b'], 'price' => 19.99];

        expect(data_get_bool($data, 'items'))->toBeFalse()
            ->and(data_get_bool($data, 'items', true))->toBeTrue();
    });
});
