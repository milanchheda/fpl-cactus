@extends('layouts.app')
@section('content')
<div class="container">
	<button class="btn btn-primary artisan-button" id="getFixtures">Get Fixtures</button>
	<button class="btn btn-primary artisan-button" id="getTeams">Get Teams</button>
	<button class="btn btn-primary artisan-button" id="getGAmeweeks">Get Gameweeks</button>
</div>
<div class="container">
	<div class="alert margin-top-10" id='errorSuccessMessageContainer'></div>
</div>
@endsection
