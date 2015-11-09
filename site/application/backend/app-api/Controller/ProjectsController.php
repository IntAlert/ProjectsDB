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


}
