<?php


class MACPipelineByDepartment {

	private $year = false;
	private $departmentBudgetThisYear = false;
	private $departmentBudgetNextYear = false;

	function __construct(
			$year, 
			$projects, 
			$departmentBudgetThisYear, 
			$departmentBudgetNextYear,
			$departmentUnrestrictedAllocationThisYear, 
			$departmentUnrestrictedAllocationNextYear
		) {
		$this->year = $year;
		$this->projects = $projects;
		$this->departmentBudgetThisYear = $departmentBudgetThisYear;
		$this->departmentBudgetNextYear = $departmentBudgetNextYear;
		$this->departmentUnrestrictedAllocationThisYear = $departmentUnrestrictedAllocationThisYear;
		$this->departmentUnrestrictedAllocationNextYear = $departmentUnrestrictedAllocationNextYear;

		// flatten/extract relevant project/contract data
		$this->flattenProjects();
	}

	function getFlattenedProjects($likelihoods = array()) {
		$projects = array();
		foreach ($this->flattenedProjects as $flattenedProject) {
			$likelihood_ok = array_search($flattenedProject['likelihood_short_name'], $likelihoods) !== FALSE;

			if ($likelihood_ok) $projects[] = $flattenedProject;
			
		}

		// sort on primary territory name
		uasort($projects, function($a, $b){

			if(count($a['territory_names']) && count($b['territory_names'])) {
				// both have territory names
				$a_name = $a['territory_names'][0];
				$b_name = $b['territory_names'][0];

				if ($a_name > $b_name) return 1;
				elseif ($a_name < $b_name) return -1;
				else return 0; 

			} elseif(count($a['territory_names'])) {
				// a has territory name, b does not
				return 1;

			} elseif(count($b['territory_names'])) {
				// b has territory name, a does not
				return -1;
			} else {
				return 0;
			}


		});



		return $projects;
	}

	function getTotalBudgetThisYear($likelihoods = array(), $includeUnrestricted = false) {
		return $this->getTotalBudgetByYear($likelihoods, 'this', $includeUnrestricted);
	}

	function getTotalBudgetNextYear($likelihoods = array(), $includeUnrestricted = false) {
		return $this->getTotalBudgetByYear($likelihoods, 'next', $includeUnrestricted);
	}

	function getPercentageBudgetThisYear($likelihoods = array(), $includeUnrestricted = false) {
		if ($this->departmentBudgetThisYear) {
			return 100 * $this->getTotalBudgetByYear($likelihoods, 'this', $includeUnrestricted) / $this->departmentBudgetThisYear;
		} else {
			return 100;
		}
		
	}

	function getPercentageBudgetNextYear($likelihoods = array(), $includeUnrestricted = false) {
		if ($this->departmentBudgetNextYear) {
			return 100 * $this->getTotalBudgetByYear($likelihoods, 'next', $includeUnrestricted) / $this->departmentBudgetNextYear;
		} else {
			return 100;
		}
	}

	function getPercentageUnrestrictedAllocationThisYear() {
		if ( !$this->departmentBudgetThisYear ) {
			return 100;
		} elseif ( !$this->departmentUnrestrictedAllocationThisYear ){
			return 0;
		} else {
			return 100 * $this->departmentUnrestrictedAllocationThisYear / $this->departmentBudgetThisYear;	
		}
	}

	function getPercentageUnrestrictedAllocationNextYear() {
		if ( !$this->departmentBudgetNextYear ) {
			return 100;
		} elseif ( !$this->departmentUnrestrictedAllocationNextYear ){
			return 0;
		} else {
			return 100 * $this->departmentUnrestrictedAllocationNextYear / $this->departmentBudgetNextYear;	
		}
	}



	// Private functions

	private function getTotalBudgetByYear($likelihoods = array(), $which_year, $includeUnrestricted = false) {

		// check which year is valid
		switch ($which_year) {
			case 'this':
				$year_key = 'contract_budget_this_year_gbp';
				break;

			case 'next':
				$year_key = 'contract_budget_next_year_gbp';
				break;
			
			default:
				throw new Exception("which_year not valid", 1);
				
				break;
		}

		$total = 0;
		foreach ($this->flattenedProjects as $flattenedProject) {
			$likelihood_ok = array_search($flattenedProject['likelihood_short_name'], $likelihoods) !== FALSE;

			if (!$likelihood_ok) continue; // ignore this project

			// add primary contracts
			$total += $flattenedProject['contract_primary'][$year_key];

			// add secondary contracts

			foreach ($flattenedProject['contracts_secondary'] as $contract_secondary) {
				
				$total += $contract_secondary[$year_key];
			}
		}

		if ($includeUnrestricted) {

			switch ($which_year) {
				case 'this':
					$total += $this->departmentUnrestrictedAllocationThisYear;
					break;

				case 'next':
					$total += $this->departmentUnrestrictedAllocationNextYear;
					break;

				// no default as would be caught earlier
			}

			
		}
		return $total;
	}

	private function flattenProjects() {

		$flattenedProjects = array();

		foreach ($this->projects as $project) {
			

			// build array of territory names
			$territory_names = array();
			foreach($project['Territory'] as $territory) {
				$territory_names[] = $territory['name'];
			}

			// determine primary contract
			$contract_primary = count($project['Contract']) ? $project['Contract'][0] : false;

			// determine secondary contracts
			$contracts_secondary = (count($project['Contract']) > 1) ? array_slice($project['Contract'], 1) : array();


			// Append contract budget this year and next
			$thisYear = $this->year;
			$nextYear = $thisYear + 1;

			// PRIMARY
			$contract_budget_this_year_gbp = 0;
			$contract_budget_next_year_gbp = 0;
			if(isset($contract_primary['Contractbudget'])):
				foreach ($contract_primary['Contractbudget'] as $contractbudget) {
					if ($contractbudget['year'] == $thisYear) {
						$contract_budget_this_year_gbp = $contractbudget['value_gbp'];
					} else if ($contractbudget['year'] == $nextYear) {
						$contract_budget_next_year_gbp = $contractbudget['value_gbp'];
					}
				}
			endif; //(isset($contract_primary['Contractbudget'])):
			$contract_primary['contract_budget_this_year_gbp'] = $contract_budget_this_year_gbp;
			$contract_primary['contract_budget_next_year_gbp'] = $contract_budget_next_year_gbp;

			// SECONDARY
			foreach ($contracts_secondary as &$contract_secondary) { // by ref
				$contract_budget_this_year_gbp = 0;
				$contract_budget_next_year_gbp = 0;
				if(isset($contract_secondary['Contractbudget'])):
					foreach ($contract_secondary['Contractbudget'] as $contractbudget) {
						if ($contractbudget['year'] == $thisYear) {
							$contract_budget_this_year_gbp = $contractbudget['value_gbp'];
						} else if ($contractbudget['year'] == $nextYear) {
							$contract_budget_next_year_gbp = $contractbudget['value_gbp'];
						}
					}
				endif; //(isset($contract_secondary['Contractbudget'])):
				$contract_secondary['contract_budget_this_year_gbp'] = $contract_budget_this_year_gbp;
				$contract_secondary['contract_budget_next_year_gbp'] = $contract_budget_next_year_gbp;
			}
			unset($contract_secondary); // by ref




			// calculate total value of primary and secondary contracts
			$contract_primary_value_gbp = 0;
			if(isset($contract_primary['Contractbudget'])):
				foreach($contract_primary['Contractbudget'] as $contractbudget) {
					$contract_primary_value_gbp += (float)$contractbudget['value_gbp'];
				}
			endif; //(isset($contract_primary['Contractbudget'])):

			$contracts_secondary_value_gbp = 0;
			foreach ($contracts_secondary as $contract_secondary) {
				if(isset($contract_secondary['Contractbudget'])):
					foreach($contract_secondary['Contractbudget'] as $contractbudget) {
						$contracts_secondary_value_gbp += (float)$contractbudget['value_gbp'];
					}
				endif;
			}

			// determine matched_funding_percentage
			if (!$contract_primary) {
				// shouldn't happen
				$matched_funding_percentage = false; // i.e. n/a
			} elseif ($contract_primary_value_gbp < $project['Project']['value_required']) {
				// matched funding is required
				$matched_funding_percentage = 100 * $contracts_secondary_value_gbp / ($project['Project']['value_required'] - $contract_primary_value_gbp);
			} else {
				$matched_funding_percentage = false;
			}

			// calculate project duration in months
			if ($project['Project']['start_date'] && $project['Project']['finish_date']) {
				$startDate = new DateTime(($project['Project']['start_date']));
				$finishDate = new DateTime(($project['Project']['finish_date']));
				$duration = $finishDate->diff($startDate, true);

				// too lazy to get real answer
				// gives at leat one month if not a one day project
				$duration_months = ceil($duration->m + $duration->d/30); 
			} else {
				$duration_months = 0;
			}
			



			$flattenedProject = array(
				'id' => $project['Project']['id'],
				'title' => $project['Project']['title'],
				'likelihood_short_name' => $project['Likelihood']['short_name'],
				'Territory' => $project['Territory'], // all contracts
				'territory_names' => $territory_names,
				'fund_code' => $project['Project']['fund_code'],

				// dates
				'proposal_date' => $project['Project']['proposal_date'],
				'start_date' => $project['Project']['start_date'],
				'finish_date' => $project['Project']['finish_date'],
				'duration_months' => $duration_months,

				'value_required' => $project['Project']['value_required'],

				'Contract' => $project['Contract'], // all contracts
				'contract_primary' => $contract_primary,
				'contracts_secondary' => $contracts_secondary,

				'matched_funding_percentage' => $matched_funding_percentage,

			);

			array_push($flattenedProjects, $flattenedProject);


		}

		$this->flattenedProjects = $flattenedProjects;
	}


	


}