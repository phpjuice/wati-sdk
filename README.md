# Wati SDK

[![CI](https://github.com/phpjuice/wati-sdk/actions/workflows/php.yml/badge.svg)](https://github.com/phpjuice/wati-sdk/actions/workflows/php.yml)
[![PHP Version](https://img.shields.io/badge/PHP-8.3%20%7C%208.4-777BB4?logo=php&logoColor=white)](https://php.net)
[![Latest Stable Version](http://poser.pugx.org/phpjuice/wati-sdk/v)](https://packagist.org/packages/phpjuice/wati-sdk)
[![Total Downloads](http://poser.pugx.org/phpjuice/wati-sdk/downloads)](https://packagist.org/packages/phpjuice/wati-sdk)
[![License](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](./.github/CONTRIBUTING.md)

A PHP SDK for the [Wati.io](https://wati.io) WhatsApp API. Provides pre-built API classes for common operations.

## Installation

This package requires PHP 8.3 or higher.

```bash
composer require "phpjuice/wati-sdk"
```

## Setup

### Get Your Credentials

1. Log in to your [Wati Account](https://app.wati.io)
2. Navigate to **API Docs** in the top menu
3. Copy your **API Endpoint URL** and **Bearer Token**

### Create a Client

```php
<?php

use Wati\Http\WatiClient;
use Wati\Http\WatiEnvironment;
use Wati\Api\GetContacts;

// Get this URL from your Wati Dashboard (API Docs section)
// It includes your tenant ID: https://your-instance.wati.io/{tenantId}
$endpoint = "https://your-instance.wati.io/123456";
$bearerToken = "your-bearer-token";

// Create environment and client
$environment = new WatiEnvironment($endpoint, $bearerToken);
$client = new WatiClient($environment);

// Use pre-built API classes
$response = $client->send(new GetContacts());
$contacts = json_decode($response->getBody()->getContents(), true);
```

### Usage with Laravel

The SDK includes a Laravel service provider for easy integration.

#### Configuration

Add the following to your `config/services.php`:

```php
'wati' => [
    'endpoint' => env('WATI_ENDPOINT'),
    'token' => env('WATI_TOKEN'),
],
```

Add to your `.env` file:

```env
WATI_ENDPOINT=https://your-instance.wati.io/123456
WATI_TOKEN=your-bearer-token
```

#### Usage in Laravel

The service provider is auto-discovered. Simply inject or resolve `WatiClient`:

```php
use Wati\Http\WatiClient;
use Wati\Api\GetContacts;

class ContactController
{
    public function __construct(
        private readonly WatiClient $wati
    ) {}

    public function index()
    {
        $response = $this->wati->send(new GetContacts());
        return json_decode($response->getBody()->getContents(), true);
    }
}
```

## Available API Classes

### Contacts

| Class         | Method | Endpoint              |
|---------------|--------|-----------------------|
| `GetContacts` | GET    | `/api/v1/getContacts` |

### Templates

| Class                 | Method | Endpoint                      |
|-----------------------|--------|-------------------------------|
| `GetMessageTemplates` | GET    | `/api/v1/getMessageTemplates` |
| `SendTemplateMessage` | POST   | `/api/v1/sendTemplateMessage` |

## Usage

### Get Contacts

```php
<?php

use Wati\Api\GetContacts;

// Get the first page with 50 contacts (default)
$response = $client->send(new GetContacts());

// Get a specific page with a custom page size
$response = $client->send(new GetContacts(pageNumber: 2, pageSize: 100));
```

## Error Handling

```php
<?php

use Wati\Http\Exceptions\AuthenticationException;
use Wati\Http\Exceptions\RateLimitException;
use Wati\Http\Exceptions\ValidationException;
use Wati\Http\Exceptions\WatiApiException;
use Wati\Http\Exceptions\WatiException;

try {
    $response = $client->send(new GetContacts());
} catch (AuthenticationException $e) {
    // Invalid bearer token - check credentials
} catch (RateLimitException $e) {
    // Rate limited - wait and retry
    $retryAfter = $e->getRetryAfter();
} catch (ValidationException $e) {
    // Invalid request parameters
    $errors = $e->getResponseData();
} catch (WatiApiException $e) {
    // Other API errors (4xx, 5xx)
    $statusCode = $e->getStatusCode();
} catch (WatiException $e) {
    // Connection or other HTTP errors
}
```

## API Reference

For full API documentation, visit [Wati API Docs](https://docs.wati.io/reference/introduction).

## Changelog

Please see the [CHANGELOG](changelog.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](./.github/CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email the author instead of using the issue tracker.

## License

Please see the [License](./LICENSE) file.
