# AGENTS.md - Wati SDK Setup Guide

This guide helps AI agents integrate the Wati SDK library into PHP projects.

## Quick Start

### 1. Install via Composer

```bash
composer require phpjuice/wati-sdk
```

### 2. Create Client

```php
use Wati\Http\WatiClient;
use Wati\Http\WatiEnvironment;
use Wati\Api\GetContacts;

// Get credentials from Wati Dashboard (API Docs section)
$endpoint = 'https://your-instance.wati.io/123456';
$bearerToken = 'your-bearer-token';

$environment = new WatiEnvironment($endpoint, $bearerToken);
$client = new WatiClient($environment);
```

### 3. Use Pre-built API Classes

```php
use Wati\Api\GetContacts;

$response = $client->send(new GetContacts());
$data = json_decode($response->getBody()->getContents(), true);
```

## Available API Classes

| Class         | Method | Endpoint              |
|---------------|--------|-----------------------|
| `GetContacts` | GET    | `/api/v1/getContacts` |

## Testing

```bash
composer install
composer test
composer types
```

## Project Structure

```
src/
└── Api/
    └── GetContacts.php
```

## Requirements

- PHP 8.3+
- `phpjuice/wati-http-client` ^1.0
