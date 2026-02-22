<?php

declare(strict_types=1);

namespace Wati\Api;

use Psr\Http\Message\ResponseInterface;

final readonly class SendTemplateMessageData
{
    public function __construct(
        public bool $result,
        public ?string $message = null,
        public ?string $id = null,
        public ?string $phone = null,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
    {
        /**
         * @var array{
         *     result?: bool,
         *     message?: string|null,
         *     id?: string|null,
         *     phone?: string|null,
         * } $data
         */
        $data = json_decode($response->getBody()->getContents(), true) ?? [];

        return new self(
            result: data_get_bool($data, 'result'),
            message: data_get_str($data, 'message'),
            id: data_get_str($data, 'id'),
            phone: data_get_str($data, 'phone'),
        );
    }

    public function isSuccess(): bool
    {
        return $this->result;
    }
}
