<?php
namespace App\Traits;

use App\Fixtures;

trait nextGameweek
{
	public function getNextGameweek() {
		$getGameweek = Fixtures::join('gameweeks as ga', 'ga.id', 'fixtures.gameweek')->whereNull('team_away_score')->whereNull('team_home_score')->where('winning_team_id','=', 0)->where('deadline_time_epoch', '>', time())->orderBy('fixtures.id')->limit(1)->get()->toArray();
		return $getGameweek;
	}

	public function getGameweekFromFixturesID($fixtureIds = array()) {
		$getGameweekId = [];
		if(is_array($fixtureIds) && !empty($fixtureIds))
			$getGameweekId = Fixtures::wherein('id', $fixtureIds)->distinct()->get(['gameweek'])->toArray();
		return $getGameweekId;
	}
}
