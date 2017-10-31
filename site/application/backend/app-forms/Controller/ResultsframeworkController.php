<?php
App::uses('AppController', 'Controller');
/**
 * Travelapplications Controller
 *
 * @property Travelapplication $Travelapplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ResultsframeworkController extends AppController {


	public $uses = array('ResultsFramework', 'Project', 'Result');

	public function edit($project_id) {
		// check if project exists
		if (! ($project = $this->Project->findById($project_id))) {
			throw new NotFoundException(__('Invalid project'));
		}

		$this->set(compact('project'));

	}

	public function save($project_id) {

		$this->layout = 'ajax';
		
		// check if project exists
		if (!$this->Project->exists($project_id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		// save submitted data
		$this->request->data['project_id'] = $project_id;
		$this->ResultsFramework->save($this->request->data);
	}

	public function query() {

	}

	public function approveResult($result_id) {

		$this->set('title', 'Approve Result');

		if (!$this->Result->exists($result_id)) {
			throw new NotFoundException(__('Invalid result'));
		}

		$result = $this->Result->find('first', array(
			'conditions' => array('Result.id' => $result_id),
			'contains' => array(
				'Project', 'Impact'
			)
		));

		$this->set('result', $result);

		
	}

}
