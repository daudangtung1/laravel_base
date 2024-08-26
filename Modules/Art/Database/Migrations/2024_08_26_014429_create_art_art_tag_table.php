<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtArtTagTable extends Migration
{
    public function up()
    {
        Schema::create('art_art_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('art_id');
            $table->unsignedInteger('art_tag_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('art_art_tag');
    }
}
