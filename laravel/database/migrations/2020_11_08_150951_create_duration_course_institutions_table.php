<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDurationCourseInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duration_course_institutions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('duration_course_id');
            $table->unsignedBigInteger('institution_id');
            $table->date('From');
            $table->date('To');
            $table->timestamps();
            $table->foreign('duration_course_id')->references('id')->on('duration_courses')->onDelete('cascade');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
			//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duration_course_institutions');
    }
}
