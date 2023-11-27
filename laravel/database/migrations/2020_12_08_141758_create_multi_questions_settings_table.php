<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiQuestionsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_questions_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("multi_questions_id");
            $table->integer('trays_count');
            $table->integer('degree');
            $table->timestamps();
            $table->foreign("multi_questions_id")->references("id")->on("multi_questions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multi_questions_settings');
    }
}
