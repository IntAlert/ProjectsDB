<?php
App::uses('AppModel', 'Model');
/**
 * Projectdatenotification Model
 *
 * @property Project $Project
 * @property Projectdate $Projectdate
 */
class Projectdatenotification extends AppModel {


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
		),
		'Projectdate' => array(
			'className' => 'Projectdate',
			'foreignKey' => 'projectdate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
