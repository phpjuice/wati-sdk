<?php

declare(strict_types=1);

namespace Wati\Api;

use Psr\Http\Message\ResponseInterface;
use Wati\Api\Dto\Contact;

/**
 * Response DTO for GetContacts API.
 *
 * This is a reference implementation for future DTO classes.
 * DTOs are immutable readonly classes that provide typed access to API responses.
 *
 * @example
 * ```php
 * $response = $client->send(new GetContacts());
 * $data = GetContactsData::fromResponse($response);
 * // or
 * $data = new GetContactsData($response);
 *
 * echo $data->totalContacts;
 * foreach ($data->contacts as $contact) {
 *     echo $contact->name;
 * }
 * ```
 */
final readonly class GetContactsData
{
    /**
     * @param  array<Contact>  $contacts
     */
    public function __construct(
        public int $totalContacts,
        public array $contacts,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
    {
        /** @var array{totalContacts?: int, contacts?: array<array<string, mixed>>} $data */
        $data = json_decode($response->getBody()->getContents(), true) ?? [];

        return new self(
            totalContacts: $data['totalContacts'] ?? 0,
            contacts: array_map(
                Contact::fromArray(...),
                $data['contacts'] ?? []
            ),
        );
    }
}
