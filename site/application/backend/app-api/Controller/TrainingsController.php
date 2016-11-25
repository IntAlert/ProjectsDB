<?php

class TrainingsController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);


	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Training->create();

			$data = $this->request->input('json_decode');
			$training = $this->Training->saveAssociated($data);
		}

		$this->set(array('data' => $training));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid Training'));
		}

		$training = $this->Training->find('first', array(
			'Training.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $training));
	}

	function update($id) {

		if (!$this->Training->exists($id)) {
			throw new NotFoundException(__('Invalid Training'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Training->id = $id;

			$data = $this->request->input('json_decode');

			$training = $this->Training->saveAssociated($data);
		}

		$this->set(array('data' => $training));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$training = $this->Training->delete($id);
		}

		$this->set(array('data' => $training));
	}

	function all() {
		
		// TODO: must be authed and must be note owner


		// Training filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$participant_type_id = $this->request->query('participant_type_id');
		$theme_id = $this->request->query('theme_id');
		
		// Project filters
		$projectFilter = array(
    		"pathway_id" => $this->request->query('pathway_id'),
    		"donor_id" => $this->request->query('donor_id'),
    		"territory_id" => $this->request->query('territory_id')
    	);

		// generate project id filters based on theme_id, pathway_id, etc
		$project_ids = $this->ProjectIdSearch->getProjectIds($projectFilter);


		// build conditions, joins
		$conditions = [];
		$joins = [];

		// filter on training dates?
		if ($start_date) $conditions[] = ['date >=' => $start_date];
		if ($finish_date) $conditions[] = ['date <=' => $finish_date];

		// filter on training participant type?

		if ($participant_type_id) {
			$joins[] = array(
				'table' => 'trainings_participant_types',
	            'alias' => 'TrainingsParticipantType',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Training.id = TrainingsParticipantType.training_id',
	                'TrainingsParticipantType.participant_type_id' => $participant_type_id
	            )
	        );

		}

		// filter on training theme?
		if ($theme_id) {
			$joins[] = array(
				'table' => 'trainings_themes',
	            'alias' => 'TrainingsTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Training.id = TrainingsTheme.training_id',
	                'TrainingsTheme.theme_id' => $theme_id
	            )
	        );	
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$trainings = $this->Training->find('all', array(
			'order' => ['Training.date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => ['ParticipantType', 'Theme']
		));


		// $this->response->header(array(
		//     'Content-Type' => 'application/csv',
		//     'Content-Disposition' => 'attachment; filename=example.csv',
		//     'Pragma' => 'no-cache'
		// ));



		$this->set(array('data' => $trainings));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$trainings = $this->Training->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $trainings));
	}


}
