<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomCtrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domestic_counter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counter');
            $table->string('emp_id');
            $table->string('schedule');
            $table->string('shift');
            $table->string('date');
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
        Schema::drop('domestic_counter');
    }
}
