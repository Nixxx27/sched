<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<script>
    (function($){
        $(document).ready(function(){

            $('#cssmenu li.active').addClass('open').children('ul').show();
            $('#cssmenu li.has-sub>a').on('click', function(){
                $(this).removeAttr('href');
                var element = $(this).parent('li');
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp(200);
                }
                else {
                    element.addClass('open');
                    element.children('ul').slideDown(200);
                    element.siblings('li').children('ul').slideUp(200);
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp(200);
                }
            });

        });
    })(jQuery);

</script>
<div class="collapse navbar-collapse navbar-ex1-collapse" >
    <ul class="nav navbar-nav side-nav" style="margin-top:17px">
        <div id='cssmenu'>
            {{--<div style="height:4px;background-color:#CE352C"> </div>--}}
            {{--<div style="padding:2px;">--}}
                {{--<table>--}}
                        {{--<tr>--}}
                            {{--<td  style="padding-right:3px"><img src="{{ url('/user_pics/'. auth::user()->picture)}}" alt="..." class="img-circle" style="height:55px;width:55px;"></td>--}}
                            {{--<td>--}}
                                {{--@if( auth::user()->email )--}}
                                    {{--<h5>{{ ucwords( auth::user()->name ) }}<br>--}}
                                        {{--<small style="font-style:italic;color:white"> {{ auth::user()->email  }}</small></h5>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--</table>--}}
            {{--</div>--}}
            {{--<video autoplay loop muted poster="{{ url('public/images/red.jpg') }}" id="background">--}}
                {{--<source src="{{ url('public/video/fx.mp4') }}" type="video/mp4">--}}
            {{--</video>--}}
            {{--<div style="height:2px;background-color:#9b0b06"> </div>--}}
            <ul >
                <li class="has-sub"><a href='{{ url('/home') }}'><i class="fa fa-home nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Dashboard </span></a>
                    <ul>
                        <li><a href='{{ url('/home') }}'><span><i class="fa fa-caret-right"></i> Home  </span></a></li>
                        <li><a href='{{ url('/dash') }}'><span><i class="fa fa-caret-right"></i> Dash  </span></a></li>
                        <li><a href='{{ url('/chart') }}'><span><i class="fa fa-caret-right"></i> Chart Full </span></a></li>
                    </ul>
                </li>

                <legend class="legend-style">Domestic</legend>
                <li class='has-sub'><a href='#'><i class="fa fa-desktop nz-red" aria-hidden="true"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Counter</span></a>
                    <ul>
                        <li><a href='{{ url('/domestic_counter') }}'><span><i class="fa fa-caret-right fg-red"></i> Check-in Counter </span></a></li>
                        <li><a href='{{ url('/domestic_counter/view_counter_settings') }}'><span><i class="fa fa-caret-right fg-red"></i> Setup Counter</span></a></li>
                        <li><a href='{{ url('/counter_list') }}'><span><i class="fa fa-caret-right nz-red"></i> Counter Lists</span></a></li>
                    </ul>
                </li>
                <li class='has-sub'><a href='#'><i class="fa fa-calendar-o nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Gates</span></a>
                    <ul>
                        <li><a href='{{ url('gates') }}'><span><i class="fa fa-caret-right fg-red"></i> View Gates Assignment</span></a></li>
                        <li><a href='{{ url('gates/setup') }}'><span><i class="fa fa-caret-right fg-red"></i> Setup Personnel</span></a></li>
                    </ul>
                </li>

                <legend class="legend-style">International</legend>
                <li class='has-sub'><a href='#'><i class="fa fa-calendar-o nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Counter</span></a>
                     <ul>
                        <li><a href='{{ url('/domestic_counter') }}'><span><i class="fa fa-caret-right fg-red"></i> Check-in Counter </span></a></li>
                        <li><a href='{{ url('/domestic_counter/view_counter_settings') }}'><span><i class="fa fa-caret-right fg-red"></i> Setup Counter</span></a></li>
                    </ul>
                </li>

                <legend class="legend-style">Employee</legend>
                <li class='has-sub'><a href='#'><i class="fa fa-users nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Employee</span></a>
                    <ul>
                        <li><a href='{{ url('/employees') }}'><span><i class="fa fa-caret-right fg-red"></i> Employee List</span></a></li>
                        <li><a href='{{ url('/employees/create') }}'><span><i class="fa fa-caret-right fg-red"></i> New Employee </span></a></li>
                        <li><a href='{{ url('/rank') }}'><span><i class="fa fa-caret-right fg-red"></i> Rank type</span></a></li>
                        <li class='last'><a href='{{ url('/level') }}'><span><i class="fa fa-caret-right fg-red"></i> Level</span></a></li>
                    </ul>
                </li>
                <li class='has-sub'><a href='#'><i class="fa fa-calendar-o nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Schedule</span></a>
                    <ul>
                        <li><a href='{{ url('/schedule') }}'><span><i class="fa fa-caret-right fg-red"></i> View all schedule </span></a></li>
                        <li><a href='{{ url('/schedule/create') }}'><span><i class="fa fa-caret-right fg-red"></i> Add New schedule</span></a></li>
                    </ul>
                </li>

                <legend class="legend-style">Others</legend>
                <li class='has-sub'><a href='#'><i class="fa fa-cog nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> Settings</span></a>
                    <ul>
                        <li><a href='{{ url('/aircraft') }}'><span><i class="fa fa-caret-right nz-red"></i> Aircraft</span></a></li>
                        <li><a href='{{ url('/daily_flight') }}'><span><i class="fa fa-caret-right nz-red"></i> Daily Flight</span></a></li>
                    
                        <li><a href='{{ url('/season') }}'><span><i class="fa fa-caret-right nz-red"></i> Season</span></a></li>
                    </ul>
                </li>

                <li class='has-sub'><a href='#'><i class="fa fa-info-circle nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow"> About</span></a>
                    <ul>
                        <li><a href='#'><i class="fa fa-caret-right nz-red"></i> <span class="mif-ani-hover-heartbeat mif-ani-slow">Contact</span></a></li>
                        <li><a href='#'><span><i class="fa fa-caret-right nz-red"></i> System Requirements</span></a></li>
                        <li><a href='{{ url('/company') }}'><span><i class="fa fa-caret-right nz-red"></i> Company</span></a></li>
                    </ul>
                </li>
             </ul>
            <footer id="btm">
                {{--<img src="{{url('/public/images/icon.png')}}" style="height:100px"><br>--}}
                <div class="hidden-sm hidden-xs hidden-md hidden-lg" data-role="calendar"></div>
             
                <h5>
                    <small title="Season set to {{ ucwords($season_theme->theme) }}">Default: <span style="font-weight:bold">{{ ucwords($season_theme->theme) }}</span></small><br>
                    <small> Quick Access</small>
                </h5>
                <a href='{{ url('/employees/create') }}'><i class="fa fa-user img-circle quick-access" aria-hidden="true" title="Add New Employee"></i></a>
                <i class="fa fa-calendar img-circle quick-access" aria-hidden="true" title="Add New Schedule"></i>
                <i class="fa fa-wrench img-circle quick-access" aria-hidden="true" title="Settings"></i>
                <h5>
                    <small title="Created By: nikko.zabala@gmail.com"><span class="mif-widgets mif-lg mif-ani-pass mif-ani-slow" ></span>
                        SkyLogistics Philippines Inc.  &copy;2016 <br>
                        Info. & Comm Tech. Department
                    </small>
                </h5>
            </footer>
        </div>
    </ul>
</div>

