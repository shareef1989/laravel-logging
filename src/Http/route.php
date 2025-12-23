<?php

use Illuminate\Support\Facades\Route;

Route::prefix(config('db-logging.prefix'))
    ->middleware(config('db-logging.middleware'))
    ->group(function () {
        Route::get('logging', [\Shareef_Morad\Logging\Http\Controllers\LoggingController::class, 'index'])
            ->name('logging.index');
    });
