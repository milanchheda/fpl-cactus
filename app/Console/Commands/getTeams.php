<?php

namespace App\Console\Commands;

use App\Teams;
use Illuminate\Console\Command;

class getTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:teams';

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
        $url = 'https://fantasy.premierleague.com/drf/teams/';
        $JSON = file_get_contents($url);
        $data = json_decode($JSON);
        Teams::truncate();
        foreach ($data as $key => $value) {
            $teamsObj = new Teams();
            $teamsObj->fpl_team_id = $value->id;
            $teamsObj->team_code = $value->code;
            $teamsObj->team_short_name = $value->short_name;
            $teamsObj->team_name = $value->name;
            $teamsObj->save();
        }
    }
}
