<?php

namespace App\Http\Controllers;

use App\Bets;
use App\User;
use App\Fixtures;
use App\Gameweeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function showNoBetsPage() {
        $gameWeeks = Gameweeks::all();
        $users = User::all();
        return View::make('noBets')->with('gameweeks', $gameWeeks)->with('users', $users);
    }

    public function runArtisan(Request $request) {
        if(Auth::id() == 1) {
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
                case 'getPlayers':
                    Artisan::call('get:players');
                    $return = Artisan::output();
                    break;

                default:
                    $return = 0;
                    break;
            }
            return response()->json(['message' => 'Artisan command executed Successfully.'])->setStatusCode(200);
        }
        return response()->json(['message' => 'You don\'t have permission to perform this action. Please contact site administrator'])->setStatusCode(403);
    }

    public function checkIfBetsExist(Request $request) {
        $gwId = $request->input('gwid');
        $user_id = $request->input('user_id');
        $updateFlag = $request->input('update');

        if($updateFlag === 1) {
            if(Auth::id() == 1) {
                $insertArray = [];
                $getFixIDs = Fixtures::where('gameweek', $gwId)->get()->pluck('id')->toArray();
                foreach ($getFixIDs as $key => $value) {
                    $insertArray[] = [
                        'gameweek_id' => $gwId,
                        'fixture_id' => $value,
                        'user_id' => $user_id,
                        'team_id' => '-1',
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s')
                    ];
                }
                DB::table('user_bets')->insert($insertArray);
                return response()->json(['message' => 'Successfully updated.'])->setStatusCode(200);
            } else {
                return response()->json(['message' => 'You do not have access.'])->setStatusCode(403);
            }
        } else {
            $result = Bets::where('gameweek_id', $gwId)->where('user_id', $user_id)->count();
            if($result > 0) {
                return response()->json(['message' => $result])->setStatusCode(200);
            }
            return response()->json(['message' => 'No records found.'])->setStatusCode(403);
        }
    }
}
