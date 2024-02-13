<?php

namespace Shareef_Morad\Logging\Models;

use Carbon\Carbon;
use Shareef_Morad\Logging\Models\Logging;

trait HasLogging
{

    static function boot()
    {
        parent::boot();
        if (!config('db-logging.enable')) {
            return false;
        }

        parent::created(function ($model) {
        
            $model->setAppends([]);
            
            $log         = new Logging();
            $log->table  = $model->getTable();
            $log->row_id = $model->id;
            $log->after   = $model;
            $log->user_id = auth()->check() ? auth()->id() : null;
            $log->action  = "create";
            $log->save();
            $max_life = Carbon::now()->subDays(config('db-logging.life_time'));
            Logging::whereDate('created_at', '<', $max_life)->delete();
        });

        parent::updating(function ($model) {
            $log          = new Logging();
            $log->table   = $model->getTable();
            $log->row_id  = $model->id;
            $log->before  = $model->getOriginal();
            $log->user_id = auth()->check() ? auth()->id() : null;
            $log->action  = "updating";
            $log->save();
        });

        parent::updated(function ($model) {
            $model->setAppends([]);
            $log         = Logging::where('action', 'updating')->orderBy('id', 'desc')->first();
            $log->action = 'update';
            $log->after  = $model;
            $log->save();
        });

        parent::deleting(function ($model) {
            
            $model->setAppends([]);

            $log = new Logging();
            $log->table   = $model->getTable();
            $log->row_id  = $model->id;
            $log->before  = $model;
            $log->user_id = auth()->check() ? auth()->id() : null;
            $log->action  = "delete";
            $log->save();
            $max_life = Carbon::now()->subDays(config('db-logging.life_time'));
            Logging::whereDate('created_at', '<', $max_life)->delete();
        });
    }


}
