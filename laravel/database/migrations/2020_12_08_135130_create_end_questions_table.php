<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_questions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger("sections_components_id");
                $table->string('text_description')->nullable();
                $table->string('Question');
                $table->string("img_src")->default("no-image.jpg");
                $table->timestamps();
                $table->foreign("sections_components_id")->references("id")->on("sections_components");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_questions');
    }
}
