<?php

// build a human-readable description of the search

if ($this->request->query('action')):

	$criteria = [];

	if($q = $this->request->query('q')) {
		$criteria[] = 'Project text matching : "' . h($q) . '"';
	}

	if($donor_id = $this->request->query('donor_id')) {
		foreach($donor_id as $donor_id_single):
			$criteria[] = 'Donor: "' . $donors[$donor_id_single] . '"';
		endforeach; //($donor_id as $donor_ids):
	}

	if($status_id = $this->request->query('status_id')) {
		foreach($status_id as $status_id_single):
			$criteria[] = 'Status: "' . $statuses[$status_id_single] . '"';
		endforeach; //($status_id as $donor_ids):
	}

	if($likelihood_id = $this->request->query('likelihood_id')) {
		$criteria[] = 'Likelihood: "' . $likelihoods[$likelihood_id] . '"';
	}

	if($department_id = $this->request->query('department_id')) {
		$criteria[] = 'Programme: "' . $departments[$department_id] . '"';
	}

	if($owner_user_id = $this->request->query('owner_user_id')) {
		$criteria[] = 'Budget Holder: "' . $budget_holders[$owner_user_id] . '"';
	}

	if($territory_id = $this->request->query('territory_id')) {
		$criteria[] = 'Territory: "' . $territories[$territory_id] . '"';
	}

	if($pathway_id = $this->request->query('pathway_id')) {
		$criteria[] = 'Pathway: "' . $pathways[$pathway_id] . '"';
	}

	if($theme_id = $this->request->query('theme_id')) {
		$criteria[] = 'Theme: "' . $themes[$theme_id] . '"';
	}

	if($contractcategory_id = $this->request->query('contractcategory_id')) {
		$criteria[] = 'Contract Category: "' . $contractcategories[$contractcategory_id] . '"';
	}

	if($framework_id = $this->request->query('framework_id')) {
		$criteria[] = 'Framework: "' . $frameworks[$framework_id] . '"';
	}

	if($fund_code = $this->request->query('fund_code')) {
		$criteria[] = 'Fund code: "' . $fund_code . '"';
	}

	if($value_from = $this->request->query('value_from')) {
		$criteria[] = 'Value above: &pound;' . $value_from;
	}

	if($value_to = $this->request->query('value_to')) {
		$criteria[] = 'Value below: &pound;' . $value_to;
	}

	if($start_date = $this->request->query('start_date')) {
		$criteria[] = 'Starting after: ' . $start_date;
	}

	if($finish_date = $this->request->query('finish_date')) {
		$criteria[] = 'Finishing before: ' . $finish_date;
	}




echo '<div class="project-search-summary">';
echo 'You searched for projects matching the following criteria:<br>';
// echo implode($criteria, ', ');
echo '<ul class="clearfix">';
foreach ($criteria as $criterium) {
	echo '<li>' . $criterium  . '</li>';
}
echo "</ul>";
echo '</div>';

endif; // ($this->request->query('action')):