@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Passenger Service Division
                <small>Employees List</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-users"></i> Employees
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <button class="button danger loading-pulse" onclick="add_employee()"><span class="mif-user-plus"></span> Add Employee</button>
            <hr>
        </div>
        <div class=" col-md-10  col-sm-10">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
        <div class="example" data-text="">
            <table class="table striped hovered cell-hovered border bordered" id="main_table_demo">
                <thead>
                    <tr>
                       <th class="sortable-column">#</th>
                       <th>ID num</th>
                       <th>Name</th>
                       <th>Code</th>
                       <th>Rank</th>
                       <th>Type</th>
                       <th>Schedule</th>
                       <th></th>
                       <th></th>
                   </tr>
                </thead>
             <tbody>
                 @foreach($employees as $employee)
                   <tr>
                      <td>{{( $employee->id ) }}</td>
                      <td>{{( $employee->idnum ) }}</td>
                      <td><span style="font-weight:bold">{{ucwords( $employee->name ) }}</span></td>
                      <td>{{ strtoupper( $employee->code )}}</td>
                      <td>{{ ucwords( $employee->rank )}}</td>
                      <td>{{ ucwords( $employee->emp_type )}}</td>
                      @if(  $employee->schedule_id !== 0 )
                           <td>{{ $employee->schedule->timein }} - {{ $employee->schedule->timeout }}</td>
                      @else
                          <td><label>Not assigned</label></td>
                      @endif
                      <td style="text-align:center">
                         {!! Form::open(['method'=>'PATCH', 'action' => ['EmployeesController@edit', $employee->id]]) !!}
                         <button class="btn btn-default btn-sm" title="Edit {{ $employee->name }}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                         {!! Form::close() !!}
                      </td>
                      <td style="text-align:center">
                          {!! Form::open(['method'=>'POST', 'action' => ['EmployeesController@destroy', $employee->id]]) !!}
                          <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $employee->name }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                          {!! Form::close() !!}
                      </td>
                 </tr>
                    @endforeach
               </tbody>
            </table>
        </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $employees->render() !!}
                </div>

    </div>
    </div>

@endsection


@section('js')
    <script>
        function add_employee() {
            window.location.href = "add_employee";
        }
    </script>
@endsection