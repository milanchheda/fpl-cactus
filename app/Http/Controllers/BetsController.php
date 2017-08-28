<?php

namespace App\Http\Controllers;

use App\Bets;
use App\Fixtures;
use App\Traits\nextGameweek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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

        if(is_numeric($gameweekID) && $gameweekID > 0) {
            $whereCondition = ' AND f.gameweek = ' . $gameweekID;
        }

        $getStats = DB::select("SELECT count(*)*2 as winningAmount, u.name from users u
                    join user_bets ub on u.id = ub.user_id
                    join fixtures f on f.id = ub.fixture_id
                    where ub.team_id = f.winning_team_id
                    $whereCondition
                    group by user_id
                    order by count(*) desc");
        return Response::json(View::make('stats', compact('getStats'))->render());
    }
}
