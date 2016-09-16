@extends('layouts.template')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Sure Logout?
                </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-power-off"></i> Log-Out
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-offset-5 col-md-7 col-sm-offset-5 col-sm-7">
            <button class="button danger loading-pulse" onClick="logout()">Yes</button>
            <button class="button" onClick="goBack()">Cancel</button>
        </div>
    </div>
@endsection