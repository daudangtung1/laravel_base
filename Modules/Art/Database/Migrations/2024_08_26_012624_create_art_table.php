<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtTable extends Migration
{
    public function up()
    {
        Schema::create('art', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('art_category_id');
            $table->string('path');
            $table->string('size')->nullable();
            $table->tinyInteger('status')->comment('1 public, 0 is private')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('art');
    }
}
