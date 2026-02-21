<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Http\WatiRequest;

final class GetContacts extends WatiRequest
{
    public function __construct(
        public readonly int $page = 1,
        public readonly int $pageSize = 50
    ) {
        parent::__construct(
            'GET',
            "/api/v1/getContacts?page={$page}&pageSize={$pageSize}",
            ['Accept' => 'application/json']
        );
    }
}
