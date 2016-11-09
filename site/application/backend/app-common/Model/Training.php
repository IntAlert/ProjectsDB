<?php
App::uses('AppModel', 'Model');
/**
 * Training Model
 *
 * @property Rf $Rf
 * @property ParticipantType $ParticipantType
 * @property Theme $Theme
 */
class Training extends AppModel {

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
		'Rf' => array(
			'className' => 'Rf',
			'joinTable' => 'rf_trainings',
			'foreignKey' => 'training_id',
			'associationForeignKey' => 'rf_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'ParticipantType' => array(
			'className' => 'ParticipantType',
			'joinTable' => 'trainings_participant_types',
			'foreignKey' => 'training_id',
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
			'joinTable' => 'trainings_themes',
			'foreignKey' => 'training_id',
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
