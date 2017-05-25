<?php


// header
$headers = [
	'Project ID',
	'Project Name',
	'Dialogue Process ID',
	'Title',
	'Budget Holder',
	'Start Date',
	'Finish Date',
	'Male Count',
	'Female Count',
	'Conflict Resolution?',
];

// add participant_type headers
foreach ($participant_types as $participant_type_id => $participant_type_name) {
	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
}

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

foreach ($data as $process) {


	$budgetHolderName = $process['Project']['OwnerUser']['last_name'] . ', ' . $process['Project']['OwnerUser']['first_name'];



	$row = [

		$process['Process']['project_id'],
		$process['Project']['title'],
		$process['Process']['id'],
		$process['Process']['title'],
		$budgetHolderName,
		$process['Process']['start_date'],
		$process['Process']['finish_date'],
		$process['Process']['male_count'],
		$process['Process']['female_count'],
		$process['Process']['conflict_resolution'],

	];

	// Add associated data, column by column


	// ACCOMPANIMENT PARTICIPANT_TYPE
	// make list of selected participant_type ids
	$selected_participant_type_ids = array_map(function($participant_type){
		return (int) $participant_type['id'];
	}, $process['ParticipantType']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($participant_types as $participant_type_id => $participant_type_name) {
		$row[] = (int) in_array($participant_type_id, $selected_participant_type_ids);
	}

	// THEME
	// make list of selected theme ids
	$selected_theme_ids = array_map(function($theme){
		return (int) $theme['id'];
	}, $process['Theme']);
	
	// add all themes, 0 if not selected, 1 if so
	foreach ($themes as $theme_id => $theme_name) {
		$row[] = (int) in_array($theme_id, $selected_theme_ids);
	}

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $process['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $process['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}



	$rows[] = $row;
}

$this->CsvResponse->send($headers, $rows, 'processes', $this->request->query);
