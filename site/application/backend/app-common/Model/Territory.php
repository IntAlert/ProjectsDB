<?php
App::uses('AppModel', 'Model');
/**
 * Country Model
 *
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Territory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Project' => array(
			'className' => 'Project',
			'joinTable' => 'territories_projects',
			'foreignKey' => 'territory_id',
			'associationForeignKey' => 'project_id',
			'unique' => 'keepExisting',
		),
		'Department' => array(
			'className' => 'Department',
			'joinTable' => 'departments_territories',
			'foreignKey' => 'territory_id',
			'associationForeignKey' => 'department_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'Department.sort_order' => 'ASC',
				'Department.name' => 'ASC',
			),
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
	);


	public function findActiveList() {
		return $this->find('list', array(
			'conditions' => array('active' => true),
			'order' => array('sort_order ASC', 'name ASC'),
		));
	}

	public function findActiveWithDepartment() {
		return $this->find('all', array(
			'contain' => array('Department'),
			'conditions' => array('active' => true),
			'order' => array('Territory.sort_order ASC', 'Territory.name ASC'),
		));
	}

	

	

}
