<?php


Route::group(['prefix'=>config('db-logging.prefix'),
'namespace'=>'ElsayedNofal\Logging\Http\Controllers',
'middleware'=>config('db-logging.middleware')],function(){

    Route::get('logging','LoggingController@index');


});
