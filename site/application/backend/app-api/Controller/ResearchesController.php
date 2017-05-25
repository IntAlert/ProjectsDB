<?php

class ResearchesController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

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
		
		// Research filters
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

		// filter on research theme?
		if ($theme_id) {
			$joins[] = array(
				'table' => 'researches_themes',
	            'alias' => 'ResearchesTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Research.id = ResearchesTheme.research_id',
	                'ResearchesTheme.theme_id' => $theme_id
	            )
	        );	
		}

		// filter on research dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Research.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Research.start_date <=' => $finish_date];
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$meetings = $this->Research->find('all', array(
			'order' => ['Research.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => [
				'Theme',
				'Project.Territory',
				'Project.Pathway', 
				'Project.OwnerUser'
			]
		));

		// get all themes
		$themes = $this->Research->Theme->findOrderedList();

		// get all territories
		$territories = $this->Research->Project->Territory->findActiveList();

		// get all pathways
		$pathways = $this->Research->Project->Pathway->findOrderedList();		

		$this->set(array(
			'pathways' => $pathways,
			'territories' => $territories,
			'themes' => $themes,
			'data' => $meetings,
		));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$researchs = $this->Research->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['created' => 'ASC'],
			'contain' => ['Theme']
		));
		
		$this->set(array('data' => $researchs));
	}


}
