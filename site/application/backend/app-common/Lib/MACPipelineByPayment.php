<?php


class MACPipeline {


	private $year;

	private $payments = array();
	private $totals = array();

	function __construct($year, $programmeBudgets, $payments) {
		$this->year = $year;
		$this->programmeBudgets = $programmeBudgets;
		$this->payments = $payments;
		$this->asOfDate = new DateTime();
	}

	function getYear() {
		return $this->year;
	}


	function getTotal($programme_id, $likelihoods) {

		if (is_string($likelihoods)) $likelihoods = array($likelihoods);
		
		$total = 0;
		

		foreach ($this->payments as $payment) {

			// relevant project?
			$programme_ok = 
				($programme_id == 'all')
				|| ($programme_id == $payment['Contract']['Project']['programme_id']);
			$likelihood_ok = array_search($payment['Contract']['Project']['Likelihood']['short_name'], $likelihoods) !== FALSE;

			if (!$programme_ok || !$likelihood_ok) {
				continue;
			}
			
			$paymentDate = new DateTime($payment['Payment']['date']);

			if ($paymentDate->format('Y') == $this->getYear()) {

				$total += $payment['Payment']['value_gbp'];

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