<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domestic_gates', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('counter_num'); //actual counter num
            $table->string('flight_num'); // actual flight num
            $table->time('timein'); //timeout   
            $table->time('timeout'); //timeout ** for csa next job after this**
            $table->string('status'); // default: assigned - on-going - cancelled - done
            $table->integer('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employees');
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
        Schema::drop('domestic_gates');
    }
}
