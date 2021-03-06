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
	public $components = array(
		'Paginator', 
		'Session', 
		'TravelapplicationNotifier',
		'CalendarInvite'
	);


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


	public function testICS() {


		$travelapplication_id = 27;

		$travelapplication = $this->Travelapplication->find('first', array(
			'conditions' => ['Travelapplication.id' => $travelapplication_id],
			'contain' => [
				'Applicant.Office365user',
				'TravelapplicationItinerary.Origin',
				'TravelapplicationItinerary.Destination',
			]
		));


		$ICSContent = $this->CalendarInvite->buildTravelapplicationICS($travelapplication);

		echo($ICSContent);

		$Email = new CakeEmail('default');
		$Email->addTo('athomson@international-alert.org');
		$result = $Email->template('travelapplications/invite')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->subject('Invite')
		    ->attachments([
		    	'invite.ics' => [
			    	'mimetype' => 'text/calendar; method=REQUEST; charset=utf-8',
					'data' => $ICSContent,
				]
			])
		    ->send();

		// debug($result);
		die();
	}

	public function index() {
		$this->set('title', "Trips");
	}

	public function admin() {

		// check they are allowed to see this
		if ( !$this->User->userHasRole($this->Auth->user('id'), 'travel-application-admin') ) {
			throw new NotFoundException(); // should really throw a 403
		}

		$this->set('title', "Trips");

	}

	public function search() {

		// check they are allowed to see this
		if ( !$this->User->userHasRole($this->Auth->user('id'), 'travel-application-admin') ) {
			throw new NotFoundException(); // should really throw a 403
		}

		$this->layout = 'ajax';

		$travelapplications = $this->Travelapplication->search($this->request->data);

		$this->set(compact('travelapplications'));

	}

	public function mine() {

		$this->layout = 'ajax';

		$travelapplications = $this->Travelapplication->getMine($this->Auth->user('id'));

		$this->set(compact('travelapplications'));

		$this->render('search');

	}

	// public function managed() {

	// 	$this->layout = 'ajax';

	// 	// get this user's o365 id
	// 	$manager_o365_object_id = $this->User->getO365Id($this->Auth->user('id'));

	// 	$travelapplications = $this->Travelapplication->getManaged($manager_o365_object_id, $this->request->data);

	// 	$this->set(compact('travelapplications'));

	// 	$this->render('search');

	// }


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
		

		// save is done via AJAX
		if ($this->request->is('post')) {

			$travelapplication_id = $this->request->data('id');

			// get the PROMPT user, given the o365 user
			$user = $this->User->getUserO365Object($this->request->data('applicant.user'));

			// create application
			$user_o365_object_id = $this->request->data('applicant.user.objectId');
			$travelapplication_id = $this->Travelapplication->saveWithItinerary($user_o365_object_id, $user['User']['id'], $this->request->data, $travelapplication_id);


			$recipientsEmailAddresses = [];

			// get Travel Application Receivers
			$admins = $this->User->findUsersByRoleName('travel-application-admin');

			foreach($admins as $admin) {
				$recipientsEmailAddresses[] = $admin['Office365user']['email'];
			}

			// add the manager to the list
			$recipientsEmailAddresses[] = $this->request->data['applicant']['approving_manager']['mail'];
			$recipientsEmailAddresses[] = $this->request->data['contact_hq']['email'];

			if($this->request->data['contact_home']['email']) {
				$recipientsEmailAddresses[] = $this->request->data['contact_home']['email'];
			}
			
			if($this->request->data['contact_incountry']['email']) {
				$recipientsEmailAddresses[] = $this->request->data['contact_incountry']['email'];	
			}
			

			// add self to the list
			$me = $this->User->findById($this->Auth->user('id'));
			$recipientsEmailAddresses[] = $me['Office365user']['email'];


			// get data for the invite
			$travelapplication = $this->Travelapplication->find('first', array(
				'conditions' => ['Travelapplication.id' => $travelapplication_id],
				'contain' => [
					'Applicant.Office365user',
					'TravelapplicationItinerary.Origin',
					'TravelapplicationItinerary.Destination',
				]
			));


			// $ICSContent = $this->CalendarInvite->buildTravelapplicationICS($travelapplication);

			// send group mail
			$this->TravelapplicationNotifier->sendEmail($this->request->data, $travelapplication_id, $recipientsEmailAddresses);


			// send invite mail to this user
			// $this->TravelapplicationNotifier->sendInvite($ICSContent, $me);


			// return result
			$this->layout = 'ajax';
			return $this->render('save_success_json');

		}

		$this->set('title', "New Trip");
		
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
			throw new NotFoundException(__('Invalid Trip'));
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
