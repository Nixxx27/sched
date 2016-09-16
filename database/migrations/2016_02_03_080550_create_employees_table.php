<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sched', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sched_num');
            $table->time('timein');
            $table->time('timeout');
            $table->string('season');
            $table->timestamps();
        });


        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('summer_sched')->unsigned();
            $table->foreign('summer_sched')->references('id')->on('sched');
            $table->integer('winter_sched')->unsigned();
            $table->foreign('winter_sched')->references('id')->on('sched');
            $table->string('name');
            $table->string('idnum');
            $table->string('emp_type');
            $table->string('code');
            $table->string('rank');
            $table->integer('level'); //area of assignment
            $table->integer('senior'); // if employee is senior. 0 = no
            $table->timestamps();

         });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
        Schema::drop('sched');
    }
}
