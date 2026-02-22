<?php

declare(strict_types=1);

namespace Wati\Laravel;

use Illuminate\Support\ServiceProvider;
use Override;
use Wati\Http\WatiClient;
use Wati\Http\WatiEnvironment;

final class WatiServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->app->singleton(WatiClient::class, fn (): WatiClient => new WatiClient(
            new WatiEnvironment(
                endpoint: config('services.wati.endpoint'),
                bearerToken: config('services.wati.token'),
            )
        ));
    }
}
