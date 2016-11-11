<?php

class MeetingsController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Meeting->create();

			$data = $this->request->input('json_decode');
			$meeting = $this->Meeting->saveAssociated($data);
		}

		$this->set(array('data' => $meeting));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}

		$meeting = $this->Meeting->find('first', array(
			'Meeting.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $meeting));
	}

	function update($id) {

		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Meeting->id = $id;

			$data = $this->request->input('json_decode');

			$meeting = $this->Meeting->saveAssociated($data);
		}

		$this->set(array('data' => $meeting));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$meeting = $this->Meeting->delete($id);
		}

		$this->set(array('data' => $meeting));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$meetings = $this->Meeting->find('all', array(
			'contain' => array('ParticipantType')
		));
		

		$this->set(array('data' => $meetings));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$meetings = $this->Meeting->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $meetings));
	}


}
