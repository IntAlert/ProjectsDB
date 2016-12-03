<?php

class ResearchesController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Research->create();

			$data = $this->request->input('json_decode');
			$research = $this->Research->saveAssociated($data);
		}

		$this->set(array('data' => $research));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Research->exists($id)) {
			throw new NotFoundException(__('Invalid Research'));
		}

		$research = $this->Research->find('first', array(
			'Research.id' => $id,
			'contain' => ['Theme']
		));
		

		$this->set(array('data' => $research));
	}

	function update($id) {

		if (!$this->Research->exists($id)) {
			throw new NotFoundException(__('Invalid Research'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Research->id = $id;

			$data = $this->request->input('json_decode');

			$research = $this->Research->saveAssociated($data);
		}

		$this->set(array('data' => $research));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$research = $this->Research->delete($id);
		}

		$this->set(array('data' => $research));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$researches = $this->Research->find('all', array(
			'contain' => ['Theme']
		));
		

		$this->set(array('data' => $researches));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$trainings = $this->Research->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['created' => 'ASC'],
			'contain' => ['Theme']
		));
		
		$this->set(array('data' => $trainings));
	}


}
