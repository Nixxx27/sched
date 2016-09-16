<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\rank;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rank = rank::orderBy('id', 'desc')->paginate(10);
        $rank->setPath('rank');
        return  view('pages.rank.list',compact('rank') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('pages.rank.add');
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
                'rank' => 'required|min:2',
            ]);

       $rank = rank::create($request->all());
       $this->logs('Add new rank ' .$rank->rank);

        return redirect('rank')->with([
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
        $rank = rank::findorfail($id);
        return view('pages.rank.edit',compact('rank'));
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
        $rank = rank::findorfail($id);
        $this->logs('Update rank ' .$rank->rank ." to " . $request->rank );
        $rank->update( $request->all() );

        return redirect('rank')->with([
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
        $rank = rank::findorfail($id);
        $this->logs("Delete " .$rank->rank );
        $rank->delete();

        return redirect('rank')->with([
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
