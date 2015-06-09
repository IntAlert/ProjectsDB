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
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
	);

	public $belongsTo = array(
		'Programme' => array(
			'className' => 'Programme',
			'foreignKey' => 'programme_id',
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

}
