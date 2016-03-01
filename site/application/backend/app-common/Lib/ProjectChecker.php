<?php


class ProjectChecker {


	private $project;

	function __construct($project) {

		// normalise
		if (!isset($project['Project'])) {
			$project['Project'] = $project;
		}

		$this->project = $project;
	}

	function hasValidDates() {

		if (is_null($this->project['Project']['start_date'])) {
			return false;			
		} elseif (is_null($this->project['Project']['finish_date'])) {
			return false;			
		}
		return true;

	}

	function hasValidAnnualBudgets($startYear = null, $finishYear = null) {

		if (!$this->hasValidDates()) return false;

		// default to start 
		if ( is_null($startYear)) {
			$startYear = (int)date('Y', strtotime($this->project['Project']['start_date']));	
		}

		if ( is_null($finishYear)) {
			$finishYear = (int)date('Y', strtotime($this->project['Project']['finish_date']));
		}

		$requiredYears = range($startYear, $finishYear);
		$presentYears = [];

		foreach ($this->project['Contract'] as $contract) {
			foreach ($contract['Contractbudget'] as $contractbudget) {

				// use keys to get unique years
				$presentYears[$contractbudget['year']] = true;
			}
		}

		// turn keys into values
		$presentYears = array_keys($presentYears);


		// if ($this->project['Project']['id'] == 48) debug(get_defined_vars());


		// should be same years
		if (
			count($requiredYears) != count($presentYears)
			|| count(array_diff($requiredYears, $presentYears))
			) {
			return false;
		}

		return true;

	}

	function hasValidTerritories() {
		return !! count($this->project['Territory']); // at least one?
	}

	function hasAtLeastOneContract() {
		return !! count($this->project['Contract']); // at least one?
	}

}