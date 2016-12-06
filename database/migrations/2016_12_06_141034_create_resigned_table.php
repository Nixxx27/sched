<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_resigned', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idnum');
            $table->string('name');
            $table->string('emp_type');
            $table->string('code');
            $table->string('rank');
            $table->string('dor'); // date of resignation
            $table->text('remarks');
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
        Schema::drop('emp_resigned');
    }
}
