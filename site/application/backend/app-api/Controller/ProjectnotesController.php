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


}
