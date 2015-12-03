<?php
App::uses('AppModel', 'Model');
/**
 * Framework Model
 *
 * @property Contract $Contract
 */
class Framework extends AppModel {

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
		'Contract' => array(
			'className' => 'Contract',
			'foreignKey' => 'framework_id',
			'dependent' => false,
		)
	);


	public function findOrderedList() {
		return $this->find('list', array(
			'order' => array('Framework.name ASC'),
			'conditions' => array('deleted' => false),
		));
	}

	public function softDelete($id) {
		$this->id = $id;
		$this->saveField('deleted', true);
		return true; // assume it worked
	}

}
