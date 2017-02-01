<?php


// header
$headers = [
	'Project ID',
	'Project Name',
	'Result ID',
	'Title',
	'Date',
	'Who are you?',
	'Who did something differently?',
	'What - tell us what they did differently',
	'Where and when?',
	'Significance',
	'Partner Contribution',
	'Alert Contribution',
	'Evidence',
];

// add impact headers
foreach ($impacts as $impact_id => $impact_name) {
	$headers[] = 'IMPACT: ' . $impact_name;
}

// add territory headers
foreach ($territories as $territory_id => $territory_name) {
	$headers[] = 'TERRITORY: ' . $territory_name;
}

// add pathway headers
foreach ($pathways as $pathway_id => $pathway_name) {
	$headers[] = 'PATHWAY: ' . $pathway_name;
}

$rows = [];

foreach ($data as $result) {
	$row = [

		$result['Result']['project_id'],
		$result['Project']['title'],
		$result['Result']['id'],
		$result['Result']['title'],
		$result['Result']['date'],

		$result['Result']['reporter'],
		$result['Result']['who'],
		$result['Result']['what'],
		$result['Result']['where'],
		$result['Result']['significance'],
		$result['Result']['contribution_partner'],
		$result['Result']['contribution_alert'],
		$result['Result']['evidence'],
	];


	// IMPACT
	// make list of selected territory ids
	$selected_impact_ids = array_map(function($impact){
		return (int) $impact['id'];
	}, $result['Impact']);
	
	// add all impacts, 0 if not selected, 1 if so
	foreach ($impacts as $impact_id => $impact_name) {
		$row[] = (int) in_array($impact_id, $selected_impact_ids);
	}

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $result['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $result['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}


	$rows[] = $row;

}

$this->CsvResponse->send($headers, $rows, 'results', $this->request->query);

