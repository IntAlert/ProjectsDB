<?php

// header
$headers = [
	'Project ID',
	'Project Name',
	'Other Activity ID',
	'Title',
	'Budget Holder',
	'Start Date',
	'Finish Date',
	'Male Count',
	'Female Count',
	'Transgender Count',
];

// add participant type headers
foreach ($participant_types as $participant_type_id => $participant_type_name) {
	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
}


// add theme headers
foreach ($themes as $theme_id => $theme_name) {
	$headers[] = 'THEME: ' . $theme_name;
}

// add continent headers
foreach ($continents as $continent_id => $continent_name) {
	$headers[] = 'CONTINENT: ' . $continent_name;
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

foreach ($data as $other_activity) {
	
	$budgetHolderName = $other_activity['Project']['OwnerUser']['last_name'] . ', ' . $other_activity['Project']['OwnerUser']['first_name'];

	$row = [
		$other_activity['OtherActivity']['project_id'],
		$other_activity['Project']['title'],
		$other_activity['OtherActivity']['id'],
		$other_activity['OtherActivity']['title'],
		$budgetHolderName,
		$other_activity['OtherActivity']['start_date'],
		$other_activity['OtherActivity']['finish_date'],
		$other_activity['OtherActivity']['male_count'],
		$other_activity['OtherActivity']['female_count'],
		$other_activity['OtherActivity']['transgender_count'],
	];

	// PARTICIPANT TYPE
	// make list of selected participant_type ids
	$selected_participant_type_ids = array_map(function($participant_type){
		return (int) $participant_type['id'];
	}, $other_activity['ParticipantType']);
	
	// add all participant_types, 0 if not selected, 1 if so
	foreach ($participant_types as $participant_type_id => $participant_type_name) {
		$row[] = (int) in_array($participant_type_id, $selected_participant_type_ids);
	}

	// THEME
	// make list of selected theme ids
	$selected_theme_ids = array_map(function($theme){
		return (int) $theme['id'];
	}, $other_activity['Project']['Theme']);
	
	// add all themes, 0 if not selected, 1 if so
	foreach ($themes as $theme_id => $theme_name) {
		$row[] = (int) in_array($theme_id, $selected_theme_ids);
	}

	// PROJECT CONTINENT
	// make list of selected territory ids
	$selected_continents_ids = array_map(function($territory){
		return (int) $territory['continent_id'];
	}, $other_activity['Project']['Territory']);

	// add all continents, 0 if not selected, 1 if so
	foreach ($continents as $continent_id => $continent_name) {
		$row[] = (int) in_array($continent_id, $selected_continents_ids);
	}

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $other_activity['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $other_activity['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}

	$rows[] = $row;

}

$this->CsvResponse->send($headers, $rows, 'other_activities', $this->request->query);


