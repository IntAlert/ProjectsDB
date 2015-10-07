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

	public function saveAnnualBudgets($year, $data) {

		// build data
		$dataToSave = array();
		foreach ($data['Departmentbudget'] as $department_id => $departmentbudget) {
			$dataToSave[] = array(
				'year' => $year,
				'department_id' => $department_id,
				'value_gbp' => $departmentbudget['value_gbp'],
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
