@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                New
                <small>Employee</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('employees') }}">Employees List</a>
                </li>
                <li class="active">
                    <i class="fa fa-user"></i> Edit {{ $employees->name }}
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-7">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'employees_edit','id'=>'employees_edit','action' => array('EmployeesController@update', $employees->id) )) !!}
                    @include('errors.list')

                    <div class="row cells">
                        <div class="cell">
                            <label for="name"> Name</label>
                            <div class="input-control text full-size {{ $errors->has('name')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="name" value="{{ $employees->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells3">
                       
                        <div class="cell">
                            <label for="idnum">ID number</label>
                            <div class="input-control text full-size {{ $errors->has('idnum')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="idnum" value="{{ $employees->idnum }}">
                            </div>
                        </div>
                        <div class="cell">
                            <label for="emp_type"> Type</label>
                            <div class="input-control select full-size {{ $errors->has('emp_type')?  ' error block-shadow-danger' : '' }}">
                                {!! Form::select('emp_type',
                                array($employees->emp_type=>$employees->emp_type,
                                'organic'=>'Organic',
                                'outsource' => 'Outsource'),
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'emp_type']) !!}
                            </div>
                        </div>

                        <div class="cell">
                            <label for="code">Employee Code</label>
                            <div class="input-control text full-size {{ $errors->has('code')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="code" value="{{ $employees->code }}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells3">
                        <div class="cell">
                            <label for="level"> Level</label>
                            <div class="input-control select full-size {{ $errors->has('level')?  ' error block-shadow-danger' : '' }}">
                                {!! Form::select('level',
                                array($employees->level => $employees->level,'1'=>'Level 1',
                                '2' => 'Level 2',
                                '3' => 'Level 3'),
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'level']) !!}
                            </div>
                        </div>
                        
                        <div class="cell colspan2">
                            <label for="rank">Rank</label>
                            <div class="input-control select full-size {{ $errors->has('rank')?  ' error block-shadow-danger' : '' }}">
                                <select id="rank" name="rank">
                                    <option value="{{ $employees->rank }}">{{ strtoupper($employees->rank) }}</option>
                                    @foreach( $ranks as $rank)
                                        <option>{{ $rank->rank }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!--grid-->
            </div><!--example-->


            <div class="example" data-text="">
                <div class="grid">

                    <div class="row cells2">
                        <div class="cell">
                            <label><span class="mif-cloudy3 mif-2x mif-ani-heartbeat mif-ani-slow" style="color:#ce9135"></span> Summer Sched:</label>
                            <div class="input-control select full-size {{ $errors->has('summer_sched')?  ' error block-shadow-danger' : '' }}">
                                <select id="summer_sched" name="summer_sched">
                                    <option value="{{ $employees->summer_sched }}">{{ $employees->s_schedule->sched_num }}</option>
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
                                    <option value="{{ $employees->winter_sched }}">{{ $employees->w_schedule->sched_num }}</option>
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
                                0 => 'No'),$employees->senior,
                                ['style'=>'cursor:pointer;font-family: FontAwesome, Helvetica',
                                'id'=>'senior']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row cells1">
                        <div class="cell">
                            <button onClick="return confirm('Are you sure you want to save changes?')" class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            <button onclick="goBack()" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>

                </div><!--grid-->
            </div><!--example-->
          

        </div><!--md 7-->


        <div class="col-md-5">
                <h4><strong><i class="fa fa-cog fa-spin" aria-hidden="true"></i> Additional settings</strong></h4>
                <hr>
        <fieldset>
            <legend>Counter qualification:</legend>
            <div class="checkbox" title="can be assigned to Mabuhay Lounge?">
                <label>
                    <input type="checkbox" name="cntr_ml" value="1" {{ $employees->cntr_ml==1 ? 'checked' : '' }}> Mabuhay lounge
                </label>
            </div>

            <div class="checkbox" title="for Terminal 1 counter?">
                <label>
                    <input type="checkbox" name="cntr_t_one" value="1" {{ $employees->cntr_t_one==1 ? 'checked' : '' }}> Terminal 1
                </label>
            </div>

            <div class="checkbox" title="for domestic counter only?">
                <label>
                    <input type="checkbox" name="cntr_dom_only" value="1" {{ $employees->cntr_dom_only==1 ? 'checked' : '' }}> For domestic only
                </label>
            </div>

            <div class="checkbox" title="for international counter only?">
                <label>
                    <input type="checkbox" name="cntr_int_only" value="1" {{ $employees->cntr_int_only==1 ? 'checked' : '' }}> For international only
                </label>
            </div>

            <div class="checkbox" title="{{ $employees->name }} Cannot be assigned to Counter?">
                <label>
                    <input type="checkbox" name="cntr_cnt_asg" value="1" {{ $employees->cntr_cnt_asg==1 ? 'checked' : ''}}> Cannot be assigned to Counter?
                </label>
            </div>
        </fieldset>

        </div><!--md 5 / side settings-->
    </div> <!-- /.row -->
  {!! Form::close() !!}

@endsection