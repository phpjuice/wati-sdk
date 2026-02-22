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
            id: data_get($data, 'id', ''),
            phone: data_get($data, 'phone', ''),
            fullName: data_get($data, 'fullName', ''),
            wAid: is_string($v = data_get($data, 'wAid')) ? $v : null,
            firstName: is_string($v = data_get($data, 'firstName')) ? $v : null,
            email: is_string($v = data_get($data, 'email')) ? $v : null,
            contactStatus: is_string($v = data_get($data, 'contactStatus')) ? $v : null,
            created: is_string($v = data_get($data, 'created')) ? $v : null,
            lastUpdated: is_string($v = data_get($data, 'lastUpdated')) ? $v : null,
        );
    }
}
