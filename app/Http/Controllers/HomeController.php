<?php

namespace App\Http\Controllers;

use App\Gameweeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameWeeks = Gameweeks::all();
        return View::make('home')->with('gameweeks', $gameWeeks);
    }
}
