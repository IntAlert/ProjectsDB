<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DepartmentsController extends AppController {


	function pipelineSummary() {

		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first payment year
		$firstProjectYear = $this->Department->Project->find('first', array(
			'contain' => false,
			'fields' => array("YEAR(start_date)"),
			'order' => array('Project.start_date' => 'ASC'),
			'conditions' => array('Project.start_date <>' => NULL ),
		));
		
		$firstYear = (int) isset($firstProjectYear[0]) ?
			$firstProjectYear[0]['YEAR(start_date)'] : date("Y");


		// get annual budgets
		$budgetsThisYear = $this->Department->Project->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => $selectedYear
			)
		));


		$budgetsLastYear = $this->Department->Project->Contract->Contractbudget->find('all', array(
			'contain' => array(
				'Contract.Project.Likelihood',
				'Contract.Project.Status',
			),
			'conditions' => array(
				'year' => ($selectedYear - 1),
			)
		));

		// get department budgets for this year
		$departmentBudgetsThisYear = $this->Department->Departmentbudget->find('list', array(
			'fields' => array('department_id', 'value_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $selectedYear
			),
		));

		// get department budgets for this year
		$departmentBudgetsLastYear = $this->Department->Departmentbudget->find('list', array(
			'fields' => array('department_id', 'value_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $selectedYear - 1
			),
		));

		// get departments
		$departmentsList = $this->Department->find('list', array(
			'fields' => array('id', 'name'),
		));


		$this->set(compact(
			'departmentBudgetsThisYear',
			'departmentBudgetsLastYear',
			'selectedYear',
			'thisYear',
			'firstYear',
			'budgetsThisYear',
			'budgetsLastYear',
			'departmentsList'
		 ));
	}

	function pipeline($department_id = null) {



		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first payment year
		$firstProjectYear = $this->Department->Project->find('first', array(
			'contain' => false,
			'fields' => array("YEAR(start_date)"),
			'order' => array('Project.start_date' => 'ASC'),
		));

		
		$firstYear = (int) isset($firstProjectYear[0]) ?
			$firstProjectYear[0]['YEAR(start_date)'] : date("Y");


		// get departments
		$departmentsList = $this->Department->find('list', array(
			'fields' => array('id', 'name'),
		));

		// get department
		$department = $this->Department->find('first', array(
			'contain' => false,
			'conditions' => array(
				'Department.id' => $department_id,
			)
		));

		// get department budget this year
		$departmentBudgetThisYear = $this->Department->Departmentbudget->field(
			'value_gbp', 
			array(
				'Departmentbudget.year' => $selectedYear,
				'Departmentbudget.department_id' => $department_id,
			)
		);

		$departmentBudgetNextYear = $this->Department->Departmentbudget->field(
			'value_gbp', 
			array(
				'Departmentbudget.year' => $selectedYear + 1,
				'Departmentbudget.department_id' => $department_id,
			)
		);

		$projects = $this->Department->Project->find('all', array(
			'contain' => array(
				'Contract.Contractbudget',
				'Contract.Donor',
				'Territory',
				'Likelihood',

			),
			'conditions' => array(
				'Project.deleted' => false,
				'Project.department_id' => $department_id,
				'OR' => array(
					'YEAR(Project.start_date) <=' => $selectedYear,
					'YEAR(Project.finish_date) >=' => $selectedYear,
				)
			),
			'order' => array(
				'Project.title' => 'ASC'
			),
		));

		$this->set(compact(
			'departmentsList',
			'thisYear',
			'firstYear',
			'department',
			'projects',
			'selectedYear', 
			'departmentBudgetThisYear', 
			'departmentBudgetNextYear'
		));


	}

	function setSharedData() {
		// TODO: factor out shared
	}

}
