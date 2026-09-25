<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('author_id')->index();
            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('cascade');

            $table->string('authorable_type');
            $table->unsignedBigInteger('authorable_id');
            $table->index(['authorable_type', 'authorable_id'], 'authorables_morphs_index');

            $table->boolean('is_primary')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();

            $table->timestamps();

            $table->unique(
                ['author_id', 'authorable_type', 'authorable_id'],
                'authorables_unique_author_morphs'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorables');
    }
}
