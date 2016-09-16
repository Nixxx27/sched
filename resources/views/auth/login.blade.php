<!DOCTYPE html>
<html>
<head>
    <title>SkyLogistics Philippines Inc | Scheduling Management System</title>
    <link href="/sched/public{{ elixir('css/styles.css') }}" rel="stylesheet">

    <script src="public/_style/js/jquery-2.1.3.min.js"></script>
    <script src="public/_style/js/metro.js"></script>
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            color:#47475c;
            background-color: #fff9fa;
             -webkit-transform: scale(.8);
            transform: scale(.8);
        }

    </style>

    <script>

        $(function(){
            var form = $(".login-form");

            form.css({
                opacity:0.9,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<video autoplay loop muted poster="screenshot.jpg" id="background"
     <source src="{{ url('public/video/slpi.mp4') }}" type="video/mp4">
</video>
<body class="bg-darkTeal">
<div class="login-form padding20 block-shadow">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <h1 class="text-light"><span class="mif-lock mif-ani-shuttle mif-ani-slow mif-2x"></span> Login to service</h1>
        <hr class="thin"/>

        @if ($errors->has('name')) <span style="color:#CE352C;font-style:italic;font-weight:bold"> {{ $errors->first('name') }}</span> @endif
            <div class="input-control modern text iconic">
               <input type="text"  name="name" id="name" placeholder="Username">
                <span class="label">You login</span>
                <span class="informer">Please enter your username</span>
                <span class="icon mif-user"></span>
            </div>
        <br>
        @if ($errors->has('password')) <span style="font-style:italic;color:#CE352C;font-weight:bold"> {{ $errors->first('password') }}</span> @endif
            <div class="input-control modern password iconic" data-role="input">
                <input type="password" name="password" id="password" placeholder="Password">
                <span class="label">You password</span>
                <span class="informer">Please enter you password</span>
                <span class="icon mif-lock"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>

        <div class="form-actions">
            <button type="submit" class="button primary block-shadow-info loading-pulse">Login</button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
    </form>
</div>
</body>
</html>

<script>
    setTimeout(function(){
        $.Notify({
            type: 'success',
            caption: 'Good Day, Welcome! to',
            content: " "});
    }, 1000);

    setTimeout(function(){
        $.Notify({
            keepOpen: true,
            type: 'default',
            caption: "<img src='public/images/skylogo.png'>",
            content: " "});
    }, 2000);

    setTimeout(function(){
        $.Notify({
            keepOpen: true,
            type: 'alert',
            caption: '',
            content: "<center>Scheduling Management System.</center>"});
    }, 2500);

    setTimeout(function(){
        var d = new Date();
        var dateNow =  d.toDateString();
        $.Notify({
            type: 'warning',
            caption: "",
            content: "<center>" + dateNow + "</center>" });
    }, 3500);

    setTimeout(function(){
        var d = new Date();
        var dateNow =  d.toDateString();
        $.Notify({
            keepOpen:true,
            type: 'info',
            caption: "",
            content: "<center>" + dateNow + "</center>" });
    }, 6500);

    setTimeout(function(){
        $.Notify({
            keepOpen:true,
            type: 'warning',
            caption: "",
            content: "<p style='text-align:center'>S. M. S.</p>" });
    }, 6500);
</script>


