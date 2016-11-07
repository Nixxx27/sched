<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\leaves;
use App\Http\Requests;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = leaves::all();
          return view('pages.leaves.list',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "im the create";
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
                'emp_id' => 'required',
                'date'  => 'required',
                'leave_type'  => 'required',
            ]);

   
        $leaves = leaves::create($request->all());
        $this->logs('Add new leave to ' .$request->emp_name);

       return \Redirect::back()->with([
            'flash_message' => $request->emp_name ." New Leave succesfully Added!"
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
        return "edit here";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $leaves = leaves::findorfail($id);
        $this->logs("Delete Leave of employee# " .$leaves->emp_id . " dated " . $leaves->date );
        $leaves->delete();

        return \Redirect::back()->with([
             'flash_message' => 'Leave Deleted Successfully'
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
