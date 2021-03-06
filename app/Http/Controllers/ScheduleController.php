<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = schedule::orderBy('id', 'desc')->paginate(10);
        $schedules->setPath('schedule');
        return view('pages.schedule.list',compact('schedules') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.schedule.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'sched_num' => 'required',
                'timein' => 'required',
                'timeout' => 'required',
            ],
            $messages = array( 'sched_num.required' => 'Sched Name field is required', 'timein.required'=> 'Time in field is required', 'timeout.required'=> 'Time out field is required' )
            );

        $sched = schedule::create($request->all());
        $this->logs('Add new schedule DB id no: ' .$sched->id);

        return redirect('schedule')->with([
            'flash_message' => "New Schedule succesfully Added!"
        ]);
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
        $schedules = schedule::findorfail($id);
        return view('pages.schedule.edit',compact('schedules'));
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
        $schedules = schedule::findorfail($id);
        $schedules->update( $request->all() );
        $this->logs('Update schedule DB id no: ' . $id);

        return redirect('schedule')->with([
            'flash_message' => 'Updated Successfully'
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
        $schedules = schedule::findorfail($id);
        $this->logs("Delete " .$schedules->name. " w/ emp #: " . $employees->idnum . " DB id no: " . $id);
        $schedules->delete();

        return redirect('schedule')->with([
            'flash_message' => 'Deleted Successfully'
        ]);
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
