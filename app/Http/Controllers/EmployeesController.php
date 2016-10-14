<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use App\employees;
use App\emp_qualities;
use App\level;
use App\rank;
use App\schedule;
use App\season;
use App\qualification;
use App\Http\Controllers\Controller;
use carbon\carbon;
use Khill\Lavacharts\Lavacharts;

/**
 * Class EmployeesController
 * @package App\Http\Controllers
 */
class EmployeesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request->search=='')? '' : $request->search;

        $employees = employees::where('name', 'like', '%'.$search . '%')
            ->orWhere('idnum', 'like', '%'.$search . '%')
            ->orWhere('emp_type', 'like', '%'.$search . '%')
            ->orWhere('code', 'like', '%'.$search . '%')
            ->orWhere('rank', 'like', '%'.$search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $employees->setPath('employees');

        /**
         * Set Panel Style
         *
         * @return Style
         */
        $season = $request['season'];

        if( $season=='summer' ){
            $panel ='panel-warning';
            $icon = 'mif-cloudy3';
            $color = '#ce9135';
            $s_name= 'Summer';
            $btn = 'danger';
        }elseif ( $season=='winter' )
        {
            $panel ='panel-primary';
            $icon = 'mif-weather5';
            $color = 'white';
            $s_name= 'Winter';
            $btn= 'info';

        }else{
            //If no selected season switch to default.
            $season_controller =  season::first();
            if( $season_controller->theme=='winter'){
                $panel ='panel-primary';
                $icon = 'mif-weather5';
                $color = 'white';
                $s_name= 'Winter';
                $btn= 'info';
            }else
            {
                $panel ='panel-warning';
                $icon = 'mif-cloudy3';
                $color = '#ce9135';
                $s_name= 'Summer';
                $btn = 'danger';
            }

        }

        return view('pages.employees.list',compact('employees','season','search','panel','icon','color','s_name','btn','test'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ranks = rank::all();
        $schedule = schedule::all();

        return view('pages.employees.add',compact('ranks','schedule') );
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
                'name' => 'required|min:2',
                'idnum' => 'required',
                'code' => 'required',
                'summer_sched' => 'required',
                'winter_sched' => 'required',
                'rank' => 'required|min:2',
                'level' => 'required',
                'senior' => 'integer',
                'emp_type' => 'required|min:2',
            ],
            $messages = array( 'idnum.required' => 'ID num field is required', 'emp_type.required'=> 'Type field is required' )
            );

        $emp = employees::create( $request->all() );
        $this->logs('Add new employee: ' .$emp->name . ' Emp ID: '.$emp->idnum );

        return redirect('employees')->with([
            'flash_message' => "New Employee succesfully Added!"
        ]);
    }

    /**
     *
     * Store new Rank from Employee
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_rank(Request $request)
    {
        $this->validate($request,
            [
                'rank' => 'required|min:2',
            ]);

        $rank = rank::create($request->all());
        $this->logs('Add new rank ' .$rank->rank);

        return back()->with([
            'flash_message' => "New Rank succesfully Added!"
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
        $qualification = qualification::all();
        $employee = employees::findorfail($id);
        
        //return area of assignment for employees
        $level = level::where('level','=',$employee->level)->get();

        
        //retrieve all qualification of employee.
        $emp_qualities = emp_qualities::where('emp_id', '=' ,$id)->get();

         //qualification to Array convertion
       $emp_qualities_array = emp_qualities::where('emp_id', '=' ,$id)->lists('qualification_id')->toArray();
        
        return view('pages.employees.show',compact('employee','qualification','emp_qualities','emp_qualities_array','level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ranks = rank::all();
        $schedule = schedule::all();
        $employees = employees::findorfail($id);
        return view('pages.employees.edit',compact('employees','ranks','schedule'));
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
                'name' => 'required|min:2',
                'idnum' => 'required',
                'code' => 'required',
                'summer_sched' => 'required',
                'winter_sched' => 'required',
                'rank' => 'required|min:2',
                'level' => 'required',
                'emp_type' => 'required|min:2',
            ],
            $messages = array( 'idnum.required' => 'ID num field is required', 'emp_type.required'=> 'Type field is required' )
            );

        //check if counter checkbox is checked or not
       $request['cntr_ml'] =(empty( $request['cntr_ml'] ))? 0 : 1;
       $request['cntr_dom_only'] =(empty( $request['cntr_dom_only'] ))? 0 : 1;
       $request['cntr_int_only'] =(empty( $request['cntr_int_only'] ))? 0 : 1;
       $request['cntr_t_one'] =(empty( $request['cntr_t_one'] ))? 0 : 1;


        $employees = employees::findorfail($id);
        $employees->update( $request->all() );
        $this->logs('Update employee DB id no: ' . $id);


        return redirect('employees/' .$id)->with([
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
        $employees = employees::findorfail($id);
        $this->logs("Delete Employee: " .$employees->name. " w/ emp #: " . $employees->idnum . " DB id no: " . $id);
        $employees->delete();
        return redirect('employees')->with([
            'flash_message' => 'Deleted Successfully'
        ]);

    }

    /**
    *
    * @param employee id, Array of qualification
    * @return Add new qualification to Employee
    * @DB emp_qualification
    */
    public function add_qualification(Request $request, $id)
    {
        $quantities = $request['qualification'];
        if (empty( $quantities )){
            return \Redirect::back()->withErrors(['No qualification Selected']);

        }else
        {
            foreach($quantities as $quan) {
                $emp_qualities = emp_qualities::create([
                    'emp_id'    => $id,
                    'qualification_id' =>$quan
                    ]);
            }      
            return \Redirect::back()->with(['flash_message' => 'Qualification succesfully Added!']);
        }
      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_employee_qualification($id)
    {
        $emp_qualities = emp_qualities::findorfail($id);
        $emp_qualities->delete();
        return \Redirect::back()->with(['flash_message' => 'Qualification succesfully Deleted!']);
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

    public function chatTest()
    {

        $datatable = \Lava::DataTable();
        $datatable->addNumberColumn('Age');
        $datatable->addNumberColumn('Weight');

            $datatable->addRow([1,2]);

        \Lava::ScatterChart('AgeWeight', $datatable, [
            'width' => 900,
            'legend' => [
                'position' => 'none'
            ],
            'hAxis' => [
                'title' => 'Time'
            ],
            'vAxis' => [
                'title' => 'Counter'
            ]
        ]);

        return view('pages.employees.test');
    }
}
