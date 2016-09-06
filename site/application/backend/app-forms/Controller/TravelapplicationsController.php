<?php
App::uses('AppController', 'Controller');
/**
 * Travelapplications Controller
 *
 * @property Travelapplication $Travelapplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TravelapplicationsController extends AppController {


	public $uses = array(
		'Travelapplication',
		'Territory'
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'TravelapplicationNotifier');


	public $paginate = array(
        'limit' => 25,
        'sort' => 'Travelapplication.created',
        'direction' => "DESC",
        'contain' => array(
        	'Applicant',
        	'ApprovingManager',
        	'TravelapplicationItinerary.Destination',
        )
    );

/**
 * index method
 *
 * @return void
 */


	public function admin_ui() {
		
	}

	public function admin() {

		// show all applications

		$this->Paginator->settings = $this->paginate;
		
		$this->set('travelapplications', $this->Paginator->paginate());

		$this->render('index');
	}

	public function mine() {

		// show applications that you have made

		$this->Paginator->settings = $this->paginate;
		$this->Paginator->settings['conditions'] = array(
			'Travelapplication.applicant_user_id' => $this->Auth->user('id')
		);
		
		$this->set('travelapplications', $this->Paginator->paginate());
	}

	public function manager() {

		$this->Paginator->settings = $this->paginate;
		$this->Paginator->settings['conditions'] = array(
			'Travelapplication.manager_user_id' => $this->Auth->user('id')
		);
		
		$this->set('travelapplications', $this->Paginator->paginate());

	}

	public function search() {

		$this->layout = 'ajax';

		$travelapplications = $this->Travelapplication->search($this->request->data);

		$this->set(compact('travelapplications'));

	}

	function testMail() {
		$travelapplication = $this->Travelapplication->findById(1);
		$travelapplicationObj = json_decode($travelapplication['Travelapplication']['application_json']);
		$this->set('travelapplicationObj', $travelapplicationObj);

		$this->layout = '/Emails/html/default';
		$this->render('/Emails/html/travelapplications/send_email');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Travelapplication->exists($id)) {
			throw new NotFoundException(__('Invalid travelapplication'));
		}
		$options = array('conditions' => array('Travelapplication.' . $this->Travelapplication->primaryKey => $id));
		$this->set('travelapplication', $this->Travelapplication->find('first', $options));
	}

	public function viewJson($id = null) {
		if (!$this->Travelapplication->exists($id)) {
			throw new NotFoundException(__('Invalid travelapplication'));
		}
		$options = array('conditions' => array('Travelapplication.' . $this->Travelapplication->primaryKey => $id));
		$this->set('travelapplication', $this->Travelapplication->find('first', $options));
		
		$this->layout = 'ajax';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		if ($this->request->is('post')) {

			// create application
			$travelapplication_id = $this->Travelapplication->saveWithItinerary($this->request->data);


			$recipientsEmailAddresses = [];

			// get Travel Application Receivers
			$admins = $this->User->findUsersByRoleName('travel-application-receiver');

			foreach($admins as $admin) {
				$recipientsEmailAddresses[] = $admin['Office365user']['email'];
			}

			// add the manager to the list
			$recipientsEmailAddresses[] = $this->request->data['applicant']['approving_manager']['mail'];
			$recipientsEmailAddresses[] = $this->request->data['contact_hq']['email'];
			$recipientsEmailAddresses[] = $this->request->data['contact_home']['email'];
			$recipientsEmailAddresses[] = $this->request->data['contact_incountry']['email'];

			// add the self to the list
			$me = $this->User->findById($this->Auth->user('id'));
			$recipientsEmailAddresses[] = $me['Office365user']['email'];

			// send mail
			$this->TravelapplicationNotifier->sendEmail($this->request->data, $travelapplication_id, $recipientsEmailAddresses);

			// return result
			$this->layout = 'ajax';
			return $this->render('save_success_json');

		}
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */


	public function edit($id = null) {
		
		if (!$this->Travelapplication->exists($id)) {
			throw new NotFoundException(__('Invalid Travel Application'));
		}

		if ($this->request->is('post')) {

			// create application
			$this->Travelapplication->saveWithItinerary($this->request->data, $id);
			$this->layout = 'ajax';
			return $this->render('save_success_json');

		}

		$this->render('add');
		
	}

}
