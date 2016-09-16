@extends('layouts.template')
@section('css')
    <style type="text/css">
        td{ padding-right:10px; }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <img src="{{ url('/public/images/pc1.gif') }}"> Domestic Gates <small>Settings</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class=" col-md-6 col-sm-6 col-xs-4">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            @include('errors.list')
             {!! Form::open(array('name'=>'global_settings','id'=>'global_settings','url' => 'dom_gates_settings')) !!}
            <div id="settings" style="display:none;background-color:#f7f7f7">
               <table>
                    <tr>
                        <td>
                            <i><small>Required Level:</small></i>
                        </td>

                         <td>
                        <?php $a =($dom_gate_level_1->settings == 1)? 'checked' : '' ?>
                        Level 1 <input type="checkbox" {{ $a}} value="true_1" name="dom_gate_level_1">
                        </td>

                        <td>
                        <?php $b =($dom_gate_level_2->settings == 1)? 'checked' : '' ?>
                        Level 2 <input type="checkbox" {{ $b }} value="true_2" name="dom_gate_level_2">
                        </td>

                        <td>
                        <?php $c =($dom_gate_level_3->settings == 1)? 'checked' : '' ?>
                        Level 3 <input type="checkbox" {{ $c }} value="true_3" name="dom_gate_level_3">
                        </td>
                    </tr>
                    <tr>
                        <td  style="padding-top:20px">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
            <button type="button" id="down" onclick="isDown()" class="btn btn-default pull-right" style="margin-bottom:10px" title="more settings...">
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
            </button>

             <button type="button" id="up" onclick="isUp()" class="btn btn-default pull-right" style="margin-bottom:10px;display:none" title="more settings...">
                    <i class="fa fa-chevron-circle-up" aria-hidden="true" ></i>
            </button>

             {!! Form::close() !!}

            {!! Form::open(array('url' => 'gates/view_gates_flight','method'=>'get')) !!}
            <table class="table">
                <tbody>
                <tr>
                    <td> Select Employees Schedule:</td>
                    <td>
                        <select id="schedule" name="schedule" class="input-control select">
                            <option value=""></option>
                            @foreach( $schedule as $sched)
                                <option value="{{ $sched->id }}">{{ $sched->sched_num }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="dom_gate_level_1" size="3" value={{ $dom_gate_level_1->settings }}>
                        <input type="hidden" name="dom_gate_level_2" size="3" value={{ $dom_gate_level_2->settings }}>
                        <input type="hidden" name="dom_gate_level_3" size="3" value={{ $dom_gate_level_3->settings }}>
                    
                    </td>
                </tr>
                <tr>
                    <td> Select Date:</td>
                    <td>
                        <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                            <input type="text" name="date">
                            <button class="button"><span class="mif-calendar"></span></button>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="button primary loading-pulse" onClick="return confirm('Are you sure you want to proceed?')">Save</button>
                        {!! $cancel_button !!}
                    </td>
                </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });

        function isDown()
        {
            $("#settings").slideToggle();
            $("#down").hide();
            $("#up").show();
        }

        function isUp()
        {
            $("#settings").slideToggle();
            $("#down").show();
            $("#up").hide();
        }
    </script>
@endsection