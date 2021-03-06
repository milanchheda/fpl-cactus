<?php $count = 0; $total = 0; ?>
@if(count($userArray) > 0)
<div class="table-responsive">
	<table class="table stats-table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Points</th>
			</tr>
		</thead>
		<tbody>
			@foreach($userArray as $key => $value)
				<?php
				$shapeClass = 'shape4';
				if($count == 0)
					$shapeClass = 'shape1';
				elseif($count == 1)
					$shapeClass = 'shape2';
				elseif($count == 2)
					$shapeClass = 'shape3';
				$count++;
				?>
				<tr>
					<td><span class=<?php echo $shapeClass; ?>></span></td>
					<td>{{ $key }}</td>
					<td>{{ round($value['amount']) }}</td>
				</tr>
				<?php $total = $total + round($value['amount']); ?>
			@endforeach
		</tbody>
	</table>
</div>
<!-- <div class="row">
	<span>Total: {{ $total }}</span>
</div> -->
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
	<table class="table stats-table-each table-striped">
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
						echo "<td class='col-md-1'>" . $newQuery[$i]->fixture . "</td>";
						echo "<td class='col-md-1'>" . $winningTeam . "</td>";
						array_push($fixtureArray, $newQuery[$i]->fixture);
					}
					if($newQuery[$i]->userBetTeamId == -1){
						echo "<td class='col-md-1'>FORGOT</td>";
					} else if($newQuery[$i]->userBetTeamId == 0){
						echo "<td class='col-md-1'>DRAW</td>";
					} else if($newQuery[$i]->userBetTeamId == $newQuery[$i]->winningTeamId){
						echo "<td class='col-md-1'>" . $winningTeam . "</td>";
					} else {
						if($newQuery[$i]->userBetTeamId == $teamOneArray[0])
							echo "<td class='col-md-1'>" . $teamOneArray[1] . "</td>";
						else
							echo "<td class='col-md-1'>" . $teamTwoArray[1] . "</td>";
					}
					?>
			@endfor
			</tr>
		</tbody>
	</table>
</div>
@endif
