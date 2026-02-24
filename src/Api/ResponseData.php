<?php

declare(strict_types=1);

namespace Wati\Api;

abstract class ResponseData
{
    final public function hasMore(): bool
    {
        return property_exists($this, 'nextPage') && $this->nextPage !== null;
    }

    final public function isSuccessful(): bool
    {
        return property_exists($this, 'result') && $this->result === 'success';
    }
}
