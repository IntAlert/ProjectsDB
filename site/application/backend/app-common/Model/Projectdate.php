<?php
App::uses('AppModel', 'Model');
/**
 * Projectdate Model
 *
 * @property Project $Project
 */
class Projectdate extends AppModel {

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


	public function search($start_date_limit, $start_date, $finish_date_limit, $finish_date, $completed) {
		$conditions = [];

		if ($start_date_limit && $start_date) {
			// finish is after start_date filter

			$start_date_mysql = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');

			$conditions[] = ['Projectdate.date >=' => $start_date_mysql];
		}

		if ($finish_date_limit && $finish_date) {
			// finish is after start_date filter

			$finish_date_mysql = DateTime::createFromFormat('d/m/Y', $finish_date)->format('Y-m-d');

			$conditions[] = ['Projectdate.date <=' => $finish_date_mysql];
		}

		if ($completed != -1) {
			// finish is after start_date filter
			$conditions[] = ['Projectdate.completed' => $completed];
		}

		// var_dump($conditions);

		return $this->find('all', array(
			'conditions' => $conditions,
			'order' => array(
				'Projectdate.date ASC'
			),
			'contain' => array(
				'Project.OwnerUser.Office365user'
			)
		));
	}
}
