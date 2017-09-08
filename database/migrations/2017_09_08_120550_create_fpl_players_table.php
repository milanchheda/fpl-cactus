<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFplPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpl_players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('element_type');
            $table->integer('code');
            $table->integer('team_code');
            $table->integer('bonus');
            $table->integer('total_points');
            $table->float('points_per_game');
            $table->integer('goals_scored');
            $table->integer('assists');
            $table->integer('clean_sheets');
            $table->integer('goals_conceded');
            $table->integer('penalties_saved');
            $table->integer('penalties_missed');
            $table->integer('minutes');
            $table->integer('saves');
            $table->integer('yellow_cards');
            $table->integer('red_cards');
            $table->string('status');
            $table->string('news');
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
        Schema::dropIfExists('fpl_players');
    }
}
