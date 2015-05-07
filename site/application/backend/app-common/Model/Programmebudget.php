<?php
App::uses('AppModel', 'Model');
/**
 * Programmebudget Model
 *
 * @property Programme $Programme
 */
class Programmebudget extends AppModel {


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
		)
	);
}
