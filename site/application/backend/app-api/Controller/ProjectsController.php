<?php

App::uses('File', 'Utility');

class ProjectsController extends AppController {


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

		// Debug
		// $options['conditions']['Project.id'] = [163,164,165];

		$projects = $this->Project->find('all', array(
			// 'fields' => array('id', 'title', 'summary'),
			'contain' => array(
				'Status',
				'Likelihood',
				'Department', 
				'SecondaryDepartment',
				'Theme',
				'Territory',
				'Pathway',
			),
	        'joins' => $options['joins'],
	        'conditions' => $options['conditions'],
	        'limit' => $limit,
	    ));

		// get territories
		$territories = $this->Project->Territory->findActiveList();

		// get pathways
		$pathways = $this->Project->Pathway->findOrderedList();

		// get themes
		$themes = $this->Project->Theme->findOrderedList();

		$this->set(compact(
			'projects',
			'territories',
			'pathways',
			'themes'
		));
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


	function sharepointShortcut($id) {

		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		$options = array(
			'conditions' => array('Project.' . $this->Project->primaryKey => $id),
		);
		$project = $this->Project->find('first', $options);

		$filename = $project['Project']['title'] . '.url';
		$filename = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $filename ) );

		$url = "\\intlalert.sharepoint.com@SSL\DavWWWRoot\prompt\Documents\PRODUCTION\projects\project_id_" . $project['Project']['id'] . "\General";

		$this->set(compact('url', 'filename'));
		
	}
}
