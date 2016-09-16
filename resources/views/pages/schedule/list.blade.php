@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Scheduled
                <small>List</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="url('home')">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-users"></i> Schedule
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href="schedule/create">
            <button class="button danger loading-pulse"><span class="mif-user-plus"></span> Add Schedule</button>
            </a>
            <hr>
        </div>
        <div class=" col-md-8  col-sm-8">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            <div class="example" data-text="">
                <div class="CSSTableGenerator" >
                    <table >
                        <tr>
                            <td class="sortable-column">#</td>
                            <td>Sched Num</td>
                            <td>Time In</td>
                            <td>Time Out</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>{{ $schedule->sched_num }}</td>
                                <td>{{ date('h:i A', strtotime( $schedule->timein) ) }}</td>
                                <td>{{ date('h:i A', strtotime( $schedule->timeout) )}}</td>
                                <td style="text-align:center">
                                    {!! Form::open(['method'=>'GET', 'action' => ['ScheduleController@edit', $schedule->id]]) !!}
                                    <button class="btn btn-default btn-sm"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                    {!! Form::close() !!}
                                </td>
                                <td style="text-align:center">
                                    {!! Form::open(['method'=>'DELETE', 'action' => ['ScheduleController@destroy', $schedule->id]]) !!}
                                     <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $schedule->sched_num }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $schedules->render() !!}
                </div>
            </div>
        </div>
@endsection
