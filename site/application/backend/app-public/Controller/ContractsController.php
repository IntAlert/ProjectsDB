<?php
App::uses('AppController', 'Controller');

/**
 * Payments Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContractsController extends AppController {

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
		$firstBudgetYear = $this->Contract->Contractbudget->find('first', array(
			'fields' => array("year"),
			'order' => array('Contractbudget.year' => 'ASC'),
		));
		
		$firstYear = (int) isset($firstBudgetYear['Contractbudget']) ?
			$firstBudgetYear['Contractbudget']['year'] : date("Y");


		// get selected year
		$selectedYear = $this->request->query('selectedYear');



		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// get payments
		$budgetsThisYear = $this->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => $selectedYear
			)
		));

		$budgetsLastYear = $this->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => $selectedYear - 1
			)
		));

		// get programme budgets for this year
		$programmeBudgetsThisYear = $this->Contract->Project->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear
			),
		));

		// get programme budgets for this year
		$programmeBudgetsLastYear = $this->Contract->Project->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear - 1
			),
		));

		// debug($programmeBudgetThisYear);

		// get programmes
		$programmesList = $this->Contract->Project->Programme->find('list', array(
			'fields' => array('id', 'name'),
		));

		// $programmesWithContracts


		$this->set(compact(
			'programmeBudgetsThisYear',
			'programmeBudgetsLastYear',
			'selectedYear',
			'thisYear',
			'firstYear',
			'budgetsThisYear',
			'budgetsLastYear',
			'programmesList'
		 ));
	}
}
