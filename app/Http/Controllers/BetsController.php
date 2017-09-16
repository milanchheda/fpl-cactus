<?php

namespace App\Http\Controllers;

use App\Bets;
use App\User;
use App\Fixtures;
use App\Traits\nextGameweek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class BetsController extends Controller
{
    use nextGameweek;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function show(Bets $bets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function edit(Bets $bets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bets $bets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bets  $bets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bets $bets)
    {
        //
    }

    public function saveBets(Request $request) {
        $params = $request->input('betsSelected');
        $params = json_decode($params);
        $params = (array) $params;
        $getGameweek = $this->getNextGameweek();
        $paramKeys = array_keys($params);
        $getGameweekId = $this->getGameweekFromFixturesID($paramKeys);
        if($getGameweekId[0]['gameweek'] == $getGameweek[0]['id']) {
            Bets::where('gameweek_id', $getGameweek[0]['id'])->wherein('fixture_id', $paramKeys)->where('user_id', Auth::id())->delete();
            foreach ($params as $key => $value) {
                $betsObj = new Bets();
                $betsObj->user_id = Auth::id();
                $betsObj->gameweek_id = $getGameweek[0]['id'];
                $betsObj->fixture_id = $key;
                $betsObj->team_id = $value;
                $betsObj->save();
            }
            return response()->json(['message' => 'Saved Successfully.'])->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Sorry, you missed the deadline.'])->setStatusCode(403);
        }
    }

    public function getBets() {
        $getGameweek = $this->getNextGameweek();

        $allFixtures = Fixtures::select(DB::raw('fixtures.id, fixtures.team_away_score, fixtures.team_home_score, fixtures.winning_team_id, t.team_short_name as home_team, t1.team_short_name as away_team, t.fpl_team_id as home_team_id, t1.fpl_team_id as away_team_id'))->join('teams as t', 't.fpl_team_id', 'fixtures.team_home_id')->join('teams as t1', 't1.fpl_team_id', 'fixtures.team_away_id')->where('gameweek', $getGameweek[0]['id'])->get();
        $allFixtures->gameweek_id = $getGameweek[0]['id'];
        return View::make('getBets')->with('allFixtures', $allFixtures);
    }

    public function getUserBets(Request $request) {
        $gameweekID = $request->input('id');
        $getBets = Bets::select(DB::raw('user_bets.fixture_id, user_bets.team_id, t.team_short_name as teamName'))->leftJoin('teams as t', 't.fpl_team_id', 'user_bets.team_id')->where('user_bets.gameweek_id', $gameweekID)->where('user_id', Auth::id())->get()->toArray();
        return json_encode($getBets);
    }

    public function getStats(Request $request) {
        $gameweekID = $request->input('id');
        $whereCondition = '';
        $query = Fixtures::whereNotNull('team_home_score')->whereNotNull('team_away_score')->whereNotIn('gameweek', [1,2,3]);

        if(is_numeric($gameweekID) && $gameweekID > 0) {
            $query->where('gameweek', $gameweekID);
            $newQuery = DB::select("SELECT concat(t1.team_short_name, ' vs ', t2.team_short_name) fixture, t3.team_short_name winningTeam, t3.id as winningTeamId, ub.team_id userBetTeamId, u.name,
                concat(t1.fpl_team_id, '-', t1.team_short_name) teamOneName,
                concat(t2.fpl_team_id, '-', t2.team_short_name) teamTwoName
                from users u
                join user_bets ub on u.id = ub.user_id
                join fixtures f on f.id = ub.fixture_id
                left join teams t1 on t1.fpl_team_id = f.team_home_id
                left join teams t2 on t2.fpl_team_id = f.team_away_id
                left join teams t3 on t3.fpl_team_id = f.winning_team_id
                where gameweek_id = " . $gameweekID);
        }

        $getFixtures = $query->get()->toArray();

        $getBets = Bets::select(DB::raw('user_id, team_id, fixture_id'))->get()->toArray();
        foreach ($getBets as $key => $value) {
            $betsArray[$value['user_id']][$value['fixture_id']] = $value['team_id'];
        }

        $fixtureCount = [];
        $userArray = [];
        foreach ($getFixtures as $key => $value) {
            $fixtureCount[$value['id']] = 0;
            foreach ($betsArray as $bk => $bv) {
                if(!isset($userArray[$bk]['amount']))
                    $userArray[$bk]['amount'] = 0;
                if(isset($betsArray[$bk]) && isset($betsArray[$bk][$value['id']])) {
                    if($value['winning_team_id'] == $betsArray[$bk][$value['id']]) {
                        $fixtureCount[$value['id']]++;
                    }
                }
            }
        }

        $someNewArray = [];
        foreach ($getFixtures as $key => $value) {
            foreach ($fixtureCount as $fk => $fv) {
                $someNewArray[$fk] = 0;
                if($fv > 0)
                    $someNewArray[$fk] = number_format(24/$fv, 2);
            }

            foreach ($betsArray as $nbk => $nbv) {
                if(isset($betsArray[$nbk][$value['id']]) && isset($betsArray[$nbk]) && $someNewArray[$value['id']] > 0) {
                    if($value['winning_team_id'] == $betsArray[$nbk][$value['id']]) {
                        $userArray[$nbk]['amount'] += $someNewArray[$value['id']];
                    }
                } else {
                    $userArray[$nbk]['amount'] += 2;
                }
            }
        }


        foreach ($userArray as $key => $value) {
            $getUserObj = User::where('id', $key)->get()->toArray();
            $userArray[$getUserObj[0]['name']] = $value;
            unset($userArray[$key]);
        }

        uasort($userArray, function($a, $b){
            return $a['amount'] < $b['amount'];
        });

        return Response::json(View::make('stats', compact('userArray', 'newQuery'))->render());
    }
}
