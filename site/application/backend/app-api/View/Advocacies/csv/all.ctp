<?php


// header
$headers = [
	'Project ID',
	'Project Name',
	'Advocacy ID',
	'Title',
	'Budget Holder',
	'Start Date',
	'Finish Date',
	'Male Count',
	'Female Count',
	'Transgender Count',
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

foreach ($data as $advocacy) {

	$budgetHolderName = $advocacy['Project']['OwnerUser']['last_name'] . ', ' . $advocacy['Project']['OwnerUser']['first_name'];

	$row = [
		$advocacy['Advocacy']['project_id'],
		$advocacy['Project']['title'],
		$advocacy['Advocacy']['id'],
		$advocacy['Advocacy']['title'],
		$budgetHolderName,
		$advocacy['Advocacy']['start_date'],
		$advocacy['Advocacy']['finish_date'],
		$advocacy['Advocacy']['male_count'],
		$advocacy['Advocacy']['female_count'],
		$advocacy['Advocacy']['transgender_count'],
	];


	// ACCOMPANIMENT PARTICIPANT_TYPE
	// make list of selected participant_type ids
	$selected_participant_type_ids = array_map(function($participant_type){
		return (int) $participant_type['id'];
	}, $advocacy['ParticipantType']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($participant_types as $participant_type_id => $participant_type_name) {
		$row[] = (int) in_array($participant_type_id, $selected_participant_type_ids);
	}

	// THEME
	// make list of selected theme ids
	$selected_theme_ids = array_map(function($theme){
		return (int) $theme['id'];
	}, $advocacy['Theme']);
	
	// add all themes, 0 if not selected, 1 if so
	foreach ($themes as $theme_id => $theme_name) {
		$row[] = (int) in_array($theme_id, $selected_theme_ids);
	}

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $advocacy['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $advocacy['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}

	$rows[] = $row;

}

$this->CsvResponse->send($headers, $rows, 'advocacies', $this->request->query);



