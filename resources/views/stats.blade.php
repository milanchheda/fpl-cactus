<div class="table-responsive">
	<table class="table stats-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($userArray as $key => $value)
				<tr>
					<td>{{ $key }}</td>
					<td>{{ $value['amount'] }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@if(isset($newQuery))
<?php $count = 0; $fixtureArray = [];?>
<div class="table-responsive">
	<table class="table stats-table">
		<thead>
			<tr>
			<th></th>
			<th>Result</th>
			@for($i = 0; $i < 8; $i++)
				<th>{{ $newQuery[$i]->name }}</th>
			@endfor
			</tr>
		</thead>
		<tbody>
			<tr>
			@for($i = 0; $i < count($newQuery); $i++)
					<?php
					$teamOneArray = explode('-', $newQuery[$i]->teamOneName);
					$teamTwoArray = explode('-', $newQuery[$i]->teamTwoName);

					if(!in_array($newQuery[$i]->fixture, $fixtureArray)) {
						$winningTeam = ($newQuery[$i]->winningTeamId == 0) ? 'DRAW' : $newQuery[$i]->winningTeam;
						if(count($fixtureArray) > 0)
							echo "</tr><tr>";
						echo "<td>" . $newQuery[$i]->fixture . "</td>";
						echo "<td>" . $winningTeam . "</td>";
						array_push($fixtureArray, $newQuery[$i]->fixture);
					}

					if($newQuery[$i]->userBetTeamId == 0){
						echo "<td>DRAW</td>";
					} else if($newQuery[$i]->userBetTeamId == $newQuery[$i]->winningTeamId){
						echo "<td>" . $winningTeam . "</td>";
					} else {
						if($newQuery[$i]->userBetTeamId == $teamOneArray[0])
							echo "<td>" . $teamOneArray[1] . "</td>";
						else
							echo "<td>" . $teamTwoArray[1] . "</td>";
					}
					?>
			@endfor
			</tr>
		</tbody>
	</table>
</div>
@endif
