@extends('layouts.template')


@section('css')
    <style>
        #myTable td{
            font-size:14px;
        }
    </style>
@endsection
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Domestic Counter
                <small>Schedule</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Schedule
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4><span class="mif-calendar"></span> {{ date('M d, Y D') }}</h4>
        </div>
        <div class="col-md-6 col-sm-6 col-md-offset-1 col-sm-offset-1">
            <div class="CSSTableGenerator" >
                <table id="myTable">
                    <tr>
                        <td>Counter #</td>
                        <td>Employee</td>
                        <td>Code</td>
                        <td>Shift</td>
                        <td></td>
                    </tr>
                    @foreach ($dom_cntr as $dom_cntr_employee)
                        <tr>
                            <td><span class="mif-display mif-2x mif-ani-slow mif-ani-pass "></span></span> {{ $dom_cntr_employee->counter }}</span></td>
                            <td>{{ ucwords($dom_cntr_employee->name) }}</td>
                            <td>{{ strtoupper($dom_cntr_employee->code) }}</td>
                            <td>{{ strtoupper($dom_cntr_employee->shift) }}</td>
                            <td><img src="public/images/edit.png" title="edit counter # {{$dom_cntr_employee->counter}} " class="cursorpointer" width="28px"></td>
                        </tr>
                    @endforeach

                </table>
            </div><button class="button primary loading-pulse" onclick="simulate()"> Simulate Schedule <i class="fa fa-file-text-o"></i></button>

        </div>
    </div>


    <ul>

    </ul>

@endsection

@section('js')

    <script>
        function simulate(){
            window.location.href = "simulate";
        }
    </script>
    @endsection