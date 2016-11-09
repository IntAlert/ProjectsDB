<?php
App::uses('AppModel', 'Model');
/**
 * Accompaniment Model
 *
 * @property ParticipantType $ParticipantType
 */
class Accompaniment extends AppModel {

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
			'joinTable' => 'accompaniments_participant_types',
			'foreignKey' => 'accompaniment_id',
			'associationForeignKey' => 'participant_type_id',
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
