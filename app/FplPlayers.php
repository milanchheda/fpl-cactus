<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FplPlayers extends Model
{
    protected $table = 'fpl_players';
    protected $fillable = ['first_name', 'last_name', 'element_type', 'code', 'team_code', 'bonus', 'total_points', 'points_per_game', 'goals_scored', 'assists', 'clean_sheets', 'goals_conceded', 'penalties_saved', 'penalties_missed', 'minutes', 'saves', 'yellow_cards', 'red_cards', 'status', 'news'
    ];

    public function teams()
    {
        return $this->hasOne('App\Teams', 'team_code', 'team_code');
    }
}
