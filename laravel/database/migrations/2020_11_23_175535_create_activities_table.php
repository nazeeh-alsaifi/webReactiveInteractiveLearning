<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->mediumText("objectives");
            $table->string("image")->default("no-image.jpg");
            $table->unsignedBigInteger("subsubject_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("level_id");
            $table->unsignedBigInteger("location_in_cycle_id");
            $table->unsignedBigInteger("purpose_id");

            $table->boolean("is_free");
            $table->boolean("is_active");
            $table->timestamps();
            $table->foreign("subsubject_id")->references("id")->on("sub_subjects");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("level_id")->references("id")->on("level_of_scaffoldings");
            $table->foreign("location_in_cycle_id")->references("id")->on("location_instructional_cycles");
            $table->foreign("purpose_id")->references("id")->on("instructional_purposes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
