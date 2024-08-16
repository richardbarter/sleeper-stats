<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('nfl_players', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        //should I reduce this to get rid of any columns, I don't think I need.  that way the command would then filter the results of the api list to transform 
        //it into only the data needed. I also need to add indexes to the relevant columns. Need to analyze which columns will need indexes. 
        //also change the player_id from a string to BIGINT 20. 
        //right now, the position is based on a string. But if I want to improve query times, should I change position to an int, and have something that maps the position to the number?
        Schema::create('nfl_players', function (Blueprint $table) {
            $table->string('player_id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('team')->nullable();
            $table->string('position')->nullable();
            $table->string('status')->nullable();
            $table->string('hashtag')->nullable();
            $table->string('depth_chart_position')->nullable();
            $table->string('sport')->nullable();
            $table->string('fantasy_positions')->nullable();
            $table->integer('number')->nullable();
            $table->string('search_last_name')->nullable();
            $table->date('injury_start_date')->nullable();
            $table->string('weight')->nullable();
            $table->string('practice_participation')->nullable();
            $table->string('sportradar_id')->nullable();
            $table->string('college')->nullable();
            $table->integer('fantasy_data_id')->nullable();
            $table->string('injury_status')->nullable();
            $table->string('height')->nullable();
            $table->string('search_full_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('stats_id')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('espn_id')->nullable();
            $table->integer('search_rank')->nullable();
            $table->integer('depth_chart_order')->nullable();
            $table->integer('years_exp')->nullable();
            $table->string('rotowire_id')->nullable();
            $table->string('rotoworld_id')->nullable();
            $table->string('search_first_name')->nullable();
            $table->string('yahoo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfl_players');
    }
};
