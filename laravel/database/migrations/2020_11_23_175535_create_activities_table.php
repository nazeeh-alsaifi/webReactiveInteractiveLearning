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
            $table->unsignedBigInteger("subject_id");
            // $table->unsignedBigInteger("user_id");
            $table->boolean("is_free");
            $table->boolean("is_active");
            $table->timestamps();
            $table->foreign("subject_id")->references("id")->on("subjects");
            // $table->foreign("user_id")->references("id")->on("users");
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
