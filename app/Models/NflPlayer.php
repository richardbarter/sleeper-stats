<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NflPlayer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'player_id', 'first_name', 'last_name', 'team', 'position', 'status',
        'hashtag', 'depth_chart_position', 'sport', 'fantasy_positions', 'number',
        'search_last_name', 'injury_start_date', 'weight', 'practice_participation',
        'sportradar_id', 'college', 'fantasy_data_id', 'injury_status', 'height',
        'search_full_name', 'age', 'stats_id', 'birth_country', 'espn_id', 'search_rank',
        'depth_chart_order', 'years_exp', 'rotowire_id', 'rotoworld_id', 'search_first_name',
        'yahoo_id'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fantasy_positions' => 'array', // Since this is stored as JSON in the database
        'injury_start_date' => 'date',  // Casts to a date object
    ];
}
