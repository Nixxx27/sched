<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\logs;
use App\Http\Controllers\Controller;

class LogsController extends Controller
{

    /**
     * @param $name
     * @param $action
     *
     * @Return write logs to File
     * @location storage/logs/{current_date}
     */
    public function logs($name,$action)
    {
        $date = carbon::now();
        \File::append('storage/logs/' .$date->format('Y-m-d'). '.txt',"\n" . $name . "      " . $action  . "      " . $date , $lock= true);
    }

    public function index( Request $request )
    {
        $search = $request->search;
        $log = logs::where('username', 'like', '%'.$search . '%')
            ->orWhere('action', 'like', '%'.$search . '%')
            ->orWhere('created_at', 'like', '%'.$search . '%')
            ->orderBy('id', 'desc')
            ->paginate(30);
        $log->setPath('logs');

        return view('pages.logs.list',compact('log'));
    }
}