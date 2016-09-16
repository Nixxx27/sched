@extends('layouts.template')


@section('content')

    <div id="bgcolor">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Counter <small>Lists</small>
                </h2>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class=" col-md-8">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                    </div>
                @endif
                {{--{!! Form::open(array('method'=>'PATCH','name'=>'counter_list_edit','id'=>'counter_list_edit','action' => array('CounterListController@update', $season->id) )) !!}--}}

                    {{--@foreach( $dom_csa as $dom)--}}
                        {{--{{ $dom->counter }}--}}
                    {{--@endforeach--}}
                <table class="table striped hovered cell-hovered border bordered">
                    <thead>
                    <tr>
                        <td>Type</td>
                        <td style="text-align:center">Counter numbers</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $counter_list as $counter)
                    <tr>
                        <td>{{ ucwords( $counter->flight_type ) . " " . strtoupper( $counter->type ) }}</td>
                        <td class="bold">{{ $counter->counter }}</td>
                        <td>

                            {!! Form::open(['method'=>'GET', 'action' => ['CounterListController@edit', $counter->id]]) !!}
                            <button class="btn btn-primary btn-sm" ><span style="font-weight: bold"><i class="fa fa-pencil"></i> </span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@endsection
