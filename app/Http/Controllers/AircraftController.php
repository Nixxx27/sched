<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aircraft;
use App\Http\Requests;

class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $aircraft = aircraft::orderBy('id', 'desc')->paginate(10);
        $aircraft->setPath('aircraft');
        return view( "pages.aircraft.list",compact('aircraft') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('pages.aircraft.add');
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
                'type' => 'required|min:2',
                'capacity' => 'required|min:1|numeric',
            ],
            $messages = array( 'type.required' => 'Aircraft Type is required','type.min' => 'Aircraft Type has a minimum of atleast 2 characters.' )
            );

        $aircraft = aircraft::create($request->all());
        $this->logs('Add new Aircraft ' .$aircraft->type);

        return redirect('aircraft')->with([
            'flash_message' => "New Aircraft succesfully Added!"
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
       $aircraft = aircraft::findorfail($id);
        return view('pages.aircraft.edit',compact('aircraft'));
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
        $this->validate($request,
            [
                'type' => 'required|min:2',
                'capacity' => 'required|min:1|numeric',
            ],
            $messages = array( 'type.required' => 'Aircraft Type is required','type.min' => 'Aircraft Type has a minimum of atleast 2 characters.' )
            );
        $aircraft = aircraft::findorfail($id);
        $this->logs('Update Aircraft ' .$aircraft->type);
        $aircraft->update( $request->all() );

        return redirect('aircraft')->with([
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
        $aircraft = aircraft::findorfail($id);
        $this->logs("Delete " .$aircraft->type );
        $aircraft->delete();

        return redirect('aircraft')->with([
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
