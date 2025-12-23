<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS behind Railway/reverse proxies so asset() and @vite() don't
        // generate http:// links that get blocked as mixed content.
        $isRailway = env('RAILWAY_ENVIRONMENT')
            || env('RAILWAY_PROJECT_ID')
            || env('RAILWAY_PUBLIC_DOMAIN')
            || env('RAILWAY_PRIVATE_DOMAIN');

        if ($isRailway || str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
