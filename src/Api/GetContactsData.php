<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Api\Dto\Contact;
use Wati\Http\WatiResponse;

final class GetContactsData extends ResponseData
{
    /**
     * @param  array<Contact>  $contacts
     */
    public function __construct(
        public readonly array $contacts,
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
        $data = $response->json() ?? [];

        $link = $data['link'] ?? [];

        return new self(
            contacts: array_map(
                Contact::fromArray(...),
                $data['contact_list'] ?? []
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
