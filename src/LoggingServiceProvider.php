<?php

namespace Shareef_Morad\Logging;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider{

    function boot(){
        $this->publishes([
            __DIR__.'/config' => config_path(), 
            __DIR__ . '/views' => resource_path() . '/views/backend/logging',

        ]);

        //load migrations
        if (floatval(Application::VERSION) >= 5.3) {
            $this->loadMigrationsFrom(__DIR__ . '/migrations');
        } else {
            $this->publishes([
                __DIR__ . '/migrations' => database_path('migrations'),
            ]);
        }

        include __DIR__ . '/Http/route.php';

    }

    function register(){

    }
}