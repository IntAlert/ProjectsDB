<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 * @property Status $Status
 * @property Programme $Programme
 * @property Country $Country
 * @property OwnerUser $OwnerUser
 * @property Projectnote $Projectnote
 * @property Country $Country
 * @property User $User
 */
class Project extends AppModel {

	

	public $actsAs = array(
		'AuditLog.Auditable' => array(
			'ignore' => array( 'deleted'),
		)
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
		),
		'Likelihood' => array(
			'className' => 'Likelihood',
			'foreignKey' => 'likelihood_id',
		),
		'Programme' => array(
			'className' => 'Programme',
			'foreignKey' => 'programme_id',
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
		),
		'SecondaryDepartment' => array(
			'className' => 'Department',
			'foreignKey' => 'secondary_department_id',
		),
		'OwnerUser' => array(
			'className' => 'User',
			'foreignKey' => 'owner_user_id',
			'conditions' => '',
			'fields' => array('id', 'username', 'name', 'first_name', 'last_name'),
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Projectnote' => array(
			'className' => 'Projectnote',
			'foreignKey' => 'project_id',
			'dependent' => false,
			'conditions' => array('Projectnote.deleted' => false),
			'order' => array('created ASC'),
		),

		'Contract' => array(
			'className' => 'Contract',
			'foreignKey' => 'project_id',
			'dependent' => true,
			'conditions' => array('Contract.deleted' => false),
			'order' => array('created DESC'),
		),

	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Territory' => array(
			'className' => 'Territory',
			'joinTable' => 'territories_projects',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'territory_id',
			'unique' => 'keepExisting',
		),
		'TeamMember' => array(
			'className' => 'User',
			'joinTable' => 'projects_users',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
		),
		'Theme' => array(
			'className' => 'Theme',
			'joinTable' => 'projects_themes',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'theme_id',
			'unique' => 'keepExisting',
		),
		'Pathway' => array(
			'className' => 'Pathway',
			'joinTable' => 'pathways_project',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'pathway_id',
			'unique' => 'keepExisting',
		)
	);

	function getFirstProjectYear() {
		$result = $this->find('first', array(
			'contain' => false,
			'fields' => array("YEAR(start_date)"),
			'order' => array('Project.start_date' => 'ASC'),
			'conditions' => array('Project.start_date <>' => NULL ),
		));

		$firstYear = (int) isset($result[0]) ?
			$result[0]['YEAR(start_date)'] : date("Y");

		return $firstYear;

	}


	function findRecentlyViewed($user_id, $limit = 10) {

		return $this->find('all', array(
			'contain' => false,
			'joins' => array(
				array(
					'table' => 'audits',
		            'alias' => 'Audit',
		            'type' => 'INNER',
		            'conditions' => array(
		            	'Audit.source_id' => $user_id, // audits the user owns
		                'Audit.model = "Project"',
		                'Project.id = Audit.entity_id',
		                'Project.deleted = 0',
		            ),

		        ),
			),
			'order' => array('Audit.created DESC'),
			'group' => array('Project.id'),
			'limit' => $limit,
		));



	}

	function getProjectsByDepartmentAndYear($department_id, $year) {
		return $this->find('all', array(
			'contain' => array(
				'Contract.Contractbudget',
				'Contract.Donor',
				'Territory',
				'Likelihood',
				'Status',
			),
			'conditions' => array(
				'Project.deleted' => false,
				'Project.department_id' => $department_id,
				'Status.short_name <>' => array('concept', 'cancelled', 'rejected', 'completed'),
				'AND' => array(
					'YEAR(Project.start_date) <=' => $year,
					'YEAR(Project.finish_date) >=' => $year,
				)
			),
			'order' => array(
				'Project.title' => 'ASC'
			),
		));
	}



	function saveComplete($data) {

		// dynamically calculate value sourced at contract level
		$value_sourced = 0;
		if (isset($data['Contract'])):
			foreach ($data['Contract'] as $contract):
				foreach ($contract['Contractbudget'] as $payment):
					$value_sourced += $payment['value_gbp'];
				endforeach; // ($contract['Payment'] as $payment):
			endforeach; // ($data['Contract'] as $contract):
		


			// delete all existing contractbudgets before a save,
			// this is a bit dangerous
			foreach ($data['Contract'] as & $contract) {

				if (isset($contract['id'])) {

					// delete any contractbudgets in the database
					$this->Contract->Contractbudget->deleteAll(array(
						'contract_id' => $contract['id']
					));

					// delete any contractbudgets in the submitted data (for deleted contracts)
					if ($contract['deleted']) {
						$contract['Contractbudget'] = array();
					}

				}
				
			}

		endif; // (isset($data['Contract'])):
		$data['Project']['value_sourced'] = $value_sourced;


		return $this->saveAssociated($data, array('deep' => true));
	}



	function getMapData($year) {
		$projects = $this->find('all', array(
			'contain' => array(
				'Contract.Contractbudget',
				'Contract.Donor',
				'Territory',
				'Likelihood',
				'Status',
			),
			'conditions' => array(
				'Project.deleted' => false,
				'Status.short_name' => array(
					'approved',
					'project-ongoing',
					'completed',
				),

				'AND' => array(
					'YEAR(Project.start_date) <=' => $year,
					'YEAR(Project.finish_date) >=' => $year,
				)
			),
			'order' => array(
				'Project.title' => 'ASC'
			),
		));

		// separate into territories with iso3 codes
		$projectsByTerritory = [];


		foreach ($projects as $project) {

			foreach($project['Territory'] as $territory):

				// don't bother returning projects with null iso3
				if ( ! $territory['iso3'] ) continue;

				if (!isset($projectsByTerritory[$territory['iso3']])) {
					$projectsByTerritory[$territory['iso3']] = [
						'territory' => $territory,
						'projects' => array(), // to be loaded up
					];
				}

				$projectsByTerritory[$territory['iso3']]['projects'][$project['Project']['id']] = $project;

			endforeach; //($project['Territory'] as $territory):

		}

		// remove keys, all a bit hacky
		foreach ($projectsByTerritory as &$val) {
			$val['projects'] = array_values($val['projects']);
		}
		
		return $projectsByTerritory;
	}


	public function softDelete($id) {
		$this->id = $id;
		$this->saveField('deleted', true);
		return true; // assume it worked
	}


}
