<?php


// header
$headers = [
	'Project ID',
	'Training ID',
	'Ti"tle',
	'Date',
	'male_count',
	'female_count',
];

$rows = [];

foreach ($data as $training) {
	$rows[] = [

		$training['Training']['project_id'],
		$training['Training']['id'],
		$training['Training']['title'],
		$training['Training']['date'],
		$training['Training']['male_count'],
		$training['Training']['female_count'],
	];
}

$this->CsvResponse->send($headers, $rows);



