<?php


class MACPipeline {


	private $year;

	private $contractBudgets = array();
	private $totals = array();

	function __construct($year, $programmeBudgets, $contractBudgets) {
		$this->year = $year;
		$this->programmeBudgets = $programmeBudgets;
		$this->contractBudgets = $contractBudgets;
		$this->asOfDate = new DateTime();
	}

	function getYear() {
		return $this->year;
	}


	function getTotal($programme_id, $likelihoods) {

		if (is_string($likelihoods)) $likelihoods = array($likelihoods);
		
		$total = 0;
		

		foreach ($this->contractBudgets as $contractBudget) {

			$projectStatus = $contractBudget['Contract']['Project']['Status']['short_name'];
			$contractLikelihood = $contractBudget['Contract']['Project']['Likelihood']['short_name'];

			// relevant project?
			$programme_ok = 
				($programme_id == 'all')
				|| ($programme_id == $contractBudget['Contract']['Project']['programme_id']);

			// relevant likelihood
			$likelihood_ok = array_search($contractLikelihood, $likelihoods) !== FALSE;

			// ignore if project is rejected
			$project_ok = ($projectStatus != 'rejected');

			if (!$programme_ok || !$likelihood_ok || !$project_ok) {
				continue;
			}

			if ($contractBudget['Contractbudget']['year'] == $this->getYear()) {

				$total += $contractBudget['Contractbudget']['value_gbp'];

			}


		}

		return $total;
	}

	function getBudget($programme_id) {


		if ($programme_id == 'all') {
			$budget = array_sum($this->programmeBudgets);
		} elseif (isset($this->programmeBudgets[$programme_id])) {
			$budget = $this->programmeBudgets[$programme_id];
		} else {
			$budget = 0;
		}
		
		return $budget;
	}

	function getPercentage($programme_id, $statuses) {

		// avoid divide by zero
		if ($this->getBudget($programme_id)) {
			$percentage = $this->getTotal($programme_id, $statuses) / $this->getBudget($programme_id);
		} else {
			$percentage = 0;
		}
		return $percentage;
	}



}