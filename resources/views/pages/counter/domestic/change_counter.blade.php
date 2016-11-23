



@extends('layouts.template')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Change  <small> Assigned Counter for {{ $code }}</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
     <hr class="bg-red">
    <div class="col-md-5 col-sm-5">
        @include('errors.list')

        {!! Form::open(array('method'=>'GET','name'=>'domestic_counter_edit','id'=>'domestic_counter_edit','url' => array('domestic_counter/save_new_counter') )) !!}
         <table class="table">
             <tr>
                   <td><label for="emp_id">Change Counter of {{ $code }}</label><br>
                      <input type="hidden" readonly name="emp_code" value="{{ $code }}">
                       <input type="hidden" readonly name="date" value="{{ $date }}">
                       <input type="hidden" readonly name="shift" value="{{ $shift }}">
                        <input type="hidden" name="current_counter" value="{{ $current_counter }}">              
                         <h3><small>From <span style="text-decoration: underline">Counter # : {{ $current_counter }}</span> to </small></h3><br>

                       <select id="counter" name="counter" class="input-control select" >
                          <option value="{{ $current_counter}}">Counter # : {{ $current_counter }}</option>
                         @foreach ($counters as $cntr)
                              <option value="{{ $cntr }}">Counter # : {{ $cntr }}</option>
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

