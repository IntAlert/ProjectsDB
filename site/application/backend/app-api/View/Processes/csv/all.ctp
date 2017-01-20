<?php


// header
$headers = [
	'Project ID',
	'Dialogue Process ID',
	'Title',
	'Start Date',
	'Finish Date',
	'male_count',
	'female_count',
];

$rows = [];

foreach ($data as $process) {
	$rows[] = [

		$process['Process']['project_id'],
		$process['Process']['id'],
		$process['Process']['title'],
		$process['Process']['start_date'],
		$process['Process']['finish_date'],
		$process['Process']['male_count'],
		$process['Process']['female_count'],
	];
}

$this->CsvResponse->send($headers, $rows);



