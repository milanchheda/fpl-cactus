<?php

namespace App\Console\Commands;

use App\Gameweeks;
use Illuminate\Console\Command;

class getGameweeks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:gameweeks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Gameweeks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'https://fantasy.premierleague.com/drf/events/';
        $JSON = file_get_contents($url);
        $data = json_decode($JSON);
        Gameweeks::truncate();
        foreach ($data as $key => $value) {
            $gwObj = new Gameweeks();
            $gwObj->name = $value->name;
            $gwObj->deadline_time = $value->deadline_time;
            $gwObj->deadline_time_epoch = $value->deadline_time_epoch;
            $gwObj->save();
        }
    }
}
