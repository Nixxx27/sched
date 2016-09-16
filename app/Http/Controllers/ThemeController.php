<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\season;
use App\Http\Requests;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $season = season::first();

        if( $season->theme =='winter')
        {
            $class = 'mif-weather5 mif-3x mif-ani-heartbeat mif-ani-slow';
            $color = '#337AB7';
            $winter_check = 'checked';
            $summer_check = '';
        }else{
            $class = 'mif-cloudy3 mif-3x mif-ani-heartbeat mif-ani-slow';
            $color = '#CE9135';
            $summer_check = 'checked';
            $winter_check = '';
        }
        return view('pages.season.list',compact('season','class','color','winter_check','summer_check' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $season = season::findorfail($id);
        $this->logs('Update Season from ' . $season->theme .  ' to ' . $request->theme);
        $season->update( $request->all() );

        return redirect('season')->with([
            'flash_message' => 'Season successfully set to '. $request->theme
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return Add Action performed to log file
     * @param $action
     */
    public function logs($action)
    {
        $logs = new LogsController;
        $logs->logs(\Auth::user()->name,$action);
    }

}
