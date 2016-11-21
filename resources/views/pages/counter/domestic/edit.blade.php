@extends('layouts.template')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Change Personnel <small> for Counter {{ $dom_counter->counter }}</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
     <hr class="bg-red">
    <div class="col-md-5 col-sm-5">
        @include('errors.list')
        <h3><small>From <span style="text-decoration: underline">{{ strtoupper($dom_counter->emp_code) }}</span> to <span id="new_csa" style="text-decoration: underline"></span></small></h3><br>
        {!! Form::open(array('method'=>'PATCH','name'=>'domestic_counter_edit','id'=>'domestic_counter_edit','action' => array('DomesticCounter@update', $dom_counter->id) )) !!}
         <table class="table">
             <tr>
                   <td><label for="emp_id">Employees</label><br>
                      <input type="hidden" name="curr_emp" value="{{ $dom_counter->emp_code }}">
                       <input type="hidden" name="log_counter" value="{{ $dom_counter->counter }}">
                       <input type="hidden" name="assign_date" value="{{ $dom_counter->date->format('Y-m-d') }}">
                      
       <!--                <select id="emp_id" name="emp_id" class="input-control select" onChange="new_name()">
                          <option value="{{ $dom_counter->emp_id }}">{{ ucwords($dom_counter->emp_id) }}</option>
                          @foreach( $employees as $employee)
                              <option value="{{ $employee->name }}">{{ strtoupper($employee->name) }}</option>
                          @endforeach
                      </select> -->


                       <select id="emp_id" name="emp_code" class="input-control select" onChange="new_name()">
                          <option value="{{ $dom_counter->emp_code }}">{{ ucwords($dom_counter->emp_code) }}</option>
                          @foreach( $unassigned_csa as $unassigned)
                              <option value="{{ $unassigned->code }}">{{ strtoupper($unassigned->code) }}</option>
                          @endforeach
                      </select>
                  </td>
              </tr>
              <tr>
                <td><label for="remarks">remarks</label><br>
                <textarea name="remarks" rows='10' cols="50" id="remarks"></textarea></td>
              </tr>
         </table>
        <br>
        <button class="button loading-pulse lighten primary" onclick="return confirm('Are you sure you want to save changes? ')"> <span class="mif-checkmark"></span> Update</button>
        {!! $cancel_button !!}
        {!! Form::close() !!}
    </div>


@endsection

@section('js')
    <script>
        function new_name(){
            var name = $('#emp_id').val().toUpperCase();
            $('#new_csa').text(name + " ?");
        }

    </script>
@endsection