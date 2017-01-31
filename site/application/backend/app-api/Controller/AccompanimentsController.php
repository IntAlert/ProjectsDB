<?php

class AccompanimentsController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Accompaniment->create();

			$data = $this->request->input('json_decode');
			$accompaniment = $this->Accompaniment->saveAssociated($data);
		}

		$this->set(array('data' => $accompaniment));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Accompaniment->exists($id)) {
			throw new NotFoundException(__('Invalid Accompaniment'));
		}

		$accompaniment = $this->Accompaniment->find('first', array(
			'Accompaniment.id' => $id,
			'contain' => ['ParticipantType']
		));
		

		$this->set(array('data' => $accompaniment));
	}

	function update($id) {

		if (!$this->Accompaniment->exists($id)) {
			throw new NotFoundException(__('Invalid Accompaniment'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Accompaniment->id = $id;

			$data = $this->request->input('json_decode');

			// delete previous associations
			$this->Accompaniment->AccompanimentParticipantCount->deleteCounts($id);

			$accompaniment = $this->Accompaniment->saveAssociated($data);
		}

		$this->set(array('data' => $accompaniment));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$accompaniment = $this->Accompaniment->delete($id);
		}

		$this->set(array('data' => $accompaniment));
	}

	function all() {

		// Accompaniment filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$participant_type_id = $this->request->query('participant_type_id');
		
		// Project filters
		$projectFilter = array(
    		"pathway_id" => $this->request->query('pathway_id'),
    		"donor_id" => $this->request->query('donor_id'),
    		"department_id" => $this->request->query('department_id'),
    		"territory_id" => $this->request->query('territory_id')
    	);

		// generate project id filters based on pathway_id, etc
		$project_ids = $this->ProjectIdSearch->getProjectIds($projectFilter);


		// build conditions, joins
		$conditions = [];
		$joins = [];

		// filter on accompaniment dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Accompaniment.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Accompaniment.start_date <=' => $finish_date];
		}

		// filter on accompaniment participant type?

		if ($participant_type_id) {
			$joins[] = array(
				'table' => 'accompaniments_participant_types',
	            'alias' => 'AccompanimentsParticipantType',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Accompaniment.id = AccompanimentsParticipantType.accompaniment_id',
	                'AccompanimentsParticipantType.participant_type_id' => $participant_type_id
	            )
	        );

		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$accompaniments = $this->Accompaniment->find('all', array(
			'order' => ['Accompaniment.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => ['ParticipantType', 'Project.Territory']
		));



		$this->set(array('data' => $accompaniments));
	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$acccompaniments = $this->Accompaniment->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => ['ParticipantType']
		));
		
		$this->set(array('data' => $acccompaniments));
	}


}
