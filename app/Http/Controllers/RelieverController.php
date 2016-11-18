<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employees;
use App\reliever;

use App\Http\Requests;

class RelieverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reliever = reliever::orderBy('id', 'desc')->paginate(10);
        $reliever->setPath('reliever');
        return  view('pages.reliever.list',compact('reliever') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $employees = employees::orderBy('name', 'asc')->get();
        return  view('pages.reliever.add',compact('employees'));
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
                'date' => 'required|min:2',
                'name'  => 'required|min:2',
            ]);

       $reliever = reliever::create($request->all());
       $this->logs('Add New Reliever  - Name: ' . $reliever->name . " Date : " . $reliever->date );

        return redirect('reliever')->with([
            'flash_message' => "New Reliever succesfully Added!"
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
        $reliever = reliever::findorfail($id);
        $this->logs("Delete " .$reliever->id );
        $reliever->delete();

        return redirect('reliever')->with([
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
