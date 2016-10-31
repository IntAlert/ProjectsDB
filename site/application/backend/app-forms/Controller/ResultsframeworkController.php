<?php
App::uses('AppController', 'Controller');
/**
 * Travelapplications Controller
 *
 * @property Travelapplication $Travelapplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ResultsframeworkController extends AppController {


	public $uses = array('ResultsFramework', 'Project');

	public function edit($project_id) {
		// check if project exists
		if (!$this->Project->exists($project_id)) {
			throw new NotFoundException(__('Invalid project'));
		}
	}

	public function save($project_id) {

		$this->layout = 'ajax';
		
		// check if project exists
		if (!$this->Project->exists($project_id)) {
			throw new NotFoundException(__('Invalid project'));
		}

		// save submitted data
		$this->request->data['project_id'] = $project_id;
		$this->ResultsFramework->save($this->request->data);
	}

// /**
//  * Components
//  *
//  * @var array
//  */
// 	public $components = array('Paginator', 'Session', 'TravelapplicationNotifier');


// 	public $paginate = array(
//         'limit' => 25,
//         'sort' => 'Travelapplication.created',
//         'direction' => "DESC",
//         'contain' => array(
//         	'Applicant',
//         	'ApprovingManager',
//         	'TravelapplicationItinerary.Destination',
//         )
//     );

// /**
//  * index method
//  *
//  * @return void
//  */
// 	public function admin() {

// 		// show all applications

// 		$this->Paginator->settings = $this->paginate;
		
// 		$this->set('travelapplications', $this->Paginator->paginate());

// 		$this->render('index');
// 	}

// 	public function mine() {

// 		// show applications that you have made

// 		$this->Paginator->settings = $this->paginate;
// 		$this->Paginator->settings['conditions'] = array(
// 			'Travelapplication.applicant_user_id' => $this->Auth->user('id')
// 		);
		
// 		$this->set('travelapplications', $this->Paginator->paginate());
// 	}

// 	public function manager() {

// 		$this->Paginator->settings = $this->paginate;
// 		$this->Paginator->settings['conditions'] = array(
// 			'Travelapplication.manager_user_id' => $this->Auth->user('id')
// 		);
		
// 		$this->set('travelapplications', $this->Paginator->paginate());

// 	}

// 	function testMail() {
// 		$travelapplication = $this->Travelapplication->findById(1);
// 		$travelapplicationObj = json_decode($travelapplication['Travelapplication']['application_json']);
// 		$this->set('travelapplicationObj', $travelapplicationObj);

// 		$this->layout = '/Emails/html/default';
// 		$this->render('/Emails/html/travelapplications/send_email');
// 	}

// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function view($id = null) {
// 		if (!$this->Travelapplication->exists($id)) {
// 			throw new NotFoundException(__('Invalid travelapplication'));
// 		}
// 		$options = array('conditions' => array('Travelapplication.' . $this->Travelapplication->primaryKey => $id));
// 		$this->set('travelapplication', $this->Travelapplication->find('first', $options));
// 	}

// 	public function viewJson($id = null) {
// 		if (!$this->Travelapplication->exists($id)) {
// 			throw new NotFoundException(__('Invalid travelapplication'));
// 		}
// 		$options = array('conditions' => array('Travelapplication.' . $this->Travelapplication->primaryKey => $id));
// 		$this->set('travelapplication', $this->Travelapplication->find('first', $options));
		
// 		$this->layout = 'ajax';
// 	}

// /**
//  * add method
//  *
//  * @return void
//  */
// 	public function add() {
		
// 		if ($this->request->is('post')) {

// 			// create application
// 			$travelapplication_id = $this->Travelapplication->saveWithItinerary($this->request->data);

// 			// get Travel Application Receivers
// 			$travelapplicationReceivers = $this->User->findUsersByRoleName('travel-application-receiver');

// 			// add the manager to the list
// 			$manager = $this->User->findById($this->request->data['applicant']['approving_manager']['User']['id']);
// 			$travelapplicationReceivers[] = $manager;

// 			// add the self to the list
// 			$me = $this->User->findById($this->Auth->user('id'));
// 			$travelapplicationReceivers[] = $me;

// 			// send mail
// 			$this->TravelapplicationNotifier->sendEmail($this->request->data, $travelapplication_id, $travelapplicationReceivers);

// 			// return result
// 			$this->layout = 'ajax';
// 			return $this->render('save_success_json');

// 		}
		
// 	}

// /**
//  * edit method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */


// 	public function edit($id = null) {
		
// 		if (!$this->Travelapplication->exists($id)) {
// 			throw new NotFoundException(__('Invalid Travel Application'));
// 		}

// 		if ($this->request->is('post')) {

// 			// create application
// 			$this->Travelapplication->saveWithItinerary($this->request->data, $id);
// 			$this->layout = 'ajax';
// 			return $this->render('save_success_json');

// 		}

// 		$this->render('add');
		
// 	}

}
