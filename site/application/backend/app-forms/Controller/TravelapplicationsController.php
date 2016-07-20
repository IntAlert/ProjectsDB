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
			$this->Travelapplication->saveWithItinerary($this->request->data);
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
