<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('art_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->unsignedInteger('author_id');
            $table->tinyInteger('status')->comment('1 is public, 0 is private');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('art_categories');
    }
}
