@extends('layouts.template')
@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Level
                <small>Lists</small>
            </h2>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class=" col-md-4  col-sm-4">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            <div class="example" data-text="">
                <div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>Level</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Level 1</td>
                        <td style="text-align:center">
                            {!! Form::open(['method'=>'GET', 'action' => ['LevelController@show', 1]]) !!}
                            <button class="button primary" title="view details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                            {!! Form::close() !!}
                            </td>
                    </tr>

                    <tr>
                        <td>Level 2</td>
                        <td style="text-align:center">
                            {!! Form::open(['method'=>'GET', 'action' => ['LevelController@show', 2]]) !!}
                            <button class="button primary" title="view details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                            {!! Form::close() !!}
                            </td>
                    </tr>

                    <tr>
                        <td>Level 3</td>
                        <td style="text-align:center">
                            {!! Form::open(['method'=>'GET', 'action' => ['LevelController@show', 3]]) !!}
                            <button class="button primary" title="view details"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
                            {!! Form::close() !!}
                            </td>
                    </tr>
              </table>
                </div>
               
            </div>


@endsection