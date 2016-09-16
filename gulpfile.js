var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass('app.scss');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/sb-admin.css',
        'vendor/plugins/morris.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/metro.css',
        'vendor/metro-icons.css',
        'vendor/metro-responsive.css',
        'vendor/menu-style.css',
        'style/table.css',
        'style/style.css',
    ],'public/css/styles.css'); //3rd arg loc: def resources/assets


    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        'vendor/metro.js',
        'scripts/myscript.js',
        'vendor/plugins/morris/morris.js',
        'vendor/plugins/morris/morris-data.js',
        'vendor/plugins/morris/raphael.min.js',
        'vendor/typed.js',
     ],'public/js/scripts.js')

    mix.version('public/css/styles.css'); //build cached file




});
