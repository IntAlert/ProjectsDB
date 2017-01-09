<?php

class ProcessesController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Process->create();

			$data = $this->request->input('json_decode');
			$process = $this->Process->saveAssociated($data);
		}

		$this->set(array('data' => $process));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Process->exists($id)) {
			throw new NotFoundException(__('Invalid Process'));
		}

		$process = $this->Process->find('first', array(
			'Process.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $process));
	}

	function update($id) {

		if (!$this->Process->exists($id)) {
			throw new NotFoundException(__('Invalid Process'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Process->id = $id;

			$data = $this->request->input('json_decode');

			$process = $this->Process->saveAssociated($data);
		}

		$this->set(array('data' => $process));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$process = $this->Process->delete($id);
		}

		$this->set(array('data' => $process));
	}

	function all() {

		// Process filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$participant_type_id = $this->request->query('participant_type_id');
		$theme_id = $this->request->query('theme_id');
		
		// Project filters
		$projectFilter = array(
    		"pathway_id" => $this->request->query('pathway_id'),
    		"donor_id" => $this->request->query('donor_id'),
    		"department_id" => $this->request->query('department_id'),
    		"territory_id" => $this->request->query('territory_id')
    	);

		// generate project id filters based on theme_id, pathway_id, etc
		$project_ids = $this->ProjectIdSearch->getProjectIds($projectFilter);


		// build conditions, joins
		$conditions = [];
		$joins = [];

		// filter on training dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Process.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Process.start_date <=' => $finish_date];
		}

		// filter on training participant type?

		if ($participant_type_id) {
			$joins[] = array(
				'table' => 'trainings_participant_types',
	            'alias' => 'ProcessesParticipantType',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Process.id = ProcessesParticipantType.training_id',
	                'ProcessesParticipantType.participant_type_id' => $participant_type_id
	            )
	        );

		}

		// filter on training theme?
		if ($theme_id) {
			$joins[] = array(
				'table' => 'trainings_themes',
	            'alias' => 'ProcessesTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Process.id = ProcessesTheme.training_id',
	                'ProcessesTheme.theme_id' => $theme_id
	            )
	        );	
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$trainings = $this->Process->find('all', array(
			'order' => ['Process.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => ['ParticipantType', 'Theme', 'Project.Territory']
		));



		$this->set(array('data' => $trainings));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$processes = $this->Process->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $processes));
	}


}
