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
	'Submission Date',
	'Start Date',
	'Finish Date',
	'Finish Extended',
	'Extension Reason',
	'Value Required',
	'Value Sourced',
	'Created',
	'Deleted',
];


// add participant_type headers
// foreach ($participant_types as $participant_type_id => $participant_type_name) {
// 	$headers[] = 'PARTICIPANT TYPE: ' . $participant_type_name;
// }

// // add territory headers
// foreach ($territories as $territory_id => $territory_name) {
// 	$headers[] = 'TERRITORY: ' . $territory_name;
// }

// // add pathway headers
// foreach ($pathways as $pathway_id => $pathway_name) {
// 	$headers[] = 'PATHWAY: ' . $pathway_name;
// }


$rows = [];

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
		$project['Project']['submission_date'],
		$project['Project']['start_date'],
		$project['Project']['finish_date'],
		$project['Project']['finish_extended'],
		$project['Project']['extension_reason'],
		$project['Project']['value_required'],
		$project['Project']['value_sourced'],
		$project['Project']['created'],
		$project['Project']['deleted'],

		// Associated Data
		
	];

	// Add associated data, column by column

	// // ACCOMPANIMENT PARTICIPANT_TYPE
	// // make list of selected participant_type ids
	// $selected_participant_type_ids = array_map(function($participant_type){
	// 	return (int) $participant_type['id'];
	// }, $accompaniment['ParticipantType']);

	// // build list of counts
	// $selected_participant_type_counts = [];
	// foreach ($accompaniment['ParticipantType'] as $participant_type) {
		
	// 	$participant_type_id = $participant_type['id'];
	// 	$count = $participant_type['AccompanimentsParticipantType']['count'];

	// 	$selected_participant_type_counts[$participant_type_id] = $count;
	// }


	// // add all pathways, 0 if not selected, 1 if so
	// foreach ($participant_types as $participant_type_id => $participant_type_name) {

	// 	if ( in_array($participant_type_id, $selected_participant_type_ids) ) {
	// 		$value = $selected_participant_type_counts[$participant_type_id];
	// 	} else {
	// 		$value = 0;
	// 	}

	// 	$row[] = $value;
	// }

	// // PROJECT TERRITORY
	// // make list of selected territory ids
	// $selected_territory_ids = array_map(function($territory){
	// 	return (int) $territory['id'];
	// }, $accompaniment['Project']['Territory']);
	
	// // add all territories, 0 if not selected, 1 if so
	// foreach ($territories as $territory_id => $territory_name) {
	// 	$row[] = (int) in_array($territory_id, $selected_territory_ids);
	// }

	// // PROJECT PATHWAY
	// // make list of selected pathway ids
	// $selected_pathway_ids = array_map(function($pathway){
	// 	return (int) $pathway['id'];
	// }, $accompaniment['Project']['Pathway']);

	// // add all pathways, 0 if not selected, 1 if so
	// foreach ($pathways as $pathway_id => $pathway_name) {
	// 	$row[] = (int) in_array($pathway_id, $selected_pathway_ids);
	// }
	

	$rows[] = $row;
}

$this->CsvResponse->send($headers, $rows, 'projects', $this->request->query);


