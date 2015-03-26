<?php
App::uses('AppModel', 'Model');
/**
 * Proposal Model
 *
 * @property Programme $Programme
 * @property Project $Project
 * @property Country $Country
 * @property Theme $Theme
 */
class Proposal extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Programme' => array(
			'className' => 'Programme',
			'foreignKey' => 'programme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'owner_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Country' => array(
			'className' => 'Country',
			'joinTable' => 'countries_proposals',
			'foreignKey' => 'proposal_id',
			'associationForeignKey' => 'country_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Theme' => array(
			'className' => 'Theme',
			'joinTable' => 'proposals_themes',
			'foreignKey' => 'proposal_id',
			'associationForeignKey' => 'theme_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
