<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/give-bets', ['middleware' => 'auth', 'uses' => 'BetsController@getBets']);
Route::get('/stats', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::post('/fixtures', ['middleware' => 'auth', 'uses' => 'FixturesController@show']);
Route::post('/get-user-bets', ['middleware' => 'auth', 'uses' => 'BetsController@getUserBets']);
Route::post('/get-stats', ['middleware' => 'auth', 'uses' => 'BetsController@getStats']);
Route::post('/gameweek/next', ['middleware' => 'auth', 'uses' => 'GameweekController@next']);
Route::post('/bets/store', ['middleware' => 'auth', 'uses' => 'BetsController@saveBets']);

