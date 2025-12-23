<?php

namespace Shareef_Morad\Logging;

use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/config/db-logging.php' => config_path('db-logging.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__ . '/views' => resource_path('views/backend/logging'),
        ], 'views');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/Http/route.php');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/config/db-logging.php', 'db-logging'
        );
    }
}