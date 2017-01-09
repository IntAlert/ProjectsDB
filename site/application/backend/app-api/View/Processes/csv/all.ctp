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

foreach ($data as $training) {
	$rows[] = [

		$training['Process']['project_id'],
		$training['Process']['id'],
		$training['Process']['title'],
		$training['Process']['start_date'],
		$training['Process']['finish_date'],
		$training['Process']['male_count'],
		$training['Process']['female_count'],
	];
}

$this->CsvResponse->send($headers, $rows);



