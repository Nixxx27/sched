<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\global_settings;
use App\Http\Requests;

class GlobalSettings extends Controller
{
    public function store_dom_counter_settings(Request $request)
    {
    	

        //check if level 1 is checked.
        $dom_counter_level_1_settings = ( $request['dom_counter_level_1']=='true_1') ? 1 : 0;
        //update dom counter level 2
        $a = global_settings::where('name','=','dom_counter_level_1')->first();
        $a->settings = $dom_counter_level_1_settings ;
        $a->save();

        //check if level 2 is checked.
        $dom_counter_level_2_settings = ( $request['dom_counter_level_2']=='true_2') ? 1 : 0;
        //update dom counter level 2
        $b = global_settings::where('name','=','dom_counter_level_2')->first();
        $b->settings = $dom_counter_level_2_settings ;
        $b->save();

        //check if level 3 is checked.
        $dom_counter_level_3_settings = ( $request['dom_counter_level_3']=='true_3') ? 1 : 0;
        //update dom counter level 3
        $c = global_settings::where('name','=','dom_counter_level_3')->first();
        $c->settings = $dom_counter_level_3_settings ;
        $c->save();

    	
    	$this->logs('change settings in dom couunter');

        return redirect('domestic_counter/view_counter_settings')->with([
            'flash_message' => "Settings succesfully updated!"
        ]);
    	
    }

    /*
    * Update setting from gates setup
    * Location : view / pages / gates / domestic / setup
    **/

    public function store_dom_gate_settings(Request $request)
    {
        

        //check if level 1 is checked.
        $dom_gate_level_1_settings = ( $request['dom_gate_level_1']=='true_1') ? 1 : 0;
        //update dom counter level 2
        $a = global_settings::where('name','=','dom_gate_level_1')->first();
        $a->settings = $dom_gate_level_1_settings ;
        $a->save();

        //check if level 2 is checked.
        $dom_gate_level_2_settings = ( $request['dom_gate_level_2']=='true_2') ? 1 : 0;
        //update dom counter level 2
        $b = global_settings::where('name','=','dom_gate_level_2')->first();
        $b->settings = $dom_gate_level_2_settings ;
        $b->save();

        //check if level 3 is checked.
        $dom_gate_level_3_settings = ( $request['dom_gate_level_3']=='true_3') ? 1 : 0;
        //update dom counter level 3
        $c = global_settings::where('name','=','dom_gate_level_3')->first();
        $c->settings = $dom_gate_level_3_settings ;
        $c->save();

        
        $this->logs('change Required level in Domestic Gates');

        return redirect('gates/setup')->with([
            'flash_message' => "Settings succesfully updated!"
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
