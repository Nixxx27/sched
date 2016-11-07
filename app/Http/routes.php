<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {


    Route::auth();

    Route::get('/', function(){
        return Redirect::to('login');
    });

    Route::get('testing', function(){
        return view('testing');
    });

    Route::get('sky', function(){
        return view('sky');
    });

    Route::get('graph', function(){
        return view('graph');
    });

    Route::get('chart', function(){
        return view('pages.chart');
    });

    Route::get('chart_small', function(){
        return view('pages.chart_small');
    });

    Route::get('dash', function(){
        return view('pages.dashboard');
    });


    /*
    * @return Pages Controller
     */
    Route::get('home', 'PagesController@index');

    /*
     * @return Domestic Controller
     */
    Route::get('dom_check_in','DomesticController@dom_check_in');
    Route::get('simulate','DomesticController@simulate');
    Route::post('simulate','DomesticController@simulate_store');


    /*
     * @return Domestic Counter
     *
     */
    Route::get('domestic_counter/view_counter_settings','DomesticCounter@view_counter_settings'); // view settings for domestic counter.
    Route::post('domestic_counter/counter_setup','DomesticCounter@counter_setup'); // view result random.
     Route::get('domestic_counter/unassigned/{date}/{sched}','DomesticCounter@view_unassigned_personnel'); // view unassigned employees
    Route::get('domestic_counter/test','DomesticCounter@test');
    Route::post('domestic_counter/counter_save','DomesticCounter@save_counter_assignment'); // Save Random counter to Db.
    Route::resource('domestic_counter', 'DomesticCounter');


    /*
    * @return Domestic Gates
    */
    Route::get('gates/setup','DomesticGates@setup'); // view setup page
    Route::get('gates/view_gates_flight','DomesticGates@view_gates_flight'); // view flight for the selected day
     Route::post('gates/save_setup','DomesticGates@save_setup'); //save each setup
    Route::resource('gates','DomesticGates');



    /*
     * @return Employees Controller
     */
    Route::get('employees/test','EmployeesController@chatTest'); // for testing
    Route::get('employees/rank','EmployeesController@add_rank'); //add new rank from employee page.
    Route::resource('employees', 'EmployeesController');
    Route::post('employees/add_qualification/{employees}', 'EmployeesController@add_qualification'); // Add Qualification to Employee
    Route::post('employees/delete_qualification/{employees}', 'EmployeesController@destroy_employee_qualification'); // Add Qualification to Employee
    
    /*
     * @return Aircraft Controller
     */
    Route::resource('aircraft', 'AircraftController');

    /*
     * @return Rank Controller
     */
    Route::resource('rank', 'RankController');

    /*
     * @return Schedule Controller
     */
    Route::resource('schedule', 'ScheduleController');

    /*
    * @return About Controller
    */
    Route::get('company','AboutController@company');

    /*
    * @return Employee Leaves Controller
    */
    Route::resource('leave', 'LeaveController');

    /*
    * @return Level Controller
    */
    Route::resource('level', 'LevelController');

    /*
    * @return Qualification Controller
    */
    Route::resource('qualification', 'QualificationController');


    /*
    * @return Counter Lists Controller
    */
    Route::resource('counter_list', 'CounterListController');

    /*
     * @return Daily Flight Controller
     */
    Route::resource('daily_flight', 'DailyFlightController');


    /*
     * @return Aircraft Controller
     */
    Route::resource('aircraft', 'AircraftController');


    /*
    * @return Ajax Controller
    */
    Route::get('get_dom_counter_employee','AjaxController@get_dom_counter_employee');
    Route::get('rank_list','AjaxController@rank_list');


    /*
   * @return Season Controller
   */
    Route::resource('season', 'ThemeController');
//    Route::get('season','ThemeController@season');
//    Route::get('season/update/{season}','PagesController@season_update');


    /*
   * @return Global Settings
   */
      Route::post('senior_counter', 'GlobalSettings@store_dom_counter_settings'); // domestic senior carousel

      Route::post('dom_gates_settings', 'GlobalSettings@store_dom_gate_settings'); // level requirements domestic gates

    /*
     * @return  Logout Page
     */
    Route::get('sure_logout',function(){
        return view('pages.logout');
    });
});
