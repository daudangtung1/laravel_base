<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('full_name')->nullable();
            $table->date('birth_day')->nullable();
            $table->longText('description')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('is_active')->default(0)->comment('0 is no, 1 is yes');
            $table->tinyInteger('is_block')->default(0)->comment('0 is no, 1 is yes');
            $table->unsignedInteger('author_type_id')->nullable();
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
