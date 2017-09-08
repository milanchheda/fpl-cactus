<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';
    protected $fillable = ['fpl_team_id', 'team_code', 'team_short_name', 'team_name'];
    public $timestamps = false;

    public function fplPlayers()
    {
        return $this->belongsTo('App\FplPlayers', 'team_code', 'team_code');
    }
}
