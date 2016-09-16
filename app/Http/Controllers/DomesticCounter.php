<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\employees;
use App\Http\Requests;
use App\Http\Requests\DomCounterRequest;
use App\dom_counter;
use App\counter_list;
use Carbon\Carbon;
use App\schedule;
use App\season;
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
                'emp_id' => 'required',
                'date' => 'required',
                'shift' => 'required',
            ],
            $messages = array('emp_id.required' => 'The employee field is required')
        );

        $exist = dom_counter::where("emp_id", "=", $request['emp_id']) //check if duplicate
            ->where("shift", "=", $request['shift'])
            ->where("date", "=", $request['date'])
            ->orWhere("date", "=", $request['date'])
            ->where("shift", "=", $request['shift'])
            ->where("counter", "=", $request['counter'])
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
    public function edit($id)
    {
        $employees = employees::all();
        $dom_counter = dom_counter::findorfail($id);
        return view('pages.counter.domestic.edit',compact('dom_counter','employees'));
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
     * @Redirect To Dom_counter_random_result.
     *
     * @Param pass $shift,$date
     */
//    public function save_counter_settings(Request $request)
//    {
//       // return "hello sched: " . $request['sched'] . " Date: " . $request['date']. " Theme : " . $request['theme'];
//        $sched = $request['sched'];
//        if( $request['theme'] =='winter')
//        {
//            $theme_query = "winter_sched";
//        }else{
//            $theme_query = "summer_sched";
//        }
//        //@return Supervisor Randomize Query.
//        $sup = employees::where('rank','=','supervisor')
//            ->where($theme_query,'=',$sched)
//            ->orderByRaw("RAND()")
//            ->limit(4)
//            ->get();
//
//        return view('pages.counter.domestic.test',compact('sup'));
//    }

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

       //@return Supervisor Randomize Query limit 4.
        $sup = employees::where('rank','=','supervisor')
            ->where($theme_query,'=',$schedule)
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
        * @return CSA  Randomize Query.
        */

            //@retrieve Domestic csa Counter List from DB.
        $csa_counter_array_list = counter_list::find(1)->counter; // domestic csa.
        $csa_counter_array_list = explode(',', $csa_counter_array_list); // explode list to array.

            //convert to collect to count counter list array of dom counter
       $csa_collection = collect($csa_counter_array_list);
       $csa_counter_limit = $csa_collection->count();

      
            
            // CSA Query with Level
       $csa = employees::where('rank','=','csa')
            ->where($theme_query,'=',$schedule)
            ->where('senior','=',0)      // set to 0 = not senior
            ->where('level','=',$where1) //level should match
                ->orwhere('level','=',$where2) //level 2 should match
                 ->where('senior','=',0)// set to 0 = not senior
            ->orwhere('level','=',$where3) //level 3 should match
            ->where('senior','=',0)// set to 0 = not senior
            ->orderByRaw("RAND()")
            ->limit( $csa_counter_limit) //defends on available counter
            ->get();

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
       $senior = employees::where('rank','=','csa')
           ->where($theme_query,'=',$schedule)
           ->where('level','=',$where1)  //level should match
           ->where('senior','=',1)      // senior set to 1
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
            'schedule','date','shift',
            'sup','sup_row_cnt','available_counter_for_sup',
            'csa','csa_row_cnt','available_counter_for_csa',
            'senior','senior_row_cnt','available_counter_for_senior') );
    }

    /**
     *
     * @Return Save Randomize Counter
     *
     * @Redirect To Domestic Counter List.
     */

    public function save_counter_assignment(Request $request)
    {
         //@Add each counter and employees to Database.
            $i = 0;
            foreach ($request->emp_id as $emp_id) {
                $exist = dom_counter::where("counter","=",$request['counter'][$i]) //check if Exist
                    ->where("date","=",$request['date'])
                    ->where("shift","=",$request['shift'])
                    ->get();

               if ( $exist->count() == 0)
               {
                   dom_counter::firstorCreate([
                       'counter' => $request->counter[$i],
                       'emp_id' => $emp_id,
                       'shift' => $request['shift'],
                       'schedule' => $request['schedule'],
                       'date' => $request['date']
                   ]);
                   $i++;
               }else
               {
                   //@return add to logs.
                   $this->logs('Failed Random Domestic Counter For : ' . $request['date'] . " ,already has assigned personnel" );

                   return redirect('domestic_counter/view_counter_settings')->withErrors(['Date already has assigned Personnel']);
               }
            }

            //@return add to logs.
            $this->logs('Save Random Domestic Counter For: ' . $request->date);

            return redirect('domestic_counter')->with([
                'flash_message' => "New Personnel succesfully assigned to Counters"
            ]);;

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
