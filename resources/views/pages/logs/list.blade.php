@extends('layouts.template')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                view <small>Logs</small>
            </h2>
        </div>
     </div>
    <!-- /.row -->
    <div class="row">
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
    <div class="col-md-offset-1 col-md-9  col-sm-offset-1 col-sm-9">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif

                 <div class="CSSTableGenerator" >
                    <table >
                        <tr>
                            <td class="sortable-column">#</td>
                           <td>Username</td>
                            <td>Action</td>
                            <td>Date / Time</td>
                        </tr>
                        @foreach($log as $logs)
                            <tr>
                                <td><span class="red-bullet"> {{( $logs->id ) }}</span></td>
                                <td>{{ $logs->username  }}</td>
                                <td>{{ $logs->action }}</td>
                                <td>{{ $logs->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                {{--{!! $employees->render() !!}--}}
                {!! $log->appends(['season' => Input::get('search') ])->render() !!}

            </div>
        </div>
    </div>
    </div>



@endsection