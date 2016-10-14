@extends('layouts.template')
@section('css')
<style type="text/css">
	td{
		text-align:center;
	}
</style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Flights <small> Available for {{ $dt->format('M d Y D') }}</small>
            </h2>
        </div>
     </div>
    <!-- /.row -->
    <div class="row">
    	<div class="col-md-3 col-sm-3">
    		<button class="button loading-pulse lighten primary" title="Back" onclick="window.history.back()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
    	</div>
       <div class=" col-md-4 col-sm-4 col-xs-4 pull-right">
            <form class="form-inline">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">GO</button>
            </form>
        </div>
    </div>
    <hr class="bg-red">
    <div class=" col-md-4 col-sm-3">
        @include('errors.list')
		<div class="CSSTableGenerator" >
		<h4 style="text-align:center"><strong>Available Flights</strong></h4>
        	<table>
        		<tr>
                    <td class="sortable-column">#</td>
                    <td>Flight Number</td>
                    <td></td>
                 </tr>
				<?php $i =1; ?>
        		@foreach ( $daily_flight as $d_f)
			{!! Form::open(array('name'=>'global_settings','id'=>'global_settings','url' => 'gates/save_setup')) !!}
				<tr>
					<td>{{ $i }}</td>
					<td><b>{{ $d_f->flight_num }}</b> </td>
					<input type="hidden" name="date" value="{{ $selected_date }} ">
  					<input type="hidden" name="schedule" value="{{ $selected_sched }} ">
  					<input type="hidden" name="dom_gate_level_1" value="{{ $dom_gate_level_1 }} ">
  					<input type="hidden" name="dom_gate_level_2" value="{{ $dom_gate_level_2 }} ">
  					<input type="hidden" name="dom_gate_level_3" value="{{ $dom_gate_level_3 }} ">
  					<input type="hidden" name="flight_num" value="{{ $d_f->flight_num}}">
  					<td style="text-align:center"><button type="submit" onclick="return confirm('Proceed assigning Employees?')" class="btn btn-success btn-md">GO</button></td>
				</tr>
			{!! Form::close() !!}
				<?php $i++; ?>
        		@endforeach
        	</table>
        </div>
	</div>


	<div class="col-md-offset-1 col-md-6 col-sm-offset-1 col-sm-3">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif

        <div class="CSSTableGenerator" >
        	<h4 style="text-align:center"><strong>Assigned Employees</strong></h4>
        	<table>
        		<tr>
                    <td class="sortable-column">#</td>
                    <td>Flight Number</td>
                    <td>Employee</td>
                </tr>
				<?php $x =1; ?>
        		@foreach ( $return_assigned_emp as $emp_assigned)
			{!! Form::open(array('name'=>'global_settings','id'=>'global_settings','url' => 'gates/save_setup')) !!}
				<tr>
					<td>{{ $x }}</td>
					<td><b>{{ $emp_assigned->flight_num }}</b> </td>
					<td  style="text-align:center">{{ strtoupper($emp_assigned->employees->name) }} </td>
				</tr>
			{!! Form::close() !!}
				<?php $x++; ?>
        		@endforeach
        	</table>
        </div>
	</div>




@endsection