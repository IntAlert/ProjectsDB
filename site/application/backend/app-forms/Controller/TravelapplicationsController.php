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
	public $components = array('Paginator', 'Session');


	public $paginate = array(
        'limit' => 25,
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
	public function index() {

		$this->Paginator->settings = $this->paginate;
		
		$this->set('travelapplications', $this->Paginator->paginate());
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

/**
 * add method
 *
 * @return void
 */
	public function add() {


		// TODO:
		/*
			remove unset dests
			convert dates

		*/

		

// 			array(
// 	'applicant' => array(
// 		'id' => '4',
// 		'name' => 'Alan Thomson',
// 		'role_category' => 'Alert staff',
// 		'role_category_other' => '',
// 		'role' => '',
// 		'reason' => 'Reason for my trip....',
// 		'approving_manager' => array(
// 			'User' => array(
// 				'id' => '87',
// 				'last_name' => 'Baloch',
// 				'first_name' => 'Shahhan',
// 				'name_formal' => 'Baloch, Shahhan'
// 			),
// 			'Office365user' => array(
// 				'email' => 'Sbaloch@international-alert.org'
// 			)
// 		),
// 		'role_text' => 'My role at Alert'
// 	),
// 	'contact_home' => array(
// 		'user' => array(
// 			'User' => array(
// 				'id' => '47',
// 				'last_name' => 'Bazigaga',
// 				'first_name' => 'Gloriosa',
// 				'name_formal' => 'Bazigaga, Gloriosa'
// 			),
// 			'Office365user' => array(
// 				'email' => 'gloriosab@international-alert.org'
// 			)
// 		),
// 		'email' => 'gloriosab@international-alert.org',
// 		'tel_land' => '234234234',
// 		'tel_mobile' => '23423423423',
// 		'skype' => 'afsdafasd',
// 		'freqency_of_contact' => 'Often'
// 	),
// 	'contact_incountry' => array(
// 		'name' => '',
// 		'email' => '',
// 		'tel_land' => '',
// 		'tel_mobile' => '',
// 		'skype' => '',
// 		'freqency_of_contact' => ''
// 	),
// 	'risks' => array(
// 		'overview' => 'Answer to: What are the main safety and security risks in the locations which you will visit?',
// 		'protection' => 'Answer to: How will you protect yourself against these risks?',
// 		'emergency_plan' => '',
// 		'sources' => 'Answer to: Sources of security information used'
// 	),
// 	'contact_other' => array(
// 		'alert' => '',
// 		'embassies' => '',
// 		'emergency' => '',
// 		'medical' => ''
// 	),
// 	'itinerary' => array(
// 		(int) 0 => array(
// 			'start' => '2016-07-04T23:00:00.000Z',
// 			'finish' => '2016-07-12T23:00:00.000Z',
// 			'origin' => array(
// 				'Territory' => array(
// 					'id' => '36',
// 					'name' => 'Belgium',
// 					'iso3' => 'BEL',
// 					'iso' => 'BE',
// 					'active' => true,
// 					'sort_order' => '-1'
// 				)
// 			),
// 			'destination' => array(
// 				'Territory' => array(
// 					'id' => '36',
// 					'name' => 'Belgium',
// 					'iso3' => 'BEL',
// 					'iso' => 'BE',
// 					'active' => true,
// 					'sort_order' => '-1'
// 				)
// 			),
// 			'transport' => array(
// 				'detail' => 'Transport Detail #2',
// 				'email' => 'trans_email2@email2.com',
// 				'phone' => '32423423'
// 			),
// 			'accommodation' => array(
// 				'email' => 'acc_email2@email2.com',
// 				'phone' => '423234234234',
// 				'detail' => 'Accommodation Detail #2'
// 			)
// 		)
// 	),
// 	'schedule' => array(
// 		(int) 0 => array(
// 			'date' => '2016-07-05T23:00:00.000Z',
// 			'time' => '12:12',
// 			'org_contact' => 'Some org and contact',
// 			'address' => 'A full address',
// 			'email' => 'meeting@meeting.com',
// 			'confirmed' => false
// 		),
// 		(int) 1 => array(
// 			'date' => '2016-07-20T23:00:00.000Z',
// 			'time' => '25:25',
// 			'org_contact' => 'Some org and contact #2',
// 			'address' => 'A full address #2',
// 			'email' => 'meeting2@email.com',
// 			'confirmed' => true
// 		)
// 	),
// 	'convenant_agreed' => true,
// 	'policy_understood' => true,
// 	'evacuation_understood' => true,
// 	'conduct_understood' => true,
// 	'countrymanager_notified' => true
// )

		if ($this->request->is('post')) {


			$travelapplication = array(
				'mode' => $this->request->data("mode"),
				'applicant_user_id' => $this->request->data("applicant.id"),
				'manager_user_id' => $this->request->data("applicant.approving_manager.User.id"),
				'contact_home_user_id' => $this->request->data("contact_home.user.User.id"),
				'contact_incountry_user_id' => $this->request->data("contact_incountry.user.User.id"),
				'application_json' => json_encode($this->request->data),
			);

			

			// create application
			$this->Travelapplication->create();
			if ($this->Travelapplication->save($travelapplication)) {

				// save the itineraries
				foreach($this->request->data('itinerary') as $itinerary) {
					$itinerary = array(
						'travelapplication_id' => $this->Travelapplication->id,
						'start' => $itinerary['start'],
						'finish' => $itinerary['finish'],
						'origin_territory_id' => $itinerary['origin']['Territory']['id'],
						'destination_territory_id' => $itinerary['destination']['Territory']['id'],
					);

					$this->Travelapplication->TravelapplicationItinerary->create();
					$this->Travelapplication->TravelapplicationItinerary->save($itinerary);
				}

				debug($this->request->data);
				die();

				$this->Session->setFlash(__('The travelapplication has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The travelapplication could not be saved. Please, try again.'));
			}
		}
		$users = $this->User->findAllUsersList();
		$usersFull = $this->User->findAllUsersOrdered();
		$territories = $this->Territory->findAllGeographical();
		$this->set(compact('users', 'territories', 'usersFull'));


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
			throw new NotFoundException(__('Invalid travelapplication'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Travelapplication->save($this->request->data)) {
				$this->Session->setFlash(__('The travelapplication has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The travelapplication could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Travelapplication.' . $this->Travelapplication->primaryKey => $id));
			$this->request->data = $this->Travelapplication->find('first', $options);
		}
		$users = $this->Travelapplication->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Travelapplication->id = $id;
		if (!$this->Travelapplication->exists()) {
			throw new NotFoundException(__('Invalid travelapplication'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Travelapplication->delete()) {
			$this->Session->setFlash(__('The travelapplication has been deleted.'));
		} else {
			$this->Session->setFlash(__('The travelapplication could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
