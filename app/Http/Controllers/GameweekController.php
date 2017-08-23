<?php

namespace App\Http\Controllers;

use App\Fixtures;
use App\Gameweeks;
use App\Traits\nextGameweek;
use Illuminate\Http\Request;

class GameweekController extends Controller
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
     * @param  \App\Gameweeks  $gameweeks
     * @return \Illuminate\Http\Response
     */
    public function show(Gameweeks $gameweeks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gameweeks  $gameweeks
     * @return \Illuminate\Http\Response
     */
    public function edit(Gameweeks $gameweeks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gameweeks  $gameweeks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gameweeks $gameweeks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gameweeks  $gameweeks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gameweeks $gameweeks)
    {
        //
    }

    /**
    */
    public function next(Gameweeks $gameweeks)
    {
        $getGameweek = $this->getNextGameweek();
        return json_encode(array('next_gameweek' => $getGameweek[0]['id']));
    }
}
