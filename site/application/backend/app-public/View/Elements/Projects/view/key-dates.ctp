<?php


// build up dates 

$all_dates = [
	[
		'title' => 'Project Start',
		'date' => $project['Project']['start_date'],
	],
	[
		'title' => 'Project Finish',
		'date' => $project['Project']['finish_date'],
	],
];

// add key dates
foreach ($project['Projectdate'] as $projectdate) {
	$all_dates[] = [
		'title' => $projectdate['title'],
		'date' => $projectdate['date'],
	];
}

// add contract audit dates
foreach ($project['Contract'] as $contract) {
	if ($contract['audit_required'] && $contract['audit_date'])
	$all_dates[] = [
		'title' => "Contract Audit Date",
		'date' => $contract['audit_date'],
	];
}


// order them
usort($all_dates, function($a, $b){
	$a_timestamp = strtotime($a['date']);
	$b_timestamp = strtotime($b['date']);

	return $a_timestamp > $b_timestamp;
});


// format dates
array_walk($all_dates, function( &$pd ){
	$pd['date_formatted'] = DateTime::createFromFormat('Y-m-d', $pd['date'])->format('d/m/Y');
});

?>


<div class="summary block">
	<h3>Key Dates</h3>

	<table>
		<thead>
			<tr>
				<th>Title</th>
				<th>Date</th>
			</tr>
		</thead>


		<tbody>

			<?php foreach ($all_dates as $date): ?>
			
				<tr>
					<td><?php echo $date['title']; ?></td>
					<td><?php echo $date['date_formatted']; ?></td>
				</tr>

			<?php endforeach; // ($dates as $date): ?>

		</tbody>

	</table>

</div>