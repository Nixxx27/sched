@extends('layouts.template')

@section('css')
    <style>
        #main_table_demo th{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <img src="{{ url('/public/images/pc1.gif') }}"> Domestic Counter <small></small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <a href='domestic_counter/create'>
                <button class="button loading-pulse lighten danger" title="Assign Personnel to counter">
                    <span class="mif-plus"></span>
                </button>
            </a>
        </div>
       <div class=" col-md-4 col-sm-4 col-xs-4 pull-right">
            <form class="form-inline" action="domestic_counter" method="GET" name="counter_calendar" id="counter_calendar">
                <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                    <input type="text" name="date" value="{{ $dt }}">
                    <button class="button"><span class="mif-calendar"></span></button>
                </div>
                <button class="button loading-pulse lighten primary">GO</button>
            </form>
        </div>
    </div>
    <hr class="bg-red">
    <div class="col-md-6 col-sm-6">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif
            @include('errors.list')

            <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <td colspan="4" style="text-align: center"><h4><strong> Employees Assigned for {{ $dt }} </strong></h4> </td>
                            </tr>
                            <tr>
                                <td>Counter #</td>
                                <td>Employee Name</td>
                                <td>Shift </td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($count == 0)
                                <tr>
                                    <td colspan="4" style="text-align: center;"><h5><strong> No Assigned Personnel </strong></h5></td>

                                </tr>
                            @else
                                @foreach($dom_counter as $counter)
                                    <tr>
                                        <td style="text-align:center"><i class="fa fa-desktop fa2x" aria-hidden="true"></i> <span style="font-weight:bold;font-size:20px">{{ $counter->counter  }}</span></td>
                                        <td >{{ $counter->emp_id }}</td>

                                            @if( $counter->shift == 1)
                                            <td style="text-align:center"> morning <img src="{{ url('public/images/morning.png') }}" width="20px"></td>
                                            @else
                                            <td style="text-align:center">   afternoon  <img src="{{ url('public/images/afternoon.png') }}" width="20px"></td>
                                            @endif

                                        <td style="text-align:center">
                                            {!! Form::open(['method'=>'GET', 'action' => ['DomesticCounter@edit', $counter->id]]) !!}
                                            <button class="btn btn-primary btn-sm" ><span style="font-weight: bold"><i class="fa fa-pencil"></i> </span></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
             </div>

        <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
            {{--{!! $dom_counter->appends(['season' => Input::get('search') ])->render() !!}--}}

        </div>
    </div>
    </div>
    </div>

@endsection

@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });
    </script>
@endsection