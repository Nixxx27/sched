@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit
                <small>Flight</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('daily_flight')}}"> Daily Flight Lists</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Edit daily Flight
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'daily_flight_edit','id'=>'daily_flight_edit','action' => array('DailyFlightController@update', $daily_flight->id) )) !!}
                    @include('errors.list')
                    <div class="row cells2">
                        <div class="cell">
                            <label>Day</label>
                            <div class="input-control text full-size {{ $errors->has('day_num')?  ' error block-shadow-danger' : '' }}">
                                <select class="input-control" name="day_num">
                                    <option value="{{ $daily_flight->day_num }}">{{ $day_name}}</option>
                                    <option value=0>Sunday</option>
                                    <option value=1>Monday</option>
                                    <option value=2>Tuesday</option>
                                    <option value=3>Wednesday</option>
                                    <option value=4>Thursday</option>
                                    <option value=5>Friday</option>
                                    <option value=6>Saturday</option>
                                </select>
                            </div>
                        </div>
            
                        <div class="cell">
                            <label>Flight Number</label>
                            <div class="input-control text full-size {{ $errors->has('flight_num')?  ' error block-shadow-danger' : '' }}">
                                 <input type="text" name="flight_num" value="{{ $daily_flight->flight_num }}">
                            </div>
                        </div>
                    </div>
                        <div class="row cells1">
                            <div class="cell">
                                <button onclick="return confirm('Confirm changes?')" class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                                <button onclick="goBack()" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div><!--grid-->
                </div><!--example-->
            </div><!--md 7-->
        </div> <!-- /.row -->
@endsection