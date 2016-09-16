@extends('layouts.template')

@section('css')

    <style>
        iframe:focus {
            outline: none;
        }

        iframe[seamless] {
            display: block;
        }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                About
                <small>Page</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="{{ $project_name }}/home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> About Company
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <a href="{{ url('chart') }}">
        <button class="btn btn-primary"><i class="fa fa-arrows" aria-hidden="true"></i> Full Screen</button>
    </a>


    <div class="row">
        <div class="col-lg-10 col-md-10">
            <iframe src="{{ url('chart_small') }}" frameborder="0" width="1000px" height="600px">
                <p>Your browser does not support iframes.</p>
            </iframe>
        </div>
    </div>

@endsection


