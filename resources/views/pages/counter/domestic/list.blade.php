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
       <div class=" col-md-5 col-sm-5 col-xs-4 pull-right">
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
    <div class="col-md-12 col-sm-12">
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
                                        <td >{{ strtoupper( $counter->emp_id )}}<!--this is emp name-->
                                            
                                            @if (!empty( $counter->remarks ))
                                                <sup  data-toggle="modal" data-target="#{{$counter->id}}-modal" style="background-color:#5cb85c;color:#fff;display:inline;padding:.2em .6em .3em;font-size:75%;line-height: 1;text-align:center;border-radius: .25em;cursor:pointer">updated</sup>
                                            @endif
                                        </td>

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

                       <!--  <table>
                        @foreach($unassigned_emp as $u_emp)

                            <tr>
                                <td>{{ $u_emp->emp_id }}</td>
                                
                            </tr>
                        @endforeach
                        </table> -->


<!-- Modal -->
@foreach($dom_counter as $counter)
    @if (!empty( $counter->remarks ))
    <div class="modal fade" id="{{$counter->id}}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Reason for Employee changed</h4>
          </div>
          <div class="modal-body">
                <textarea rows="15" cols="67" disabled="" style="font-size:80%;background-color:transparent">
                    {{ $counter->remarks }}
                </textarea>
                
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    @endif
@endforeach
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
    function view_update_reason($reason){
                alert($reason);
            }

    </script>
@endsection



