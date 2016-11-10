<?php
App::uses('AppModel', 'Model');
/**
 * Process Model
 *
 * @property ParticipantType $ParticipantType
 * @property Theme $Theme
 */
class Process extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'ParticipantType' => array(
			'className' => 'ParticipantType',
			'joinTable' => 'processes_participant_types',
			'foreignKey' => 'process_id',
			'associationForeignKey' => 'participant_type_id',
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
			'joinTable' => 'processes_themes',
			'foreignKey' => 'process_id',
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

	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
