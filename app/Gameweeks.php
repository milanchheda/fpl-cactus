<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gameweeks extends Model
{
    protected $table = 'gameweeks';
    protected $fillable = ['name', 'deadline_time', 'deadline_time_epoch'];
    public $timestamps = false;
}
