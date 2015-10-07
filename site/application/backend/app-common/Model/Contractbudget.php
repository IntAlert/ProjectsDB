<?php
App::uses('AppModel', 'Model');
/**
 * Contractbudget Model
 *
 * @property Contract $Contract
 */
class Contractbudget extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Contract' => array(
			'className' => 'Contract',
			'foreignKey' => 'contract_id',
			'conditions' => array(
				'deleted' => false,
			),
			'fields' => '',
			'order' => ''
		)
	);
}
