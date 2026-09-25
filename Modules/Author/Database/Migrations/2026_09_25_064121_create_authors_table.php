<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique()->index();
            $table->string('full_name', 200)->index();
            $table->text('bio')->nullable();
            $table->string('avatar', 500)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('website_url', 500)->nullable();
            $table->string('location', 255)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
