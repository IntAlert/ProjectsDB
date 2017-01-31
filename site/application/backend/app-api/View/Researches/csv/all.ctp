<?php


// header
$headers = [
	'Project ID',
	'Research ID',
	'Title',
	'Start Date',
	'Finish Date',
];

// add theme headers
foreach ($themes as $theme_id => $theme_name) {
	$headers[] = 'THEME: ' . $theme_name;
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

foreach ($data as $research) {
	$row = [

		$research['Research']['project_id'],
		$research['Research']['id'],
		$research['Research']['title'],
		$research['Research']['start_date'],
		$research['Research']['finish_date'],
	];


	// TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $research['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $research['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}

	$rows[] = $row;

}

$this->CsvResponse->send($headers, $rows, 'researches', $this->request->query);



