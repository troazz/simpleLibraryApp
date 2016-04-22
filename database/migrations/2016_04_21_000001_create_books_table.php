<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('synopsis',120);
            $table->text('description');
            $table->integer('category_id')
                ->unsigned();
            $table->integer('publisher_id')
                ->unsigned();
            $table->string('photo');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade');
            $table->foreign('publisher_id')
                ->references('id')
                ->on('publishers')
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
        Schema::drop('books');
    }
}
