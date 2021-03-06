@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                New
                <small>Rank</small>
            </h2>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('rank')}}"> Rank Type</a>
                </li>
                <li class="active">
                    <i class="fa fa-bookmark"></i> Add Rank Type
                </li>
            </ol>
        </div>

    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-5">
            <div class="example" data-text="">
                <div class="grid">
                    {!! Form::open(array('name'=>'add_rank','id'=>'add_rank','action'=>'RankController@store')) !!}
                    @include('errors.list')
                    <div class="row cells1">
                        <div class="cell">
                            <label>Rank Name</label>
                            <div class="input-control text full-size {{ $errors->has('rank')?  ' error block-shadow-danger' : '' }}">
                                <input type="text" name="rank" value="{{old('rank')}}">
                            </div>
                        </div>
                    <div class="row cells1">
                        <div class="cell">
                            <button class="button primary  block-shadow-primary loading-pulse"><i class="fa fa-floppy-o"></i> Save</button>
                            {!! $cancel_button !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!--grid-->

            </div><!--example-->
        </div><!--md 7-->
    </div> <!-- /.row -->


@endsection