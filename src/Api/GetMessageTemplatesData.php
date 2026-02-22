<?php

declare(strict_types=1);

namespace Wati\Api;

use Psr\Http\Message\ResponseInterface;
use Wati\Api\Dto\MessageTemplate;

final readonly class GetMessageTemplatesData
{
    /**
     * @param  array<MessageTemplate>  $messageTemplates
     */
    public function __construct(
        public string $result,
        public int $total,
        public int $pageNumber,
        public int $pageSize,
        public ?string $prevPage,
        public ?string $nextPage,
        public array $messageTemplates,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
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
        $data = json_decode($response->getBody()->getContents(), true) ?? [];

        $link = $data['link'] ?? [];

        return new self(
            result: is_string($data['result'] ?? null) ? $data['result'] : '',
            total: (int) ($link['total'] ?? 0),
            pageNumber: (int) ($link['pageNumber'] ?? 1),
            pageSize: (int) ($link['pageSize'] ?? 50),
            prevPage: is_string($link['prevPage'] ?? null) ? $link['prevPage'] : null,
            nextPage: is_string($link['nextPage'] ?? null) ? $link['nextPage'] : null,
            messageTemplates: array_map(
                MessageTemplate::fromArray(...),
                $data['messageTemplates'] ?? []
            ),
        );
    }

    public function hasMore(): bool
    {
        return $this->nextPage !== null;
    }
}
