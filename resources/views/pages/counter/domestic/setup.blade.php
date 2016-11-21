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
                Set Up <small>Domestic Counter</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">

        <div class=" col-md-8 col-sm-8">
            <?php
                $n=1;
                foreach( $sup as $supervisor)
                {
                    $sup_name_array[ $n ]= $supervisor->name;
                    $sup_code_array[ $n ]= $supervisor->code;
                    $n++;
                }
            ?>

                <?php
                $j=1;
                foreach( $csa as $csa1)
                {
                    $csa_name_array[ $j ]= $csa1->name;
                    $csa_code_array[ $j ]= $csa1->code;
                    $j++;
                }
                ?>

                <?php
                $k=1;
                foreach( $senior as $senior1)
                {
                    $senior_name_array[ $k ]= $senior1->name;
                    $senior_code_array[ $k ]= $senior1->code;
                    $k++;
                }
                ?>

                <?php
                $b=1;
                foreach( $mabuhay as $mabuhay1)
                {
                    $mabuhay_name_array[ $b ]= $mabuhay1->name;
                    $mabuhay_code_array[ $b ]= $mabuhay1->code;
                    $b++;
                }
                ?>


                {!! Form::open(array('url' => 'domestic_counter/counter_save')) !!}
                <input type="hidden" name="schedule" value="{{ $schedule }}">
                <input type="hidden" name="schedule_1" value="{{ $schedule_1 }}">
                <input type="hidden" name="schedule_2" value="{{ $schedule_2 }}">
                <input type="hidden" name="schedule_3" value="{{ $schedule_3 }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="shift" value="{{ $shift }}">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Counter #</td>
                            <td>Name</td>
                            <td>Emp Code</td>
                        </tr>
                    </thead>
                    <tbody>
                    <!--SUPERVISOR COUNTER -->
                    <tr>
                        <td colspan="3" style="text-align:center;font-size:20px;font-weight:bold">Supervisors Counter</td>
                    </tr>
                    <?php $z=1 //initiate number or table rows and column ?>
                        @foreach ( $available_counter_for_sup as $sup_counter )

                            <tr>
                                 <td>{{ $sup_counter }}  <input type="hidden" name="counter[]" value="{{ $sup_counter }}"></td>
                                <td>  {{ strtoupper( $sup_name_array[ $z ] ) }}  <input type="hidden" name="emp_id[]" value="{{ $sup_name_array[ $z ] }}"></td>
                                <td>{{ strtoupper( $sup_code_array[ $z ] ) }}
                                    <input type="hidden" name="code[]" value="{{ $sup_code_array[ $z ] }}">
                                 </td>

                            </tr>
                    <?php $z++ ?>
                         @endforeach

                    <!--SENIOR COUNTER -->
                    <tr>
                        <td colspan="3" style="text-align:center;font-size:20px;font-weight:bold">CSA Senior Counter</td>
                    </tr>
                    <?php $h=1 //initiate number or table rows and column ?>
                        @foreach ( $available_counter_for_senior as $senior_counter )

                            <tr>
                                 <td>{{ $senior_counter }}  <input type="hidden" name="counter[]" value="{{ $senior_counter }}"></td>
                                <td>  {{ strtoupper( $senior_name_array[ $h ] )}} <input type="hidden" name="emp_id[]" value="{{ $senior_name_array[ $h ] }}"></td>
                                <td>{{ strtoupper( $senior_code_array[ $h ] )}}
                                    <input type="hidden" name="code[]" value="{{ $senior_code_array[ $h ] }}">
                                </td>
                            </tr>
                    <?php $h++ ?>
                         @endforeach        


                    <!-- CSA COUNTER -->
                            <tr>
                                <td colspan="3" style="text-align:center;font-size:20px;font-weight:bold">CSA Counter</td>
                            </tr>

                            <?php $c=1 //initiate number or table rows and column ?>
                            @foreach ( $available_counter_for_csa as $csa_counter )
                                <tr>
                                    <td>{{ $csa_counter }}  <input type="hidden" name="counter[]" value="{{ $csa_counter }}"></td>
                                    <td>  {{ strtoupper( $csa_name_array[ $c ]) }} <input type="hidden" name="emp_id[]" value="{{ $csa_name_array[ $c ] }}"></td>
                                    <td>{{ strtoupper( $csa_code_array[ $c ]) }} 
                                        <input type="hidden" name="code[]" value="{{ $csa_code_array[ $c ] }}">
                                    </td>
                                </tr>
                                <?php $c++ ?>
                            @endforeach


                    <!--MABUHAY LOUNGE COUNTER -->
                    <tr>
                        <td colspan="3" style="text-align:center;font-size:20px;font-weight:bold">Business Class Counter</td>
                    </tr>
                    <?php $nn=1 //initiate number or table rows and column ?>
                        @foreach ( $available_counter_for_mabuhay as $mabuhay_counter )

                            <tr>
                                 <td>{{ $mabuhay_counter }}  <input type="hidden" name="counter[]" value="{{ $mabuhay_counter }}"></td>
                                <td>  {{ strtoupper( $mabuhay_name_array[ $nn ] )}} <input type="hidden" name="emp_id[]" value="{{ $mabuhay_name_array[ $nn ] }}"></td>
                                <td>{{ strtoupper( $mabuhay_code_array[ $nn ] )}}
                                    <input type="hidden" name="code[]" value="{{ $mabuhay_code_array[ $nn ] }}">
                                </td>
                            </tr>
                    <?php $nn++ ?>
                         @endforeach 
                        <tr>
                            <td colspan="2"><button class="button primary loading-pulse" onclick="return confirm('Are you sure you want to save assigned personnel?')">Save</button>
                            </td>

                        </tr>



                    </tbody>
                </table>

               
                {!! Form::close() !!}
        </div>
    </div>

@endsection
