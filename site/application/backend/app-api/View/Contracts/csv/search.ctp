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

	// Belongs to fields
	'Status',
	'Likelihood',
	'Department',
	'Secondary Department',
];



$rows = [];

foreach ($contracts as $contract) {
	$row = [

		// Contract ID
		$contract['Contract']['id'],

		// Project fields
		$contract['Project']['id'],
		$contract['Project']['title'],
		$contract['Project']['fund_code'],
		$contract['Project']['solicited_proposal'],
		$contract['Project']['submission_date'],
		$contract['Project']['start_date'],
		$contract['Project']['finish_date'],
		$contract['Project']['finish_extended'],
		$contract['Project']['extension_reason'],
		$contract['Project']['value_required'],
		$contract['Project']['value_sourced'],
		$contract['Project']['created'],

		// Donor fields
		$contract['Donor']['name'],
		$contract['Contract']['subdonor_name'],

		// Framework
		$contract['Framework']['name'],

		// Contract Category
		$contract['Contractcategory']['name'],
		
		// Contract fields (ex. ID)
		$contract['Currency']['code'],
		$contract['Contract']['origin_total_value'],
		$contract['Contract']['summary'],
		$contract['Contract']['commercial_tender'],
		$contract['Contract']['lead_contractor'],
		
		// Project's Belongs to fields
		$contract['Project']['Status']['name'],
		empty($contract['Project']['Likelihood']) ? 'n/a': $contract['Project']['Likelihood']['name'],
		$contract['Project']['Department']['name'],
		empty($contract['Project']['SecondaryDepartment']) ? 'none': $contract['Project']['SecondaryDepartment']['name'],
		
	];

	$rows[] = $row;
}

$this->CsvResponse->send($headers, $rows, 'projects', $this->request->query);


