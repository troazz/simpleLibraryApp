<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_keyword', function (Blueprint $table) {
            $table->integer('book_id')
                ->unsigned();
            $table->integer('keyword_id')
                ->unsigned();
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('keyword_id')
                ->references('id')
                ->on('keywords')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_keywords');
    }
}
