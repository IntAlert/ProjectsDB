<?php

class OtherActivitiesController extends AppController {


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->OtherActivity->create();

			$data = $this->request->input('json_decode');
			$otheractivity = $this->OtherActivity->saveAssociated($data);
		}

		$this->set(array('data' => $otheractivity));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->OtherActivity->exists($id)) {
			throw new NotFoundException(__('Invalid OtherActivity'));
		}

		$otheractivity = $this->OtherActivity->find('first', array(
			'OtherActivity.id' => $id,
			'contain' => ['ParticipantType']
		));
		

		$this->set(array('data' => $otheractivity));
	}

	function update($id) {

		if (!$this->OtherActivity->exists($id)) {
			throw new NotFoundException(__('Invalid OtherActivity'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->OtherActivity->id = $id;

			$data = $this->request->input('json_decode');

			$otheractivity = $this->OtherActivity->saveAssociated($data);
		}

		$this->set(array('data' => $otheractivity));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$otheractivity = $this->OtherActivity->delete($id);
		}

		$this->set(array('data' => $otheractivity));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$otheractivitys = $this->OtherActivity->find('all', array(
			'contain' => ['ParticipantType']
		));
		

		$this->set(array('data' => $otheractivitys));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$otheractivitys = $this->OtherActivity->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType']
		));
		
		$this->set(array('data' => $otheractivitys));
	}


}
