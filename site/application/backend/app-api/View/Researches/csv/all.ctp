<?php


// header
$headers = [
	'Project ID',
	'Project Name',
	'Research ID',
	'Title',
	'Budget Holder',
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

	$budgetHolderName = $research['Project']['OwnerUser']['last_name'] . ', ' . $research['Project']['OwnerUser']['first_name'];

	$row = [
		$research['Research']['project_id'],
		$research['Project']['title'],
		$research['Research']['id'],
		$research['Research']['title'],
		$budgetHolderName,
		$research['Research']['start_date'],
		$research['Research']['finish_date'],
	];


	// THEME
	// make list of selected theme ids
	$selected_theme_ids = array_map(function($theme){
		return (int) $theme['id'];
	}, $research['Theme']);
	
	// add all themes, 0 if not selected, 1 if so
	foreach ($themes as $theme_id => $theme_name) {
		$row[] = (int) in_array($theme_id, $selected_theme_ids);
	}


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



