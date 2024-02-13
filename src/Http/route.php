<?php


Route::group([
    'prefix'     => config('db-logging.prefix'),
    'namespace'  => 'Shareef_Morad\Logging\Http\Controllers',
    'middleware' => config('db-logging.middleware')
], function () {
    Route::get('logging', 'LoggingController@index');
});
