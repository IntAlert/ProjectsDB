<?php
App::uses('AppModel', 'Model');
/**
 * Contract Model
 *
 * @property Project $Project
 * @property Donor $Donor
 * @property DonorCurrency $DonorCurrency
 * @property Payment $Payment
 */
class Contract extends AppModel {


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
		),
		'Donor' => array(
			'className' => 'Donor',
			'foreignKey' => 'donor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
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
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'contract_id',
			'dependent' => true,
			'exclusive' => true,
			'conditions' => array('Payment.deleted' => false),
			'fields' => '',
			'order' => array('Payment.date ASC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
