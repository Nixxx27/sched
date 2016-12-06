<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\employees;
use App\resign;

class ResignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
         $search = ($request->search=='')? '' : ltrim(rtrim( $request->search ));

        $resign = resign::where('name', 'like', '%'.$search . '%')
            ->orWhere('idnum', 'like', '%'.$search . '%')
            ->orWhere('emp_type', 'like', '%'.$search . '%')
            ->orWhere('code', 'like', '%'.$search . '%')
            ->orWhere('rank', 'like', '%'.$search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $resign->setPath('resign');

        return view('pages.employees.resigned.list',compact('employees','resign','search'));
    
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
        $this->validate($request,
            [
                'idnum' => 'required',
                'name' => 'required',
                'emp_type' => 'required',
                'code' => 'required',
                'rank' => 'required',
                'dor' => 'required',
                'remarks' => 'required',

            ],
             $messages = array('dor.required' => 'Date of Resignation is required')
            );

       $resign = resign::create($request->all());
       $this->logs('Move ' . $request['name'] . " to Resigned Database.");

       if ($resign)
       {
            $employees = employees::findorfail($request['emp_id']);
            $employees->delete();

       }
      
        return redirect('employees')->with([
            'flash_message' => "Succesfully move " . $request['name'] . " to Resigned Database."
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
      
        $resign = resign::findorfail($id);
        
       return view('pages.employees.resigned.show',compact('resign'));
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
