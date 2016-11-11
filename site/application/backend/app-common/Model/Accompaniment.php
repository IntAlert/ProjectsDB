<?php
App::uses('AppModel', 'Model');
/**
 * Accompaniment Model
 *
 * @property Project $Project
 * @property ParticipantCounts $ParticipantCounts
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ParticipantCount' => array(
			'className' => 'AccompanimentParticipantCount',
			'foreignKey' => 'accompaniment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


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
