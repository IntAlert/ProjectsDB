<?php
App::uses('AppController', 'Controller');
/**
 * Programmes Controller
 *
 * @property Programme $Programme
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProgrammesController extends AppController {


	function pipelineSummary() {

		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first payment year
		$firstProjectYear = $this->Programme->Project->find('first', array(
			'contain' => false,
			'fields' => array("YEAR(start_date)"),
			'order' => array('Project.start_date' => 'ASC'),
		));

		
		$firstYear = (int) isset($firstProjectYear[0]) ?
			$firstProjectYear[0]['YEAR(start_date)'] : date("Y");


		// get payments
		$budgetsThisYear = $this->Programme->Project->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => $selectedYear
			)
		));

		$budgetsLastYear = $this->Programme->Project->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => $selectedYear - 1
			)
		));

		// get programme budgets for this year
		$programmeBudgetsThisYear = $this->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear
			),
		));

		// get programme budgets for this year
		$programmeBudgetsLastYear = $this->Programme->Programmebudget->find('list', array(
			'fields' => array('programme_id', 'value_gbp'),
			'conditions' => array(
				'Programmebudget.year' => $selectedYear - 1
			),
		));

		// get programmes
		$programmesList = $this->Programme->find('list', array(
			'fields' => array('id', 'name'),
		));


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

	function pipeline($programme_id = null) {



		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first payment year
		$firstProjectYear = $this->Programme->Project->find('first', array(
			'contain' => false,
			'fields' => array("YEAR(start_date)"),
			'order' => array('Project.start_date' => 'ASC'),
		));

		
		$firstYear = (int) isset($firstProjectYear[0]) ?
			$firstProjectYear[0]['YEAR(start_date)'] : date("Y");


		// get programmes
		$programmesList = $this->Programme->find('list', array(
			'fields' => array('id', 'name'),
		));

		// get programme
		$programme = $this->Programme->find('first', array(
			'contain' => false,
			'conditions' => array(
				'Programme.id' => $programme_id,
			)
		));

		// get programme budget this year
		$programmeBudgetThisYear = $this->Programme->Programmebudget->field(
			'value_gbp', 
			array(
				'Programmebudget.year' => $selectedYear,
				'Programmebudget.programme_id' => $programme_id,
			)
		);

		$programmeBudgetNextYear = $this->Programme->Programmebudget->field(
			'value_gbp', 
			array(
				'Programmebudget.year' => $selectedYear + 1,
				'Programmebudget.programme_id' => $programme_id,
			)
		);

		$projects = $this->Programme->Project->find('all', array(
			'contain' => array(
				'Contract.Contractbudget',
				'Contract.Donor',
				'Territory',
				'Likelihood',

			),
			'conditions' => array(
				'Project.programme_id' => $programme_id,
				'OR' => array(
					'YEAR(Project.start_date)' => $selectedYear,
					'YEAR(Project.finish_date)' => $selectedYear,
				)
			)
		));

		$this->set(compact(
			'programmesList',
			'thisYear',
			'firstYear',
			'programme',
			'projects',
			'selectedYear', 
			'programmeBudgetThisYear', 
			'programmeBudgetNextYear'
		));


	}

	function setSharedData() {
		// TODO: factor out shared
	}

}
