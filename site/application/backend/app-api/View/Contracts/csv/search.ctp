<?php

// determine the maximum, minimum years of all annual budgets
$years = [];
foreach ($contracts as $contract) {
	foreach ($contract['Contractbudget'] as $contractbudget) {
		if ($contractbudget['year'])
			$years[$contractbudget['year']] = $contractbudget['year'];
	}
}



$min_annual_budget_year = min($years);
$max_annual_budget_year = max($years);

// header
$headers = [


	// Key fields
	'Contract ID',

	// Donor fields
	'Donor Name',
	'Sub-donor Name',

	'Project ID',
	'Project Title',
	'Fund Code',

	// Project fields
	'Solicited Proposal',
	'Submission Date',
	'Start Date',
	'Finish Date',
	'Finish Extended?',
	'Extension Reason',
	'Value Required',
	'Value Sourced',
	'Project Creation Date',
	
	// Framework
	'Framework', 

	// Contract Category
	'Contract Category',
	
	// Contract fields (ex. ID)
	'Currency Code',
	'Origin Total Value',
	'Summary',
	'Commercial Tender?',
	'Lead Contractor?',

	// Project's Belongs to fields
	'Project Status',
	'Project Likelihood',

	'Department',
	'Secondary Department',
	
];

// Add budget years
for ($y=$min_annual_budget_year; $y <= $max_annual_budget_year; $y++) { 
	$headers[] = 'Budget (GBP) ' . $y;
}



$rows = [];

foreach ($contracts as $contract) {
	$row = [

		// Key fields
		$contract['Contract']['id'],

		// Donor fields
		$contract['Donor']['name'],
		$contract['Contract']['subdonor_name'],

		// Project fields
		$contract['Project']['id'],
		$contract['Project']['title'],
		$contract['Project']['fund_code'],

		// Project fields
		$contract['Project']['solicited_proposal'],
		$contract['Project']['submission_date'],
		$contract['Project']['start_date'],
		$contract['Project']['finish_date'],
		$contract['Project']['finish_extended'],
		$contract['Project']['extension_reason'],
		$contract['Project']['value_required'],
		$contract['Project']['value_sourced'],
		$contract['Project']['created'],

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

	// add a budget for every year
	for ($y=$min_annual_budget_year; $y <= $max_annual_budget_year; $y++) { 
		$matching_budgets = array_filter($contract['Contractbudget'], 
			function($contractbudget) use($y) {
				return ($y == $contractbudget['year']);
			}
		);

		

		if (count($matching_budgets)) {
			$budget = array_values($matching_budgets)[0]['value_gbp'];
		} else {
			$budget = '';
		}

		$row[] = $budget;
	}
	

	$rows[] = $row;

	// if(count($rows) > 2) {
	// 	// var_dump($rows);
	// 	die();	
	// }
	
}

$this->CsvResponse->send($headers, $rows, 'projects', $this->request->query);


