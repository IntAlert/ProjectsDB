<?php

// header
$headers = [
	'Project ID',
	'Other Activity ID',
	'Title',
	'Start Date',
	'Finish Date',
	'male_count',
	'female_count',
];

// add theme headers
foreach ($participant_types as $participant_type_id => $participant_type_name) {
	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
}

$rows = [];

foreach ($data as $other_activity) {
	$row = [
		$other_activity['OtherActivity']['project_id'],
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

	$rows[] = $row;

}

$this->CsvResponse->send($headers, $rows);



