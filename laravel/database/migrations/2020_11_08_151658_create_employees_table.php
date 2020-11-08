<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('First_Name');
            $table->string('Last_Name')->nullable();
            $table->string('Mobile');
            $table->string('Gender')->nullable();
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('nationality_id')->nullable();
            $table->string('Address');
            $table->string('Address1');
            $table->date('birth_date')->nullable();
            $table->date('jop_date')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
