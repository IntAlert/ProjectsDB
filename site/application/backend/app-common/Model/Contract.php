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
		),
		'Donor' => array(
			'className' => 'Donor',
			'foreignKey' => 'donor_id',
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
		),
		'Framework' => array(
			'className' => 'Framework',
			'foreignKey' => 'framework_id',
		),
		'Contractcategory' => array(
			'className' => 'Contractcategory',
			'foreignKey' => 'contractcategory_id',
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Contractbudget' => array(
			'className' => 'Contractbudget',
			'foreignKey' => 'contract_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('Contractbudget.year ASC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
