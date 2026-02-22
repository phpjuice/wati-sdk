<?php

declare(strict_types=1);

namespace Wati\Api\Dto;

final readonly class Contact
{
    public function __construct(
        public string $id,
        public string $phone,
        public string $fullName,
        public ?string $wAid = null,
        public ?string $firstName = null,
        public ?string $email = null,
        public ?string $contactStatus = null,
        public ?string $created = null,
        public ?string $lastUpdated = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: data_get_str($data, 'id') ?? '',
            phone: data_get_str($data, 'phone') ?? '',
            fullName: data_get_str($data, 'fullName') ?? '',
            wAid: data_get_str($data, 'wAid'),
            firstName: data_get_str($data, 'firstName'),
            email: data_get_str($data, 'email'),
            contactStatus: data_get_str($data, 'contactStatus'),
            created: data_get_str($data, 'created'),
            lastUpdated: data_get_str($data, 'lastUpdated'),
        );
    }
}
