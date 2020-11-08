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
            $table->increments('id');
            $table->string('First_name');
            $table->string('Last_Name');
            $table->integer('subject_id');
            $table->integer('nationality_id');
            $table->string('Mobile');
            $table->string('Gender');
            $table->date('birth_date')->nullable();
            $table->integer('user_id');
            $table->integer('Is_Coordinator');
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
        Schema::dropIfExists('teachers');
    }
}
