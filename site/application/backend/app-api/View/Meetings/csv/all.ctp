<?php


// header
$headers = [
	'Project ID',
	'Dialogue Meeting ID',
	'Title',
	'Start Date',
	'Finish Date',
	'male_count',
	'female_count',
];


// add territory headers
foreach ($territories as $territory_id => $territory_name) {
	$headers[] = 'TERRITORY: ' . $territory_name;
}

// add pathway headers
foreach ($pathways as $pathway_id => $pathway_name) {
	$headers[] = 'PATHWAY: ' . $pathway_name;
}

// add participant_type headers
foreach ($participant_types as $participant_type_id => $participant_type_name) {
	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
}

$rows = [];

foreach ($data as $meeting) {
	$row = [

		$meeting['Meeting']['project_id'],
		$meeting['Meeting']['id'],
		$meeting['Meeting']['title'],
		$meeting['Meeting']['start_date'],
		$meeting['Meeting']['finish_date'],
		$meeting['Meeting']['male_count'],
		$meeting['Meeting']['female_count'],
	];

	// Add associated data, column by column

	// PROJECT TERRITORY
	// make list of selected territory ids
	$selected_territory_ids = array_map(function($territory){
		return (int) $territory['id'];
	}, $meeting['Project']['Territory']);
	
	// add all territories, 0 if not selected, 1 if so
	foreach ($territories as $territory_id => $territory_name) {
		$row[] = (int) in_array($territory_id, $selected_territory_ids);
	}

	// PROJECT PATHWAY
	// make list of selected pathway ids
	$selected_pathway_ids = array_map(function($pathway){
		return (int) $pathway['id'];
	}, $meeting['Project']['Pathway']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($pathways as $pathway_id => $pathway_name) {
		$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	}

	// ACCOMPANIMENT PARTICIPANT_TYPE
	// make list of selected participant_type ids
	$selected_participant_type_ids = array_map(function($participant_type){
		return (int) $participant_type['id'];
	}, $meeting['ParticipantType']);

	// add all pathways, 0 if not selected, 1 if so
	foreach ($participant_types as $participant_type_id => $participant_type_name) {
		$row[] = (int) in_array($participant_type_id, $selected_participant_type_ids);
	}



	$rows[] = $row;
}

$this->CsvResponse->send($headers, $rows, 'meetings', $this->request->query);



