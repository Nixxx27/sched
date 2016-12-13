<style type="text/css">
	
	  /* Print styles */
@media print {
    .nottoprint {
      display: none;
    }
}

.t-print{
	font-size:90%;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 6px !important;
    line-height: 1.3 !important;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ url('/public/_style/css/bootstrap.min.css') }}">




<div class="container ">
	<div class="row ">
		<div class="col-md-offset-1 col-md-9">

			<div style="margin-top:20px;margin-bottom:10px" class="nottoprint">
				<button onClick="goBack()" class=" btn btn-success btn-md">Back</button>
				<button onClick="window.print()" class=" btn btn-primary btn-md">Print</button>
			</div>
		
			<table class="table table-bordered table-hover table-striped t-print">
				<thead>
               	    <tr>
                        <td colspan="5" style="text-align: center"><h4><strong> Counter Assignment for {{ $dt }} </strong></h4> </td>
                    </tr>
                    <tr style="text-align:center;font-weight: bold">
                                <td>Counter #</td>
                                <td>Employee Name</td>
                                <td>Code</td>
                                <td>Shift </td>
                            </tr>
                            </thead>
                            <tbody>

                        @foreach($dom_counter as $counter)
                            <tr>
                                   <td style="text-align:center"><i class="fa fa-desktop fa2x" aria-hidden="true"></i> <span style="font-weight:bold;font-size:16px">{{ $counter->counter  }}</span></td>
                            <td >{{ strtoupper( $counter->emp_id )}}</td>
                            <td style="text-align:center;font-weight:bold;">
                                              {{ strtoupper( $counter->emp_code )}}
                            </td>

                                            @if( $counter->shift == 1)
                                            <td style="text-align:center"> morning <img src="{{ url('public/images/morning.png') }}" width="20px"></td>
                                            @else
                                            <td style="text-align:center">   afternoon  <img src="{{ url('public/images/afternoon.png') }}" width="20px"></td>
                                            @endif

                                        
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
		</div><!--div 12 -->
	</div><!--div row-->
	<div class="row" style="margin-top:50px">
		<div class="col-md-offset-2 col-md-4">
			<label>Prepared by:</label>
             ______________________
		</div>

		<div class="col-md-offset-1 col-md-4 pull-right">
			<label>Approved by:</label>
             ______________________
			
		</div>

	</div>
	<div style="margin-top:20px;margin-bottom:10px" class="nottoprint">
				<button onClick="goBack()" class=" btn btn-success btn-md">Back</button>
				<button onClick="window.print()" class=" btn btn-primary btn-md">Print</button>
			</div>
</div>



<script>
    function goBack() {
	       window.history.back()
    }
</script>