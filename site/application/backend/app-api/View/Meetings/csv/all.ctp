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

$rows = [];

foreach ($data as $meeting) {
	$rows[] = [

		$meeting['Meeting']['project_id'],
		$meeting['Meeting']['id'],
		$meeting['Meeting']['title'],
		$meeting['Meeting']['start_date'],
		$meeting['Meeting']['finish_date'],
		$meeting['Meeting']['male_count'],
		$meeting['Meeting']['female_count'],
	];
}

$this->CsvResponse->send($headers, $rows);



