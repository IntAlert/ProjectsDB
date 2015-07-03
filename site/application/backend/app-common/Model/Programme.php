<?php
App::uses('AppModel', 'Model');
/**
 * Programme Model
 *
 * @property Programmebudget $Programmebudget
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Programme extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Programmebudget' => array(
			'className' => 'Programmebudget',
			'foreignKey' => 'programme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'programme_id',
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
		// ,
		// 'Territory' => array(
		// 	'className' => 'Territory',
		// 	'foreignKey' => 'programme_id',
		// 	'dependent' => false,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => array(
		// 		'Territory.sort_order' => 'ASC',
		// 		'Territory.name' => 'ASC',
		// 	),
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'exclusive' => '',
		// 	'finderQuery' => '',
		// 	'counterQuery' => ''
		// )
	);

	public $hasAndBelongsToMany = array(
		'Territory' => array(
			'className' => 'Territory',
			'joinTable' => 'programmes_territories',
			'foreignKey' => 'programme_id',
			'associationForeignKey' => 'territory_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => array(
				'Territory.sort_order' => 'ASC',
				'Territory.name' => 'ASC',
			),
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
	);

}
