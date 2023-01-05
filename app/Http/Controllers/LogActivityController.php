<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    //
    public function myTestAddToLog()
    {
        \App\Helpers\LogActivity::addToLog('Login');
        dd('log insert successfully.');
    }
    public function logActivity()
    {
        $logs = \App\Helpers\LogActivity::logActivityLists();

        return view('admin.logactivity',compact('logs'));
    }
}
