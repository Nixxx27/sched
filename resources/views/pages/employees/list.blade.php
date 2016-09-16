@extends('layouts.template')

@section('css')
    <style>
         th{
            text-align: center;

          }
    </style>
    @endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6 col-sm-4 col-xs-4">
            <h2 class="page-header">
                Employee <small>List</small>
            </h2>
        </div>

        <div class=" col-md-6 col-sm-8 col-xs-8 pull-right">
            <br>
            <form class="form-inline">
                  <div class="form-group">
                       <div class="input-group">
                                    {!! Form::select('season',
                                    array(''=>'-- Select Season --','summer' => 'Summer Sched', 'winter' => 'Winter Sched'),'',
                                    ['class'=>'form-control',
                                    'id'=>'select_theme',
                                    'onChange'=>'this.form.submit()',
                                    'title'=>'Select Season']) !!}
                        </div>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search" value="{{ $search }}">
                                </div>
                          </div>
                <button type="submit" class="btn btn-primary">GO</button>
            </form>
         </div>
    </div>
    <hr class="bg-red">
        <div class=" col-md-12  col-sm-12">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
                <div class="panel {{ $panel }}" id="theme" style="border:none;">
                    <div class="panel-heading"><span id="theme_icon" class="{{ $icon }} mif-2x mif-ani-heartbeat mif-ani-slow" style="color:{{ $color }}"></span>
                        <span id='sched_name'>{{ $s_name }} Sched</span>
                        <a href='employees/create'>
                            <button class="btn btn-{{ $btn }} pull-right" title="Add Employee"><span class="mif-user-plus mif-lg"></span></button>
                            {{--<button class="button danger loading-pulse pull-right" title="Add Employee"><i class="fa fa-plus" aria-hidden="true"></i></button>--}}
                        </a>
                    </div>
                     <div class="panel-body">
                         <table class="table striped hovered cell-hovered border bordered">
                             <thead>
                                 <tr>
                                     <!-- <th class="sortable-column">#</td> -->
                                     <th>ID </th>
                                     <th>Name</th>
                                     <th>Code</th>
                                     <th>Rank</th>
                                     <th>Type</th>
                                     <th>Schedule</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                     <!-- <td><span class="red-bullet"> {{( $employee->id ) }}</span></td> -->
                                     <td>{{( $employee->idnum ) }}</td>
                                     <td class="center-txt"><span style="font-weight:bold">{{strtoupper( $employee->name ) }}</span></td>
                                     <td class="center-txt">{{ strtoupper( $employee->code )}}</td>
                                     <td>{{ ucwords( $employee->rank )}}</td>
                                     <td class="center-txt">{{ ucwords( $employee->emp_type )}}</td>

                                     @if( $season=='')
                                         <!--check if has selected season, switch to default if not. -->
                                         @if($season_theme == 'summer')
                                             @if(  $employee->summer_sched !== 0 )
                                                 <td class="center-txt">{{ $employee->s_schedule->timein->format('h:i A') }} - {{ $employee->s_schedule->timeout->format('h:i A') }}</td>
                                             @else
                                                 <td><label>Not assigned</label></td>
                                             @endif
                                         @else
                                             @if(  $employee->winter_sched !== 0 )
                                                 <td class="center-txt">{{ $employee->w_schedule->timein->format('h:i A') }} - {{ $employee->w_schedule->timeout->format('h:i A') }}</td>
                                             @else
                                                 <td class="center-txt"><label>Not assigned</label></td>
                                                 @endif
                                                 @endif
                                                 @else
                                                         <!-- check what is selected summer or winter -->
                                                 @if($season == 'summer')
                                                     @if(  $employee->summer_sched !== 0 )
                                                         <td class="center-txt">{{ $employee->s_schedule->timein->format('h:i A') }} - {{ $employee->s_schedule->timeout->format('h:i A') }}</td>
                                                     @else
                                                         <td><label>Not assigned</label></td>
                                                     @endif
                                                 @else
                                                     @if(  $employee->winter_sched !== 0 )
                                                         <td class="center-txt">{{ $employee->w_schedule->timein->format('h:i A') }} - {{ $employee->w_schedule->timeout->format('h:i A') }}</td>
                                                     @else
                                                         <td class="center-txt"><label>Not assigned</label></td>
                                                     @endif
                                                 @endif
                                             @endif
                                             <td style="text-align:center">
                                                 {!! Form::open(['method'=>'GET', 'action' => ['EmployeesController@show', $employee->id]]) !!}
                                                 <button class="button loading-pulse lighten primary" title="view {{ $employee->name }} details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>

                                                 {!! Form::close() !!}
                                             </td>
                                             <td style="text-align:center">
                                                 {!! Form::open(['method'=>'GET', 'action' => ['EmployeesController@edit', $employee->id]]) !!}
                                                 <button class="button success" title="Edit {{ $employee->name }}"><i class="fa fa-pencil"></i></button>
                                                 {!! Form::close() !!}
                                             </td>
                                             <td style="text-align:center">
                                                 {!! Form::open(['method'=>'DELETE', 'action' => ['EmployeesController@destroy', $employee->id]]) !!}
                                                 <button class="button danger" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $employee->name }}"><i class="fa fa-times"></i> </button>
                                                 {!! Form::close() !!}
                                             </td>
                                        </tr>
                                    @endforeach
                             </tbody>
                         </table>
                     </div>
                     <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                            {{--{!! $employees->render() !!}--}}
                            {!! $employees->appends(['season' => Input::get('season'),'search' => Input::get('search') ])->render() !!}
                    </div>
                </div>
            </div>
    </div>



@endsection