<?php

class ProjectnotesController extends AppController {


	function add() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Projectnote->create();

			// add authed user
			$this->request->data['Projectnote']['user_id'] = $this->Auth->user('id');

			$projectnote = $this->Projectnote->save($this->request->data);
		}

		$this->set(compact('projectnote'));
	}

	function delete($projectnote_id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			
			$projectnote = $this->Projectnote->softDelete($projectnote_id);

		}

		$this->set(compact('projectnote'));
	}


}
