<?php
App::uses('AppController', 'Controller');
/**
 * Travelapplications Controller
 *
 * @property Travelapplication $Travelapplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ResultsframeworkController extends AppController {


	public $uses = array('ResultsFramework', 'Project');

	public function view($project_id) {
		// check if project exists
		if (!$this->Project->exists($project_id)) {
			throw new NotFoundException(__('Invalid project: ' . $project_id));
		}

		// get any data that exists for this project
		$results = $this->ResultsFramework->findByProjectId($project_id);

		$this->set('results', $results);
	}

}
