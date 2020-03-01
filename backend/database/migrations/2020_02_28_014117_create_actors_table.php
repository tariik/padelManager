<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->integer('cast_id'); 
            $table->string('character');
            $table->string('credit_id'); 
            $table->integer('gender'); 
            $table->integer('id'); 
            $table->string('name'); 
            $table->integer('order'); 
            $table->string('profile_path'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actors');
    }
}
