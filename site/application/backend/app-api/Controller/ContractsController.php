<?php

class ContractsController extends AppController {

	public $components = array(
		'ProjectSearch'
	);

	function search() {

		// set limit
		if ( $this->request->query('limit') ) {
			$limit = $this->request->query('limit');

		} elseif ( isset($this->request->params['ext']) ) {
			// if CSV, no limit, otherwise, 5
			$limit = ($this->request->params['ext'] == 'csv') ? null : 5;

		} else {
			$limit = 5;
		}

		$options = $this->ProjectSearch->buildSearchOptions();

		// get project Ids that match these conditions
		$project_ids = $this->Contract->Project->find('list', array(
			'fields' => array('id', 'id'),
	        'joins' => $options['joins'],
	        'conditions' => $options['conditions'],
	        'limit' => $limit,
	    ));

	    $contracts = $this->Contract->find('all', array(
	    	'contain' => array(
				'Project.Status',
				'Project.Likelihood',
				'Project.Department', 
				'Project.SecondaryDepartment',
				'Donor',
				'Currency',
				'Currency',
				'Framework',
				'Contractcategory',
				'Contractbudget'
			),
			'conditions' => array(
				'project_id' => $project_ids
			),
			'order' => array(
				'project_id' => 'DESC'
			)
	    ));

		$this->set(compact('contracts'));
	}

}
