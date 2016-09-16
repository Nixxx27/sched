@extends('layouts.template')
@section('css')
    <style type="text/css">
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
        {
            padding: 2px;
            vertical-align: top;
            border-top: 0px solid #ddd;
        }
    </style>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ ucwords($employee->name) }}
                <small>  details</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('employees') }}">Employees List</a>
                </li>
                <li class="active">
                    <i class="fa fa-user"></i> view {{ $employee->name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-8 col-md-8">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif
          @include('errors.list')
            <table>
                <tr>
                    <td>
                        <button class="button loading-pulse lighten primary" title="Back" onclick="window.history.back()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
                    </td>
                    <td style="padding-left:10px">
                        {!! Form::open(['method'=>'GET', 'action' => ['EmployeesController@edit', $employee->id]]) !!}
                        <button class="button loading-pulse success" title="Edit {{ $employee->name }}">
                           <i class="fa fa-pencil"></i></button>
                        {!! Form::close() !!}
                    </td>
                    <td style="padding-left:10px">
                        {!! Form::open(['method'=>'DELETE', 'action' => ['EmployeesController@destroy', $employee->id]]) !!}
                        <button class="button loading-pulse danger" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $employee->name }}"><i class="fa fa-times"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                 <tr>
            </table>
         </div>
    </div>
    <hr class="bg-red">
    <!-- Employee Details -->
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <table border="1" cellpadding="20px" cellspacing="20px" class="table-responsive" >
                <tr>
                    <td class="details_td">Emp ID</td>
                    <td class="data_td"> {{ $employee->idnum }}</td>
                </tr>
                 <tr>
                    <td class="details_td">Name</td>
                    <td style="padding:10px"> {{ ucwords($employee->name) }}</td>
                </tr>
                <tr>
                    <td class="details_td">Code</td>
                    <td style="padding:10px"> {{ strtoupper($employee->code) }}</td>
                </tr>
                <tr>
                    <td class="details_td">Rank</td>
                    <td style="padding:10px"> {{ ucwords($employee->rank) }}</td>
                </tr>
                <tr>
                    <td class="details_td"> Type</td>
                    <td style="padding:10px"> {{ ucwords($employee->emp_type) }}</td>
                </tr>
                <tr>
                    <td class="details_td">Summer Sched</td>
                    <td style="padding:10px"> {{ $employee->s_schedule->sched_num }}
                        <small> {{ $employee->s_schedule->timein->format('h:i A') }} - {{ $employee->s_schedule->timeout->format('h:i A') }} </small>
                    </td>
                </tr>
                <tr>
                    <td class="details_td">Winter Sched</td>
                    <td style="padding:10px"> {{ $employee->w_schedule->sched_num }}
                        <small> {{ $employee->w_schedule->timein->format('h:i A') }} - {{ $employee->w_schedule->timeout->format('h:i A') }} </small>
                    </td>
                </tr>
            </table>
        </div>
 
        <!-- Level -->
        <div class="col-lg-7 col-md-7">
           <h4><strong> Area of Assignment :</strong> <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i></h4>
             <h4><strong><i>Level {{ $employee->level }}
                    @if ($employee->senior==1)
                    ( senior )
                    @endif
             </i></strong></h4>
            <ul type='square'> 
              @foreach( $level as $l)
                    <li>{{ ucwords( $l->area ) }}</li>
                @endforeach   
            </ul>
        </div>
    </div>
@endsection
