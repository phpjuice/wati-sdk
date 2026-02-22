<?php

declare(strict_types=1);

namespace Tests\Api;

use Wati\Api\GetMessageTemplates;

it('can create a get message templates with default parameters', function (): void {
    $request = new GetMessageTemplates;

    expect($request->getMethod())->toBe('GET')
        ->and($request->getUri()->getPath())->toBe('/api/v1/getMessageTemplates')
        ->and($request->getUri()->getQuery())->toBe('pageNumber=1&pageSize=50')
        ->and($request->getHeaderLine('Accept'))->toBe('application/json');
});

it('can create a get message templates with custom page number', function (): void {
    $request = new GetMessageTemplates(pageNumber: 2);

    expect($request->pageNumber)->toBe(2)
        ->and($request->pageSize)->toBe(50)
        ->and($request->getUri()->getQuery())->toBe('pageNumber=2&pageSize=50');
});

it('can create a get message templates with custom page size', function (): void {
    $request = new GetMessageTemplates(pageSize: 100);

    expect($request->pageNumber)->toBe(1)
        ->and($request->pageSize)->toBe(100)
        ->and($request->getUri()->getQuery())->toBe('pageNumber=1&pageSize=100');
});

it('can create a get message templates with custom page number and page size', function (): void {
    $request = new GetMessageTemplates(pageNumber: 3, pageSize: 25);

    expect($request->pageNumber)->toBe(3)
        ->and($request->pageSize)->toBe(25)
        ->and($request->getUri()->getQuery())->toBe('pageNumber=3&pageSize=25');
});
