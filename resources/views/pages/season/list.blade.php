@extends('layouts.template')


@section('content')

    <div id="bgcolor">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Season <small><span id="theme_icon" class="{{ $class }}" style="color:{{ $color }}"></span></small>
            </h2>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class=" col-md-5">
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
                </div>
            @endif
            {!! Form::open(array('method'=>'PATCH','name'=>'season_theme_edit','id'=>'season_theme_edit','action' => array('ThemeController@update', $season->id) )) !!}
            <input type="hidden" name="theme" id="theme" value="{{ $season->theme }}">
            <table>
                <tr>
                    <td>
                        <label class="input-control radio small-check">
                            <input type="radio" name="season1" id="summer" {{ $summer_check }} value="summer" onclick="clickme()">
                            <span class="check"></span>
                            <span class="caption">Summer</span>
                        </label>
                    </td>

                    <td style="padding-left:20px">
                        <label class="input-control radio small-check">
                            <input type="radio" name="season1" id="winter" {{ $winter_check }} value="winter" onclick="clickme()">
                            <span class="check"></span>
                            <span class="caption">Winter</span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-primary" onclick="return confirm('Are you sure you want to change Season?')">Save</button>
                        <button class="btn btn-danger" onclick="goBack()">Cancel</button>
                    </td>
                </tr>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
    </div>  <!-- BGcolor -->
    @endsection

    @section('js')

    <script>
        function clickme()
        {
            var selected =$("input[name=season1]:checked").val()
                ,theme_icon=$('#theme_icon');

            $('#theme').val( selected);

            if( selected == 'summer')
            {
                theme_icon.removeClass('mif-weather5 mif-3x mif-ani-heartbeat mif-ani-slow');
                theme_icon.addClass('mif-cloudy3 mif-3x mif-ani-heartbeat mif-ani-slow');
                theme_icon.attr("style","color:#CE9135");
            }else
            {
                theme_icon.removeClass('mif-cloudy3 mif-3x mif-ani-heartbeat mif-ani-slow');
                theme_icon.addClass('mif-weather5 mif-3x mif-ani-heartbeat mif-ani-slow');
                theme_icon.attr("style","color:#337ab7");
            }
        }
    </script>
    @endsection