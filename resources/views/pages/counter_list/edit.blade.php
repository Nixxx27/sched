@extends('layouts.template')


@section('content')

    <div id="bgcolor">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Edit Counter <small>Lists</small>
                </h2>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class=" col-md-8">
                <div class="example" data-text="">
                <div class="grid">
                    @include('errors.list')

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
                    {!! Form::open(array('method'=>'PATCH','name'=>'counter_list_edit','id'=>'counter_list_edit','action' => array('CounterListController@update', $counter_list->id) )) !!}

                    <table class="table striped hovered cell-hovered border bordered">
                    <thead>
                    <tr>
                        <td>Type</td>
                        <td style="text-align:center">Counter numbers</td>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ ucwords( $counter_list->flight_type ) . " " . strtoupper( $counter_list->type ) }}
                                <input type="hidden" name="flight_name" value="{{ ucwords( $counter_list->flight_type ) . ' ' . strtoupper( $counter_list->type ) }}"
                            </td>
                            <td><input type="text" name="counter" class="input-control text full-size {{ $errors->has('counter')?  ' error block-shadow-danger' : '' }}" value="{{ $counter_list->counter }}">
                            <h5><small>Separate each Counters by a Comma. e.g ( 1, 2, 3)</small></h5></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><button class="button loading-pulse lighten primary">Update Counter</button></td>
                        </tr>

                    </tbody>
                </table>
                {!! Form::close() !!}
                    <div>
                <div>
            </div>
        </div>
    </div>
@endsection
