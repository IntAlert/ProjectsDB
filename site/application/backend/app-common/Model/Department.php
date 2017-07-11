<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 * @property Departmentbudget $Departmentbudget
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Department extends AppModel {

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
		'Departmentbudget' => array(
			'className' => 'Departmentbudget',
			'foreignKey' => 'department_id',
			'dependent' => false,
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'department_id',
			'dependent' => false,
			'conditions' => array('Project.deleted' => false),
		)
	);

	public function findSimpleById($department_id) {
		return $this->find('first', array(
			'contain' => false,
			'conditions' => array(
				'Department.id' => $department_id,
			)
		));
	}

	public function findOrderedList() {
		return $this->find('list', array(
			'order' => array('Department.sort_order ASC')
		));
	}

	public function findListByYear($year) {

		// returns valid departments
		$conditions = array(
			[
				'OR' => [
					'start_date' => null,
					'YEAR(start_date) <=' => $year
				]
			],
			[
				'OR' => [
					'finish_date' => null,
					'YEAR(finish_date) >=' => $year
				]
			],
		);


		return $this->find('list', array(
			'conditions' => $conditions,
			'order' => array('sort_order' => 'ASC')
		));
	}

	public function findListByDate($dateString) {

		// returns valid departments
		$conditions = array(
			[
				'OR' => [
					'start_date' => null,
					'start_date <=' => $dateString
				]
			],
			[
				'OR' => [
					'finish_date' => null,
					'finish_date >=' => $dateString
				]
			],
		);


		return $this->find('list', array(
			'conditions' => $conditions
		));
	}


}
