<?php

class ResultsController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Result->create();

			$data = $this->request->input('json_decode');
			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}

		$result = $this->Result->find('first', array(
			'Result.id' => $id,
			'contain' => ['Impact']
		));
		

		$this->set(array('data' => $result));
	}

	function update($id) {

		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Result->id = $id;

			$data = $this->request->input('json_decode');

			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$result = $this->Result->delete($id);
		}

		$this->set(array('data' => $result));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$results = $this->Result->find('all', array(
			'contain' => ['Impact']
		));
		

		$this->set(array('data' => $results));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$results = $this->Result->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['Impact']
		));
		
		$this->set(array('data' => $results));
	}


}
