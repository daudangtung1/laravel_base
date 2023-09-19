<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('user_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
