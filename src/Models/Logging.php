<?php

namespace Shareef_Morad\Logging\Models;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model {
    protected $table='logging';
    protected $guarded=['id'];


    protected $casts=[
        'after'=>'object',
        'before'=>'object'
    ];


    function user(){
        return $this->belongsTo(config('db-logging.user.model'),'user_id');
    }

}