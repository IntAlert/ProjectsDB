<?php

class ProjectsController extends AppController {


	public $components = array(
		'ProjectSearch'
	);

	function search() {

		$options = $this->ProjectSearch->buildSearchOptions();

		$projects = $this->Project->find('all', array(
			'fields' => array('id', 'title', 'summary'),
			'contain' => false,
	        'joins' => $options['joins'],
	        'conditions' => $options['conditions'],
	        'limit' => 25,
	    ));

		$this->set('projects', $projects);
	}

	function all() {

		$key = $this->request->query('key');

		$projects = $this->Project->find('all', array(
			// 'fields' => array('id', 'title', 'summary'),
			'contain' => array(
				'Contract.Donor',
				'Contract.Currency',
				'Contract.Contractbudget',
				'Status',
				'Theme',
				'Likelihood',
				'Programme',
				'OwnerUser',
				'Territory',
				'Pathway',
			),
	        // 'joins' => $options['joins'],
	        'conditions' => array('Project.deleted' => false),
	        // 'limit' => 25,
	    ));

		$this->set('projects', $projects);
	}

	// public function isAuthorized($user) {
	// 	// if logged in, you can access whole API unless overridden
	// 	return true; //!!$this->Auth->user('id');
	// }


}
