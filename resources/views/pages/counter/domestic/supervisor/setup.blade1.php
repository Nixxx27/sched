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
        <div class="col-md-12">
            <button class="btn btn-primary">Randomize </button>
        </div>
        <hr>
        <div class=" col-md-5 col-sm-5">

            <?php
            foreach( $sup as $supervisor)
            {
                $supervisor_counter_list[ $count_start ];
                $sup_name_array[  $count_start ]= $supervisor->name;
                $count_start++;
            }
            ?>
            <br>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                <li role="presentation"><a href="#carousel1" aria-controls="carousel1" role="tab" data-toggle="tab">Carousel 1</a></li>
                <li role="presentation"><a href="#carousel2" aria-controls="carousel2" role="tab" data-toggle="tab">Carousel 2</a></li>
                <li role="presentation"><a href="#carousel3" aria-controls="carousel3" role="tab" data-toggle="tab">Carousel 3</a></li>
                <li role="presentation"><a href="#carousel4" aria-controls="carousel4" role="tab" data-toggle="tab">Carousel 4</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Counter #</th>
                                    <th>Employee Name</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr><!-- Counter 1 Supervisor -->
                                    @if( isset( $supervisor_counter_list[ 1 ] ) )
                                        <td>{{ $supervisor_counter_list[ 1 ] }}</td>
                                        <td>{{ $sup_name_array[ 1 ] }} </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr><!-- Counter 1 Supervisor -->


                                <tr><!-- Counter 21 Supervisor -->
                                    @if( isset( $supervisor_counter_list[ 2 ] ) )
                                        <td>{{ $supervisor_counter_list[ 2 ] }}</td>
                                        <td>{{ $sup_name_array[ 2 ] }} </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr><!-- Counter 21 Supervisor -->

                                <tr><!-- Counter 22 Supervisor -->
                                    @if( isset( $supervisor_counter_list[ 3 ] ) )
                                        <td>{{ $supervisor_counter_list[ 3 ] }}</td>
                                        <td>{{ $sup_name_array[ 3 ] }} </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr><!-- Counter 22 Supervisor -->


                                <tr><!-- Counter 41 Supervisor -->
                                    @if( isset( $supervisor_counter_list[ 4 ] ) )
                                        <td>{{ $supervisor_counter_list[ 4 ] }}</td>
                                        <td>{{ $sup_name_array[ 4 ] }} </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr><!-- Counter 22 Supervisor -->

                            </tbody>
                        </table>
                    </div>
                </div><!--Home-->


                <!-- PER CAROUSEL -->
                <div role="tabpanel" class="tab-pane" id="carousel1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Counter #</th>
                                    <th>Employee Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @if( isset( $supervisor_counter_list[ 1 ] ) )
                                        <td>{{ $supervisor_counter_list[ 1 ] }}</td>
                                        <td>
                                            <select class="form-control">
                                                <option>{{ ucwords( $sup_name_array[ 1 ] )  }}</option>
                                                <option>emp 1</option>
                                                <option>emp 2</option>
                                                <option>emp 3</option>
                                            </select>
                                        </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                </tbody>
                        </table>
                    </div>
                </div><!--carousel 1-->

                <div role="tabpanel" class="tab-pane" id="carousel2">
                    @if( isset( $supervisor_counter_list[ 2 ] ) )
                        <label> {{ $supervisor_counter_list[ 2 ] }}</label>
                        <input type="text" name="ab" value="{{ $sup_name_array[ 2 ] }}" class="form-control-static">
                    @endif
                </div><!--carousel 2-->

                <div role="tabpanel" class="tab-pane" id="carousel3">
                    @if( isset( $supervisor_counter_list[3] ) )
                        <label> {{ $supervisor_counter_list[ 3 ] }}</label>
                        <input type="text" name="ab" value="{{ $sup_name_array[ 3 ] }}" class="form-control-static">
                    @endif
                </div><!--carousel 3-->


                <div role="tabpanel" class="tab-pane" id="carousel4">

                    @if( isset( $supervisor_counter_list[4] ) )
                        <label> {{ $supervisor_counter_list[ 4 ] }}</label>
                        <input type="text" name="ab" value="{{ $sup_name_array[ 4 ] }}" class="form-control-static">
                    @endif
                </div><!--carousel 4-->
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        var x =
                $('#ctr1-hidden').val('')
    </script>
@endsection