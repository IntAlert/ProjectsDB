<?php
App::uses('AppController', 'Controller');

/**
 * Payments Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PaymentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');



	function pipeline() {

		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// determine first payment year
		$firstPaymentYear = $this->Payment->find('first', array(
			'fields' => array("YEAR(date)"),
			'conditions' => array(
				'Payment.deleted' => false,
			),
			'order' => array('Payment.date' => 'ASC'),
		));
		
		$firstYear = (int) $firstPaymentYear[0]['YEAR(date)'];


		// get selected year
		$selectedYear = $this->request->query('selectedYear');



		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// get payments
		$paymentsThisYear = $this->Payment->find('all', array(
			'contain' => array('Contract.Project.Likelihood'),
			'conditions' => array(
				'Payment.deleted' => false,
				'YEAR(Payment.date)' => $selectedYear
			)
		));

		$paymentsLastYear = $this->Payment->find('all', array(
			'contain' => array('Contract.Project.Likelihood'),
			'conditions' => array(
				'Payment.deleted' => false,
				'YEAR(Payment.date)' => $selectedYear - 1
			)
		));

		// get programme budgets for this year
		$programmeBudgetsThisYear = $this->Payment->Project->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear
			),
		));

		// get programme budgets for this year
		$programmeBudgetsLastYear = $this->Payment->Project->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear - 1
			),
		));

		// debug($programmeBudgetThisYear);

		// get programmes
		$programmesList = $this->Payment->Project->Programme->find('list', array(
			'fields' => array('id', 'name'),
		));

		$this->set(compact(
			'programmeBudgetsThisYear',
			'programmeBudgetsLastYear',
			'selectedYear',
			'thisYear',
			'firstYear',
			'paymentsThisYear',
			'paymentsLastYear',
			'programmesList'
		 ));
	}
}
