<?php

declare(strict_types=1);

namespace Wati\Api\Dto;

final readonly class MessageTemplate
{
    public function __construct(
        public string $id,
        public string $elementName,
        public ?string $category = null,
        public ?string $status = null,
        public ?string $language = null,
        public ?string $body = null,
        public mixed $hsm = null,
        public mixed $hsmOriginal = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: data_get_str($data, 'id', ''),
            elementName: data_get_str($data, 'elementName', ''),
            category: is_string($v = data_get_str($data, 'category')) ? $v : null,
            status: is_string($v = data_get_str($data, 'status')) ? $v : null,
            language: is_string($v = data_get_str($data, 'language')) ? $v : null,
            body: is_string($v = data_get_str($data, 'body')) ? $v : null,
            hsm: $data['hsm'] ?? null,
            hsmOriginal: $data['hsmOriginal'] ?? null,
        );
    }
}
