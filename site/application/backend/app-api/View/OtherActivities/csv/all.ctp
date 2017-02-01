<?php

// header
$headers = [
	'Project ID',
	'Project Name',
	'Other Activity ID',
	'Title',
	'Start Date',
	'Finish Date',
	'male_count',
	'female_count',
];

// add participant type headers
foreach ($participant_types as $participant_type_id => $participant_type_name) {
	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
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
	$row = [
		$other_activity['OtherActivity']['project_id'],
		$other_activity['Project']['title'],
		$other_activity['OtherActivity']['id'],
		$other_activity['OtherActivity']['title'],
		$other_activity['OtherActivity']['start_date'],
		$other_activity['OtherActivity']['finish_date'],
		$other_activity['OtherActivity']['male_count'],
		$other_activity['OtherActivity']['female_count'],
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


