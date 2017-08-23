<?php

namespace App\Http\Controllers;

use App\Fixtures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class FixturesController extends Controller
{
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
     * @param  \App\Fixtures  $fixtures
     * @return \Illuminate\Http\Response
     */
    public function show(Fixtures $fixtures, Request $request)
    {
        $gameweekID = $request->input('id');
        $allFixtures = Fixtures::select(DB::raw('fixtures.id, fixtures.team_away_score, fixtures.team_home_score, fixtures.winning_team_id, t.team_short_name as home_team, t1.team_short_name as away_team, t.fpl_team_id as home_team_id, t1.fpl_team_id as away_team_id'))->join('teams as t', 't.fpl_team_id', 'fixtures.team_home_id')->join('teams as t1', 't1.fpl_team_id', 'fixtures.team_away_id')->where('gameweek', '=', $gameweekID)->get();
        $allFixtures->triggerCall = $request->input('triggerCall');
        return Response::json(View::make('fixtures', compact('allFixtures'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fixtures  $fixtures
     * @return \Illuminate\Http\Response
     */
    public function edit(Fixtures $fixtures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fixtures  $fixtures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fixtures $fixtures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fixtures  $fixtures
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fixtures $fixtures)
    {
        //
    }
}
