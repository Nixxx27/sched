<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('cntr_ml');
            $table->integer('cntr_dom_only');
            $table->integer('cntr_int_only');
            $table->integer('cntr_t_one');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('cntr_ml');
            $table->dropColumn('cntr_dom_only');
            $table->dropColumn('cntr_int_only');
            $table->dropColumn('cntr_t_one');
        });
    }
}
