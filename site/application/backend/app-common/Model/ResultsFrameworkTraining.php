<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 * @property Departmentbudget $Departmentbudget
 * @property Project $Project
 * @property Proposal $Proposal
 */

class ResultsFrameworkTraining extends AppModel {

	var $useTable = 'rf_trainings';

	function saveItemised($rf_id, $trainings) {

		// delete all records for this rf_id
		$this->deleteAll(compact('rf_id'));

		foreach ($trainings['items'] as $training):

			$dataToSave = array(
				'rf_id' => $rf_id,
				'date' => $training['date'],
				// 'date' => date_format(date_create('@' . strtotime($training['date'])), 'c'),
				'data_json' => json_encode($training)
			);

			$this->save($dataToSave);

		endforeach; // ($trainings as $training):

	}
}
