<?php

return [

    /*
    * enable and disable db log
    * you can add DB_LOGGING to .env file
    */
    'enable'       => env('DB_LOGGING', true),

    /*
    * user date to inject for each action
    */
    'user'         => [
        'model'         => 'App\Models\User',
        'display_field' => 'user_name'
    ],

    /*
    * max time in days to keep log in db 
    */
    'life_time'    => 30,


    /*
    * ##### display log in your backend #######
    * edit config below then access url : ./backend/logging
    */

    // master backend layout to work with it
    'layout'       => 'backend.layout.master',

    // content area in layout to display data
    'content_area' => 'content',


    // url prefix
    'prefix'       => 'backend',

    // middleware for url ./backend/logging
    'middlewares'  => [
        'web',
    ],


];