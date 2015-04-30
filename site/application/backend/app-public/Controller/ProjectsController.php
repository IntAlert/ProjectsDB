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

		// BUILD SEARCH CONDITIONS
		$conditions = $joins = [];

		// text search
		if ($q = $this->request->query('q')) $conditions[] = array(
			'Project.title LIKE' => '%' . trim($q) . '%',
		);

		// status_id
		if ($status_id = $this->request->query('status_id')) $conditions[] = array(
			'Project.status_id' => $status_id,
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

		// country_id (INNER JOIN METHOD)
		if ($country_id = $this->request->query('country_id')) {
			$joins[] = array(
				'table' => 'countries_projects',
	            'alias' => 'CountriesProject',
	            'type' => 'INNER',
	            'conditions' => array(
	                'Project.id = CountriesProject.project_id',
	                'CountriesProject.country_id' => (int)$country_id
	            )
	        );
		}





		$this->Paginator->settings = array(
	        'joins' => $joins,
	        'conditions' => $conditions,
	        'limit' => 20,
	    );
		$this->set('projects', $this->Paginator->paginate());


		// get search form data
		$statuses = $this->Project->Status->findOrderedList();
		$programmes = $this->Project->Programme->find('list');
		$countries = $this->Project->Country->findActiveList();
		$employees = $this->User->findEmployeesList();
		$themes = $this->Project->Theme->find('list');

		$this->set(compact('statuses', 'programmes', 'countries', 'employees', 'themes'));
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
				'Contract.Payment',
				'Projectnote.User',
				'Status',
				'Programme',
				'OwnerUser'
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
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		$statuses = $this->Project->Status->find('list');
		$programmes = $this->Project->Programme->find('list');
		$countries = $this->Project->Country->findActiveList();
		$users = $this->Project->User->find('list');
		$employees = $this->User->findEmployeesList();
		$this->set(compact('statuses', 'programmes', 'countries', 'countries', 'users', 'employees'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {





// 		$project = $this->Project->find('first', array(
// 			'contain' => array('Contract.Payment'),
// 			'conditions' => array(
// 				'Project.id' => 10
// 			)
// 		));

// 		$project['Contract'][0]['Payment'][0]['value_gbp'] = rand(1,5);

// 		$this->Project->saveAssociated($project, array('deep' => true));

// 		debug($project);


// die();
// 			debug($this->Project->saveAssociated($this->request->data, array('deep' => true)));

// 			die();


		if (!$this->Project->exists($id)) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is(array('post', 'put'))) {

			if ($this->Project->saveAssociated($this->request->data, array('deep' => true))) {
				$this->Session->setFlash(__('The project has been saved.'));

				
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
				'contain' => 'Contract.Payment',
				'conditions' => array(
					'Project.id' => $id
				)
			);
			$this->request->data = $this->Project->find('first', $options);
		}
		$statuses = $this->Project->Status->find('list');
		$programmes = $this->Project->Programme->find('list');
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->find('list');

		$countries = $this->Project->Country->findActiveList();
		$users = $this->User->find('list');
		$employees = $this->User->findEmployeesList();
		
		$this->set(compact('statuses', 'programmes', 'countries', 'countries', 'users', 'employees', 'currencies', 'donors'));
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
		$countries = $this->Project->Country->findActiveList();
		$users = $this->User->find('list');

		$current_status = $project['Status'];

		$this->set(compact(
			'statuses',
			 'programmes',
			 'countries',
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
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
