<?php

// header
$headers = [
	'Project ID',
	'Accompaniment ID',
	'Title',
	'Start Date',
	'Finish Date',
];

$rows = [];

foreach ($data as $accompaniment) {
	$rows[] = [

		$accompaniment['Accompaniment']['project_id'],
		$accompaniment['Accompaniment']['id'],
		$accompaniment['Accompaniment']['title'],
		$accompaniment['Accompaniment']['start_date'],
		$accompaniment['Accompaniment']['finish_date'],
	];
}

$this->CsvResponse->send($headers, $rows);



