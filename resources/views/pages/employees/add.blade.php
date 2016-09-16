@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                New
                <small>Employee</small>
            </h2>
            {{--<ol class="breadcrumb">--}}
                {{--<li>--}}
                    {{--<i class="fa fa-users"></i>  <a href="{{ $project_name }}/employees">Employees List</a>--}}
                {{--</li>--}}
                {{--<li class="active">--}}
                    {{--<i class="fa fa-user"></i> Add employee--}}
                {{--</li>--}}
            {{--</ol>--}}
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-8 col-lg-8">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            <div class="example" data-text="details">
                <div class="grid">
                    {!! Form::open(array('name'=>'add_employee','id'=>'add_employee','action'=>'EmployeesController@store')) !!}
                    @include('errors.list')

                    <div class="row cells">
                        <div class="cell">
                            <label for="name"> Name</label>
                            <div class="input-control text full-size {{ $errors->has('name')?  ' error block-shadow-danger' : '' }}">
                              <input type="text" name="name" id="name" value="{{old('name')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells3">
                        <div class="cell">
                            <label for="idnum">ID number</label>
                            <div class="input-control text full-size {{ $errors->has('idnum')?  ' error block-shadow-danger' : '' }}">
                                 <input type="text" name="idnum" id="idnum" value="{{old('idnum')}}">
                            </div>
                        </div>
                       <div class="cell">
                            <label for="emp_type"> Type</label>
                            <div class="input-control select full-size {{ $errors->has('emp_type')?  ' error block-shadow-danger' : '' }}">
                                {!! Form::select('emp_type',
                                array(''=>'-- Please Select--',
                                'organic'=>'Organic',
                                'outsource' => 'Outsource'),
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'emp_type']) !!}
                            </div>
                        </div>
                         <div class="cell">
                            <label for="code">Employee Code</label>
                            <div class="input-control text full-size {{ $errors->has('code')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" id="code" name="code" value="{{old('code')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells2">
                     <div class="cell">
                            <label for="level"> Level</label>
                            <div class="input-control select full-size {{ $errors->has('level')?  ' error block-shadow-danger' : '' }}">
                                {!! Form::select('level',
                                array('1'=>'Level 1',
                                '2' => 'Level 2',
                                '3' => 'Level 3'),
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'level']) !!}
                            </div>
                        </div>
                        <div class="cell">
                            <label for="rank">Rank</label> <button type="button" class="btn btn-primary btn-xs" title="Add Rank" data-toggle="modal"  data-target="#rank_modal">+</button>
                            <div class="input-control select full-size {{ $errors->has('rank')?  ' error block-shadow-danger' : '' }}">
                                <select id="rank" name="rank">
                                    <option value="">-- Please Select--</option>
                                    @foreach( $ranks as $rank)
                                        <option value="{{ $rank->rank }}">{{ strtoupper( $rank->rank ) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
              

                    <div class="row cells2">
                        <div class="cell">
                            <label><span class="mif-cloudy3 mif-2x mif-ani-heartbeat mif-ani-slow" style="color:#ce9135"></span> Summer Sched:</label>
                            <div class="input-control select full-size {{ $errors->has('summer_sched')?  ' error block-shadow-danger' : '' }}">
                                <select id="summer_sched" name="summer_sched">
                                    <option value="">-- Please Select--</option>
                                    @foreach( $schedule as $sched)
                                        <option value="{{ $sched->id }}">{{ $sched->sched_num }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="cell">
                            <label for="winter_sched"><span class="mif-weather5 mif-2x mif-ani-heartbeat mif-ani-slow" style="color:#0072c6"></span> Winter Sched: </label>
                            <div class="input-control select full-size {{ $errors->has('winter_sched')?  ' error block-shadow-danger' : '' }}">
                                <select id="winter_sched" name="winter_sched">
                                    <option value="">-- Please Select--</option>
                                    @foreach( $schedule as $sched)
                                        <option value="{{ $sched->id }}">{{ $sched->sched_num }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row cells3">
                        <div class="cell">
                             <label for="senior"> Senior employee?</label>
                            <div class="input-control select full-size {{ $errors->has('senior')?  ' error block-shadow-danger' : '' }}">
                                {!! Form::select('senior',
                                array(1 => 'Yes',
                                0 => 'No'),0,
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'senior']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <button class="button primary  block-shadow-primary loading-pulse" onClick="return confirm('Are you sure you want to add this new Employee?')"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                        </div>
                    </div>

                </div><!--grid-->
            </div><!--example-->
            {!! Form::close() !!}
        </div><!--md 7-->
    </div> <!-- /.row -->
@endsection

@section('modal')
     <!-- Rank Modal -->
    <div class="modal fade" id="rank_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="grid">
                        {{ Form::open(array('url' => 'employees/rank','method' => 'GET')) }}
                        @include('errors.list')
                        <div class="row cells1">
                            <div class="cell">
                                <label>Rank </label>
                                <div class="input-control text full-size {{ $errors->has('rank')?  ' error block-shadow-danger' : '' }}">
                                    <input type="text" name="rank" value="{{old('rank')}}">
                                </div>
                            </div>
                         </div><!--grid-->
                </div>
                <div class="modal-footer">
                    <button class="button primary  block-shadow-primary loading-pulse" onClick="return confirm('Add new Rank?')"><i class="fa fa-floppy-o"></i> Save</button>
                    <button data-dismiss="modal" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection