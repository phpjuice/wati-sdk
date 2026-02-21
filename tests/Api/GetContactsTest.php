<?php

declare(strict_types=1);

namespace Tests\Api;

use Wati\Api\GetContacts;

it('can create a get contacts with default parameters', function (): void {
    $request = new GetContacts;

    expect($request->getMethod())->toBe('GET')
        ->and($request->getUri()->getPath())->toBe('/api/v1/getContacts')
        ->and($request->getUri()->getQuery())->toBe('page=1&pageSize=50')
        ->and($request->getHeaderLine('Accept'))->toBe('application/json');
});

it('can create a get contacts with custom page', function (): void {
    $request = new GetContacts(page: 2);

    expect($request->page)->toBe(2)
        ->and($request->pageSize)->toBe(50)
        ->and($request->getUri()->getQuery())->toBe('page=2&pageSize=50');
});

it('can create a get contacts with custom page size', function (): void {
    $request = new GetContacts(pageSize: 100);

    expect($request->page)->toBe(1)
        ->and($request->pageSize)->toBe(100)
        ->and($request->getUri()->getQuery())->toBe('page=1&pageSize=100');
});

it('can create a get contacts with custom page and page size', function (): void {
    $request = new GetContacts(page: 3, pageSize: 25);

    expect($request->page)->toBe(3)
        ->and($request->pageSize)->toBe(25)
        ->and($request->getUri()->getQuery())->toBe('page=3&pageSize=25');
});
