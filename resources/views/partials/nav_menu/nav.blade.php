<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        {{--<a class="navbar-brand" href="home" style="font-weight: 500" title="Scheduling Management System">--}}
            {{--<span class="mif-paper-plane mif-lg mif-ani-pass mif-ani-slow"></span>--}}
            {{--<span style="font-size:25px;font-style:italic;color:red">S</span>kyLogistics--}}
            {{--<span style="font-size:14px;font-family:'Ubuntu', sans-serif;font-style:italic;font-weight:bold"> Scheduling Management System.</span></a>--}}
        <a class="navbar-brand hidden-xs" href="home"><img src="{{ url('/public/images/sky-brand.png') }}" class="img-responsive mif-ani-hover-heartbeat mif-ani-slow"></a>
        <a class="navbar-brand visible-xs" href="home"><img src="{{ url('/public/images/sky-brand-xs.png') }}"></a>
        <span class="mif-calendar mif-2x  mif-ani-vertical mif-ani-slow" style="color: #8a9a91;margin-top:5px"></span>
    </div>

    {{--TOP MENU--}}
    @include('partials.nav_menu.top_menu'  )

    {{--SIDE BAR--}}
    @include('partials.nav_menu.sidebar')
    <!-- /.navbar-collapse -->

</nav>