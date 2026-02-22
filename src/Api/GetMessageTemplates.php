<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Http\WatiRequest;

final class GetMessageTemplates extends WatiRequest
{
    public function __construct(
        public readonly int $pageNumber = 1,
        public readonly int $pageSize = 50
    ) {
        parent::__construct(
            'GET',
            "/api/v1/getMessageTemplates?pageNumber={$pageNumber}&pageSize={$pageSize}",
            ['Accept' => 'application/json']
        );
    }
}
