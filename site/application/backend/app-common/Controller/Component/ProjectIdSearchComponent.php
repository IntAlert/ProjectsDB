<?php

App::uses('Component', 'Controller');
class ProjectIdSearchComponent extends Component {

	public function initialize(Controller $controller) {
	    $this->controller = $controller;

	    $this->Project = ClassRegistry::init('Project');
	}
    
    function getProjectIds($projectFilter) {

    	// $projectFilter can have any of these values
    	$projectFilterDefaults = array(
    		"project_id" => NULL,
    		"theme_id" => NULL,
    		"pathway_id" => NULL,
    		"donor_id" => NULL,
    		"department_id" => NULL,
    		"territory_id" => NULL
    	);

    	$projectFilter = array_merge($projectFilterDefaults, $projectFilter);


    	// If we have received no filters, return FALSE
    	
    	// array_filter returns empty if all children all null/false
    	if (!array_filter($projectFilter)) {
			return FALSE;
		}
    	
    	// BUILD SEARCH CONDITIONS AND JOINS
		$conditions = array('Project.deleted' => false);

		// simple filters
		if ($projectFilter['department_id']) {
			$conditions['department_id'] = $projectFilter['department_id'];
		}

		// if a project id is set, then obviously the response 
		// will just be this project id
		// For the sake of code complexity though, 
		// just let the rest of the function run its course
		
		if( !is_null($projectFilter['project_id']) ) {
			$conditions['id'] = $projectFilter['project_id'];
		}

		$joins = [];

		// theme_id (INNER JOIN METHOD)
		if ( !is_null($projectFilter['theme_id']) ) {
			$joins[] = array(
				'table' => 'projects_themes',
	            'alias' => 'ProjectsTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ProjectsTheme.project_id',
	                'ProjectsTheme.theme_id' => $projectFilter['theme_id']
	            )
	        );
		}

		// theme_id (INNER JOIN METHOD)
		if ( !is_null($projectFilter['pathway_id']) ) {
			$joins[] = array(
				'table' => 'pathways_project',
	            'alias' => 'ProjectsPathway',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ProjectsPathway.project_id',
	                'ProjectsPathway.pathway_id' => $projectFilter['pathway_id']
	            )
	        );
		}

		// donor_id (INNER JOIN METHOD)
		if ( !is_null($projectFilter['donor_id']) ) {

			$joins[] = array(
				'table' => 'contracts',
	            'alias' => 'ContractDonor',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ContractDonor.project_id',
	                'OR' => array(
		                'ContractDonor.donor_id' => $projectFilter['donor_id']
	                )
	            )
	        );
		}

		// territory_id (INNER JOIN METHOD)
		if ( !is_null($projectFilter['territory_id']) ) {
			$joins[] = array(
				'table' => 'territories_projects',
	            'alias' => 'TerritoriesProject',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = TerritoriesProject.project_id',
	                'TerritoriesProject.territory_id' => $projectFilter['territory_id']
	            )
	        );
		}

		// get the ids
		$fields = array('Project.id', 'Project.id');
		return $this->Project->find('list', compact(
			'conditions', 'joins', 'fields'
		));

		// return compact('conditions', 'joins', 'fields');

    }
}