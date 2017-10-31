<?php

class ResultsController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Result->create();

			$data = $this->request->input('json_decode');

			// date should default to first date the result was recorded
			// as in, today
			$data->Result->date = date('Y-m-d');

			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}

		$result = $this->Result->find('first', array(
			'Result.id' => $id,
			'contain' => ['Impact']
		));
		

		$this->set(array('data' => $result));
	}

	function update($id) {

		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Result->id = $id;

			$data = $this->request->input('json_decode');

			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$result = $this->Result->delete($id);
		}

		$this->set(array('data' => $result));
	}

	function approvePublication($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$result = $this->Result->approvePublication($id);
		}

		$this->set(array('data' => $result));
	}

	function blockPublication($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$result = $this->Result->blockPublication($id);
		}

		$this->set(array('data' => $result));
	}

	function all() {
		
		// Result filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$theme_id = $this->request->query('theme_id');
		$impact_id = $this->request->query('impact_id');
		
		// Project filters
		$projectFilter = array(
			"project_id" => $this->request->query('project_id'), 
    		"pathway_id" => $this->request->query('pathway_id'),
    		"department_id" => $this->request->query('department_id'),
    		"territory_id" => $this->request->query('territory_id')
    	);

		// generate project id filters based on theme_id, pathway_id, etc
		$project_ids = $this->ProjectIdSearch->getProjectIds($projectFilter);


		// build conditions, joins
		$conditions = [];
		$joins = [];

		// filter on other_activitiy dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Result.date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Result.date <=' => $finish_date];
		}

		// filter on result impact?
		if ($impact_id) {
			$joins[] = array(
				'table' => 'impacts_results',
	            'alias' => 'ImpactsResults',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Result.id = ImpactsResults.result_id',
	                'ImpactsResults.impact_id' => $impact_id
	            )
	        );	
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$results = $this->Result->find('all', array(
			'order' => ['Result.date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => [
				'Impact',
				'Project.Territory',
				'Project.Pathway', 
				'Project.OwnerUser'
			]
		));

		// get continents
		$continents = $this->Result->Project->Territory->Continent->find('list');

		// get territories
		$territories = $this->Result->Project->Territory->findActiveList();

		// get pathways
		$pathways = $this->Result->Project->Pathway->findOrderedList();

		// get all impacts
		$impacts = $this->Result->Impact->findOrderedList();	

		$this->set(array(
			'continents' => $continents,
			'territories' => $territories,
			'pathways' => $pathways,
			'impacts' => $impacts,
			'data' => $results,
		));
	}

	public function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$results = $this->Result->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => [
				'Project.Territory', 
				'Project.Pathway', 
				'Project.Theme', 
				'Impact'
			]
		));
		
		$this->set(array('data' => $results));
		
	}

}
