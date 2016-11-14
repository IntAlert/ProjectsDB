<?php

class AdvocaciesController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Advocacy->create();

			$data = $this->request->input('json_decode');
			$advocacy = $this->Advocacy->saveAssociated($data);
		}

		$this->set(array('data' => $advocacy));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Advocacy->exists($id)) {
			throw new NotFoundException(__('Invalid Advocacy'));
		}

		$advocacy = $this->Advocacy->find('first', array(
			'Advocacy.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $advocacy));
	}

	function update($id) {

		if (!$this->Advocacy->exists($id)) {
			throw new NotFoundException(__('Invalid Advocacy'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Advocacy->id = $id;

			$data = $this->request->input('json_decode');

			// delete previous associations
			$this->Advocacy->AdvocacyParticipantCount->deleteCounts($id);

			$advocacy = $this->Advocacy->saveAssociated($data);
		}

		$this->set(array('data' => $advocacy));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$advocacy = $this->Advocacy->delete($id);
		}

		$this->set(array('data' => $advocacy));
	}

	function all() {
		
		// TODO: must be authed and must be note owner


		$advocacies = $this->Advocacy->find('all', array(
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $advocacies));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$advocacies = $this->Advocacy->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $advocacies));
	}


}
