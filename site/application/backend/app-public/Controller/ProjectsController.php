<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
App::uses('SharepointDocs', 'Lib');

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
	public $components = array(
		'Paginator',
		'ProjectSearch'
	);



/**
 * index method
 *
 * @return void
 */
	public function index() {

		$action = $this->request->query('action');

		if ($action == 'search'): 

			// BUILD SEARCH CONDITIONS
			$options = $this->ProjectSearch->buildSearchOptions();

			$this->Paginator->settings = array(
				'contain' => array(
					'Department', 
					'Status', 
					'Territory', 
					'Contract.Donor'
				),
		        'joins' => $options['joins'],
		        'conditions' => $options['conditions'],
		        'limit' => 25,
		        'order' => array('Project.start_date' => 'DESC'),
		    );

		    $projects = $this->Paginator->paginate();
		    
		else: // ($this->request->query('action') == 'search'): 
			
			$projects = array();

		endif; // ($this->request->query('action') == 'search'): 



		// build CSV download link
		$csv_download_link_contracts = '/api/contracts/search.csv?' . $_SERVER['QUERY_STRING'] . '&download=1';
		$csv_download_link_projects = '/api/projects/search.csv?' . $_SERVER['QUERY_STRING'] . '&download=1';
		


		// get search form data
		$statuses = $this->Project->Status->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		$donors = $this->Project->Contract->Donor->findOrderedList();
		$frameworks = $this->Project->Contract->Framework->findOrderedList();
		$contractcategories = $this->Project->Contract->Contractcategory->findOrderedList();
		$departments = $this->Project->Department->find('list');
		$territories = $this->Project->Territory->findActiveList();

		
		$budget_holders = $this->User->findBudgetHoldersList();
		$themes = $this->Project->Theme->findOrderedList();
		$pathways = $this->Project->Pathway->findOrderedList();


		// pass data to view
		$this->set(compact(
			'projects',
			'action',
			'statuses',
			'likelihoods',
			'programmes',
			'departments',
			'territories',
			'budget_holders',
			'themes',
			'donors',
			'frameworks',
			'contractcategories',
			'pathways',
			'csv_download_link_projects',
			'csv_download_link_contracts'
		));
		
	}


	public function searchDocs() {

		$action = $this->request->query('data.action');

		if ($action == 'search'): 

			$sd = new SharepointDocs($this->Auth->user('id'), $this->User->Office365user);

			$q = $this->request->query('data.q');

			$searchResults = $sd->search($q);

			// debug($searchResults);

			$this->set(compact('searchResults'));

		endif; // ($action == 'search'): 


	}



	public function health($year) {
		$conditions = array(
			'Project.deleted' => false,
			'YEAR(Project.start_date) <=' => $year,
			'YEAR(Project.finish_date) >=' => $year,
		);


		$projects = $this->Project->find('all', array(
			'contain' => array('Territory', 'Theme', 'Contract.Donor', 'Contract.Contractbudget'),
	        'conditions' => $conditions,
	        'order' => array('Project.title' => 'ASC'),
	    ));


		$this->set('projects', $projects);


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
				'Status',
				'Pathway',
				'Theme',
				'Likelihood',
				'Department',
				'SecondaryDepartment',
				'Programme',
				'OwnerUser',
				'Territory',
			),
			'conditions' => array('Project.' . $this->Project->primaryKey => $id),
		);
		$project = $this->Project->find('first', $options);


		// check not deleted
		if ($project['Project']['deleted']) {
			throw new NotFoundException(__('This project has been deleted. Please contact the Admin to reinstate'));
		}


		// DOCUMENTS

		// connect to Sharepoint
		if ( !Configure::read('disable_sharepoint_folder_sync') ):
			$user_id = $this->Auth->user('id');
			$sd = new SharepointDocs($user_id, $this->User->Office365user);

			// get list of files on Sharepoint
			$results = $sd->createTemplateFolders($id, false); // TODO: remove ensureFoldersCreated = false
			// $results = $sd->createTemplateFolders($id); // TODO: remove ensureFoldersCreated = false

			$sharepoint_root_folder = $results['sharepoint_root_folder'];
			$fileTree = $results['fileTree'];	

		endif; // ( !Configure::read('disable_sharepoint_folder_sync') ) {
		


		// get activity
		$project_activity = $this->Audit->findProjectActivity($id);

		// AUDIT
		$this->Audit->record("READ", "Project", $id, $project);

		$this->set(compact('project', 'fileTree', 'sharepoint_root_folder', 'project_activity'));
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

				$user_id = $this->Auth->user('id');
				$sd = new SharepointDocs($user_id, $this->User->Office365user);

				// ensure that the folders exist
				$id = $this->Project->id;
				
				$results = $sd->createTemplateFolders($id);
				
				$this->Session->setFlash(__('The project has been saved.'));

				return $this->redirect(array('action' => 'view', $this->Project->id));

			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
		

		$statuses = $this->Project->Status->findOrderedList();
		$themes = $this->Project->Theme->findOrderedList();
		$pathways = $this->Project->Pathway->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		$departments = $this->Project->Department->findListByDate(date('Y-m-d'));
		$frameworks = $this->Project->Contract->Framework->findOrderedList();
		$contractcategories = $this->Project->Contract->Contractcategory->findOrderedList();
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->findOrderedList();
		$donorWarnings = $this->Donor->findDonorWarnings();

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithDepartments = $this->Project->Territory->findActiveWithDepartment();
		$users = $this->User->find('list');
		$budget_holders = $this->User->findBudgetHoldersList();
		
		$this->set(compact('territoriesWithDepartments', 'statuses', 'themes', 'likelihoods', 'programmes', 'departments', 'territories', 'users', 'budget_holders', 'currencies', 'donors', 'frameworks', 'contractcategories', 'pathways', 'donorWarnings'));


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
					'Pathway',
					'Projectdate'
				),
				'conditions' => array(
					'Project.id' => $id
				)
			);
			$this->request->data = $this->Project->find('first', $options);

		}
		$statuses = $this->Project->Status->findOrderedList();
		$themes = $this->Project->Theme->findOrderedList();
		$pathways = $this->Project->Pathway->findOrderedList();
		$likelihoods = $this->Project->Likelihood->findOrderedList();
		
		$frameworks = $this->Project->Contract->Framework->findOrderedList();
		$contractcategories = $this->Project->Contract->Contractcategory->findOrderedList();
		$departments = $this->Project->Department->findListByDate(date('Y-m-d'));
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->findOrderedList();
		$donorWarnings = $this->Donor->findDonorWarnings();

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithDepartments = $this->Project->Territory->findActiveWithDepartment();
		$users = $this->User->find('list');
		$budget_holders = $this->User->findBudgetHoldersList();


		// THESE LINES WERE IN PLACE TO ENSURE THAT LEGACY PROJECTS 
		// WOULD HAVE THE RIGHT FILE STRUCTURE
		//
		// if ( !Configure::read('disable_sharepoint_folder_sync') ):
		// 	// ensure that folder exists
		// 	$user_id = $this->Auth->user('id');
		// 	$sd = new SharepointDocs($user_id, $this->User->Office365user);
		// 	$results = $sd->createTemplateFolders($id); // TODO: remove ensureFoldersCreated = false

		// endif; // ( !Configure::read('disable_sharepoint_folder_sync') ) {


		$this->set(compact('territoriesWithDepartments', 'statuses', 'themes', 'likelihoods', 'programmes', 'departments', 'territories', 'users', 'currencies', 'donors', 'frameworks', 'contractcategories', 'pathways', 'budget_holders', 'donorWarnings'));
	}



	public function docs($project_id = null) {

		if (!$this->Project->exists($project_id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		// TODO: check that the project isn't deleted

		// 
		$user_id = $this->Auth->user('id');
		$sd = new SharepointDocs($user_id, $this->User->Office365user);


		// ensure that the folders exist
		$parent_folder = 'project_id_' . $project_id;
		$general_folder = $parent_folder . '/' . 'general';

		$sd->createFolder($parent_folder);
		$sd->createFolder($general_folder);

		$fileList = $sd->getFolderContents($general_folder);

		$sharepoint_root_folder = '/prompt/Documents/' . $general_folder;

		$this->set(compact('fileList', 'sharepoint_root_folder'));

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


			// RECYCLE ASSOCIATED FILES
			// connect to Sharepoint
			$user_id = $this->Auth->user('id');
			$sd = new SharepointDocs($user_id, $this->User->Office365user);

			// ensure that the folders exist
			$parent_folder = Configure::read('ENVIRONMENT') . '/projects/project_id_' . $id;

			$sd->recycleFolder($parent_folder);

			$this->Session->setFlash(__('The project has been deleted.'));
		} else {
			$this->Session->setFlash(__('The project could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	// function newInterface() {}

	function searchFeedback() {


		// email PROMPT admins about the feedback
		App::uses('CakeEmail', 'Network/Email');
		$Email = new CakeEmail('default');
		$result = $Email->template('projects/search_feedback')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'feedback' => $this->request->data,
		    	'user_fullname' => AuthComponent::user('name'),
		    ))
		    ->subject('PROMPT Search Feedback')
		    ->to('as.thomson@gmail.com')
		    ->send();

		


	}

}
