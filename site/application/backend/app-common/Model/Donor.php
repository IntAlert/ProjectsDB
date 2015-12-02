<?php
App::uses('AppModel', 'Model');
/**
 * Donor Model
 *
 * @property Contract $Contract
 */
class Donor extends AppModel {



	public $actsAs = array(
		'AuditLog.Auditable' => array(
		)
	);

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
			'foreignKey' => 'donor_id',
			'dependent' => false,
		)
	);

	public function findOrderedList() {
		return $this->find('list', array(
			'order' => array('Donor.name ASC')
		));
	}

	public function softDelete($id) {
		$this->id = $id;
		$this->saveField('deleted', true);
		return true; // assume it worked
	}

}
