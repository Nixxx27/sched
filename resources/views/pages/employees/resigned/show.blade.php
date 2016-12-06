@extends('layouts.template')
@section('css')
    <style type="text/css">
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
        {
            padding: 2px;
            vertical-align: top;
            border-top: 0px solid #ddd;
        }
    </style>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ ucwords($resign->name) }}
                <small>  details</small>
            </h1>
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-users"></i>  <a href="{{ url('resign') }}">Resigned Employees List</a>
                </li>
                <li class="active">
                    <i class="fa fa-user"></i> view {{ $resign->name }}
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-8 col-md-8">
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif
          @include('errors.list')
            <table>
                <tr>
                    <td>
                        <button class="button loading-pulse lighten success" title="Back" onclick="window.history.back()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
                    </td>
                <tr>
            </table>
         </div>
    </div>
    <hr class="bg-red">
    <!-- Employee Details -->
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <table border="1" cellpadding="20px" cellspacing="20px" class="table-responsive" >
                <tr>
                    <td class="details_td">Date of Resignation</td>
                    <td class="data_td"> {{ $resign->dor->format('M-d-Y') }}</td>
                </tr>
                <tr>
                    <td class="details_td">Emp ID</td>
                    <td class="data_td"> {{ $resign->idnum }}</td>
                </tr>
                 <tr>
                    <td class="details_td">Name</td>
                    <td style="padding:10px"> {{ ucwords($resign->name) }}</td>
                </tr>
                <tr>
                    <td class="details_td">Code</td>
                    <td style="padding:10px"> {{ strtoupper($resign->code) }}</td>
                </tr>
                <tr>
                    <td class="details_td">Rank</td>
                    <td style="padding:10px"> {{ ucwords($resign->rank) }}</td>
                </tr>
                <tr>
                    <td class="details_td"> Type</td>
                    <td style="padding:10px"> {{ ucwords($resign->emp_type) }}</td>
                </tr>
                <tr>
                    <td class="details_td"> Remarks</td>
                    <td style="padding:10px"><textarea cols="30" rows="10" readonly style="border:none">{{ ucwords($resign->remarks) }}</textarea> </td>
                </tr>
            </table>

            
        </div>
  </div>
@endsection

