@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Reliever Type
                <small>view all</small>
            </h2>
            {{--<ol class="breadcrumb">--}}
                {{--<li>--}}
                    {{--<i class="fa fa-dashboard"></i>  <a href="{{ $project_name }}/home"">Dashboard</a>--}}
                {{--</li>--}}
                {{--<li class="active">--}}
                    {{--<i class="fa fa-bookmark"></i> Rank Type--}}
                {{--</li>--}}
            {{--</ol>--}}
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href='reliever/create'>
            <button class="button primary loading-pulse" title="Add Rank"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </a>
            <hr>
        </div>
        <div class=" col-md-10  col-sm-10">
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
                            <td class="sortable-column">#</td>
                            <td>Employee Name</td>
                            <td>Reliever On (Date)</td>
                            <td colspan="2"></td>
                        </tr>
                        @foreach($reliever as $relievers )
                            <tr>
                                <td>{{( $relievers->id ) }}</td>
                                <td>{{ strtoupper( $relievers->name ) }}</td>
                                <td>{{  $relievers->date->format('Y-m-d D' ) }}</td>
                                <td style="text-align:center">
                                    {!! Form::open(['method'=>'GET', 'action' => ['RelieverController@edit', $relievers->id]]) !!}
                                    <button class="btn btn-default btn-sm"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                    {!! Form::close() !!}
                                </td>
                                <td style="text-align:center">
                                    {!! Form::open(['method'=>'DELETE', 'action' => ['RelieverController@destroy', $relievers->id]]) !!}
                                    <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $relievers->name }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
            </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $reliever->render() !!}
                </div>



        </div>


@endsection