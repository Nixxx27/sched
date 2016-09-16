@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Edit </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('level/' . $level->level ) }}"> Level {{ $level->level }}</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Edit area of assignment
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'level_edit','id'=>'level_edit','action' => array('LevelController@update', $level->id) )) !!}
                    @include('errors.list')
                    <div class="row cells1">
                        <div class="cell">
                            <label>Area of Assignment</label>
                            <div class="input-control text full-size {{ $errors->has('area')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="area" value="{{ $level->area }}">
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