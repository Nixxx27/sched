<?php

namespace App\Providers;


use Carbon\Carbon;
use App\season;
use App\global_settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * initiate when called
         * @return variables within View
         */
        view()->composer('*', function ($view) {
          $view->with([
              "back_button" => "<button class='button danger text-shadow cycle-button' onClick='goBack()' title='Go Back'><span class='mif-chevron-thin-left'></span></button>", //render back button"back_button" => "<button class='button danger text-shadow cycle-button' onClick='goBack()' title='Go Back'><span class='mif-chevron-thin-left'></span></button>"
              "cancel_button" => "<button onclick='goBack()' class='button danger'><i class='fa fa-times'></i> Cancel</button>"
          ]);
        });

        /**
         * General Declaration
         * @return Global variables
         */

        view()->share(
            array(
                "dev_name"          =>"Nikko Zabala",
                "system_name"       =>"SkyLogistics Scheduling System",
                "company_name"      =>"SkyLogistics Philippines Inc.",
                "dev_email"         =>"nikko.zabala@gmail.com",
                "date_now"          => Carbon::now()->toCookieString(),
                "date_today"        => Carbon::now(),
                "project_name"      => "/sched",
                "season_theme"      => season::first(),
            )
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
