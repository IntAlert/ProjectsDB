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
		$departments = $this->Project->Department->find('list');
		$programmes = $this->Project->Programme->find('list');
		$territories = $this->Project->Territory->findActiveList();

		
		$employees = $this->User->findEmployeesList();
		$themes = $this->Project->Theme->findOrderedList();

		$this->set(compact('action', 'statuses', 'likelihoods', 'programmes', 'departments', 'territories', 'employees', 'themes', 'donors'));
		
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
				'Projectnote.User',
				'Status',
				'Theme',
				'Likelihood',
				'Department',
				'Programme',
				'OwnerUser',
				'Territory',
			),
			'conditions' => array('Project.' . $this->Project->primaryKey => $id),
		);
		$project = $this->Project->find('first', $options);


		



		// DOCUMENTS

		// connect to Sharepoint
		$user_id = $this->Auth->user('id');
		$sd = new SharepointDocs($user_id, $this->User->Office365user);

		// ensure that the folders exist
		$parent_folder = 'project_id_' . $id;
		$general_folder = $parent_folder . '/' . 'general';
		$sd->createFolder($parent_folder);
		$sd->createFolder($general_folder);

		// get list of files on Sharepoint
		$fileList = $sd->getFolderContents($general_folder);
		$sharepoint_root_folder = '/prompt/Documents/' . $general_folder;

		// AUDIT
		$this->Audit->record("READ", "Project", $id, $project);

		$this->set(compact('project', 'fileList', 'sharepoint_root_folder'));
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
		$departments = $this->Project->Department->find('list');
		$programmes = $this->Project->Programme->find('list');
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->findOrderedList();

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithProgrammes = $this->Project->Territory->findActiveWithProgramme();
		$users = $this->User->find('list');
		$employees = $this->User->findEmployeesList();
		
		$this->set(compact('territoriesWithProgrammes', 'statuses', 'themes', 'likelihoods', 'programmes', 'departments', 'territories', 'users', 'employees', 'currencies', 'donors'));


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
		$departments = $this->Project->Department->find('list');
		$currencies = $this->Currency->find('list');
		$donors = $this->Donor->findOrderedList();

		$territories = $this->Project->Territory->findActiveList();
		$territoriesWithProgrammes = $this->Project->Territory->findActiveWithProgramme();
		$users = $this->User->find('list');
		$employees = $this->User->findEmployeesList();



		$this->set(compact('territoriesWithProgrammes', 'statuses', 'themes', 'likelihoods', 'programmes', 'departments', 'territories', 'users', 'employees', 'currencies', 'donors'));
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


	public function testFolderCreate() {


		$access_token = Configure::read('OFFICE365_CLIENT_SECRET');


		// get USER details
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'text/plain; odata=verbose',
                'Content-length' => 0,
            ),
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));

        $url = "https://intlalert.sharepoint.com/prompt/_api/web/folders/add('Documents/sadfsad')";

        // $url = 'https://intlalert.sharepoint.com/prompt/_api/contextinfo';

        var_dump($url);


        $result = $socket->post($url, null, $options);

        $response = json_decode($result->body);


        debug($socket->request);
        debug($socket->response);

        die();



	}

	public function testFolderDelete() {


		$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSIsImtpZCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSJ9.eyJhdWQiOiJodHRwczovL2ludGxhbGVydC5zaGFyZXBvaW50LmNvbSIsImlzcyI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzYxODlmMjQ4LWNmMzMtNGE2OS1iNTBlLTA5YjMyYmNhNTgxMS8iLCJpYXQiOjE0NDEzNzg5NDAsIm5iZiI6MTQ0MTM3ODk0MCwiZXhwIjoxNDQxMzgyODQwLCJ2ZXIiOiIxLjAiLCJ0aWQiOiI2MTg5ZjI0OC1jZjMzLTRhNjktYjUwZS0wOWIzMmJjYTU4MTEiLCJvaWQiOiI2Nzc0ZDAxZi0wYzUzLTRlNjctOTdkMi04OTc2ZmRkZmYzNDAiLCJ1cG4iOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsInB1aWQiOiIxMDAzMDAwMDkyREJDMDcwIiwic3ViIjoiLUdBYzVXMlE5a3dmX3dVVk9Od3F3MWJqNkxldEpPeE1IMDl3OWZXbW0xbyIsImdpdmVuX25hbWUiOiJBbGFuIiwiZmFtaWx5X25hbWUiOiJUaG9tc29uIiwibmFtZSI6IkFsYW4gVGhvbXNvbiIsImFtciI6WyJwd2QiXSwidW5pcXVlX25hbWUiOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsIm9ucHJlbV9zaWQiOiJTLTEtNS0yMS00NDg1Mzk3MjMtMTg0NDIzNzYxNS04Mzk1MjIxMTUtNTA3MSIsImFwcGlkIjoiMjNmZDM1NDEtMTAxYS00Y2Q5LTkyMjctMmI2MGQ0YzkzNGNjIiwiYXBwaWRhY3IiOiIxIiwic2NwIjoiQWxsU2l0ZXMuRnVsbENvbnRyb2wgQWxsU2l0ZXMuTWFuYWdlIEFsbFNpdGVzLlJlYWQgQWxsU2l0ZXMuV3JpdGUgTXlGaWxlcy5SZWFkIE15RmlsZXMuV3JpdGUgU2l0ZXMuU2VhcmNoLkFsbCBUZXJtU3RvcmUuUmVhZC5BbGwgVGVybVN0b3JlLlJlYWRXcml0ZS5BbGwgVXNlci5SZWFkLkFsbCBVc2VyLlJlYWRXcml0ZS5BbGwiLCJhY3IiOiIxIiwiaXBhZGRyIjoiODIuMTA4LjYuMjEwIn0.o_BfzUncJAI8CZo3voRibGL5fVMmNtNZdA3h4_r0MBw6MPJxBU45JfcRpomnjI73MuUIACnl_8ZuZRfLpvGX0WaornrW_WrUlOz4PMqGrU4nuZt5GjQsjMPX23li_tbLwP3SskvAwcpZoWkpN4YdEe-pg8W1AKecVunAN_wmKoJj4RrW-rMfAT7aks8uBkRt_CkpNpIoHtfZzewae0_Bt96Tbiop8o4weO4p_-KEOZCdTVoHyswoYz2ucy11xmJJL-qjOuzBu5Z81-e3CtlBPL83ArK5aEbFEliKelwouAldtlsAUsOyAIaDcO_K4gYgrKEw2Yv9S57LpucumLL-ew';


		// get USER details
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'text/plain; odata=verbose',
                'Content-length' => 0,
            ),
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));

        $url = "https://intlalert.sharepoint.com/prompt/_api/web/GetFolderByServerRelativeUrl('Documents/sadfsad')";

        // $url = 'https://intlalert.sharepoint.com/prompt/_api/contextinfo';

        var_dump($url);


        $result = $socket->delete($url, null, $options);

        $response = json_decode($result->body);


        debug($socket->request);
        debug($socket->response);

        die();



	}

	public function testDocUpload() {


		$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSIsImtpZCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSJ9.eyJhdWQiOiJodHRwczovL2dyYXBoLndpbmRvd3MubmV0IiwiaXNzIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvNjE4OWYyNDgtY2YzMy00YTY5LWI1MGUtMDliMzJiY2E1ODExLyIsImlhdCI6MTQ0MDY4ODU4OSwibmJmIjoxNDQwNjg4NTg5LCJleHAiOjE0NDA2OTI0ODksInZlciI6IjEuMCIsInRpZCI6IjYxODlmMjQ4LWNmMzMtNGE2OS1iNTBlLTA5YjMyYmNhNTgxMSIsIm9pZCI6IjY3NzRkMDFmLTBjNTMtNGU2Ny05N2QyLTg5NzZmZGRmZjM0MCIsInVwbiI6IkFUaG9tc29uQGludGVybmF0aW9uYWwtYWxlcnQub3JnIiwicHVpZCI6IjEwMDMwMDAwOTJEQkMwNzAiLCJzdWIiOiJjX0Q2QzBQdUhlUjUzLTB0WDQ1MzJyVmprNUdZSGMtTE0xbnh3VUxLZnRBIiwiZ2l2ZW5fbmFtZSI6IkFsYW4iLCJmYW1pbHlfbmFtZSI6IlRob21zb24iLCJuYW1lIjoiQWxhbiBUaG9tc29uIiwiYW1yIjpbInB3ZCJdLCJ1bmlxdWVfbmFtZSI6IkFUaG9tc29uQGludGVybmF0aW9uYWwtYWxlcnQub3JnIiwib25wcmVtX3NpZCI6IlMtMS01LTIxLTQ0ODUzOTcyMy0xODQ0MjM3NjE1LTgzOTUyMjExNS01MDcxIiwiYXBwaWQiOiIyM2ZkMzU0MS0xMDFhLTRjZDktOTIyNy0yYjYwZDRjOTM0Y2MiLCJhcHBpZGFjciI6IjEiLCJzY3AiOiJVc2VyUHJvZmlsZS5SZWFkIiwiYWNyIjoiMSIsImlwYWRkciI6IjgyLjEwOC42LjIxMCJ9.e_28WEjDdOl0AHl_3PbBFTJOAa9z1dC70pwvQ6kTYaLvv3n67SMqQrEXEtgRJjUfxC0FYJY-7h55fPYVi5qBek7L36ZfbQLzhWKjPz5X-ySQfjSv_8tUiK6DlcQRPzO0ouUQFXCovXSYI9q6BLlWOjJC3dnTVEh94YZB4yHmaXxVSa5zOfjsYBTUD6wOCIIqHQUkKmj-hXWWSzTl-JHzRy5GlBLt6SKJnexSX1KxsQBfeonHo56zDgnFQHm7EqiXavG5bGMC4cuI9IyCVLeNoxHy1LYSzPxb8TGCUNvkLFaawBMz4cYK9g13WmpdFkbTcv272M0ocdDUjxG6XAoncA';


		$file_contents = file_get_contents(APP . '../../v12-zero-percent.png');

		$file_contents = 'affsadffasd';

		// get USER details
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'text/plain; odata=verbose',
            ),
            'body' => $file_contents,
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));


        // NB: file name must be URL encoded
        $filename = 'asfdasfds.png';

        $url = "https://intlalert.sharepoint.com/prompt/_api/web/GetFolderByServerRelativeUrl('Documents')/Files/Add(url='".$filename."',overwrite=true)";

        // $url = 'https://intlalert.sharepoint.com/prompt/_api/contextinfo';

        var_dump($url);


        $result = $socket->post($url, null, $options);

        $response = json_decode($result->body);


        debug($socket->request);
        debug($socket->response);

        die();



	}

	function testLibraryCreate() {
		$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSIsImtpZCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSJ9.eyJhdWQiOiJodHRwczovL2ludGxhbGVydC5zaGFyZXBvaW50LmNvbSIsImlzcyI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzYxODlmMjQ4LWNmMzMtNGE2OS1iNTBlLTA5YjMyYmNhNTgxMS8iLCJpYXQiOjE0NDEzODI4OTMsIm5iZiI6MTQ0MTM4Mjg5MywiZXhwIjoxNDQxMzg2NzkzLCJ2ZXIiOiIxLjAiLCJ0aWQiOiI2MTg5ZjI0OC1jZjMzLTRhNjktYjUwZS0wOWIzMmJjYTU4MTEiLCJvaWQiOiI2Nzc0ZDAxZi0wYzUzLTRlNjctOTdkMi04OTc2ZmRkZmYzNDAiLCJ1cG4iOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsInB1aWQiOiIxMDAzMDAwMDkyREJDMDcwIiwic3ViIjoiLUdBYzVXMlE5a3dmX3dVVk9Od3F3MWJqNkxldEpPeE1IMDl3OWZXbW0xbyIsImdpdmVuX25hbWUiOiJBbGFuIiwiZmFtaWx5X25hbWUiOiJUaG9tc29uIiwibmFtZSI6IkFsYW4gVGhvbXNvbiIsImFtciI6WyJwd2QiXSwidW5pcXVlX25hbWUiOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsIm9ucHJlbV9zaWQiOiJTLTEtNS0yMS00NDg1Mzk3MjMtMTg0NDIzNzYxNS04Mzk1MjIxMTUtNTA3MSIsImFwcGlkIjoiMjNmZDM1NDEtMTAxYS00Y2Q5LTkyMjctMmI2MGQ0YzkzNGNjIiwiYXBwaWRhY3IiOiIxIiwic2NwIjoiQWxsU2l0ZXMuRnVsbENvbnRyb2wgQWxsU2l0ZXMuTWFuYWdlIEFsbFNpdGVzLlJlYWQgQWxsU2l0ZXMuV3JpdGUgTXlGaWxlcy5SZWFkIE15RmlsZXMuV3JpdGUgU2l0ZXMuU2VhcmNoLkFsbCBUZXJtU3RvcmUuUmVhZC5BbGwgVGVybVN0b3JlLlJlYWRXcml0ZS5BbGwgVXNlci5SZWFkLkFsbCBVc2VyLlJlYWRXcml0ZS5BbGwiLCJhY3IiOiIxIiwiaXBhZGRyIjoiODIuMTA4LjYuMjEwIn0.enbpY8HrTt4FwLh-cyt4A7nooTbtt2VfLqjCZh3PKAno3NQHn81Wyn_ZnMty3T5vkVnWhYvYCFV2TPhtjyXtJtuj21YiXNxj0rRlTtTrPzDGUXqSiDW1X2Dip0ELVtBxZ3MeuD2KZFPayg_Jx-hJxzpizqVm6qZfmp3oVh7T5aJOBb8KeVlpv_lF7s4l734n8iPiimCHDGAah9HnH7lNp4Hk-7DUBzFnQ5hsleig9u4kl9PElb1pkFMfOaAGICsJ6I6k8RSTTE5c_5Dh9pxOTCwCWo2xdD_ShEkvuWe-7u68EeAq2SxhnqE2n7YFc91UzGVIcXVfnDyuCtl_ynP6EA';
		$sd = new SharepointDocs($access_token);

		$sd->createFolder('sadfasdf');

		die();


	}

	function testLibraryDelete() {
		$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSIsImtpZCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSJ9.eyJhdWQiOiJodHRwczovL2ludGxhbGVydC5zaGFyZXBvaW50LmNvbSIsImlzcyI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzYxODlmMjQ4LWNmMzMtNGE2OS1iNTBlLTA5YjMyYmNhNTgxMS8iLCJpYXQiOjE0NDEzODI4OTMsIm5iZiI6MTQ0MTM4Mjg5MywiZXhwIjoxNDQxMzg2NzkzLCJ2ZXIiOiIxLjAiLCJ0aWQiOiI2MTg5ZjI0OC1jZjMzLTRhNjktYjUwZS0wOWIzMmJjYTU4MTEiLCJvaWQiOiI2Nzc0ZDAxZi0wYzUzLTRlNjctOTdkMi04OTc2ZmRkZmYzNDAiLCJ1cG4iOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsInB1aWQiOiIxMDAzMDAwMDkyREJDMDcwIiwic3ViIjoiLUdBYzVXMlE5a3dmX3dVVk9Od3F3MWJqNkxldEpPeE1IMDl3OWZXbW0xbyIsImdpdmVuX25hbWUiOiJBbGFuIiwiZmFtaWx5X25hbWUiOiJUaG9tc29uIiwibmFtZSI6IkFsYW4gVGhvbXNvbiIsImFtciI6WyJwd2QiXSwidW5pcXVlX25hbWUiOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsIm9ucHJlbV9zaWQiOiJTLTEtNS0yMS00NDg1Mzk3MjMtMTg0NDIzNzYxNS04Mzk1MjIxMTUtNTA3MSIsImFwcGlkIjoiMjNmZDM1NDEtMTAxYS00Y2Q5LTkyMjctMmI2MGQ0YzkzNGNjIiwiYXBwaWRhY3IiOiIxIiwic2NwIjoiQWxsU2l0ZXMuRnVsbENvbnRyb2wgQWxsU2l0ZXMuTWFuYWdlIEFsbFNpdGVzLlJlYWQgQWxsU2l0ZXMuV3JpdGUgTXlGaWxlcy5SZWFkIE15RmlsZXMuV3JpdGUgU2l0ZXMuU2VhcmNoLkFsbCBUZXJtU3RvcmUuUmVhZC5BbGwgVGVybVN0b3JlLlJlYWRXcml0ZS5BbGwgVXNlci5SZWFkLkFsbCBVc2VyLlJlYWRXcml0ZS5BbGwiLCJhY3IiOiIxIiwiaXBhZGRyIjoiODIuMTA4LjYuMjEwIn0.enbpY8HrTt4FwLh-cyt4A7nooTbtt2VfLqjCZh3PKAno3NQHn81Wyn_ZnMty3T5vkVnWhYvYCFV2TPhtjyXtJtuj21YiXNxj0rRlTtTrPzDGUXqSiDW1X2Dip0ELVtBxZ3MeuD2KZFPayg_Jx-hJxzpizqVm6qZfmp3oVh7T5aJOBb8KeVlpv_lF7s4l734n8iPiimCHDGAah9HnH7lNp4Hk-7DUBzFnQ5hsleig9u4kl9PElb1pkFMfOaAGICsJ6I6k8RSTTE5c_5Dh9pxOTCwCWo2xdD_ShEkvuWe-7u68EeAq2SxhnqE2n7YFc91UzGVIcXVfnDyuCtl_ynP6EA';
		$sd = new SharepointDocs($access_token);

		$sd->deleteFolder('sadfasdf');

		die();


	}

	function testLibraryURL() {
		$access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSIsImtpZCI6Ik1uQ19WWmNBVGZNNXBPWWlKSE1iYTlnb0VLWSJ9.eyJhdWQiOiJodHRwczovL2ludGxhbGVydC5zaGFyZXBvaW50LmNvbSIsImlzcyI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzYxODlmMjQ4LWNmMzMtNGE2OS1iNTBlLTA5YjMyYmNhNTgxMS8iLCJpYXQiOjE0NDEzODI4OTMsIm5iZiI6MTQ0MTM4Mjg5MywiZXhwIjoxNDQxMzg2NzkzLCJ2ZXIiOiIxLjAiLCJ0aWQiOiI2MTg5ZjI0OC1jZjMzLTRhNjktYjUwZS0wOWIzMmJjYTU4MTEiLCJvaWQiOiI2Nzc0ZDAxZi0wYzUzLTRlNjctOTdkMi04OTc2ZmRkZmYzNDAiLCJ1cG4iOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsInB1aWQiOiIxMDAzMDAwMDkyREJDMDcwIiwic3ViIjoiLUdBYzVXMlE5a3dmX3dVVk9Od3F3MWJqNkxldEpPeE1IMDl3OWZXbW0xbyIsImdpdmVuX25hbWUiOiJBbGFuIiwiZmFtaWx5X25hbWUiOiJUaG9tc29uIiwibmFtZSI6IkFsYW4gVGhvbXNvbiIsImFtciI6WyJwd2QiXSwidW5pcXVlX25hbWUiOiJBVGhvbXNvbkBpbnRlcm5hdGlvbmFsLWFsZXJ0Lm9yZyIsIm9ucHJlbV9zaWQiOiJTLTEtNS0yMS00NDg1Mzk3MjMtMTg0NDIzNzYxNS04Mzk1MjIxMTUtNTA3MSIsImFwcGlkIjoiMjNmZDM1NDEtMTAxYS00Y2Q5LTkyMjctMmI2MGQ0YzkzNGNjIiwiYXBwaWRhY3IiOiIxIiwic2NwIjoiQWxsU2l0ZXMuRnVsbENvbnRyb2wgQWxsU2l0ZXMuTWFuYWdlIEFsbFNpdGVzLlJlYWQgQWxsU2l0ZXMuV3JpdGUgTXlGaWxlcy5SZWFkIE15RmlsZXMuV3JpdGUgU2l0ZXMuU2VhcmNoLkFsbCBUZXJtU3RvcmUuUmVhZC5BbGwgVGVybVN0b3JlLlJlYWRXcml0ZS5BbGwgVXNlci5SZWFkLkFsbCBVc2VyLlJlYWRXcml0ZS5BbGwiLCJhY3IiOiIxIiwiaXBhZGRyIjoiODIuMTA4LjYuMjEwIn0.enbpY8HrTt4FwLh-cyt4A7nooTbtt2VfLqjCZh3PKAno3NQHn81Wyn_ZnMty3T5vkVnWhYvYCFV2TPhtjyXtJtuj21YiXNxj0rRlTtTrPzDGUXqSiDW1X2Dip0ELVtBxZ3MeuD2KZFPayg_Jx-hJxzpizqVm6qZfmp3oVh7T5aJOBb8KeVlpv_lF7s4l734n8iPiimCHDGAah9HnH7lNp4Hk-7DUBzFnQ5hsleig9u4kl9PElb1pkFMfOaAGICsJ6I6k8RSTTE5c_5Dh9pxOTCwCWo2xdD_ShEkvuWe-7u68EeAq2SxhnqE2n7YFc91UzGVIcXVfnDyuCtl_ynP6EA';
		$sd = new SharepointDocs($access_token);

		var_dump($sd->getWebUrl('sadfasdf'));

		die();


	}
}
