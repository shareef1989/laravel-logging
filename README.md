# Logging
log changes on each model and db row


## Installation
- `composer require elsayednofal/logging`
- add service provider to config/app.php
    `ElsayedNofal\Logging\LoggingServiceProvider::class,`
- run `php artisan migrate`
- run `php artisan vendor:publish` and choose package id


## Configration
- edit config in "config/db-logging.php" every config has its own comment show how it use

## usage
 - to log action on model just add  `use HasLogging;` like example:
 ```php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use ElsayedNofal\Logging\Models\HasLogging;

    class Slider extends Model{
        use HasLogging;
    }
```

- display and search in log go to url "./backend/logging"


## support
for any questions contact me at : `elsayed_nofal@ymail.com`
