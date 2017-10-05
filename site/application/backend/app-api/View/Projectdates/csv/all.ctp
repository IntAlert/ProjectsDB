<?php

// header
$headers = [
	'Key Date Type',
	'Key Date',
	'Key Date Title',
	'Project Name',
	'Title',
	'Budget Holder',
	'Budget Holder Email',
	'Completed'
];

$rows = [];
foreach($data as $projectdate):

	$rows[] = array(
		$projectdate['Projectdate']['type'],
		$projectdate['Projectdate']['date'],
		$projectdate['Projectdate']['title'],
		$projectdate['Project']['title'],
		$projectdate['Project']['OwnerUser']['first_name'] . ' ' . $projectdate['Project']['OwnerUser']['Office365user']['email'],
		$projectdate['Projectdate']['completed'] ? 'YES' : 'NO',
	);

endforeach; //($rows as $projectdate):


$this->CsvResponse->send($headers, $rows, 'PROMPT-key-dates', $this->request->query);