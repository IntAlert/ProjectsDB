<?php

class AccompanimentsController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Accompaniment->create();

			$data = $this->request->input('json_decode');
			$accompaniment = $this->Accompaniment->saveAssociated($data);
		}

		$this->set(array('data' => $accompaniment));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Accompaniment->exists($id)) {
			throw new NotFoundException(__('Invalid Accompaniment'));
		}

		$accompaniment = $this->Accompaniment->find('first', array(
			'Accompaniment.id' => $id,
			'contain' => ['ParticipantType']
		));
		

		$this->set(array('data' => $accompaniment));
	}

	function update($id) {

		if (!$this->Accompaniment->exists($id)) {
			throw new NotFoundException(__('Invalid Accompaniment'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Accompaniment->id = $id;

			$data = $this->request->input('json_decode');

			// delete previous associations
			$this->Accompaniment->ParticipantCount->deleteCounts($id);

			$accompaniment = $this->Accompaniment->saveAssociated($data);
		}

		$this->set(array('data' => $accompaniment));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$accompaniment = $this->Accompaniment->delete($id);
		}

		$this->set(array('data' => $accompaniment));
	}

	function all() {
		
		// TODO: must be authed and must be note owner


		$accompaniments = $this->Accompaniment->find('all', array(
			'contain' => array('ParticipantType')
		));
		

		$this->set(array('data' => $accompaniments));
	}


}
