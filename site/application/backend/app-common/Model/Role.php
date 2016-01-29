<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 */
class Role extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $hasAndBelongsToMany = 'User';

	public function findOrderedList() {
		return $this->find('list', array(
			'order' => array('sort_order ASC, name ASC'),
		));
	}

}
