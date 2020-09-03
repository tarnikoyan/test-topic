<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('topic_id');
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
