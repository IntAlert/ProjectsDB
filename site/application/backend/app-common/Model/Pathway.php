<?php
App::uses('AppModel', 'Model');
/**
 * Pathway Model
 *
 * @property Project $Project
 */
class Pathway extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Project' => array(
			'className' => 'Project',
			'joinTable' => 'pathways_project',
			'foreignKey' => 'pathway_id',
			'associationForeignKey' => 'project_id',
			'unique' => 'keepExisting',
		)
	);


	public function findOrderedList() {
		return $this->find('list', array(
			'order' => array('sort_order ASC, name ASC'),
		));
	}

}
