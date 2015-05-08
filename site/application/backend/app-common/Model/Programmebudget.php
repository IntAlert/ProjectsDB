<?php
App::uses('AppModel', 'Model');
/**
 * Programmebudget Model
 *
 * @property Programme $Programme
 */
class Programmebudget extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Programme' => array(
			'className' => 'Programme',
			'foreignKey' => 'programme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	public function saveAnnualBudgets($year, $data) {

		

		// build data
		$dataToSave = array();
		foreach ($data['Programmebudget'] as $programme_id => $programmebudget) {
			$dataToSave[] = array(
				'year' => $year,
				'programme_id' => $programme_id,
				'value_gbp' => $programmebudget['value_gbp'],
			);
		}

		// delete 
		$this->deleteAll(array(
			'Programmebudget.year' => $year
		));

		// save many
		return $this->saveMany($dataToSave);
	}
}
