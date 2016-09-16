@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Level
                <small>{{ $level_id}}</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{url('level')}}">Levels</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> view level {{ $level_id }} area of Assignment
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

   <div class="row">
        <div class="col-md-12 col-sm-12">
        <button class="button loading-pulse lighten success" title="Back" onclick="window.history.back()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
            <a href='qualification/create'>
            <button class="button primary loading-pulse" title="Add Rank"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </a>
            <hr>
        </div>
        <div class=" col-md-8  col-sm-8">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            <div class="example" data-text="">
                <div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>Area Of Assignment</td>
                        <td colspan="2"></td>
                    </tr>
                    @foreach ( $level as $l)
                        <tr>
                            <td>{{ ucwords( $l->area) }}</td>   
                            <td style="text-align:center">
                                {!! Form::open(['method'=>'GET', 'action' => ['LevelController@edit', $l->id]]) !!}
                                <button class="btn btn-default btn-sm" title="Edit {{ $l->area }}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                {!! Form::close() !!}
                            </td>
                             <td style="text-align:center">
                                {!! Form::open(['method'=>'DELETE', 'action' => ['LevelController@destroy', $l->id]]) !!}
                                <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $l->area }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                 {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $level->render() !!}
                </div>
            </div>
    </div>

@endsection


