<?php

class AdvocaciesController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

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

		// Advocacy filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$theme_id = $this->request->query('theme_id');
		
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

		// filter on training theme?
		if ($theme_id) {
			$joins[] = array(
				'table' => 'meetings_themes',
	            'alias' => 'AdvocaciesTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Advocacy.id = AdvocaciesTheme.training_id',
	                'AdvocaciesTheme.theme_id' => $theme_id
	            )
	        );	
		}

		// filter on training dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Advocacy.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Advocacy.start_date <=' => $finish_date];
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$meetings = $this->Advocacy->find('all', array(
			'order' => ['Advocacy.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => [
				'Theme',
				'Project.Territory',
				'Project.Pathway'
			]
		));

		// get all themes
		$themes = $this->Advocacy->Theme->findOrderedList();

		// get all territories
		$territories = $this->Advocacy->Project->Territory->findActiveList();

		// get all pathways
		$pathways = $this->Advocacy->Project->Pathway->findOrderedList();		

		$this->set(array(
			'pathways' => $pathways,
			'territories' => $territories,
			'themes' => $themes,
			'data' => $meetings,
		));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$advocacies = $this->Advocacy->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $advocacies));
	}


}
