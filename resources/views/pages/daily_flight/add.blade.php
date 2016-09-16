@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                New
                <small>Daily Flight</small>
            </h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('daily_flight')}}"> Daily Flight Lists</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Add daily Flight
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-7">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('name'=>'add_daily_flight','id'=>'add_qualification','action'=>'DailyFlightController@store')) !!}
                    @include('errors.list')
                    <div class="row cells2">
                        <div class="cell">
                            <label>Day</label>
                            <div class="input-control text full-size {{ $errors->has('day_num')?  ' error block-shadow-danger' : '' }}">
                                <select class="input-control" name="day_num">
                                    <option value="">-- Please Select--</option>
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
                                 <input type="text" name="flight_num" value="{{old('flight_num')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <button class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 7-->
    </div> <!-- /.row -->


@endsection