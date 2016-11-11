<?php

class TrainingsController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Training->create();

			$data = $this->request->input('json_decode');
			$training = $this->Training->saveAssociated($data);
		}

		$this->set(array('data' => $training));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid Training'));
		}

		$training = $this->Training->find('first', array(
			'Training.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $training));
	}

	function update($id) {

		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid Training'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Training->id = $id;

			$data = $this->request->input('json_decode');

			$training = $this->Training->saveAssociated($data);
		}

		$this->set(array('data' => $training));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$training = $this->Training->delete($id);
		}

		$this->set(array('data' => $training));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$trainings = $this->Training->find('all', array(
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $trainings));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$trainings = $this->Training->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $trainings));
	}


}
