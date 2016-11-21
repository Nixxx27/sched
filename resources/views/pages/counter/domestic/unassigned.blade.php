
@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Domestic Counter 
                <small>List of Unassigned Employees</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12"> 
            <button class="button loading-pulse lighten primary" title="Back" onclick="window.location.href = '/sched/domestic_counter'"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
            <hr>
        </div>
        <div class=" col-md-11  col-sm-11">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
             @include('errors.list')
            <div class="example" data-text="">

            <div style="display:none">
         
            {!! Form::open(array('name'=>'unassigned_emp','id'=>'unassigned_emp','url' => 'add_to_counter_unassigned')) !!}
            <table>
                <tr>
                    <td> 
                    <input type="hidden" readonly  name="emp_code" id="emp_code" value="code">
                    <input type="hidden" readonly name="date" value="{{ $date }}" >
                    <input type="hidden" readonly name="schedule" id="schedule">
                    </td>

                </tr>
                <tr>
                    <td> <input type="hidden" readonly name="counter" id="counter"></td>
                </tr>
                <tr>
                    <td><input type="hidden" readonly name="x_shift" id="x_shift">
                     <input type="hidden"  readonly name="shift" id="shift"></td>
                </tr>

            </table>
            {!! Form::close() !!}   
            </div>

                <div class="CSSTableGenerator" >
                    <table >
                        <tr>
                        	<td>#</td>
                        	<td>CODE</td>
                            <td>Employee Name</td>
                            <td>Rank </td>
                            <td>Schedule</td>
                            <td></td>
                        </tr>
                        	<?php $i=1; ?>
							@foreach($unassigned_csa as $available_csa)
					    <tr>
					    	<td>{{ $i }}</td>
					    	<td class="center-txt">{{ $available_csa->code }}</td>
						    <td>{{ strtoupper( $available_csa->name ) }}</td>
                            <td class="center-txt">{{ strtoupper( $available_csa->rank ) }}</td>
                            <td class="center-txt">{{ $available_csa->w_schedule->timein->format('h:i A') }} - {{ $available_csa->w_schedule->timeout->format('h:i A') }}</td>
                       
                            <td>
                                <div id="div_counter{{$i}}" style="display:none;">
                                <input type="text" name="emp_code{{ $i }}"  id="emp_code{{ $i }}" value="{{ strtoupper( $available_csa->code ) }}">
                                <input type="hidden" name="schedule{{ $i }}" id="schedule{{ $i }}" value="{{ $available_csa->winter_sched }}">
                               
                                <select  name="morning_counter{{ $i }}" id="morning_counter{{ $i }}" onChange="fillShift(1,{{ $i }})">
                                    <option value="" >Morning Shift</option>
                                        @foreach($dom_counters_morning as $morning)
                                    <option value="{{ $morning }}">CTR # {{ $morning }}</option>
                                        @endforeach
                                </select>

                                <select  name="afternoon_counter{{ $i }}" id="afternoon_counter{{ $i }}" onChange="fillShift(2,{{ $i }})">
                                    <option value="" >Afternoon Shift</option>
                                        @foreach($dom_counters_afternoon as $afternoon)
                                    <option value="{{ $afternoon }}">CTR # {{ $afternoon }}</option>
                                        @endforeach
                                </select>
                                 <button  onclick="submitNew({{ $i}})" class="btn btn-danger btn-xs"><span style="font-weight: bold" ><i class="fa fa-floppy-o"></i>Save</span></button>
                                </div>
                                
                                <button  onclick="openDivCounter({{ $i}})" class="btn btn-default btn-sm"><span style="font-weight: bold" > Assign to cntr</span></button>
                 
                            </td>
						</tr>
                        <?php $i++; ?>
							@endforeach
                  
					</table>


           	 	</div>
			</div>

@endsection

@section('js')
    <script>
      //  $("#counters").val('aa'); 
        function fillShift(shift,cntr_num)
        {
   
            if (shift == 1)
            {
                $('#afternoon_counter'+cntr_num).val('');
                
                var cntr    =$('#morning_counter'+cntr_num).val();
                var e_code    =$('#emp_code'+cntr_num).val();
                var e_sched    =$('#schedule'+cntr_num).val();
                console.log(e_sched);
                $('#counter').val(cntr);        
                $('#emp_code').val(e_code);  
                $('#schedule').val(e_sched);
                $('#shift').val(1); 
                $('#x_shift').val('Morning'); 
            }else
            {
                $('#morning_counter'+cntr_num).val('');
                
                var cntr    =$('#afternoon_counter'+cntr_num).val();
                var e_code    =$('#emp_code'+cntr_num).val();
                var e_sched    =$('#schedule'+cntr_num).val();
                console.log(e_sched);
                $('#counter').val(cntr);        
                $('#emp_code').val(e_code);  
                $('#schedule').val(e_sched);
                $('#shift').val(2); 
                $('#x_shift').val('Afternoon');     
            }
  
        }

        function openDivCounter(cntr_num)
        {
           $('#div_counter'+cntr_num).fadeToggle();
        
        }

        function submitNew(cntr_num)
        {
           $("#unassigned_emp").submit();
        }

        

    </script>
@endsection