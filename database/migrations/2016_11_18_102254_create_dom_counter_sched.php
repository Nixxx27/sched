<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomCounterSched extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domestic_counter_scheds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date'); // date of counter assignment
            $table->string('sched'); //schedules separated by comma
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
        Schema::drop('domestic_counter_scheds');
    }
}
