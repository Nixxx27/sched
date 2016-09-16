@extends('layouts.template')
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Daily Flight
                <small>Lists</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href='daily_flight/create'>
            <button class="button primary loading-pulse" title="Add Rank"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </a>
            <hr>
        </div>
        <div class=" col-md-4  col-sm-4">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            <div class="example" data-text="">
                <form>
                    <select name="set_day" class="form-control-static" onChange="this.form.submit()">
                        <option>-- Select Day --</option>
                        <option value=0>Sunday</option>
                        <option value=1>Monday</option>
                        <option value=2>Tuesday</option>
                        <option value=3>Wednesday</option>
                        <option value=4>Thursday</option>
                        <option value=5>Friday</option>
                        <option value=6>Saturday</option>
                    </select>
                </form>
                <hr>
                <div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>#</td>
                        <td>Day</td>
                        <td>Flight Num</td>
                        <td colspan="2"></td>
                    </tr>
                    @foreach ( $daily_flight as $d_f)
                    <?php
                        //convert daily num to day name 1 = "Sunday"
                       switch ($d_f->day_num) 
                        {
                            case 0 :
                                $day_name = "Sunday";
                                break;
                            case 1 :
                                $day_name = "Monday";
                                break;
                            case 2 :
                                $day_name = "Tuesday";
                                break;
                            case 3 :
                                $day_name = "Wednesday";
                                break;
                            case 4 :
                                $day_name = "Thursday";
                                break;
                            case 5 :
                                $day_name = "Friday";
                                break;
                            case 6   :
                                $day_name = "Saturday";
                                break;
                           default:
                                $day_name = "";
                            }   
                    ?>
                        <tr>
                            <td>{{ $d_f->id }}</td>
                            <td>{{ ucwords( $day_name) }}</td>   
                            <td>{{ ucwords( $d_f->flight_num) }}</td>  
                            <td style="text-align:center">
                                {!! Form::open(['method'=>'GET', 'action' => ['DailyFlightController@edit', $d_f->id]]) !!}
                                <button class="btn btn-default btn-sm" title="Edit {{ $d_f->flight_num }}"><span style="font-weight: bold"><i class="fa fa-pencil"></i> Edit</span></button>
                                {!! Form::close() !!}
                            </td>
                             <td style="text-align:center">
                                {!! Form::open(['method'=>'DELETE', 'action' => ['DailyFlightController@destroy', $d_f->id]]) !!}
                                <button class="btn btn-default btn-sm" onclick="return confirm('Are you sure you want to delete this record?')" title="Delete {{ $d_f->flight_num }}"><span style="font-weight: bold"><i class="fa fa-times"></i> Delete</span></button>
                                 {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
                </div>
                <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                    {!! $daily_flight->render() !!}
                </div>
            </div>


@endsection