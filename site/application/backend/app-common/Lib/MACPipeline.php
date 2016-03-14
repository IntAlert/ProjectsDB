<?php

class MACPipeline {


	private $year;

	private $contractBudgets = array();
	private $totals = array();

	function __construct($year, $departmentBudgets, $contractBudgets) {
		$this->year = $year;
		$this->departmentBudgets = $departmentBudgets;
		$this->contractBudgets = $contractBudgets;
		$this->asOfDate = new DateTime();
	}

	function getYear() {
		return $this->year;
	}


	function getTotal($department_id, $likelihoods) {

		if (is_string($likelihoods)) $likelihoods = array($likelihoods);
		
		$total = 0;	
		foreach ($this->contractBudgets as $contractBudget) {

			// don't count deleted/corrupted projects
			if (
				   !isset($contractBudget['Contract'])
				|| !isset($contractBudget['Contract']['Project'])
				|| ($contractBudget['Contract']['Project']['deleted'])
				)
			{
				continue;
			}

			$projectStatus = $contractBudget['Contract']['Project']['Status']['short_name'];

			if (is_null($projectStatus)) {

				die($contractBudget['Contract']['Project']['id']);
			}
			$contractLikelihood = $contractBudget['Contract']['Project']['Likelihood']['short_name'];

			// relevant project?
			$department_ok = 
				($department_id == 'all')
				|| ($department_id == $contractBudget['Contract']['Project']['department_id']);

			// relevant likelihood
			$likelihood_ok = array_search($contractLikelihood, $likelihoods) !== FALSE;

			// remove deleted projects
			$project_deleted = $contractBudget['Contract']['Project']['deleted'];

			// ignore if project is rejected, cancelled or deleted
			$project_ok = !$project_deleted && ($projectStatus != 'rejected') && ($projectStatus != 'cancelled') ;

			// remove deleted contracts
			$contract_ok = !$contractBudget['Contract']['deleted'];

			if (!$department_ok || !$likelihood_ok || !$project_ok || !$contract_ok) {
				continue;
			}



			if ($contractBudget['Contractbudget']['year'] == $this->getYear()) {

				$total += $contractBudget['Contractbudget']['value_gbp'];

			}


		}

		return $total;
	}

	function getBudget($department_id) {


		if ($department_id == 'all') {
			$budget = array_sum($this->departmentBudgets);
		} elseif (isset($this->departmentBudgets[$department_id])) {
			$budget = $this->departmentBudgets[$department_id];
		} else {
			$budget = 0;
		}
		
		return $budget;
	}

	

	function getRatio($department_id, $statuses) {

		// avoid divide by zero
		if ($this->getBudget($department_id)) {
			$ratio = $this->getTotal($department_id, $statuses) / $this->getBudget($department_id);
		} else {
			$ratio = 1;
		}
		return $ratio;
	}

	function getPercentage($department_id, $statuses) {
		return $this->getRatio($department_id, $statuses) * 100;
	}

}