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
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: data_get_str($data, 'id') ?? '',
            elementName: data_get_str($data, 'elementName') ?? '',
            category: data_get_str($data, 'category'),
            status: data_get_str($data, 'status'),
            language: data_get_str($data, 'language'),
            body: data_get_str($data, 'body'),
        );
    }
}
