<?php

class MeetingsController extends AppController {

	public $components = array(
		'ProjectIdSearch'
	);

	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Meeting->create();

			$data = $this->request->input('json_decode');
			$meeting = $this->Meeting->saveAssociated($data);
		}

		$this->set(array('data' => $meeting));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}

		$meeting = $this->Meeting->find('first', array(
			'Meeting.id' => $id,
			'contain' => ['ParticipantType', 'Theme']
		));
		

		$this->set(array('data' => $meeting));
	}

	function update($id) {

		if (!$this->Meeting->exists($id)) {
			throw new NotFoundException(__('Invalid Meeting'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Meeting->id = $id;

			$data = $this->request->input('json_decode');

			$meeting = $this->Meeting->saveAssociated($data);
		}

		$this->set(array('data' => $meeting));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$meeting = $this->Meeting->delete($id);
		}

		$this->set(array('data' => $meeting));
	}

	function all() {

		// Meeting filters
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$participant_type_id = $this->request->query('participant_type_id');
		$theme_id = $this->request->query('theme_id');
		
		// Project filters
		$projectFilter = array(
			"project_id" => $this->request->query('project_id'), 
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

		// filter on meeting dates?
		if ($start_date) {
			// finish is after start_date filter
			$conditions[] = ['Meeting.finish_date >=' => $start_date];
		}

		if ($finish_date) {
			// finish is after start_date filter
			$conditions[] = ['Meeting.start_date <=' => $finish_date];
		}

		// filter on meeting participant type?

		if ($participant_type_id) {
			$joins[] = array(
				'table' => 'meetings_participant_types',
	            'alias' => 'MeetingsParticipantType',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Meeting.id = MeetingsParticipantType.meeting_id',
	                'MeetingsParticipantType.participant_type_id' => $participant_type_id
	            )
	        );

		}

		// filter on meeting theme?
		if ($theme_id) {
			$joins[] = array(
				'table' => 'meetings_themes',
	            'alias' => 'MeetingsTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Meeting.id = MeetingsTheme.meeting_id',
	                'MeetingsTheme.theme_id' => $theme_id
	            )
	        );	
		}

		// Add project ID filter
		if (is_array($project_ids)) 
			$conditions['project_id'] = $project_ids;

		$meetings = $this->Meeting->find('all', array(
			'order' => ['Meeting.start_date' => 'DESC'],
			'conditions' => $conditions,
			'joins' => $joins,
			'contain' => ['ParticipantType', 'Theme', 'Project.Territory', 'Project.Pathway']
		));

		// get territories
		$territories = $this->Meeting->Project->Territory->findActiveList();

		// get pathways
		$pathways = $this->Meeting->Project->Pathway->findOrderedList();		

		// get participant_types
		$participant_types = $this->Meeting->ParticipantType->findOrderedList();		

		$this->set(array(
			'participant_types' => $participant_types,
			'pathways' => $pathways,
			'territories' => $territories,
			'data' => $meetings
		));

	}

	function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$meetings = $this->Meeting->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['finish_date' => 'ASC'],
			'contain' => ['ParticipantType', 'Theme']
		));
		
		$this->set(array('data' => $meetings));
	}


}
