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
		'Impact' => array(
			'className' => 'Impact',
			'joinTable' => 'impacts_results',
			'foreignKey' => 'result_id',
			'associationForeignKey' => 'impact_id',
			'unique' => 'keepExisting',
		)
	);

	public function approvePublication($id) {
		$this->id = $id;
		return $this->saveField('publication_approved', true);
		return true; // assume it worked
	}

	public function blockPublication($id) {
		$this->id = $id;
		return $this->saveField('publication_approved', false);
		return true; // assume it worked
	}

}
