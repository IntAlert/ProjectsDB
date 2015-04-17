<?php
App::uses('AppModel', 'Model');
/**
 * Country Model
 *
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Country extends AppModel {

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
			'joinTable' => 'countries_projects',
			'foreignKey' => 'country_id',
			'associationForeignKey' => 'project_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Proposal' => array(
			'className' => 'Proposal',
			'joinTable' => 'countries_proposals',
			'foreignKey' => 'country_id',
			'associationForeignKey' => 'proposal_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);


	public function findActiveList() {
		return $this->find('list', array(
			'conditions' => array('active' => true),
			'order' => array('sort_order ASC', 'name ASC'),
		));
	}

}
