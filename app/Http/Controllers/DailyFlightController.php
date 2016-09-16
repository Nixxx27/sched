<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\carbon;
use App\aircraft;
use App\daily_flight;
use App\Http\Requests;

class DailyFlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //check if user choose a day, default is current day of the week.
        $set_query = ( isset( $request['set_day'] ) ) ? $request['set_day'] : Carbon::now()->dayOfWeek;

        $daily_flight = daily_flight::where('day_num',"=",$set_query)
            ->orderBy('day_num','asc')
            ->paginate(10);
        $daily_flight->setPath('daily_flight');

        return view( "pages.daily_flight.list",compact('daily_flight') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aircraft = aircraft::all();
       return  view('pages.daily_flight.add',compact('aircraft'));
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
                'day_num' => 'required',
                'flight_num' => 'required',
            ],
            $messages = array( 'day_num.required' => 'Day field is required', 'flight_num.required'=> 'Flight number field is required' )
            );
       
       $daily_flight = daily_flight::create($request->all());
       $this->logs('Add new Daily Flight ' .$daily_flight->flight_num);

        return redirect('daily_flight')->with([
            'flash_message' => "New Daily Flight succesfully Added!"
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
        $aircraft = aircraft::all();
        $daily_flight = daily_flight::findorfail($id);

        switch ($daily_flight->day_num) 
            {
                case 0 :
                $day_name = "Sunday";
                break;
                case 1 :
                $day_name = "Monday";
                break;
                case 2 :
                $day_name = "Tuesday";
                break;
                case 3 :
                $day_name = "Wednesday";
                break;
                case 4 :
                $day_name = "Thursday";
                break;
                case 5 :
                $day_name = "Friday";
                break;
                case 6   :
                $day_name = "Saturday";
                break;
                default:
                $day_name = "";
            }       

        return view('pages.daily_flight.edit',compact('daily_flight','aircraft','day_name'));
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
                'day_num' => 'required',
                'flight_num' => 'required',
            ],
            $messages = array( 'day_num.required' => 'Day field is required', 'flight_num.required'=> 'Flight number field is required' )
            );

        $daily_flight = daily_flight::findorfail($id);
        $this->logs('Update Daily Flight ' .$daily_flight->flight_num);
        $daily_flight->update( $request->all() );

        return redirect('daily_flight')->with([
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
       $daily_flight = daily_flight::findorfail($id);
        $this->logs("Delete " .$daily_flight->flight_num );
        $daily_flight->delete();

        return redirect('daily_flight')->with([
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
