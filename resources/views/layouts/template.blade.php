@include('partials.prevent_caching')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SkyLogistics Scheduling System">
    <meta name="author" content="">

    <title>SkyLogistics Philippines Inc | Scheduling Management System</title>
    <script src="{{ url('/public/_style/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ url('/public/js/scripts.js') }}"></script>
    @yield('js-src')

    <link href="/sched/public{{ elixir('css/styles.css') }}" rel="stylesheet">
<link rel="shortcut icon" href="{{ url('public/images/icon/skyicon.ico') }}" type="image/x-icon">
    @yield('css')
</head>

<body>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            @include('partials.nav_menu.nav')
             @yield('content')
        </div><!-- /.container-fluid -->
    </div><!-- /#page-wrapper -->

    @yield('modal')
</div><!-- /#wrapper -->


</body>

</html>

@yield('js')