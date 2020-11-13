<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('First_name');
            $table->string('Last_Name');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->string('Mobile');
            $table->string('Gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('Is_Coordinator');
            $table->timestamps();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade'); 
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
        Schema::dropIfExists('teachers');
    }
}
