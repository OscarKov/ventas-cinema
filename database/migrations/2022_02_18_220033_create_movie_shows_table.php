<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_shows', function (Blueprint $table) {
            $table->id();
            $table->dateTime('starts_at');
            $table->boolean('available');

            $table->foreignId('movie_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('room_id')
                ->nullable()
                ->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movie_shows', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);
            $table->dropForeign(['room_id']);
        });
        Schema::dropIfExists('movie_shows');
    }
}
