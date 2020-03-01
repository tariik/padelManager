<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_movies', function (Blueprint $table) {
            $table->integer('id');
            $table->string('title');
            $table->date('release_date');
            $table->string('poster_path');
            $table->text('overview')->nullable();
            $table->text('tagline')->nullable();
            $table->integer('popularity');
            $table->float('vote_average', 8, 2);
            $table->integer('vote_count');
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
        Schema::dropIfExists('my_movies');
    }
}
