<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelieverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reliever', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_id'); // employee id
            $table->string('name'); // date of reliever
            $table->string('date'); // date of reliever
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
        Schema::drop('reliever');
    }
}
