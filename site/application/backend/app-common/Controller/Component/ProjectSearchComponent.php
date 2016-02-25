<?php

App::uses('Component', 'Controller');
class ProjectSearchComponent extends Component {

	public function initialize(Controller $controller) {
	    $this->controller = $controller;
	}
    
    function buildSearchOptions() {
    	
    	// BUILD SEARCH CONDITIONS AND JOINS
		$conditions = array('Project.deleted' => false);
		$joins = [];

		// text search
		if ($q = $this->controller->request->query('q')) {

			// split the query into words
			$q_split = explode(' ', $q);

			foreach ($q_split as $q_word) {

				$conditions[] = array(

					'OR' => array(
						'Project.title LIKE' => '%' . trim($q_word) . '%',
						'Project.summary LIKE' => '%' . trim($q_word) . '%',
						'Project.objectives LIKE' => '%' . trim($q_word) . '%',
						'Project.goals LIKE' => '%' . trim($q_word) . '%',
						'Project.beneficiaries LIKE' => '%' . trim($q_word) . '%',
						'Project.location LIKE' => '%' . trim($q_word) . '%',	
					)

				);


				// // also search donor names
				// $joins[] = array(
				// 	'table' => 'donors',
		  //           'alias' => 'ContractDonorName',
		  //           'type' => 'INNER',
		  //           'conditions' => array(
		  //               'Project.id = ContractDonorName.project_id',
		  //               'ContractDonorName.name LIKE' =>  '%' . trim($q_word) . '%',
		  //           )
		  //       );



			}
		}

		// text search
		if ($fund_code = $this->controller->request->query('fund_code')) $conditions[] = array(
			'Project.fund_code LIKE' => '%' . trim($fund_code) . '%',
		);

		// status_id
		if ($status_id = $this->controller->request->query('status_id')) $conditions[] = array(
			'Project.status_id' => $status_id,
		);

		// likelihood_id
		if ($likelihood_id = $this->controller->request->query('likelihood_id')) $conditions[] = array(
			'Project.likelihood_id' => $status_id,
		);

		// department_id
		if ($department_id = $this->controller->request->query('department_id')) $conditions[] = array(
			'Project.department_id' => $department_id,
		);

		// owner_user_id
		if ($owner_user_id = $this->controller->request->query('owner_user_id')) $conditions[] = array(
			'Project.owner_user_id' => $owner_user_id,
		);

		// value_from
		if ($value_from = $this->controller->request->query('value_from')) $conditions[] = array(
			'Project.value_required >=' => $value_from,
		);

		// value_to
		if ($value_to = $this->controller->request->query('value_to')) $conditions[] = array(
			'Project.value_required <=' => $value_to,
		);

		// start_date
		if ($start_date = $this->controller->request->query('start_date')) {
			
			$start_date_mysql = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');

			$conditions[] = array(
				'Project.start_date >=' => $start_date_mysql,
			);
		}

		if ($finish_date = $this->controller->request->query('finish_date')) {

			$finish_date_mysql = DateTime::createFromFormat('d/m/Y', $finish_date)->format('Y-m-d');

			$conditions[] = array(
				'Project.finish_date <=' => $finish_date_mysql,
			);

		}

		// theme_id (INNER JOIN METHOD)
		if ($theme_id = $this->controller->request->query('theme_id')) {
			$joins[] = array(
				'table' => 'projects_themes',
	            'alias' => 'ProjectsTheme',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ProjectsTheme.project_id',
	                'ProjectsTheme.theme_id' => (int)$theme_id
	            )
	        );
		}

		// theme_id (INNER JOIN METHOD)
		if ($pathway_id = $this->controller->request->query('pathway_id')) {
			$joins[] = array(
				'table' => 'pathways_project',
	            'alias' => 'ProjectsPathway',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ProjectsPathway.project_id',
	                'ProjectsPathway.pathway_id' => (int)$pathway_id
	            )
	        );
		}

		// donor_id (INNER JOIN METHOD)
		if ($donor_id = $this->controller->request->query('donor_id')) {

			$joins[] = array(
				'table' => 'contracts',
	            'alias' => 'ContractDonor',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ContractDonor.project_id',
	                'ContractDonor.donor_id' => (int)$donor_id
	            )
	        );
		}

		// contractcategory_id (INNER JOIN METHOD)
		if ($contractcategory_id = $this->controller->request->query('contractcategory_id')) {

			$joins[] = array(
				'table' => 'contracts',
	            'alias' => 'ContractContractcategory',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ContractContractcategory.project_id',
	                'ContractContractcategory.contractcategory_id' => (int)$contractcategory_id
	            )
	        );
		}

		// framework_id (INNER JOIN METHOD)
		if ($framework_id = $this->controller->request->query('framework_id')) {

			$joins[] = array(
				'table' => 'contracts',
	            'alias' => 'ContractFramework',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = ContractFramework.project_id',
	                'ContractFramework.framework_id' => (int)$framework_id
	            )
	        );
		}

		// territory_id (INNER JOIN METHOD)
		if ($territory_id = $this->controller->request->query('territory_id')) {
			$joins[] = array(
				'table' => 'territories_projects',
	            'alias' => 'TerritoriesProject',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = TerritoriesProject.project_id',
	                'TerritoriesProject.territory_id' => (int)$territory_id
	            )
	        );
		}

		return compact('conditions', 'joins');

    }
}