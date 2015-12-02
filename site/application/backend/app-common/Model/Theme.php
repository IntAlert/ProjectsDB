<?php
App::uses('AppModel', 'Model');
/**
 * Theme Model
 *
 * @property Project $Project
 * @property Proposal $Proposal
 */
class Theme extends AppModel {

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
			'joinTable' => 'projects_themes',
			'foreignKey' => 'theme_id',
			'associationForeignKey' => 'project_id',
			'unique' => 'keepExisting',
		)
	);

	public function findOrderedList() {
		return $this->find('list', array(
			'conditions' => array('Theme.deleted' => false),
			'order' => array('sort_order ASC, name ASC'),
		));
	}

	public function softDelete($id) {
		$this->id = $id;
		$this->saveField('deleted', true);
		return true; // assume it worked
	}

}
