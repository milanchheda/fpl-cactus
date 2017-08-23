<div class="table-responsive">
	<table class="table stats-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($getStats as $stat)
				<tr>
					<td>{{ $stat->name }}</td>
					<td>{{ $stat->winningAmount }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
