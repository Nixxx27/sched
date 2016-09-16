@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit
                <small>Rank</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('rank') }}"> Rank Type</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Edit Rank Type
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('method'=>'PATCH','name'=>'rank_edit','id'=>'rank_edit','action' => array('RankController@update', $rank->id) )) !!}
                    @include('errors.list')
                    <div class="row cells1">
                        <div class="cell">
                            <label>Rank Name</label>
                            <div class="input-control text full-size {{ $errors->has('rank')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="rank" value="{{ $rank->rank }}">
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