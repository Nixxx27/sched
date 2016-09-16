@extends('layouts.template')
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Qualification
                <small>Lists</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href='qualification/create'>
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
                        <td>Qualifications</td>
                        <td colspan="2"></td>
                    </tr>
                    @foreach ( $qualifications as $q)
                        <tr>
                            <td>{{ $q->id }}</td>
                            <td>{{ ucwords( $q->qualification) }}</td>   
                            <td style="text-align:center">
                                {!! Form::open(['method'=>'GET', 'action' => ['QualificationController@edit', $q->id]]) !!}
                                <button class="btn btn-default btn-sm" title="Edit {{ $q->qualification }}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                {!! Form::close() !!}
                            </td>
                             <td style="text-align:center">
                                {!! Form::open(['method'=>'DELETE', 'action' => ['QualificationController@destroy', $q->id]]) !!}
                                <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $q->qualification }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                 {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $qualifications->render() !!}
                </div>
            </div>


@endsection