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
		)
	);
	
	public $belongsTo = array(
		'Continent' => array(
			'className' => 'Continent',
			'foreignKey' => 'continent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	public function findActiveList() {
		return $this->find('list', array(
			'conditions' => array('active' => true),
			'order' => array('sort_order ASC', 'name ASC'),
		));
	}

	public function findAllCountries() {
		return $this->find('all', array(
			'contain' => false,
			'conditions' => array('type' => 'country'),
			'order' => array('sort_order ASC', 'name ASC'),
		));
	}

	public function findAllRegions() {
		return $this->find('all', array(
			'contain' => false,
			'conditions' => array('type' => 'region'),
			'order' => array('sort_order ASC', 'name ASC'),
		));
	}

	// public function findActiveWithDepartment() {
	// 	return $this->find('all', array(
	// 		'contain' => array('Department'),
	// 		'conditions' => array('active' => true),
	// 		'order' => array('Territory.sort_order ASC', 'Territory.name ASC'),
	// 	));
	// }

}
