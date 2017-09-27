<?php
App::uses('AppModel', 'Model');
/**
 * Continent Model
 *
 * @property Territory $Territory
 */
class Continent extends AppModel {

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
		'Territory' => array(
			'className' => 'Territory',
			'foreignKey' => 'continent_id',
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

	function findContinentsWithTerritories() {
		return $this->find('all', array('contain' => array('Territory')));
	}

}
