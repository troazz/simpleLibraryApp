<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookWriterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_writer', function (Blueprint $table) {
            $table->integer('book_id')
                ->unsigned();
            $table->integer('writer_id')
                ->unsigned();
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('writer_id')
                ->references('id')
                ->on('writers')
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
        Schema::drop('book_writers');
    }
}
