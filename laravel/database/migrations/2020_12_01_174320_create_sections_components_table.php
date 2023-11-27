<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_components', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("component_id");
            $table->unsignedBigInteger("section_id");
            $table->json("options")->nullable();
            $table->foreign("component_id")->references("id")->on("components");
            $table->foreign("section_id")->references("id")->on("activities_sections");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections_components');
    }
}
