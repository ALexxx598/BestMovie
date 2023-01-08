<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_collection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('collection_id');
            $table->timestamps();

            $table
                ->foreign('movie_id')
                ->references('id')
                ->on('movies');
            $table
                ->foreign('collection_id')
                ->references('id')
                ->on('collections');

            $table->unique(['collection_id', 'movie_id'], 'movie_collection_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_collection');
    }
};
