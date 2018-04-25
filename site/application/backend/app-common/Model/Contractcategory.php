<?php
App::uses('AppModel', 'Model');
/**
 * Contractcategory Model
 *
 * @property Contract $Contract
 */
class Contractcategory extends AppModel {

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
			'foreignKey' => 'contractcategory_id',
			'dependent' => false,
		)
	);

	public function findOrderedList($includeCoreGrant = false) {

		$conditions = array('deleted' => false);

		if ( !$includeCoreGrant ) {
			$conditions['short_name <>'] = 'core_grant';
		}

		return $this->find('list', array(
			'order' => array('Contractcategory.name ASC'),
			'conditions' => $conditions,
		));
	}

	public function softDelete($id) {
		$this->id = $id;
		$this->saveField('deleted', true);
		return true; // assume it worked
	}

}
