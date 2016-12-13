<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\employees;
use App\Http\Requests;
use App\Http\Requests\DomCounterRequest;
use App\dom_counter;
use App\dom_counter_sched;
use App\counter_list;
use Carbon\Carbon;
use App\reliever;
use App\schedule;
use App\season;
use App\leaves;
use App\global_settings;
use App\Http\Controllers\File;


class DomesticCounter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$dom_counter = dom_counter::all()->sortBy('counter');

        //@param Date now formatted.
        $dt = ($request['date'] == '') ? Carbon::now()->format('Y-m-d') : $request['date'];
        //$dt = Carbon::now();

        //@return Query where date is, Order by Counter.
        $dom_counter = dom_counter::where('date', '=', $dt)
            ->orderBy('shift', 'asc')
            ->orderBy('counter', 'asc')
            ->get();


        $count = $dom_counter->count();
        return view('pages.counter.domestic.list', compact('dom_counter', 'dt', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dom_csa = counter_list::find(1)->counter; //$dom csa.
        $dom_csa = explode(',', $dom_csa);

        $dom_sup = counter_list::find(2)->counter; //$dom csa.
        $dom_sup = explode(',', $dom_sup);

        $dom_counters = array_merge($dom_csa, $dom_sup); //merge 2 counters dom and sup.

        $employees = employees::all();

        return view('pages.counter.domestic.add', compact('dom_csa', 'dom_sup', 'dom_counters', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Manually Assign Employee to counter
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'counter' => 'required',
                'emp_code' => 'required',
                'date' => 'required',
                'shift' => 'required',
            ],
            $messages = array('emp_id.required' => 'The employee field is required')
        );

        $exist = dom_counter::where("emp_id", "=", $request['emp_id']) //check if duplicate
            ->where("date", "=", $request['date'])
            ->where("shift", "=", $request['shift'])

            ->orWhere("date", "=", $request['date'])
            ->where("counter", "=", $request['counter'])
            ->where("shift", "=", $request['shift'])
            ->count();

        if ($exist > 0)
        {
            $this->logs('Failed to manually assign :'. $request['emp_id'] . ' to Counter : ' .$request['counter'] . ' For date : '. $request['date']);
            return redirect('domestic_counter')->withErrors(["There is alreasy assigned Personnel"]);
        }else
        {
            dom_counter::create($request->all());
            $this->logs('Manually assign :'. $request['emp_id'] . ' to Counter : ' .$request['counter'] . ' For date : '. $request['date'] . " shift " . $request['shift']);
            return redirect('domestic_counter')->with(['flash_message' => "New Employee successfully assign to counter"]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $date=$request->date;

        //@Return will check weather default theme is winter or summer.
        $season = season::findorfail(1);
        $theme_query = ($season->theme =='winter')? "winter_sched" : "summer_sched";

        //@return assigned employees on the requested date
       $view_personnel_on_that_date = dom_counter::where("date","=",$date)->lists('emp_code');
     //   $view_personnel_on_that_date = explode(' ', $view_personnel_on_that_date); // explode list to array. --not included
                
        //@return scheduled selected on the requested date

        $dom_counter_sched = dom_counter_sched::where("date","=",$date)->lists('sched');
        $dom_counter_sched = explode(',', $dom_counter_sched); // explode list to array.

            $unassigned_csa = employees::whereIn($theme_query,$dom_counter_sched)
                ->whereNotIn('code',$view_personnel_on_that_date)
                ->where('rank','=','CSA1')
                ->orwhere('rank','=','CSA2')
                    ->whereIn($theme_query,$dom_counter_sched)
                     ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','CSA3')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','SUPERVISOR')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','SUPERVISORS')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orderBy('code')
                ->get();


        $employees = employees::all();
        $dom_counter = dom_counter::findorfail($id);
        return view('pages.counter.domestic.edit',compact('dom_counter','employees','unassigned_csa'));
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
                'emp_code' => 'required',
                'remarks' => 'required',
            ],
            $messages = array('emp_code.required' => 'The Employee Code is required')
        );


        //FOR remarks
        $previous_remarks = dom_counter::where('emp_code','=',$request['curr_emp'])
            ->where("date","=",$request['assign_date'])->first();

        $new_remarks = $previous_remarks->remarks . "\r\n" . "\r\n" . "=================" . "\r\n" .
        \Auth::user()->name . " updated CTR#" . $request['log_counter'] . " " . carbon::now() . "\r\n" .
         "From ". $request['curr_emp'] . " to " . $request['emp_code'] . "\r\n" . "\r\n" .
            $request['remarks'] ;

        $request['remarks'] = $new_remarks;


        //check if exist
        $exist = dom_counter::where('emp_id','=',$request['emp_id'])
            ->where("date","=",$request['assign_date'])
            ->get();
        if ( $exist->count() > 0)
        {
            return redirect('domestic_counter')->withErrors([$request->emp_id . " already assigned to different counter ."]);

        }else
        {
            $dom_counter = dom_counter::findorfail($id);
            $dom_counter->update( $request->all() );
            $this->logs('Update Personnel for counter # ' . $request['log_counter']);

            return redirect('domestic_counter')->with([
                'flash_message' => 'Updated Counter' . $request['counter_num'] . ' Successfully '
            ]);
        }
    }


    public function edit_counter_assignment($code,$date,$shift,$current_counter)
    {

        $dom_csa = counter_list::find(1)->counter; //$dom csa.
        $dom_csa = explode(',', $dom_csa);

        $dom_sup = counter_list::find(2)->counter; //$dom csa.
        $dom_sup = explode(',', $dom_sup);

        $csa_senior = counter_list::find(3)->counter; //$dom csa.
        $csa_senior = explode(',', $csa_senior);

        $mabuhay = counter_list::find(4)->counter; //$dom csa.
       $mabuhay = explode(',', $mabuhay);

        //merge all counters
         $dom_counters = array_merge($dom_csa, $dom_sup,$csa_senior,$mabuhay);
         
        //@return counter on the requested date for morning shift
        $view_counter_on_that_date_morning = dom_counter::where("date","=",$date)->where('shift',1)->lists('counter');
        $view_counter_on_that_date_morning_count =  $view_counter_on_that_date_morning->count();
        
        if ( $view_counter_on_that_date_morning_count > 0)
        {   
            $view_counter_on_that_date_morning =  $view_counter_on_that_date_morning->toArray();
            $dom_counters_morning = array_diff($dom_counters,$view_counter_on_that_date_morning);
        }else
        {
            $dom_counters_morning = [];
        }

        //@return counter on the requested date for afternoon shift
        $view_counter_on_that_date_afternoon = dom_counter::where("date","=",$date)->where('shift',2)->lists('counter');
        $view_counter_on_that_date_afternoon_count =  $view_counter_on_that_date_afternoon->count();
        
        if (  $view_counter_on_that_date_afternoon_count > 0)
        {
            $view_counter_on_that_date_afternoon =  $view_counter_on_that_date_afternoon->toArray();
            $dom_counters_afternoon = array_diff($dom_counters,$view_counter_on_that_date_afternoon);
        }else
        {
            $dom_counters_afternoon = [];
        }


        if($shift==1)
        {
            $counters = $dom_counters_morning;
        }else
        {
            $counters = $dom_counters_afternoon;
        }

        
        return view('pages.counter.domestic.change_counter',compact('counters','code','date','current_counter','shift') );
    }

    public function save_new_counter(Request $request)
    {
        $this->validate($request,
            [
                'counter' => 'required',
                'emp_code' => 'required',
                'date' => 'required',
                'remarks'   => 'required',
                'shift' => 'required',
           ],
            $messages = array('emp_id.required' => 'The employee field is required')
        );

        //FOR remarks
        $previous_remarks = dom_counter::where('emp_code','=',$request['emp_code'])
            ->where("date","=",$request['date'])->first();

        $new_remarks = $previous_remarks->remarks . "\r\n" . "\r\n" . "=================" . "\r\n" .
        \Auth::user()->name . " Reassigned Counter of " . $request['emp_code'] . " " . carbon::now() . "\r\n" .
         "From ". $request['current_counter'] . " to " . $request['counter'] . "\r\n" . "\r\n" .
            $request['remarks'] ;

        $request['remarks'] = $new_remarks;


        $update_emp_counter = dom_counter::where('date',$request->date)
            ->where('emp_code',$request->emp_code)
            ->where('shift',$request->shift)
            ->first();
        $update_emp_counter->update(['counter' =>   $request->counter,'remarks'=> $request['remarks'] ]);
        $update_emp_counter->save();

        $this->logs('Update Counter assignment for :'. $request['emp_code'] . ' to Counter : ' .$request['counter'] . ' For date : '. $request['date'] . " shift " . $request['shift']);
            return redirect('domestic_counter')->with(['flash_message' => $request->emp_code ." Successfully transfered to counter # " . $request->counter]);
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
     *
     *@return Counter Settings.
     *
     * @param Schedule.
     */
    public function view_counter_settings()
    {
        // $Senior per carousel in global settings db. fixed name=senior_per_carousel_dom
        // _new update ommitted.
        $senior_per_carousel = global_settings::where('name','=','senior_per_carousel_dom')->first();

        //default counter level 1
        $dom_counter_level_1 = global_settings::where('name','=','dom_counter_level_1')->first();

        //default counter level 2
        $dom_counter_level_2 = global_settings::where('name','=','dom_counter_level_2')->first();

        //default counter level 3
        $dom_counter_level_3 = global_settings::where('name','=','dom_counter_level_3')->first();

        $schedule = schedule::all();
        return view('pages.counter.domestic.settings',compact('schedule','dom_counter_level_1','dom_counter_level_2','dom_counter_level_3') );
    }


    /**
     *
     * @Return Result From randomize selection
     *
     * @Redirect To Save.
     */
    public function counter_setup(DomCounterRequest $request)
    {

        //@param variables @schedule $date.
        $schedule = $request['schedule'];
        $schedule_1 =$request['schedule_1'];
        $schedule_2 = $request['schedule_2']; //supervisor schedule
        $schedule_3 = $request['schedule_3']; //supervisor schedule 2
        $date =  $request['date'];
        $shift = $request['shift'];
        $level = $request['level_dom'];

        // query if level 1 is check
        $where1 =( $request['dom_counter_level_1'] ==1) ? 1 : 0 ;
        // query if level 2 is check
        $where2 =( $request['dom_counter_level_2'] ==1) ? 2 : 0 ;

        // query if level 3 is check
        $where3 =( $request['dom_counter_level_3'] ==1) ? 3 : 0 ;

        //@Return will check weather default theme is winter or summer.
        $season = season::findorfail(1);
        $theme_query = ($season->theme =='winter')? "winter_sched" : "summer_sched";

        // return integer of day now sunday = 0, saturday = 6
        $day_num_now =date( "w", strtotime( $date)); //date("w");

        // Return all leaves on selected Date

        $reliever_today  = reliever::where('date', '=', $date)
        ->lists('name');

        //$reliever_today = [1,3,4,357,358];
       $on_leave_today = leaves::where('date', '=', $date)
        ->whereNotIn('emp_id', $reliever_today) //overwrite leave if he is reliever
        ->lists('emp_id');

        //@return Supervisor Randomize Query limit 4.
         $sup = employees::where('rank','=','supervisor')
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->where(function($q) use ($theme_query,$schedule_2,$schedule_3) {
                $q->where($theme_query, $schedule_2)     // return two sup chosen schedules
                ->orWhere($theme_query, $schedule_3);
            })
           

            ->orwhere('rank','=','supervisors')
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
                ->where('cntr_cnt_asg','=',0)
                ->where('rd1','<>',$day_num_now) // where not restday today
                ->where('rd2','<>',$day_num_now) // where not restday today
            ->where(function($q) use ($theme_query,$schedule_2,$schedule_3) {
                $q->where($theme_query, $schedule_2)     // return two sup chosen schedules
                ->orWhere($theme_query, $schedule_3);
            })
           

            //if he/she is reliever today
            ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('rank','=','supervisor')
                ->where('cntr_cnt_asg','=',0)
            ->where(function($q) use ($theme_query,$schedule_2,$schedule_3) {
                $q->where($theme_query, $schedule_2)     // return two sup chosen schedules
                ->orWhere($theme_query, $schedule_3);
            })
           

            ->orderByRaw("RAND()")
            ->limit(4)
            ->get();


        //@return supervisor Query row Count.
        $sup_row_cnt = $sup->count();

        //@retrieve Domestic Supervisor Counter List from DB.
        $sup_counter_array_list = counter_list::find(2)->counter; // domestic supervisor.
        $sup_counter_array_list = explode(',', $sup_counter_array_list); // explode list to array.

       //@return supervisor counter list.
        $chunk_sup =  collect( $sup_counter_array_list )->take($sup_row_cnt);
        $available_counter_for_sup = $chunk_sup->all();


        /*
        *
        * @return Business COUNTER Randomize Query.
        */

        //@retrieve Domestic csa Counter List from DB.
        $mabuhay_counter_array_list = counter_list::find(4)->counter; // domestic csa-senior.
        $mabuhay_counter_array_list = explode(',', $mabuhay_counter_array_list); // explode list to array.

            //convert to collect to count counter list array of dom counter
       $mabuhay_collection = collect($mabuhay_counter_array_list);
       $mabuhay_counter_limit = $mabuhay_collection->count();
       
            // CSA Query with Level
       $mabuhay = employees::where('cntr_ml','=',1)
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            // ->whereNotIn('id', $choosed_csa_id ) // where not selected in CSA
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            ->where($theme_query,'=',$schedule)
            
            ->orwhere($theme_query,'=',$schedule_1)
            ->where('cntr_ml','=',1)
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            // ->whereNotIn('id', $choosed_csa_id ) // where not selected in CSA
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            

            //if he/she is reliever today
            ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('cntr_ml','=',1)
                ->where('cntr_cnt_asg','=',0)
                ->where('cntr_int_only','=',0) // assigned to international only
                ->where($theme_query, $schedule_1) // supervisors schedule

             ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('cntr_ml','=',1)
                ->where('cntr_cnt_asg','=',0)
                ->where('cntr_int_only','=',0) // assigned to international only
                ->where($theme_query, $schedule) // supervisors schedule

            ->orderByRaw("RAND()")
            ->limit( $mabuhay_counter_limit); //defends on available counter

            $mabuhay = $mabuhay->get();
            $choosed_mabuhay_id = $mabuhay->lists('id');

            //@return CSA Query row Count.
        $mabuhay_row_cnt = $mabuhay->count();

            //@return csa counter list.
        $chunk_mabuhay =  collect( $mabuhay_counter_array_list )->take($mabuhay_row_cnt);
        $available_counter_for_mabuhay = $chunk_mabuhay->all();

        /**** end mabuhay lounge counter ****/


        /*
        *
        * @return CSA  Randomize Query.
        */

            //@retrieve Domestic csa Counter List from DB.
        $csa_counter_array_list = counter_list::find(1)->counter; // domestic csa.
        $csa_counter_array_list = explode(',', $csa_counter_array_list); // explode list to array.

            //convert to collect to count counter list array of dom counter
       $csa_collection = collect($csa_counter_array_list);
       $csa_counter_limit = $csa_collection->count();

      
            
            // CSA Query with Level
      $csa = employees::where('rank','=','csa1')
           
            ->where('cntr_cnt_asg','=',0) // set to 0 meaning CAN assigned
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            ->where(function($q) use ($theme_query,$schedule,$schedule_1) {  //advance query with param pass
                    $q->where($theme_query, $schedule)     // return two chosen schedules
                    ->orWhere($theme_query, $schedule_1);
                })
            ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter
            
            ->orwhere('rank','=','csa2')
            ->where('cntr_cnt_asg','=',0) 
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })
            ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter

            ->orwhere('rank','=','csa3')
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
            ->where('cntr_cnt_asg','=',0) 
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only

            ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })
            ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter

            //if he/she is reliever today
            ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('rank','=','csa1')
                ->where('cntr_cnt_asg','=',0)
                ->where('cntr_int_only','=',0) // assigned to international only
                 ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })

            ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('rank','=','csa2')
                ->where('cntr_cnt_asg','=',0)
                ->where('cntr_int_only','=',0) // assigned to international only
                 ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })

             ->orWhereIn('name',$reliever_today) // where he is a reliever
                ->where('rank','=','csa3')
                ->where('cntr_cnt_asg','=',0)
                ->where('cntr_int_only','=',0) // assigned to international only
                 ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })


             ->orderByRaw("RAND()")
            ->limit( $csa_counter_limit); //defends on available counter
  
          $csa  =  $csa->get();
          $choosed_csa_id = $csa->lists('id');

            //@return CSA Query row Count.
       $csa_row_cnt = $csa->count();

            //@return csa counter list.
        $chunk_csa =  collect( $csa_counter_array_list )->take($csa_row_cnt);
        $available_counter_for_csa = $chunk_csa->all();

        /**** end CSA Counter with level Query ****/


        /*
        *
        * @return CSA Senior Randomize Query.
        */

            //@retrieve Domestic csa Counter List from DB.
        $senior_counter_array_list = counter_list::find(3)->counter; // domestic csa-senior.
        $senior_counter_array_list = explode(',', $senior_counter_array_list); // explode list to array.

            //convert to collect to count counter list array of dom counter
       $senior_collection = collect($senior_counter_array_list);
       $senior_counter_limit = $senior_collection->count();
       
            // CSA Query with Level
       $senior = employees::where('rank','=','csa1')
            //Match to Schedule ==============
            ->where('senior','=',1) // set to 1 = should be senior
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })
            ->whereNotIn('id', $choosed_csa_id ) // where not selected in CSA
            ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter
            ->whereNotIn('id', $on_leave_today ) // where not on leave today
           
            ->orwhere('rank','=','csa2')
            ->where('senior','=',1)
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                })
            ->whereNotIn('id', $choosed_csa_id ) // where not selected in CSA
            ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter
            ->whereNotIn('id', $on_leave_today ) // where not on leave today

            
            ->orwhere('rank','=','csa3')
            ->where('senior','=',1)
            ->where('cntr_cnt_asg','=',0)
            ->where('rd1','<>',$day_num_now) // where not restday today
            ->where('rd2','<>',$day_num_now) // where not restday today
            ->where('cntr_int_only','=',0) // assigned to international only
            ->where(function($q) use ($theme_query,$schedule,$schedule_1) { 
                    $q->where($theme_query, $schedule)  
                    ->orWhere($theme_query, $schedule_1);
                }) 
             ->whereNotIn('id', $choosed_csa_id ) // where not selected in CSA
             ->whereNotIn('id', $choosed_mabuhay_id ) // where not selected in Business Counter
             ->whereNotIn('id', $on_leave_today ) // where not on leave today
            

            ->orderByRaw("RAND()")
            ->limit( $senior_counter_limit) //defends on available counter
            ->get();

            //@return CSA Query row Count.
        $senior_row_cnt = $senior->count();

            //@return csa counter list.
        $chunk_senior =  collect( $senior_counter_array_list )->take($senior_row_cnt);
        $available_counter_for_senior = $chunk_senior->all();

        /**** end CSA senior counter ****/



        //@return add to logs.
        $this->logs('Random Domestic Counter For : ' . $date );

            //@return view with variables.
        return view('pages.counter.domestic.setup',compact(
            'schedule','schedule_1','schedule_2','schedule_3','date','shift',
            'sup','sup_row_cnt','available_counter_for_sup',
            'csa','csa_row_cnt','available_counter_for_csa',
            'senior','senior_row_cnt','available_counter_for_senior',
            'mabuhay','mabuhay_row_cnt','available_counter_for_mabuhay') );
    }

    /**
     *
     * @Return Save Randomize Counter
     *
     * @Redirect To Domestic Counter List.
     */

    public function save_counter_assignment(Request $request)
    {
        $schedule =     $request['schedule'];
        $schedule_1=    $request['schedule_1'];
        $schedule_2 =   $request['schedule_2'];
        $schedule_3 =   $request['schedule_3'];
        $date=          $request['date'];
            
           

            $exist = dom_counter::where("date","=",$request['date'])
                ->where("shift","=",$request['shift'])
                ->get();
               
               if ( $exist->count() == 0)
               {
                    //@Add each counter and employees to Database.
                    $i = 0;
                    foreach ($request->emp_id as $emp_id) 
                    {
                        
                        dom_counter::firstorCreate([
                           'counter' => $request->counter[$i],
                           'emp_id' => $emp_id,
                           'emp_code'   => $request->code[$i],
                           'shift' => $request['shift'],
                           'schedule' => $request['schedule'],
                           'date' => $request['date']
                       ]);
                       $i++;
                    }

                    // add counter date and employees schedule to db

                    $schedule_1 = ( empty( $schedule_1 ))? " " : "," . $schedule_1;
                    $schedule_3 = ( empty( $schedule_3 ))? " " : "," . $schedule_3;
                    
                    $dom_counter_sched_count =  dom_counter_sched::where('date',$date)->count();

                    if ( $dom_counter_sched_count > 0)
                    {
                        $update_dom_counter_sched = dom_counter_sched::where('date',$date)->first();
                        $update_dom_counter_sched->update([
                                'sched' =>   $update_dom_counter_sched->sched . ",". $schedule . "," . $schedule_2 . $schedule_1 . $schedule_3
                                ]);
                            $update_dom_counter_sched->save();
                    }else
                    {
                        dom_counter_sched::where('date',$date)->get();
                        $dom_counter_sched = dom_counter_sched::firstorCreate([
                        'date' => $request['date'],
                        'sched' => $schedule . "," . $schedule_2 . $schedule_1 . $schedule_3
                        ]);

                        $dom_counter_sched->save();
                    }
                }else
                {
                   //@return add to logs.
                   $this->logs('Failed Random Domestic Counter For : ' . $request['date'] . " ,already has assigned personnel" );

                   return redirect('domestic_counter/view_counter_settings')->withErrors(['Date already has assigned Personnel']);
               }
         

            //@return add to logs.
            $this->logs('Save Random Domestic Counter For: ' . $request->date);

            return redirect('domestic_counter')->with([
                'flash_message' => "New Personnel succesfully assigned to Counters"
            ]);;

    }

     /**
     *
     * @Return Unassigned Personnel base on date and schedules
     *
     */

     public function view_unassigned_personnel(Request $request,$date)
     {

        
        //@Return will check weather default theme is winter or summer.
        $season = season::findorfail(1);
        $theme_query = ($season->theme =='winter')? "winter_sched" : "summer_sched";

        //@return assigned employees on the requested date
       $view_personnel_on_that_date = dom_counter::where("date","=",$date)->lists('emp_code');
     //   $view_personnel_on_that_date = explode(' ', $view_personnel_on_that_date); // explode list to array. --not included
                
        //@return scheduled selected on the requested date

        $dom_counter_sched = dom_counter_sched::where("date","=",$date)->lists('sched');
        $dom_counter_sched = explode(',', $dom_counter_sched); // explode list to array.

            $unassigned_csa = employees::whereIn($theme_query,$dom_counter_sched)
                ->whereNotIn('code',$view_personnel_on_that_date)
                ->where('rank','=','CSA1')
                ->orwhere('rank','=','CSA2')
                    ->whereIn($theme_query,$dom_counter_sched)
                     ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','CSA3')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','SUPERVISOR')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orwhere('rank','=','SUPERVISORS')
                    ->whereIn($theme_query,$dom_counter_sched)
                    ->whereNotIn('code',$view_personnel_on_that_date)
                ->orderBy($theme_query)
                ->get();

                //counter lists

           
        $dom_csa = counter_list::find(1)->counter; //$dom csa.
       $dom_csa = explode(',', $dom_csa);

        $dom_sup = counter_list::find(2)->counter; //$dom csa.
        $dom_sup = explode(',', $dom_sup);

        $csa_senior = counter_list::find(3)->counter; //$dom csa.
        $csa_senior = explode(',', $csa_senior);

        $mabuhay = counter_list::find(4)->counter; //$dom csa.
       $mabuhay = explode(',', $mabuhay);

        //merge all counters
         $dom_counters = array_merge($dom_csa, $dom_sup,$csa_senior,$mabuhay);
         
        //@return counter on the requested date for morning shift
        $view_counter_on_that_date_morning = dom_counter::where("date","=",$date)->where('shift',1)->lists('counter');
        $view_counter_on_that_date_morning_count =  $view_counter_on_that_date_morning->count();
        
        if ( $view_counter_on_that_date_morning_count > 0)
        {   
            $view_counter_on_that_date_morning =  $view_counter_on_that_date_morning->toArray();
            $dom_counters_morning = array_diff($dom_counters,$view_counter_on_that_date_morning);
        }else
        {
            $dom_counters_morning = [];
        }

        //@return counter on the requested date for afternoon shift
        $view_counter_on_that_date_afternoon = dom_counter::where("date","=",$date)->where('shift',2)->lists('counter');
        $view_counter_on_that_date_afternoon_count =  $view_counter_on_that_date_afternoon->count();
        
        if (  $view_counter_on_that_date_afternoon_count > 0)
        {
            $view_counter_on_that_date_afternoon =  $view_counter_on_that_date_afternoon->toArray();
            $dom_counters_afternoon = array_diff($dom_counters,$view_counter_on_that_date_afternoon);
        }else
        {
            $dom_counters_afternoon = [];
        }
        

  
        return view('pages.counter.domestic.unassigned',compact('unassigned_csa','counter','dom_counters_morning','dom_counters_afternoon','date') );

     }

     public function add_from_unassigned(Request $request)
     {

        $this->validate($request,
            [
                'counter' => 'required',
                'emp_code' => 'required',
                'date' => 'required',
                'schedule' => 'required',
                'shift' => 'required',
           ],
            $messages = array('emp_id.required' => 'The employee field is required')
        );

        $exist = dom_counter::where("emp_code", "=", $request['emp_code']) //check if duplicate
            ->where("date", "=", $request['date'])
            ->where("shift", "=", $request['shift'])

            ->orWhere("date", "=", $request['date'])
            ->where("counter", "=", $request['counter'])
            ->where("shift", "=", $request['shift'])
            ->count();

        if ($exist > 0)
        {
            $this->logs('Failed to manually assign from unassigned list :'. $request['emp_code'] . ' to Counter : ' .$request['counter'] . ' For date : '. $request['date']);
            return back()->withErrors(["There is alreasy assigned Personnel"]);
        }else
        {
            dom_counter::create($request->all());
            $this->logs('Manually assign from unassigned list :'. $request['emp_code'] . ' to Counter : ' .$request['counter'] . ' For date : '. $request['date']);
            return back()->with([
            'flash_message' => $request['emp_code'] ." successfully assigned to counter " . $request['counter'] ]);

        }

     }

    /**
     * @return Print Counter assignment base on selected date
     * @param $date
     */

     public function print_assignment($dt,Request $request)
     {


        //@return Query where date is, Order by Counter.
        $dom_counter = dom_counter::where('date', '=', $dt)
            ->orderBy('shift', 'asc')
            ->orderBy('counter', 'asc')
            ->get();


        return view('pages.counter.domestic.print_assignment', compact('dom_counter', 'dt') );
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


    public function test()
    {
        //TEST
//        $collection = collect([0, 1, 2, 3, 4, 5]);
//
//        $chunk = $collection->take(3);
//        $test = $chunk->all();
//        return $test;
//
//       return $schedule = season::all();


        // [0, 1, 2]

        $name = "nikko";
        \File::append('storage/logs/mytextdocument.txt',"\n" . "tests2  " . $name , $lock= true);
     // return  \File::get('storage/logs/mytextdocument.txt');
    }


}
