@extends('layouts.template')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Add Personnel <small> for Domestic Counter </small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
    <hr class="bg-red">
    <div class="col-md-5 col-sm-5">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif
        <div class="example" data-text="">
            <div class="grid">
                @include('errors.list')
                {!! Form::open(array('name'=>'add_counter_personnel','id'=>'add_counter_personnel','action'=>'DomesticCounter@store')) !!}
                <div class="row cells">
                    <table class="table">
                        <tr>
                            <td ><label for="counter">Counter #</label></td>
                            <td>
                            <select name="counter" id="counter" class="input-control select">
                                <option value="" >Select Counter</option>
                                @foreach($dom_counters as $dom_counter)
                                  <option value="{{ $dom_counter }}">CTR # {{ $dom_counter }}</option>
                                @endforeach
                            </select>
                        </tr>
                        <tr>
                            <td><label for="emp_id">Employee</label></td>
                            <td>
                                <select name="emp_id" id="emp_id" class="input-control select">
                                    <option value="" >Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->name }}">{{ strtoupper($employee->name) }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="schedule">Date</label></td>
                            <td> <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                                    <input type="text" name="date">
                                    <button class="button"><span class="mif-calendar"></span></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="input-control radio small-check">
                                    <input type="radio" name="shift_x" id="winter"  onclick="x_shift(1)">
                                    <span class="check"></span>
                                    <span class="caption">Morning Shift </span>
                                </label></td>
                            <td>
                                <label class="input-control radio small-check">
                                    <input type="radio" name="shift_x" id="winter" onclick="x_shift(2)">
                                    <span class="check"></span>
                                    <span class="caption">Afternoon Shift </span>
                                </label>

                                <input type="hidden" name="shift" id="shift" readonly >
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row cells">
                    <div class="cell">
                            <button class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                    </div>
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

        function x_shift(y)
        {
            var x = $('#shift');
            x.val(y);
        }
    </script>
@endsection