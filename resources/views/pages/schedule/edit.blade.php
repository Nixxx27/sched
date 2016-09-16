@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit
                <small>Schedule</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('schedule') }}"> Schedule</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Edit Schedule
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'edit_schedule','id'=>'edit_schedule','action' => array('ScheduleController@update', $schedules->id) )) !!}
                    @include('errors.list')
                    <div class="row cells">
                        <div class="cell">
                            <label>Sched Name:</label>
                            <div class="input-control text full-size {{ $errors->has('sched_num')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="sched_num" value="{{ $schedules->sched_num }}">
                            </div>
                        </div>


                    </div>

                    <div class="row cells2">
                        <div class="cell">
                            <label>Time In</label>
                            <div class="input-control select full-size {{ $errors->has('timein')?  ' error block-shadow-danger' : '' }}">

                                {!! Form::select('timein',
                                array($schedules->timein->format('h:m:s') => $schedules->timein->format('h:m:s A'),
                                '01:00:00'  =>  '1:00 AM',
                                '01:30:00'  =>  '1:30 AM',
                                '02:00:00'  =>  '2:00 AM',
                                '02:30:00'  =>  '2:30 AM',
                                '03:00:00'  =>  '3:00 AM',
                                '03:30:00'  =>  '3:30 AM',
                                '04:00:00'  =>  '4:00 AM',
                                '04:30:00'  =>  '4:30 AM',
                                '05:00:00'  =>  '5:00 AM',
                                '05:30:00'  =>  '5:30 AM',
                                '06:00:00'  =>  '6:00 AM',
                                '06:30:00'  =>  '6:30 AM',
                                '07:00:00'  =>  '7:00 AM',
                                '07:30:00'  =>  '7:30 AM',
                                '08:00:00'  =>  '8:00 AM',
                                '08:30:00'  =>  '8:30 AM',
                                '09:00:00'  =>  '9:00 AM',
                                '09:30:00'  =>  '9:30 AM',
                                '10:00:00'  =>  '10:00 AM',
                                '10:30:00'  =>  '10:30 AM',
                                '11:00:00'  =>  '11:00 AM',
                                '11:30:00'  =>  '11:30 AM',
                                '12:00:00'  =>  '12:00 PM',
                                '12:30:00'  =>  '12:30 PM',
                                '13:00:00'  =>  '1:00 PM',
                                '13:30:00'  =>  '1:30 PM',
                                '14:00:00'  =>  '2:00 PM',
                                '14:30:00'  =>  '2:30 PM',
                                '15:00:00'  =>  '3:00 PM',
                                '15:30:00'  =>  '3:30 PM',
                                '16:00:00'  =>  '4:00 PM',
                                '16:30:00'  =>  '4:30 PM',
                                '17:00:00'  =>  '5:00 PM',
                                '17:30:00'  =>  '5:30 PM',
                                '18:00:00'  =>  '6:00 PM',
                                '18:30:00'  =>  '6:30 PM',
                                '19:00:00'  =>  '7:00 PM',
                                '19:30:00'  =>  '7:30 PM',
                                '20:00:00'  =>  '8:00 PM',
                                '20:30:00'  =>  '8:30 PM',
                                '21:00:00'  =>  '9:00 PM',
                                '21:30:00'  =>  '9:30 PM',
                                '22:00:00'  =>  '10:00 PM',
                                '22:30:00'  =>  '10:30 PM',
                                '23:00:00'  =>  '11:00 PM',
                                '23:30:00'  =>  '11:30 PM',
                                '24:00:00'  =>  '12:00 AM',
                                '24:30:00'=>' 12:30 AM'),
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'timein']) !!}
                            </div>
                        </div>

                        <div class="cell">
                            <label>Time Out</label>
                           <div class="input-control select full-size {{ $errors->has('timeout')?  ' error block-shadow-danger' : '' }}">
                                    {!! Form::select('timeout',
                                    array($schedules->timein->format('h:m:s') => $schedules->timein->format('h:m:s A'),
                                    '01:00:00'  =>  '1:00 AM',
                                    '01:30:00'  =>  '1:30 AM',
                                    '02:00:00'  =>  '2:00 AM',
                                    '02:30:00'  =>  '2:30 AM',
                                    '03:00:00'  =>  '3:00 AM',
                                    '03:30:00'  =>  '3:30 AM',
                                    '04:00:00'  =>  '4:00 AM',
                                    '04:30:00'  =>  '4:30 AM',
                                    '05:00:00'  =>  '5:00 AM',
                                    '05:30:00'  =>  '5:30 AM',
                                    '06:00:00'  =>  '6:00 AM',
                                    '06:30:00'  =>  '6:30 AM',
                                    '07:00:00'  =>  '7:00 AM',
                                    '07:30:00'  =>  '7:30 AM',
                                    '08:00:00'  =>  '8:00 AM',
                                    '08:30:00'  =>  '8:30 AM',
                                    '09:00:00'  =>  '9:00 AM',
                                    '09:30:00'  =>  '9:30 AM',
                                    '10:00:00'  =>  '10:00 AM',
                                    '10:30:00'  =>  '10:30 AM',
                                    '11:00:00'  =>  '11:00 AM',
                                    '11:30:00'  =>  '11:30 AM',
                                    '12:00:00'  =>  '12:00 PM',
                                    '12:30:00'  =>  '12:30 PM',
                                    '13:00:00'  =>  '1:00 PM',
                                    '13:30:00'  =>  '1:30 PM',
                                    '14:00:00'  =>  '2:00 PM',
                                    '14:30:00'  =>  '2:30 PM',
                                    '15:00:00'  =>  '3:00 PM',
                                    '15:30:00'  =>  '3:30 PM',
                                    '16:00:00'  =>  '4:00 PM',
                                    '16:30:00'  =>  '4:30 PM',
                                    '17:00:00'  =>  '5:00 PM',
                                    '17:30:00'  =>  '5:30 PM',
                                    '18:00:00'  =>  '6:00 PM',
                                    '18:30:00'  =>  '6:30 PM',
                                    '19:00:00'  =>  '7:00 PM',
                                    '19:30:00'  =>  '7:30 PM',
                                    '20:00:00'  =>  '8:00 PM',
                                    '20:30:00'  =>  '8:30 PM',
                                    '21:00:00'  =>  '9:00 PM',
                                    '21:30:00'  =>  '9:30 PM',
                                    '22:00:00'  =>  '10:00 PM',
                                    '22:30:00'  =>  '10:30 PM',
                                    '23:00:00'  =>  '11:00 PM',
                                    '23:30:00'  =>  '11:30 PM',
                                    '24:00:00'  =>  '12:00 AM',
                                    '24:30:00'=>' 12:30 AM'),
                                    ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                    'id'=>'timeout']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <button class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            <button onclick="goBack()" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 7-->
    </div> <!-- /.row -->


@endsection