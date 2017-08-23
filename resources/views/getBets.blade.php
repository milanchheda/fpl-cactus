@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row container">
	    <div class="row">
			<h2 class="h2">Gameweek: {{ $allFixtures->gameweek_id }}</h2>
	    </div>
		<div class="table-responsive">
			<table class="table">
			@foreach($allFixtures as $fixture)
				<tr data-fixture-id="{{ $fixture->id }}">
					<td id="{{ $fixture->home_team_id }}" class="col-md-5 text-right set-bet">
						<span class="checkmark pull-left">
						    <div class="checkmark_stem"></div>
						    <div class="checkmark_kick"></div>
						</span>
					{{ $fixture->home_team }}
					</td>
					<td class="col-md-2 text-center draw-bet">DRAW</td>
					<td id="{{ $fixture->away_team_id }}" class="col-md-5 text-left set-bet">
					{{ $fixture->away_team }}
						<span class="checkmark pull-right">
						    <div class="checkmark_stem"></div>
						    <div class="checkmark_kick"></div>
						</span>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
		<div class="container row">
			<div class="form-group">
				<button type="button" class="btn btn-success pull-right" id="save-my-bets">Save My Bets</button>
			</div>
		</div>
	</div>
</div>
@endsection

