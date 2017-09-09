<?php $count = 0; ?>
@if(count($userArray) > 0)
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
				<?php $count++; ?>
				<tr>
					<td>{{ $key }}</td>
					<td>{{ $value['amount'] }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class='alert alert-info margin-top-10'>
		No bets found OR Matches in this gameweek are yet to finish. Come again later.
	</div>
@endif
@if(isset($newQuery) && $count > 0)
<?php $fixtureArray = [];
	$newArray = array_map(function($v){
		return $v->name;
	}, $newQuery);
?>
<div class="table-responsive">
	<table class="table stats-table">
		<thead>
			<tr>
			<th></th>
			<th>Result</th>
			@for($i = 0; $i < count(array_unique($newArray)); $i++)
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
