@extends('layouts.template')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Domestic Gates <small>Assignment</small>
            </h2>
        </div>
     </div>
    <!-- /.row -->
    <div class="row">
       <div class=" col-md-4 col-sm-4 col-xs-4 pull-right">
            <form class="form-inline">
                <div class="form-group">
                   <!--  <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
                    </div> -->
                    <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                    	<input type="text" name="search" value="{{ $search }}">
                        <button class="button"><span class="mif-calendar"></span></button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">GO</button>
            </form>
        </div>
    </div>
    <hr class="bg-red">
    <div class="col-md-10 col-sm-offset-1 col-sm-5">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif

                 <div class="CSSTableGenerator" >
                 	<h4 style="text-align:center"><strong>Assigned Employees for {{ $search }}</strong></h4>
                    <table >
                        <tr>
                        	<td class="sortable-column">#</td>
                           	<td>Flight Number</td>
                    		<td>Employee</td>
                        </tr>
                        <?php $x =1; ?>
                        @foreach($dom_gates as $gates)
                            <tr>
                                <td><span class="red-bullet"> {{ $x  }}</span></td>
                                <td><b>{{ $gates->flight_num }}</b> </td>
                                <td>{{ strtoupper($gates->employees->name) }} </td>
                             </tr>
                         <?php $x++; ?>
                        @endforeach
                    </table>
                </div>

            <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                {{--{!! $employees->render() !!}--}}
                {!! $dom_gates->appends(['search' => Input::get('search') ])->render() !!}

            </div>
        </div>
    </div>
    </div>

@endsection

@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });
    </script>
@endsection