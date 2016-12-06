@extends('layouts.template')

@section('css')
    <style>
         th{
            text-align: center;

          }
    </style>
    @endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6 col-sm-4 col-xs-4">
            <h2 class="page-header">
               Resigned Employee <small>Lists</small>
            </h2>
        </div>

        <div class=" col-md-4 col-sm-8 col-xs-8 pull-right">
            <br>
            <form class="form-inline">
                  <div class="form-group">
                      
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search" value="{{ $search }}">
                                </div>
                          </div>
                <button type="submit" class="btn btn-primary">GO</button>
            </form>
         </div>
    </div>
    <hr class="bg-red">
        <div class=" col-md-12  col-sm-12">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
                <div class="panel " id="theme" style="border:none;">
                    
                     <div class="panel-body">
                         <table class="table striped hovered cell-hovered border bordered">
                             <thead>
                                 <tr>
                                     <!-- <th class="sortable-column">#</td> -->
                                     <th>ID </th>
                                     <th>Resignation Date</th>
                                     <th>Employee ID </th>
                                     <th >Name</th>
                                     <th>Code</th>
                                     <th>Rank</th>
                                     <th>Type</th>
                                    <th></th>
                                 
                             </thead>
                             <tbody>
                                @foreach($resign as $employee)
                                    <tr>
                                     <td><span class="red-bullet"> {{( $employee->id ) }}</span></td>
                                     <td><span class="red-bullet"> {{ $employee->dor->format('M-d-Y') }}</span></td>
                                     <td>{{( $employee->idnum ) }}</td>
                                     <td class="center-txt"><span style="font-weight:bold">{{strtoupper( $employee->name ) }}</span></td>
                                     <td class="center-txt">{{ strtoupper( $employee->code )}}</td>
                                     <td>{{ ucwords( $employee->rank )}}</td>
                                     <td class="center-txt">{{ ucwords( $employee->emp_type )}}</td>
                                    <td style="text-align:center">
                                        {!! Form::open(['method'=>'GET', 'action' => ['ResignController@show', $employee->id]]) !!}
                                                 <button class="button loading-pulse lighten primary" title="view {{ $employee->name }} details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>

                                                 {!! Form::close() !!}
                                             </td>
                                             
                                             
                                        </tr>
                                    @endforeach
                             </tbody>
                         </table>
                     </div>
                     <div class="col-md-offset-5 col-md-6 col-sm-12" style="margin-bottom:20px">
                            {{--{!! $employees->render() !!}--}}
                            {!! $resign->appends(['season' => Input::get('season'),'search' => Input::get('search') ])->render() !!}
                    </div>
                </div>
            </div>
    </div>



@endsection