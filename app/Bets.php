<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bets extends Model
{
    protected $table = 'user_bets';
    protected $fillable = ['user_id', 'gameweek_id', 'fixture_id', 'team_id'];
}
