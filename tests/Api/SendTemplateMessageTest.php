<?php

declare(strict_types=1);

namespace Tests\Api;

use Wati\Api\SendTemplateMessage;

it('can create a send template message with required parameters', function (): void {
    $request = new SendTemplateMessage(
        whatsappNumber: '1234567890',
        templateName: 'order_update',
        broadcastName: 'order_update'
    );

    expect($request->getMethod())->toBe('POST')
        ->and($request->getUri()->getPath())->toBe('/api/v1/sendTemplateMessage')
        ->and($request->getUri()->getQuery())->toBe('whatsappNumber=1234567890')
        ->and($request->getHeaderLine('Accept'))->toBe('application/json')
        ->and($request->getHeaderLine('Content-Type'))->toBe('application/json')
        ->and($request->whatsappNumber)->toBe('1234567890')
        ->and($request->templateName)->toBe('order_update')
        ->and($request->broadcastName)->toBe('order_update')
        ->and($request->parameters)->toBe([]);
});

it('can create a send template message with parameters', function (): void {
    $parameters = [
        ['name' => 'name', 'value' => 'John'],
        ['name' => 'ordernumber', 'value' => '12345'],
    ];

    $request = new SendTemplateMessage(
        whatsappNumber: '1234567890',
        templateName: 'order_update',
        broadcastName: 'order_update',
        parameters: $parameters
    );

    expect($request->parameters)->toBe($parameters);

    $body = $request->getBody()->getContents();
    $decoded = json_decode($body, true);

    expect($decoded)->toBe([
        'template_name' => 'order_update',
        'broadcast_name' => 'order_update',
        'parameters' => $parameters,
    ]);
});

it('encodes special characters in whatsapp number', function (): void {
    $request = new SendTemplateMessage(
        whatsappNumber: '+1 234 567 890',
        templateName: 'welcome',
        broadcastName: 'welcome_campaign'
    );

    expect($request->getUri()->getQuery())->toBe('whatsappNumber=+1%20234%20567%20890');
});
