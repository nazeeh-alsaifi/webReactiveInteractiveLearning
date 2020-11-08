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
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->string('Address');
            $table->string('Address1');
            $table->unsignedBigInteger('user_id');
            $table->date('birth_date')->nullable();
            $table->date('jop_date')->nullable();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade'); 
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); 
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
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
