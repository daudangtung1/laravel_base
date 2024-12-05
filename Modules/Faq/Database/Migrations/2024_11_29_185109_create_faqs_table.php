<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->longText('answer');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
