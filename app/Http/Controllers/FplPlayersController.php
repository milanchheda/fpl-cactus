<?php

namespace App\Http\Controllers;

use App\FplPlayers;
use Illuminate\Http\Request;

class FplPlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPlayers = FplPlayers::with('teams')->orderBy('total_points', 'desc')->get();
        return view('players', [
                'allPlayers' => $allPlayers
            ]);
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
     * @param  \App\FplPlayers  $fplPlayers
     * @return \Illuminate\Http\Response
     */
    public function show(FplPlayers $fplPlayers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FplPlayers  $fplPlayers
     * @return \Illuminate\Http\Response
     */
    public function edit(FplPlayers $fplPlayers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FplPlayers  $fplPlayers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FplPlayers $fplPlayers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FplPlayers  $fplPlayers
     * @return \Illuminate\Http\Response
     */
    public function destroy(FplPlayers $fplPlayers)
    {
        //
    }
}
