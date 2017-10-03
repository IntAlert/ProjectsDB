<?php

class OtherActivitiesController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

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
		
		// OtherActivity filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$participant_type_id = $this->request->query('participant_type_id');
		
		// Project filters
		$projectFilter = array(
			"project_id" => $this->request->query('project_id'), 
    		"pathway_id" => $this->request->query('pathway_id'),
    		"department_id" => $this->request->query('department_id'),
    		"territory_id" => $this->request->query('territory_id')
    	);

		// generate project id filters based on participant_type_id, pathway_id, etc
		$project_ids = $this->ProjectIdSearch->getProjectIds($projectFilter);


		// build conditions, joins
		$conditions = [];
		$joins = [];

		// filter on other_activitiy dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['OtherActivity.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['OtherActivity.finish_date <=' => $finish_date];
		}

		// filter on other_activity theme?
		if ($participant_type_id) {
			$joins[] = array(
				'table' => 'other_activities_participant_types',
	            'alias' => 'OtherActivitiesParticipantTypes',
	            'type' => 'INNER',
	            'conditions' => array(
	                'OtherActivity.id = OtherActivitiesParticipantTypes.other_activity_id',
	                'OtherActivitiesParticipantTypes.participant_type_id' => $participant_type_id
	            )
	        );	
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$other_activities = $this->OtherActivity->find('all', array(
			'order' => ['OtherActivity.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => [
				'ParticipantType',
				'Project.Territory',
				'Project.Pathway',
				'Project.OwnerUser'
			]
		));

		// get all participant_types
		$participant_types = $this->OtherActivity->ParticipantType->findOrderedList();	
		// get continents
		$continents = $this->OtherActivity->Project->Territory->Continent->find('list');

		// get all territories
		$territories = $this->OtherActivity->Project->Territory->findActiveList();

		// get all pathways
		$pathways = $this->OtherActivity->Project->Pathway->findOrderedList();		

		$this->set(array(
			'continents' => $continents,
			'participant_types' => $participant_types,
			'pathways' => $pathways,
			'territories' => $territories,
			'data' => $other_activities,
		));

	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$otheractivities = $this->OtherActivity->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => ['ParticipantType']
		));
		
		$this->set(array('data' => $otheractivities));
	}


}
