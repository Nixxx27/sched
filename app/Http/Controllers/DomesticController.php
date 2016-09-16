<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\dom_counter;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DomesticController extends Controller
{
    public function dom_check_in(){
        $dom_cntr = domcounter::all();

        return view('pages.domestic.dom_check_in',compact('dom_cntr'));
    }

    public function ab()
    {
        $jcode = User::all();
//
//    $test = "ss";
////        $result = [];
////        foreach($jcode as $item) {
////       $test=     $item->id }
//
//        return $test;

        return view('pages.json',compact('result'));
    }

    public function simulate(){
        return view('pages.domestic.simulate');
    }

    public function simulate_store(Request $request){

        $this->validate($request,
            [
                'counter' => 'required|numeric|min:1',
                  'shift' => 'required|min:2',
            ]);


        $employees_shift = employees::where('shift','=', $request['shift'])
            ->where('')
            ->orderByRaw("RAND()")->get();

        $x = $request['counter'] + 1;
            foreach ($employees_shift as $shift) {
             $x--;

                $request['counter'] =$x;
                $request['date'] = Carbon::now()->format('Ymd');
                $request['name'] = $shift->name;
                $request['code'] = $shift->code;
                domcounter::create($request->all());

            }//foreach

        return redirect('dom_check_in')->with([
            'flash_message' => "New Employee succesfully Added! "
        ]);
    }

}

