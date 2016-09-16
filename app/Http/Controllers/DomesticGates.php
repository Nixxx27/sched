<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\dom_gates;
use App\employees;
use App\schedule;
use App\season;
use App\global_settings;
use App\daily_flight;
use App\Http\Requests;

class DomesticGates extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
        $dt = Carbon::now()->format('Y-m-d');
        $search = ($request->search=='')? $dt  : $request->search;

        $dom_gates = dom_gates::where('date', 'like', '%'.$search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
        $dom_gates->setPath('gates');

        return view( "pages.gates.domestic.list",compact('search','dom_gates') );
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
    * View setup Page
    *
    * @return \Illuminate\Http\Response
    */
    public function setup()
    {
        //default gate level 1
        $dom_gate_level_1 = global_settings::where('name','=','dom_gate_level_1')->first();

        //default gate level 2
        $dom_gate_level_2 = global_settings::where('name','=','dom_gate_level_2')->first();

        //default gate level 3
        $dom_gate_level_3 = global_settings::where('name','=','dom_gate_level_3')->first();


        $schedule = schedule::all();

        return view('pages.gates.domestic.setup',compact('schedule','dom_gate_level_1','dom_gate_level_2','dom_gate_level_3'));     
    }

    /**
    * View all flights available for the selected Day | Sun - Sat
    *
    * @return \Illuminate\Http\Response
    */

    public function view_gates_flight(Request $request)
    {

        $this->validate($request,
            [
                'schedule' => 'required',
                'date'     => 'required'
            ]);


        // convert selected date to day number
        $dt = carbon::parse( $request['date'] ); // 0 = sunday 6 = saturday ADD ->dayOfWeek

        $daily_flight = daily_flight::where('day_num',"=",$dt->dayOfWeek)
        ->orderBy('day_num','asc')
        ->get();

        $selected_sched = $request['schedule'];
        $selected_date = $request['date'];
        $dom_gate_level_1 = $request['dom_gate_level_1'];    
        $dom_gate_level_2 = $request['dom_gate_level_2'];
        $dom_gate_level_3 = $request['dom_gate_level_3'];

        //to view personnels on selected date.
        $return_assigned_emp = dom_gates::where( 'date', $request['date'])->get();

         return view( "pages.gates.domestic.show_flight_results",compact('dt','daily_flight','selected_sched','selected_date','dom_gate_level_1','dom_gate_level_2','dom_gate_level_3','return_assigned_emp') );
    }

    public function save_setup(Request $request)
    {
       
        $schedule = $request['schedule'];

        //@Return will check weather default theme is winter or summer.
        $season = season::findorfail(1);
        $theme_query = ($season->theme =='winter')? "winter_sched" : "summer_sched";

        // query if level 1 is check
        $where1 =( $request['dom_gate_level_1'] ==1) ? 1 : 0 ;
        // query if level 2 is check
        $where2 =( $request['dom_gate_level_2'] ==1) ? 2 : 0 ;
        // query if level 3 is check
        $where3 =( $request['dom_gate_level_3'] ==1) ? 3 : 0 ;

        //check if already  has 4 assigned employees
        $matchThese = ['flight_num' => $request['flight_num'], 'date' => $request['date']];
        $if_has_assignment = dom_gates::where( $matchThese )->count();
         
        // return all assigned employee in dom gates DB. to array
           $return_assigned_emp = dom_gates::where( 'date', $request['date'])->lists('emp_id');
                
        if ($if_has_assignment >= 4)
            {
                $this->logs('already 4');
                //return redirect('gates/setup')->withErrors(["There is already 4 Personnel Assigned "]);
                 return back()->withErrors(["There is already 4 Personnel Assigned "]);
            }else
            {
                $csa = employees::where('rank','=','csa')
                ->where($theme_query,'=',$schedule)
                ->where('senior','=',0)      // set to 0 = not senior
                ->where('level','=',$where1) //level should match
                ->whereNotIn('id',$return_assigned_emp)
                    ->orwhere('level','=',$where2) //level 2 should match
                    ->where($theme_query,'=',$schedule)
                    ->where('senior','=',0)// set to 0 = not senior
                    ->whereNotIn('id',$return_assigned_emp)
                ->orwhere('level','=',$where3) //level 3 should match
                ->where($theme_query,'=',$schedule)
                ->where('senior','=',0)// set to 0 = not senior
                ->whereNotIn('id',$return_assigned_emp)
                ->orderByRaw("RAND()")
                ->limit(4)
                ->get();

                foreach ($csa as $key) {
                    echo $key->id . " " . $key->name . "<br>";

                   dom_gates::create([
                        'date'  => $request['date'],
                        'flight_num'  => $request['flight_num'],
                        'emp_id' => $key->id
                    ]);
                } //end foreach


                //check if there is available CSA to assigned
                if ( $csa->count() >= 0 ) {
                    $this->logs('Assigned new Gate Personnel for ' . $request['date']);
                    return back()->withErrors(["No Available CSA to Assigned "]);

        
                }else
                {
                    $this->logs('Assigned new Gate Personnel for ' . $request['date']);
                    return back()->with([
                    'flash_message' => "New Personnel Successfully Assigned"
                ]);  
                }

                
                 


            }

       //return view( "pages.gates.domestic.nn",compact('users','csa') );
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
