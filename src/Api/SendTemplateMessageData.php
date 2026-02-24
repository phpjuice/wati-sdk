<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Http\WatiResponse;

final class SendTemplateMessageData extends ResponseData
{
    public function __construct(
        public readonly string $result,
        public readonly ?string $message = null,
        public readonly ?string $id = null,
        public readonly ?string $phone = null,
    ) {}

    public static function fromResponse(WatiResponse $response): self
    {
        /**
         * @var array{
         *     result?: bool,
         *     message?: string|null,
         *     id?: string|null,
         *     phone?: string|null,
         * } $data
         */
        $data = $response->json() ?? [];

        return new self(
            result: data_get_str($data, 'result') ?? '',
            message: data_get_str($data, 'message'),
            id: data_get_str($data, 'id'),
            phone: data_get_str($data, 'phone'),
        );
    }
}
