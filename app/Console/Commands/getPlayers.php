<?php

namespace App\Console\Commands;

use App\FplPlayers;
use Illuminate\Console\Command;

class getPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches all FPL players from fantasy premier league';

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
        $url = 'https://fantasy.premierleague.com/drf/elements/';
        $JSON = file_get_contents($url);
        $data = json_decode($JSON);
        FplPlayers::truncate();
        foreach ($data as $key => $value) {
            $fplPlayerObj = new FplPlayers();
            $fplPlayerObj->first_name = $value->first_name;
            $fplPlayerObj->last_name = $value->second_name;
            $fplPlayerObj->element_type = $value->element_type;
            $fplPlayerObj->code = $value->code;
            $fplPlayerObj->team_code = $value->team_code;
            $fplPlayerObj->bonus = $value->bonus;
            $fplPlayerObj->total_points = $value->total_points;
            $fplPlayerObj->points_per_game = $value->points_per_game;
            $fplPlayerObj->goals_scored = $value->goals_scored;
            $fplPlayerObj->assists = $value->assists;
            $fplPlayerObj->clean_sheets = $value->clean_sheets;
            $fplPlayerObj->goals_conceded = $value->goals_conceded;
            $fplPlayerObj->penalties_saved = $value->penalties_saved;
            $fplPlayerObj->penalties_missed = $value->penalties_missed;
            $fplPlayerObj->minutes = $value->minutes;
            $fplPlayerObj->saves = $value->saves;
            $fplPlayerObj->yellow_cards = $value->yellow_cards;
            $fplPlayerObj->red_cards = $value->red_cards;
            $fplPlayerObj->status = $value->status;
            $fplPlayerObj->news = $value->news;
            $fplPlayerObj->save();
        }
    }
}
