<?php

namespace Shareef_Morad\Logging\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Shareef_Morad\Logging\Models\Logging;

class LoggingController extends Controller
{
    /**
     * Display the logging index page.
     */
    public function index(Request $request): View
    {
        $log = Logging::query();
        
        if ($request->isMethod('POST') && $request->has('search')) {
            foreach ($request->search as $key => $value) {
                if ($value == "") {
                    continue;
                }
                $log = $log->where($key, $value);
            }
        }
        
        $log = $log->orderBy('id', 'desc')->paginate(20);
        $tables = Logging::groupBy('table')->pluck('table');
        
        $userModelClass = config('db-logging.user.model');
        $users = app($userModelClass)->pluck(config('db-logging.user.display_field'));
        
        $data = [
            'users'  => $users,
            'tables' => $tables,
            'log'    => $log
        ];
        
        return view('backend.logging.index', $data);
    }
}
