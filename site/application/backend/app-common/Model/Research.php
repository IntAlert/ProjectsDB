<?php
App::uses('AppModel', 'Model');
/**
 * Research Model
 *
 * @property Territory $Territory
 * @property Theme $Theme
 */
class Research extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'researches';

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
		'Theme' => array(
			'className' => 'Theme',
			'joinTable' => 'researches_themes',
			'foreignKey' => 'research_id',
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

	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
