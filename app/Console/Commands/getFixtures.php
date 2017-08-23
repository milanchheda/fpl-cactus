<?php

namespace App\Console\Commands;

use App\Fixtures;
use Illuminate\Console\Command;

class getFixtures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:fixtures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $url = 'https://fantasy.premierleague.com/drf/fixtures/';
        $JSON = file_get_contents($url);
        $data = json_decode($JSON);
        Fixtures::truncate();
        foreach ($data as $key => $value) {
            if(isset($value->event) && $value->event != '') {
                $winning_team_id = 0;
                if($value->team_a_score > $value->team_h_score) {
                    $winning_team_id = $value->team_a;
                } else if($value->team_a_score < $value->team_h_score) {
                    $winning_team_id = $value->team_h;
                }
                $fixturesObj = new Fixtures();
                $fixturesObj->gameweek = $value->event;
                $fixturesObj->team_away_id = $value->team_a;
                $fixturesObj->team_home_id = $value->team_h;
                $fixturesObj->team_away_score = $value->team_a_score;
                $fixturesObj->team_home_score = $value->team_h_score;
                $fixturesObj->winning_team_id = $winning_team_id;
                $fixturesObj->save();
            }
        }
    }
}
