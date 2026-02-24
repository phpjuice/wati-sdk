<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Api\Dto\MessageTemplate;
use Wati\Http\WatiResponse;

final class GetMessageTemplatesData extends ResponseData
{
    /**
     * @param  array<MessageTemplate>  $messageTemplates
     */
    public function __construct(
        public readonly array $messageTemplates,
        public readonly string $result,
        public readonly int $total,
        public readonly int $pageNumber,
        public readonly int $pageSize,
        public readonly ?string $prevPage,
        public readonly ?string $nextPage,
    ) {}

    public static function fromResponse(WatiResponse $response): self
    {
        /**
         * @var array{
         *     result?: string,
         *     messageTemplates?: array<array<string, mixed>>,
         *     link?: array{
         *          prevPage?: string|null,
         *          nextPage?: string|null,
         *          pageNumber?: int,
         *          pageSize?: int,
         *          total?: int
         *     }
         * } $data
         */
        $data = $response->json() ?? [];

        $link = $data['link'] ?? [];

        return new self(
            messageTemplates: array_map(
                MessageTemplate::fromArray(...),
                $data['messageTemplates'] ?? []
            ),
            result: data_get_str($data, 'result') ?? '',
            total: data_get_int($link, 'total'),
            pageNumber: data_get_int($link, 'pageNumber', 1),
            pageSize: data_get_int($link, 'pageSize', 50),
            prevPage: data_get_str($link, 'prevPage'),
            nextPage: data_get_str($link, 'nextPage'),
        );
    }
}
