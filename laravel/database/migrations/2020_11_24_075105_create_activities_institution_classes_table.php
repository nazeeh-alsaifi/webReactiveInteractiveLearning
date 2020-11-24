<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesInstitutionClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_institution_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("activity_id");
            $table->unsignedBigInteger("institution_class_id");
            $table->foreign("activity_id")->references("id")->on("activities");
            $table->foreign("institution_class_id")->references("id")->on("institution_classes");
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
        Schema::dropIfExists('activities_institution_classes');
    }
}
