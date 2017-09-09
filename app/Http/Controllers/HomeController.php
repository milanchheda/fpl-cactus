<?php

namespace App\Http\Controllers;

use App\Gameweeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;

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

    public function getRunArtisan() {
        return view('artisan-commands');
    }

    public function runArtisan(Request $request) {
        switch ($request->input('id')) {
            case 'getFixtures':
                Artisan::call('get:fixtures');
                $return = Artisan::output();
                break;
            case 'getTeams':
                Artisan::call('get:teams');
                $return = Artisan::output();
                break;
            case 'getGameweeks':
                Artisan::call('get:gameweeks');
                $return = Artisan::output();
                break;

            default:
                $return = 0;
                break;
        }

        return response()->json(['message' => 'Artisan command executed Successfully.'])->setStatusCode(200);
        // return response()->json(['message' => 'Oops, artisan command encourtered some error.'])->setStatusCode(403);
    }
}
