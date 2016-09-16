@extends('layouts.template')

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
                    <i class="fa fa-dashboard"></i>  <a href="{{url('home')}}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> About Company
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-offset-2 col-lg-6 col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-6">
            <h3>Property of :</h3>
            <img src="public/images/skylogo.png">
            <h5 style="text-align:right"><small><a href="http://www.skylogistics.com.ph" target="_blank">www.skylogistics.com.ph</a></small></h5>
        </div>
    </div>

@endsection


