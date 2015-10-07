<?php


class ProjectChecker {


	private $project;

	function __construct($project) {
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

	function hasValidAnnualBudgets() {

		if (!$this->hasValidDates()) return false;

		$startYear = (int)date('Y', strtotime($this->project['Project']['start_date']));
		$finishYear = (int)date('Y', strtotime($this->project['Project']['finish_date']));

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


		// should be same years
		if (
			count($requiredYears) != count($presentYears)
			|| count(array_diff($requiredYears, $presentYears))
			) {
			return false;
		}

		return true;

	}

}