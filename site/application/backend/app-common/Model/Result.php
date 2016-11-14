<?php
App::uses('AppModel', 'Model');
/**
 * Result Model
 *
 * @property Pathway $Pathway
 * @property Impact $Impact
 */
class Result extends AppModel {

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
		'Pathway' => array(
			'className' => 'Pathway',
			'foreignKey' => 'pathway_id',
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
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Territory' => array(
			'className' => 'Territory',
			'joinTable' => 'results_territories',
			'foreignKey' => 'result_id',
			'associationForeignKey' => 'territory_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Impact' => array(
			'className' => 'Impact',
			'joinTable' => 'impacts_results',
			'foreignKey' => 'result_id',
			'associationForeignKey' => 'impact_id',
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
