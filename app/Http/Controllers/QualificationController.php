<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\emp_qualities;
use App\employees;
use App\qualification;
use App\Http\Requests;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $id= 1;
        // $employee = employees::findorfail($id);
        // //retrieve all qualification of employee.
        // $emp_qualities = emp_qualities::where('emp_id', '=' ,$id)->get();
        // return view( "pages.qualifications.list",compact('emp_qualities','employee') );


        $qualifications = qualification::orderBy('id', 'desc')->paginate(10);
        $qualifications->setPath('qualification');
        return view( "pages.qualifications.list",compact('qualifications') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('pages.qualifications.add');
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
                'qualification' => 'required|min:2',
            ]);

       $qualification = qualification::create($request->all());
       $this->logs('Add new qualification ' .$qualification->qualification);

        return redirect('qualification')->with([
            'flash_message' => "New Qualification succesfully Added!"
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
        $qualification = qualification::findorfail($id);
        return view('pages.qualifications.edit',compact('qualification'));
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
                'qualification' => 'required|min:2',
            ]);
        $qualification = qualification::findorfail($id);
        $this->logs('Update qualification ' .$qualification->qualification ." to " . $request->qualification );
        $qualification->update( $request->all() );

        return redirect('qualification')->with([
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
        $qualification = qualification::findorfail($id);
        $this->logs("Delete " .$qualification->rank );
        $qualification->delete();

        return redirect('qualification')->with([
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
