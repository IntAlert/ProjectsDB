<?php

class ProcessesController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Process->create();

			$data = $this->request->input('json_decode');
			$process = $this->Process->saveAssociated($data);
		}

		$this->set(array('data' => $process));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Process->exists($id)) {
			throw new NotFoundException(__('Invalid Process'));
		}

		$process = $this->Process->find('first', array(
			'Process.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $process));
	}

	function update($id) {

		if (!$this->Process->exists($id)) {
			throw new NotFoundException(__('Invalid Process'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Process->id = $id;

			$data = $this->request->input('json_decode');

			$process = $this->Process->saveAssociated($data);
		}

		$this->set(array('data' => $process));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$process = $this->Process->delete($id);
		}

		$this->set(array('data' => $process));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$processes = $this->Process->find('all', array(
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $processes));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$processes = $this->Process->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $processes));
	}


}
