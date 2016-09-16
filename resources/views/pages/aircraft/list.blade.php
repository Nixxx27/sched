@extends('layouts.template')
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Aircraft
                <small>Lists</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href='aircraft/create'>
            <button class="button primary loading-pulse" title="Add Rank"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </a>
            <hr>
        </div>
        <div class=" col-md-4  col-sm-4">
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
                        <td>#</td>
                        <td>Aircraft</td>
                        <td>Capacity</td>
                        <td colspan="2"></td>
                    </tr>
                    @foreach ( $aircraft as $aircrafts)
                        <tr>
                            <td>{{ $aircrafts->id }}</td>
                            <td>{{ $aircrafts->type }}</td>   
                            <td>{{ $aircrafts->capacity }}</td>
                            <td style="text-align:center">
                                {!! Form::open(['method'=>'GET', 'action' => ['AircraftController@edit', $aircrafts->id]]) !!}
                                <button class="btn btn-default btn-sm" title="Edit {{ $aircrafts->qualification }}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                {!! Form::close() !!}
                            </td>
                             <td style="text-align:center">
                                {!! Form::open(['method'=>'DELETE', 'action' => ['AircraftController@destroy', $aircrafts->id]]) !!}
                                <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $aircrafts->type }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                 {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $aircraft->render() !!}
                </div>
            </div>


@endsection