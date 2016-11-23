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
                <tr>
                    <td class="details_td">Rest Day</td>
                    <td style="padding:10px"> 
                    <?php $dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursay', 'Friday', 'Saturday'); ?>
                        {{ $dowMap[$employee->rd1] }}
                        {!! ($employee->rd2=="")? "" : " & " .$dowMap[$employee->rd2] !!}
                    </td>
                </tr>
            </table>

            <hr>
            <table border="1" cellpadding="20px" cellspacing="20px" class="table-responsive" >
            <tr>
                <td class="details_td" colspan="3">
                <span class="mif-event-available mif-2x mif-ani-shake"></span> Employee Leaves 
               <span style="cursor: pointer" data-toggle="modal" data-target="#myModal" class="mif-plus pull-right" title="add new leave"></span> 
              </td>
            </tr>
            <tr>
                <td style="text-align:center;font-weight:bold">Date</td>
                <td colspan="2" style="text-align:center;font-weight:bold">Type</td>
              
            </tr>
            @foreach($leaves as $l)
            <tr >
                <td style="padding:5px">{{ $l->date->format('M d,Y l')}}</td>
                <td style="padding:5px">{{ $l->leave_type }}</td>
                
                <td style="text-align:center;padding:5px">
                {!! Form::open(['method'=>'DELETE', 'action' => ['LeaveController@destroy', $l->id]]) !!}
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                {!! Form::close() !!}
                </td>
            </tr>

            @endforeach

            </table>
        </div>
 
        <!-- Level -->
        <div class="col-lg-3 col-md-3">
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
        </div><!-- Lecol-lg-3 -->


        <!-- Settings -->
        <div class="col-lg-4 col-md-4">
           <h4><strong><i class="fa fa-cog fa-spin" aria-hidden="true"></i> Additional settings
                <br><small>Qualified for:</small>
           </strong></h4>
            
            <ul type='square'> 
                {!!($employee->cntr_ml ==1)? '<li>Mabuhay counter </li>' : ''!!}  
                {!!($employee->cntr_t_one ==1)? '<li>Terminal 1</li>' : ''!!}
                {!!($employee->cntr_dom_only ==1)? '<li>Domestic Counter</li>' : ''!!}
                {!!($employee->cntr_int_only ==1)? '<li>Intl Counter</li>' : ''!!}
                {!!($employee->cntr_cnt_asg ==1)? "<li>Can't Assigned to Counter</li>" : ''!!}
            </ul>
        </div><!-- settings-->
    </div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Leave</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('name'=>'add_leave_to_employee','id'=>'add_employee','action'=>'LeaveController@store')) !!}
       <table class="table">
            <input type="hidden" name="emp_id" value="{{ $employee->id }}">
            <input type="hidden" name="emp_name" value="{{ $employee->name }}">
            <tr>
                <td>Select Date:</td>
                    <td colspan="2">
                        <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                            <input type="text" name="date">
                            <button class="button"><span class="mif-calendar"></span></button>
                        </div>
                    </td>
                </tr>

           <tr>
           <td>Select Leave Type:</td>
            <td><select class="input-control text" name="leave_type">
                <option value="">--Select Leave Type--</option>
               <option value="vacation">VL</option>
               <option value="maternity">Maternity</option>
               <option value="paternity">Paternity</option>
               <option value="others">Others</option>
           </select></td>
           </tr>
           <tr>
                <td>
                    <label>Remarks</label>
                </td>
               
           </tr>
           <tr>
               <td colspan="2">
                   <textarea name="remarks" cols="50" rows="5"></textarea>
               </td>
           </tr>

        </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });

    </script>
@endsection