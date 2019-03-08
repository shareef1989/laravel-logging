<?php
namespace ElsayedNofal\Logging\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use ElsayedNofal\Logging\Models\Logging;

trait HasLogging {

    static function boot(){
        parent::boot();
        if(!config('db-logging.enable')){
            return false;
        }

        parent::created(function($model){
            $log=new Logging();
            $log->table=$model->table;
            $log->row_id=$model->id;
            $log->after=$model;
            $log->user_id=Session::get(config('db-logging.user.session'))->id;
            $log->action="create";
            $log->save();
            $max_life=Carbon::now()->subDays(config('db-logging.life_time'));
            Logging::whereDate('created_at','<',$max_life)->delete();
        });

        parent::updating(function($model){
            $log=new Logging();
            $log->table=$model->table;
            $log->row_id=$model->id;
            $log->before=$model->getOriginal();
            $log->user_id=Session::get(config('db-logging.user.session'))->id;
            $log->action="updating";
            $log->save();
        });

        parent::updated(function($model){
            $log= Logging::where('action','updating')->orderBy('id','desc')->first();
            $log->action='update';
            $log->after=$model;
            $log->save();
        });

        parent::deleting(function($model){
            $log=new Logging();
            $log->table=$model->table;
            $log->row_id=$model->id;
            $log->before=$model;
            $log->user_id=Session::get(config('db-logging.user_session'))->id;
            $log->action="delete";
            $log->save();
            $max_life=Carbon::now()->subDays(config('db-logging.life_time'));
            Logging::whereDate('created_at','<',$max_life)->delete();
        });



    }


}