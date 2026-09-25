<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorTypeAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_type_author', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->index();
            $table->unsignedBigInteger('author_type_id')->index();
            $table->timestamps();

            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('cascade');

            $table->foreign('author_type_id')
                  ->references('id')
                  ->on('author_types')
                  ->onDelete('cascade');

            $table->primary(['author_id', 'author_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_type_author');
    }
}
