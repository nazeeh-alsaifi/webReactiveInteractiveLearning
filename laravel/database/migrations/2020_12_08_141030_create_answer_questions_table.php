<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("multi_questions_id");
            $table->string('Answer');
            $table->string("img_src")->default("no-image.jpg");
            $table->integer('is_true');
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
        Schema::dropIfExists('answer_questions');
    }
}
