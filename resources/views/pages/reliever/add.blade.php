@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                New
                <small>Reliever</small>
            </h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('reliever')}}"> Reliever List</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Add Reliever
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-5">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('name'=>'add_reliever','id'=>'add_reliever','action'=>'RelieverController@store')) !!}
                    @include('errors.list')
                  <div class="row cells2">
                        <div class="cell">
                            <label for="code">Date</label>
                               <div class="input-control text {{ $errors->has('date')?  ' error block-shadow-danger' : '' }}" id="datepicker" data-format="yyyy-mm-dd">
                            <input type="text" name="date">
                            <button class="button"><span class="mif-calendar"></span></button>
                        </div>

                        <div class="cell">
                            <input type="hidden" name="emp_id">
                            <label>Employee Name</label>
                             <div class="input-control select full-size {{ $errors->has('name')?  ' error block-shadow-danger' : '' }}">
                                <select id="name" name="name">
                                    <option value="">-- Please Select--</option>
                                    @foreach( $employees as $emp)
                                        <option value="{{ $emp->name }}">{{ strtoupper( $emp->name ) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row cells1">
                        <div class="cell">
                            <button onclick="return confirm('Save new reliever?')" class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 7-->
    </div> <!-- /.row -->


@endsection


@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });

    </script>
@endsection