@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit
                <small>Qualification</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('qualification')}}"> Qualification Lists</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Edit Qualification
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'qualification_edit','id'=>'qualification_edit','action' => array('QualificationController@update', $qualification->id) )) !!}
                    @include('errors.list')
                    <div class="row cells1">
                        <div class="cell">
                            <label>Qualification Name</label>
                            <div class="input-control text full-size {{ $errors->has('qualification')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="qualification" value="{{ $qualification->qualification }}">
                            </div>
                        </div>
                        <div class="row cells1">
                            <div class="cell">
                                <button class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                                <button onclick="goBack()" class="button danger"><i class="fa fa-times"></i> Cancel</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div><!--grid-->
                </div><!--example-->
            </div><!--md 7-->
        </div> <!-- /.row -->


@endsection