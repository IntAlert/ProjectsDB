<?php

// header
$headers = [
	'Project ID',
	'Project Name',
	'Fund_code',
	'Summary',
	'Objectives',
	'Goals',
	'Beneficiaries',
	'Location',
	'Partners',
	'Solicited Proposal',
	'Proposal Date',
	'Start Date',
	'Finish Date',
	'Finish Extended',
	'Extension Reason',
	'Value Required',
	'Value Sourced',
	'Created',

	// Belongs to fields
	'Status',
	'Likelihood',
	'Department',
	'Secondary Department',
];

// add territory headers
foreach ($territories as $territory_id => $territory_name) {
	$headers[] = 'TERRITORY: ' . $territory_name;
}

// add pathway headers
foreach ($pathways as $pathway_id => $pathway_name) {
	$headers[] = 'PATHWAY: ' . $pathway_name;
}

// add theme headers
foreach ($themes as $theme_id => $theme_name) {
	$headers[] = 'THEME: ' . $theme_name;
}


$rows = [];

// var_dump($projects);

foreach ($projects as $project) {
	$row = [

		// Project fields
		$project['Project']['id'],
		$project['Project']['title'],
		$project['Project']['fund_code'],
		$project['Project']['summary'],
		$project['Project']['objectives'],
		$project['Project']['goals'],
		$project['Project']['beneficiaries'],
		$project['Project']['location'],
		$project['Project']['partners'],
		$project['Project']['solicited_proposal'],
		$project['Project']['proposal_date'],
		$project['Project']['start_date'],
		$project['Project']['finish_date'],
		$project['Project']['finish_extended'],
		$project['Project']['extension_reason'],
		$project['Project']['value_required'],
		$project['Project']['value_sourced'],
		$project['Project']['created'],

		// Belongs to fields
		$project['Status']['name'],
		$project['Likelihood']['name'],
		$project['Department']['name'],
		$project['SecondaryDepartment']['name'],
		
	];

	// Add associated data, column by column

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $project['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $project['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}

	// PROJECT THEME
	// make list of selected theme ids
	$selected_theme_ids = array_map(function($theme){
		return (int) $theme['id'];
	}, $project['Theme']);

	// add all themes, 0 if not selected, 1 if so
	foreach ($themes as $theme_id => $theme_name) {
		$row[] = (int) in_array($theme_id, $selected_theme_ids);
	}
	

	$rows[] = $row;
}

$this->CsvResponse->send($headers, $rows, 'projects', $this->request->query);


