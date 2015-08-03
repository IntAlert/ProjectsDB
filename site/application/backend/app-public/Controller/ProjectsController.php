<?php
App::uses('AppController', 'Controller');

/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProjectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');



/**
 * index method
 *
 * @return void
 */
	public function index() {

		$action = $this->request->query('action');

		if ($action == 'search'): 

			// BUILD SEARCH CONDITIONS
			$conditions = array('Project.deleted' => false);
			$joins = [];

			// text search
			if ($q = $this->request->query('q')) $conditions[] = array(
				'OR' => array(

					'Project.title LIKE' => '%' . trim($q) . '%',
					'Project.summary LIKE' => '%' . trim($q) . '%',
					'Project.objectives LIKE' => '%' . trim($q) . '%',
					'Project.goals LIKE' => '%' . trim($q) . '%',
					'Project.beneficiaries LIKE' => '%' . trim($q) . '%',
					'Project.location LIKE' => '%' . trim($q) . '%',	
				)
			);

			// text search
			if ($fund_code = $this->request->query('fund_code')) $conditions[] = array(
				'Project.fund_code LIKE' => '%' . trim($fund_code) . '%',
			);

			// status_id
			if ($status_id = $this->request->query('status_id')) $conditions[] = array(
				'Project.status_id' => $status_id,
			);

			// likelihood_id
			if ($likelihood_id = $this->request->query('likelihood_id')) $conditions[] = array(
				'Project.likelihood_id' => $status_id,
			);

			// programme_id
			if ($programme_id = $this->request->query('programme_id')) $conditions[] = array(
				'Project.programme_id' => $programme_id,
			);

			// owner_user_id
			if ($owner_user_id = $this->request->query('owner_user_id')) $conditions[] = array(
				'Project.owner_user_id' => $owner_user_id,
			);

			// value_from
			if ($value_from = $this->request->query('value_from')) $conditions[] = array(
				'Project.value >=' => $value_from,
			);

			// value_to
			if ($value_to = $this->request->query('value_to')) $conditions[] = array(
				'Project.value <=' => $value_to,
			);

			// start_date
			if ($start_date = $this->request->query('start_date')) {


				$start_date_mysql = DateTime::createFromFormat('d-m-Y', $start_date)->format('Y-m-d');

				$conditions[] = array(
					'Project.start_date >=' => $start_date_mysql,
				);
			}

			if ($finish_date = $this->request->query('finish_date')) {

				$finish_date_mysql = DateTime::createFromFormat('d-m-Y', $finish_date)->format('Y-m-d');

				$conditions[] = array(
					'Project.finish_date <=' => $finish_date_mysql,
				);

			}

			// theme_id (INNER JOIN METHOD)
			if ($theme_id = $this->request->query('theme_id')) {
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

			// donor_id (INNER JOIN METHOD)
			if ($donor_id = $this->request->query('donor_id')) {

				$joins[] = array(
					'table' => 'contracts',
		            'alias' => 'Contract',
		            'type' => 'INNER',
		            'conditions' => array(
		                'Project.id = Contract.project_id',
		                'Contract.donor_id' => (int)$donor_id
		            )
		        );
			}

			// territory_id (INNER JOIN METHOD)
			if ($territory_id = $this->request->query('territory_id')) {
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


			$this->Paginator->settings = array(
				'contain' => array('Programme', 'Status', 'Territory', 'Contract.Donor'),
		        'joins' => $joins,
		        'conditions' => $conditions,
		        'limit' => 10,
		        'order' => array('Project.start_date' => 'DESC'),
		    );

		    $projects = $this->Paginator->paginate();
		    
		else: // ($this->request->query('action') == 'search'): 
			
			$projects = array();

		endif; // ($this->request->query('action') == 'search'): 




		$this->set('projects', $projects);

		// get search form data
		$statuses = $this->Project->Status->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		$donors = $this->Project->Contract->Donor->findOrderedList();
		$programmes = $this->Project->Programme->find('list');
		$territories = $this->Project->Territory->findActiveList();

		
		$employees = $this->User->findEmployeesList();
		$themes = $this->Project->Theme->findOrderedList();

		$this->set(compact('action', 'statuses', 'likelihoods', 'programmes', 'territories', 'employees', 'themes', 'donors'));
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		$options = array(
			'contain' => array(
				'Contract.Donor',
				'Contract.Currency',
				'Contract.Contractbudget',
				'Projectnote.User',
				'Status',
				'Theme',
				'Likelihood',
				'Programme',
				'OwnerUser',
				'Territory',
			),
			'conditions' => array('Project.' . $this->Project->primaryKey => $id),
		);
		$project = $this->Project->find('first', $options);
		$this->set('project', $project);




		// AUDIT
		$this->Audit->record("READ", "Project", $id, $project);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->saveComplete($this->request->data)) {
				
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'view', $this->Project->id));

			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		

		$statuses = $this->Project->Status->findOrderedList();
		$themes = $this->Project->Theme->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		$programmes = $this->Project->Programme->find('list');
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->find('list');

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithProgrammes = $this->Project->Territory->findActiveWithProgramme();
		$users = $this->User->find('list');
		$employees = $this->User->findEmployeesList();
		
		$this->set(compact('territoriesWithProgrammes', 'statuses', 'themes', 'likelihoods', 'programmes', 'territories', 'users', 'employees', 'currencies', 'donors'));


	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {


		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is(array('post', 'put'))) {

			if ($this->Project->saveComplete($this->request->data)) {
				// debug($this->request->data);
				// die();
				$this->Session->setFlash(__('The project has been saved.'));

				
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
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
				),
				'conditions' => array(
					'Project.id' => $id
				)
			);
			$this->request->data = $this->Project->find('first', $options);
		}
		$statuses = $this->Project->Status->findOrderedList();
		$themes = $this->Project->Theme->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		$programmes = $this->Project->Programme->find('list');
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->find('list');

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithProgrammes = $this->Project->Territory->findActiveWithProgramme();
		$users = $this->User->find('list');
		$employees = $this->User->findEmployeesList();

		$this->set(compact('territoriesWithProgrammes', 'statuses', 'themes', 'likelihoods', 'programmes', 'territories', 'users', 'employees', 'currencies', 'donors'));
	}



/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function convert($id = null) {
		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		// TODO: check that the proposal is in the right state

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The proposal has been converted.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
			$project = $this->Project->find('first', $options);;
			$this->request->data = $project;
		}
		$statuses = $this->Project->Status->find('list', array(
			'order' => array('sort_order'),
			'conditions' => array(
				'short_name' => array('funded', 'active', 'declined')
			)
		));
		$territories = $this->Project->Territory->findActiveList();
		$users = $this->User->find('list');

		$current_status = $project['Status'];

		$this->set(compact(
			'statuses',
			 'programmes',
			 'territories',
			 'users',
			 'current_status'
		));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Project->softDelete($id)) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
