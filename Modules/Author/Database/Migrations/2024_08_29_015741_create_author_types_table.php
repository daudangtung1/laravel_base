<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorTypesTable extends Migration
{
    public function up()
    {
        Schema::create('author_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable()->comment('if color field is null, color is #fff');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('author_types');
    }
}
