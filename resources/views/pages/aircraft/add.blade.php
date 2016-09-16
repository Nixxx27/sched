@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                New
                <small>Aircraft</small>
            </h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('aircraft')}}"> Aircraft type Lists</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Add Aircraft
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-5">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('name'=>'add_aircraft','id'=>'add_aircraft','action'=>'AircraftController@store')) !!}
                    @include('errors.list')
                    <div class="row cells2">
                        <div class="cell">
                            <label>Aircraft Type</label>
                            <div class="input-control text full-size {{ $errors->has('type')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="type" value="{{old('type')}}">
                            </div>
                        </div>

                        <div class="cell">
                            <label>Capacity</label>
                            <div class="input-control text full-size {{ $errors->has('capacity')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="capacity" value="{{old('capacity')}}">
                            </div>
                        </div>

                    <div class="row cells1">
                        <div class="cell">
                            <button onclick="return confirm('Save new aircraft type?')" class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 7-->
    </div> <!-- /.row -->


@endsection