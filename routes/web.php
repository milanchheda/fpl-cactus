<?php

use App\Events\MessagePosted;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('coming_soon');
// });

Route::get('/chat', function () {
    return view('chat');
});

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'FplPlayersController@index');
Route::get('/give-bets', ['middleware' => 'auth', 'uses' => 'BetsController@getBets']);
Route::get('/stats', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::post('/fixtures', ['middleware' => 'auth', 'uses' => 'FixturesController@show']);
Route::post('/get-user-bets', ['middleware' => 'auth', 'uses' => 'BetsController@getUserBets']);
Route::post('/get-stats', ['middleware' => 'auth', 'uses' => 'BetsController@getStats']);
Route::post('/gameweek/next', ['middleware' => 'auth', 'uses' => 'GameweekController@next']);
Route::post('/bets/store', ['middleware' => 'auth', 'uses' => 'BetsController@saveBets']);



Route::get('/messages', function () {
    return App\Message::with('user')->get();
})->middleware('auth');
Route::post('/messages', function () {
    // Store the new message
    $user = Auth::user();
    $message = $user->messages()->create([
        'message' => request()->get('message')
    ]);
    // Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user))->toOthers();
    return ['status' => 'OK'];
})->middleware('auth');
