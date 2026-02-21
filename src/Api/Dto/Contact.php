<?php

declare(strict_types=1);

namespace Wati\Api\Dto;

/**
 * Contact DTO for nested contact data in API responses.
 *
 * This is a reference implementation for future nested DTO classes.
 * Nested DTOs are immutable readonly classes used within response DTOs.
 */
final readonly class Contact
{
    public function __construct(
        public string $id,
        public string $name,
        public string $phone,
        public ?string $email = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: is_string($data['id'] ?? null) ? $data['id'] : '',
            name: is_string($data['name'] ?? null) ? $data['name'] : '',
            phone: is_string($data['phone'] ?? null) ? $data['phone'] : '',
            email: is_string($data['email'] ?? null) ? $data['email'] : null,
        );
    }
}
