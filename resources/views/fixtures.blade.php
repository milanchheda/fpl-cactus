<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Team 1</th>
				<th colspan="2">Score</th>
				<th>Team 2</th>
				<th>Your Bet</th>
			</tr>
		</thead>
		<tbody>
			@foreach($allFixtures as $fixture)
				<tr data-fixture-id="{{ $fixture->id }}" id="team-{{ $fixture->id }}" data-winning-team-id="{{ $fixture->winning_team_id }}">
					<td id="{{ $fixture->home_team_id }}" class="col-md-5 text-right">
					{{ $fixture->home_team }}
					</td>
						<td class="col-md-1 text-center">{{ $fixture->team_home_score }}</td>
						<td class="col-md-1 text-center">{{ $fixture->team_away_score }}</td>
					<td id="{{ $fixture->away_team_id }}" class="col-md-5 text-left">
					{{ $fixture->away_team }}
					</td>
					<td class="user-bet"></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
