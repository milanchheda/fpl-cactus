<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixtures extends Model
{
    protected $table = 'fixtures';
    protected $fillable = ['gameweek', 'team_away_id', 'team_home_id', 'team_away_score', 'team_home_score', 'winning_team_id'];
    public $timestamps = false;
}
