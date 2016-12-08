<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 * @property Departmentbudget $Departmentbudget
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Departmentbudget extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'dependent' => false,
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'department_id',
			'dependent' => false,
		)
	);

	public function getDepartmentBudget($department_id, $year) {
		return $this->Department->Departmentbudget->field(
			'value_gbp', 
			array(
				'Departmentbudget.year' => $year,
				'Departmentbudget.department_id' => $department_id,
			)
		);
	}

	public function getDepartmentBudgetsList($year) {

		return $this->find('list', array(
			'fields' => array('department_id', 'value_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $year
			),
		));
	}

	public function getDepartmentUnrestrictedAllocation($department_id, $year) {
		return $this->Department->Departmentbudget->field(
			'unrestricted_allocation_gbp', 
			array(
				'Departmentbudget.year' => $year,
				'Departmentbudget.department_id' => $department_id,
			)
		);
	}

	public function getDepartmentUnrestrictedAllocationsList($year) {
		return $this->find('list', array(
			'fields' => array('department_id', 'unrestricted_allocation_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $year
			),
		));
	}

	public function saveAnnualBudgets($year, $data) {

		// build data
		$dataToSave = array();
		foreach ($data['Departmentbudget'] as $department_id => $departmentbudget) {
			$dataToSave[] = array(
				'year' => $year,
				'department_id' => $department_id,
				'value_gbp' => $departmentbudget['value_gbp'],
				'unrestricted_allocation_gbp' => $departmentbudget['unrestricted_allocation_gbp'],
			);
		}

		// delete 
		$this->deleteAll(array(
			'Departmentbudget.year' => $year
		));

		// save many
		return $this->saveMany($dataToSave);
	}


}
