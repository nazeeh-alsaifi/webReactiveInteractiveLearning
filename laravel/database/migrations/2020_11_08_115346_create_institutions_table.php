<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Institu_name');
            $table->integer('academic_levels_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('Mobile');
            $table->string('Email');
            $table->string('Address');
            $table->string('Address1');
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
        Schema::dropIfExists('institutions');
    }
}
