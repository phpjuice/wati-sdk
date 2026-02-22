<?php

declare(strict_types=1);

namespace Wati\Api;

use Wati\Http\WatiRequest;

final class SendTemplateMessage extends WatiRequest
{
    /**
     * @param  string  $whatsappNumber  The recipient's WhatsApp number
     * @param  string  $templateName  The name of the template to send
     * @param  string  $broadcastName  The broadcast/campaign name
     * @param  array<array{name: string, value: string}>  $parameters  Template parameters
     */
    public function __construct(
        public readonly string $whatsappNumber,
        public readonly string $templateName,
        public readonly string $broadcastName,
        public readonly array $parameters = []
    ) {
        $body = json_encode([
            'template_name' => $templateName,
            'broadcast_name' => $broadcastName,
            'parameters' => $parameters,
        ]) ?: '{}';

        parent::__construct(
            'POST',
            "/api/v1/sendTemplateMessage?whatsappNumber={$whatsappNumber}",
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            $body
        );
    }
}
