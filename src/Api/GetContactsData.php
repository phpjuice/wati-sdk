<?php

declare(strict_types=1);

namespace Wati\Api;

use Psr\Http\Message\ResponseInterface;
use Wati\Api\Dto\Contact;

final readonly class GetContactsData
{
    /**
     * @param  array<Contact>  $contacts
     */
    public function __construct(
        public string $result,
        public int $total,
        public int $pageNumber,
        public int $pageSize,
        public ?string $prevPage,
        public ?string $nextPage,
        public array $contacts,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
    {
        /**
         * @var array{
         *     result?: string,
         *     contact_list?: array<array<string, mixed>>,
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
            result: data_get_str($data, 'result') ?? '',
            total: data_get_int($link, 'total'),
            pageNumber: data_get_int($link, 'pageNumber', 1),
            pageSize: data_get_int($link, 'pageSize', 50),
            prevPage: data_get_str($link, 'prevPage'),
            nextPage: data_get_str($link, 'nextPage'),
            contacts: array_map(
                Contact::fromArray(...),
                $data['contact_list'] ?? []
            ),
        );
    }

    public function hasMore(): bool
    {
        return $this->nextPage !== null;
    }
}
