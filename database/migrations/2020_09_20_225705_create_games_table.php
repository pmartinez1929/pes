<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('local_id');
          $table->foreign('local_id')->references('id')->on('users');
          $table->unsignedBigInteger('visit_id');
          $table->foreign('visit_id')->references('id')->on('users');
          $table->integer("gol_local");
          $table->integer("gol_visit");
          $table->unsignedBigInteger('winnerpenaltys')->nullable();
          $table->foreign('winnerpenaltys')->references('id')->on('users');
          $table->unsignedBigInteger('winner')->nullable();
          $table->foreign('winner')->references('id')->on('users');
          $table->unsignedBigInteger('loser')->nullable();
          $table->foreign('loser')->references('id')->on('users');
          $table->integer("draw")->nullable();
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
        Schema::dropIfExists('games');
    }
}
