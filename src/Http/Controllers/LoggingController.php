<?php

namespace Shareef_Morad\Logging\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shareef_Morad\Logging\Models\Logging;

class LoggingController extends Controller{

    function index(Request $request){
        $log=new Logging;
        if($request->isMethod('POST')){
            foreach($request->search as $key=>$value){
                if($value=="")continue;
                $log=$log->where($key,$value);
            }
        }
        $log=$log->orderBy('id','desc')->paginate(20);
        $tables=Logging::groupBy('table')->pluck('table');
        $user_table=config('db-logging.user.model');
        
        $users=new $user_table;
        $users=$users->pluck(config('db-logging.user.display_field'));
        $data=[
            'users'=>$users,
            'tables'=>$tables,
            'log'=>$log
        ];
        return view('backend.logging.index',$data);
    }


}