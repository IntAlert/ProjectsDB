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
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Programme' => array(
			'className' => 'Programme',
			'foreignKey' => 'programme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		,
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
		'Country' => array(
			'className' => 'Country',
			'joinTable' => 'countries_projects',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'country_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'TeamMember' => array(
			'className' => 'User',
			'joinTable' => 'projects_users',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Theme' => array(
			'className' => 'Theme',
			'joinTable' => 'projects_themes',
			'foreignKey' => 'project_id',
			'associationForeignKey' => 'theme_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);


	public $actsAs = array(
		'AuditLog.Auditable'
	);


	function findRecentlyViewed($user_id, $limit = 10) {

		return $this->find('all', array(
			'contain' => false,
			'joins' => array(
				array(
					'table' => 'audits',
		            'alias' => 'Audit',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Audit.model = "Project"',
		                'Project.id = Audit.entity_id',
		            ),

		        ),
			),
			'order' => array('Audit.created DESC'),
			'group' => array('Project.id'),
			'limit' => $limit,
		));



	}


}
