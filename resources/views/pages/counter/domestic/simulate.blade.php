@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Create Schedule
                <small>Domestic Check-in Counter</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="dom_check_in">Domestic Check-In</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Create Schedule
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-4 col-sm-4 col-md-offset-1 col-sm-offset-1">
            <div class="example" data-text="">
                <div class="grid">
                    @include('errors.list')
                    {!! Form::open(array('name'=>'simmulate_dom_cntr_form','id'=>'simmulate_dom_cntr_form')) !!}
                    <div class="row cells1">
                        <div class="cell">
                            <label>Set Available Counter <span style="color:darkred;font-size:10px">(do not include supervisor's counter)</span></label>
                            <div class="input-control text full-size{{ $errors->has('counter')?  ' error block-shadow-danger' : '' }}">
                                <input type="number" name="counter" value="{{old('counter')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <label>Set Available Supervisors Counter </label>
                            <div class="input-control text full-size{{ $errors->has('supervisor')?  ' error block-shadow-danger' : '' }}">
                                <input type="number" name="supervisor" value="{{old('supervisor')}}">
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <label>Shift</label>
                            <div class="input-control select full-size {{ $errors->has('shift')?  ' error block-shadow-danger' : '' }}">
                                <select name="shift" id="shift" onChange="dom_counter_employee()">
                                    <option value="">-- Please Select --</option>
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row cells1">
                        <div class="cell">
                            <button onclick="return confirm('Proceed simulation?');" class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-circle-o-notch fa-spin"></i> Simulate</button>
                            <button type="button" onclick="goBack()" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 4-->

        <div class="col-md-4">
            <div class="CSSTableGenerator" >
                <table id="myTable">
                    <tr>
                        <td>Employee Name</td>
                        <td>Code</td>
                    </tr>
                </table>
            </div>
        </div>
    </div> <!-- /.row -->

@endsection

