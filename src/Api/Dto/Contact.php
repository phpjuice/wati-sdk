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
            id: data_get_str($data, 'id', ''),
            phone: data_get_str($data, 'phone', ''),
            fullName: data_get_str($data, 'fullName', ''),
            wAid: is_string($v = data_get_str($data, 'wAid')) ? $v : null,
            firstName: is_string($v = data_get_str($data, 'firstName')) ? $v : null,
            email: is_string($v = data_get_str($data, 'email')) ? $v : null,
            contactStatus: is_string($v = data_get_str($data, 'contactStatus')) ? $v : null,
            created: is_string($v = data_get_str($data, 'created')) ? $v : null,
            lastUpdated: is_string($v = data_get_str($data, 'lastUpdated')) ? $v : null,
        );
    }
}
