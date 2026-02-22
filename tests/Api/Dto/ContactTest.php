<?php

declare(strict_types=1);

namespace Tests\Api\Dto;

use Wati\Api\Dto\Contact;

describe('Contact', function (): void {
    it('can be created from array with all fields', function (): void {
        $data = [
            'id' => '123',
            'phone' => '+1234567890',
            'fullName' => 'John Doe',
            'wAid' => 'wa123',
            'firstName' => 'John',
            'email' => 'john@example.com',
            'contactStatus' => 'active',
            'created' => '2024-01-01',
            'lastUpdated' => '2024-01-02',
        ];

        $contact = Contact::fromArray($data);

        expect($contact->id)->toBe('123')
            ->and($contact->phone)->toBe('+1234567890')
            ->and($contact->fullName)->toBe('John Doe')
            ->and($contact->wAid)->toBe('wa123')
            ->and($contact->firstName)->toBe('John')
            ->and($contact->email)->toBe('john@example.com')
            ->and($contact->contactStatus)->toBe('active')
            ->and($contact->created)->toBe('2024-01-01')
            ->and($contact->lastUpdated)->toBe('2024-01-02');
    });

    it('can be created from array with required fields only', function (): void {
        $data = [
            'id' => '123',
            'phone' => '+1234567890',
            'fullName' => 'John Doe',
        ];

        $contact = Contact::fromArray($data);

        expect($contact->id)->toBe('123')
            ->and($contact->phone)->toBe('+1234567890')
            ->and($contact->fullName)->toBe('John Doe')
            ->and($contact->wAid)->toBeNull()
            ->and($contact->firstName)->toBeNull()
            ->and($contact->email)->toBeNull()
            ->and($contact->contactStatus)->toBeNull()
            ->and($contact->created)->toBeNull()
            ->and($contact->lastUpdated)->toBeNull();
    });

    it('handles empty array with defaults', function (): void {
        $contact = Contact::fromArray([]);

        expect($contact->id)->toBe('')
            ->and($contact->phone)->toBe('')
            ->and($contact->fullName)->toBe('');
    });

    it('trims string values', function (): void {
        $data = [
            'id' => '  123  ',
            'phone' => '  +1234567890  ',
            'fullName' => '  John Doe  ',
            'email' => '  john@example.com  ',
        ];

        $contact = Contact::fromArray($data);

        expect($contact->id)->toBe('123')
            ->and($contact->phone)->toBe('+1234567890')
            ->and($contact->fullName)->toBe('John Doe')
            ->and($contact->email)->toBe('john@example.com');
    });

    it('handles null values in optional fields', function (): void {
        $data = [
            'id' => '123',
            'phone' => '+1234567890',
            'fullName' => 'John Doe',
            'wAid' => null,
            'firstName' => null,
            'email' => null,
        ];

        $contact = Contact::fromArray($data);

        expect($contact->wAid)->toBeNull()
            ->and($contact->firstName)->toBeNull()
            ->and($contact->email)->toBeNull();
    });

    it('converts scalar values to strings', function (): void {
        $data = [
            'id' => 123,
            'phone' => 1234567890,
            'fullName' => ['John', 'Doe'],
        ];

        $contact = Contact::fromArray($data);

        expect($contact->id)->toBe('123')
            ->and($contact->phone)->toBe('1234567890')
            ->and($contact->fullName)->toBe('');
    });
});
