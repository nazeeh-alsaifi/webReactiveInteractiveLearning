<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution__subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id');
            $table->integer('subject_id');
            $table->integer('Student_count');
            $table->integer('Teacher_count');
            $table->integer('buyment_method_id');
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
        Schema::dropIfExists('institution__subjects');
    }
}
