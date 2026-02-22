<?php

declare(strict_types=1);

namespace Tests\Api\Dto;

use Wati\Api\Dto\MessageTemplate;

describe('MessageTemplate', function (): void {
    it('can be created from array with all fields', function (): void {
        $data = [
            'id' => 'template_123',
            'elementName' => 'welcome_message',
            'category' => 'MARKETING',
            'status' => 'APPROVED',
            'language' => 'en',
            'body' => 'Hello {{name}}!',
        ];

        $template = MessageTemplate::fromArray($data);

        expect($template->id)->toBe('template_123')
            ->and($template->elementName)->toBe('welcome_message')
            ->and($template->category)->toBe('MARKETING')
            ->and($template->status)->toBe('APPROVED')
            ->and($template->language)->toBe('en')
            ->and($template->body)->toBe('Hello {{name}}!');
    });

    it('can be created from array with required fields only', function (): void {
        $data = [
            'id' => 'template_123',
            'elementName' => 'welcome_message',
        ];

        $template = MessageTemplate::fromArray($data);

        expect($template->id)->toBe('template_123')
            ->and($template->elementName)->toBe('welcome_message')
            ->and($template->category)->toBeNull()
            ->and($template->status)->toBeNull()
            ->and($template->language)->toBeNull()
            ->and($template->body)->toBeNull();
    });

    it('handles empty array with defaults', function (): void {
        $template = MessageTemplate::fromArray([]);

        expect($template->id)->toBe('')
            ->and($template->elementName)->toBe('');
    });

    it('trims string values', function (): void {
        $data = [
            'id' => '  template_123  ',
            'elementName' => '  welcome_message  ',
            'category' => '  MARKETING  ',
            'body' => '  Hello {{name}}!  ',
        ];

        $template = MessageTemplate::fromArray($data);

        expect($template->id)->toBe('template_123')
            ->and($template->elementName)->toBe('welcome_message')
            ->and($template->category)->toBe('MARKETING')
            ->and($template->body)->toBe('Hello {{name}}!');
    });

    it('handles null values in optional fields', function (): void {
        $data = [
            'id' => 'template_123',
            'elementName' => 'welcome_message',
            'category' => null,
            'status' => null,
            'language' => null,
            'body' => null,
        ];

        $template = MessageTemplate::fromArray($data);

        expect($template->category)->toBeNull()
            ->and($template->status)->toBeNull()
            ->and($template->language)->toBeNull()
            ->and($template->body)->toBeNull();
    });

    it('converts scalar values to strings', function (): void {
        $data = [
            'id' => 123,
            'elementName' => ['welcome', 'message'],
            'category' => true,
        ];

        $template = MessageTemplate::fromArray($data);

        expect($template->id)->toBe('123')
            ->and($template->elementName)->toBe('')
            ->and($template->category)->toBe('1');
    });
});
