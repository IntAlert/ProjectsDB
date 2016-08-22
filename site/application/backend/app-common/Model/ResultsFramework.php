<?php
App::uses('AppModel', 'Model');

class ResultsFramework extends AppModel {

	var $useTable = 'rf';


	public $hasMany = array(
		'ResultsFrameworkTraining' => array(
			'className' => 'ResultsFrameworkTraining',
			'foreignKey' => 'rf_id',
		),
	);


	function findByProjectId($project_id) {
		return $this->find('first', array(
			'contain' => false,
			'conditions' => array(
				'project_id' => $project_id
			)
		));
	}

	function save($data = NULL, $validate = true, $fieldList = array()) {

		// save full record as JSON
		$dataToSave = array(
			'project_id' => $data['project_id'],
			'data_json' => json_encode($data),
		);

		// is there already a record for this projectId?
		$record = $this->findByProjectId($data['project_id']);

		if ($record) { // update?
			$this->id = $record['ResultsFramework']['id'];
		}

		parent::save($dataToSave);

		// save trainings
		$this->ResultsFrameworkTraining->saveItemised($this->id, $data['trainings']);

	}
}
