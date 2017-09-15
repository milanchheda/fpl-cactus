@extends('layouts.app')
@section('content')
<div class="container">
	<button class="btn btn-primary artisan-button" id="getFixtures">Get Fixtures</button>
	<button class="btn btn-primary artisan-button" id="getTeams">Get Teams</button>
	<button class="btn btn-primary artisan-button" id="getGameweeks">Get Gameweeks</button>
	<button class="btn btn-primary artisan-button" id="getPlayers">Get Players</button>
</div>
<div class="container">
	<div class="alert margin-top-10" id='errorSuccessMessageContainer'></div>
</div>
@endsection
