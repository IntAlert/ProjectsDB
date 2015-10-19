<?php
App::uses('AppController', 'Controller');
/**
 * Programmebudgets Controller
 *
 * @property Programmebudget $Programmebudget
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PipelineController extends AppController {

	var $uses = array('Department');


	function summary() {

		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first project year
		$firstYear = $this->Department->Project->getFirstProjectYear();

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

		// get department budgets for this year
		$departmentBudgetsThisYear = $this->Department->Departmentbudget->find('list', array(
			'fields' => array('department_id', 'value_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $selectedYear
			),
		));

		// get departments
		$departmentsList = $this->Department->find('list', array(
			'fields' => array('id', 'name'),
		));


		$this->set(compact(
			'departmentBudgetsThisYear',
			'selectedYear',
			'thisYear',
			'firstYear',
			'budgetsThisYear',
			'departmentsList'
		 ));
	}

	function department($department_id) {


		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;

		// determine first payment year
		$firstYear = $this->Department->Project->getFirstProjectYear();

		// get departments
		$departmentsList = $this->Department->findOrderedList();

		// get department
		$department = $this->Department->findSimpleById($department_id);

		// get department budget this year
		$departmentBudgetThisYear = $this->Department->Departmentbudget->getDepartmentBudget($department_id, $selectedYear);

		// and next
		$departmentBudgetNextYear = $this->Department->Departmentbudget->getDepartmentBudget($department_id, $selectedYear + 1);

		// get projects for this department and year
		$projects = $this->Department->Project->getProjectsByDepartmentAndYear($department_id, $selectedYear);

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

	function health() {

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;
		$nextYear = $selectedYear + 1;

		// get all projects
		$conditions = array(
			'Project.deleted' => false,
			'YEAR(Project.start_date) <=' => $selectedYear,
			'YEAR(Project.finish_date) >=' => $selectedYear,
		);

		$projects = $this->Department->Project->find('all', array(
			'contain' => array('Territory', 'Theme', 'Contract.Donor', 'Contract.Contractbudget', 'Status', 'Likelihood'),
	        'conditions' => $conditions,
	        'order' => array('Project.title' => 'ASC'),
	    ));


	    // departments
	    $departmentsList = $this->Department->findOrderedList();

		$this->set(compact(
			'thisYear',
			'firstYear',
			'department',
			'projects',
			'selectedYear',
			'nextYear', 
			'departmentBudgetThisYear', 
			'departmentBudgetNextYear',
			'departmentsList'
		));

	}

	// show all data
	// this page can be printed to PDF
	function preview() {

		
		// determine this year
		$now = new DateTime();
		$thisYear = (int) ($now->format("Y"));

		// get selected year
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;
		$nextYear = $selectedYear + 1;

		// get first payment year
		$firstYear = $this->Department->Project->getFirstProjectYear();

		// get departments
		$departmentsList = $this->Department->findOrderedList();


		// BUILD UP SUMMARY DATA for this year and next

		// THIS YEAR
		//
		// get annual contract budgets
		$contractbudgetsThisYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($selectedYear);

		// get department budgets for this year
		$departmentBudgetsThisYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($selectedYear);

		// NEXT YEAR
		//
		// get annual contract budgets
		$contractbudgetsNextYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($nextYear);

		// get department budgets for this year
		$departmentBudgetsNextYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($nextYear);


		// BUILD UP DEPARTMENT-LEVEL DATA
		$departmentsDetailAnnual = [];
		foreach ($departmentsList as $department_id => $name) {

			$departmentDetailAnnual = array(
				'department' => $this->Department->findSimpleById($department_id),
				'projects' => $this->Department->Project->getProjectsByDepartmentAndYear($department_id, $selectedYear),
				'departmentBudgetThisYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $selectedYear),
				'departmentBudgetNextYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $nextYear),
			);

			$departmentsDetailAnnual[$department_id] = $departmentDetailAnnual;

		}


		$this->set(compact(

			'departmentsList',
			'firstYear',
			'thisYear',
			'selectedYear',
			'nextYear',
			
			// Summary data
			'departmentBudgetsThisYear',
			'departmentBudgetsNextYear',
			'contractbudgetsThisYear',
			'contractbudgetsNextYear',

			// department-level
			'departmentsDetailAnnual'
			
		 ));

	}

	// create XLS of all data
	private function export() {
		// export is in PipelineExportContoller
	}


	// get selected year from query parameter
	private function getSelectedYear() {
		$selectedYear = $this->request->query('selectedYear');
		if (is_null($selectedYear)) $selectedYear = $thisYear;
		$nextYear = $selectedYear+1;
		return array($selectedYear, $nextYear);
	}
}
