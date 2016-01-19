<?php
App::uses('AppController', 'Controller');
/**
 * Donors Controller
 *
 * @property Donor $Donor
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DonorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public $paginate = array(
        'limit' => 100,
        'order' => array(
            // 'Department.sort_order' => 'asc',
            // 'Department.name' => 'asc',
            'Donor.sort_order' => 'asc',
            'Donor.name' => 'asc',
        ),
        'conditions' => array(
        	'deleted' => false
        )
    );

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Donor->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('donors', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Donor->exists($id)) {
			throw new NotFoundException(__('Invalid donor'));
		}
		$options = array('conditions' => array('Donor.' . $this->Donor->primaryKey => $id));
		$this->set('donor', $this->Donor->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Donor->create();
			if ($this->Donor->save($this->request->data)) {
				$this->Session->setFlash(__('The donor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The donor could not be saved. Please, try again.'));
			}
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
		if (!$this->Donor->exists($id)) {
			throw new NotFoundException(__('Invalid donor'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Donor->save($this->request->data)) {
				$this->Session->setFlash(__('The donor has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The donor could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Donor.' . $this->Donor->primaryKey => $id));
			$this->request->data = $this->Donor->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Donor->id = $id;
		if (!$this->Donor->exists()) {
			throw new NotFoundException(__('Invalid donor'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Donor->delete()) {
			$this->Session->setFlash(__('The donor has been deleted.'));
		} else {
			$this->Session->setFlash(__('The donor could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function isAuthorized($user) {
		// limit to managers
		return $this->Auth->user('role') == 'admin';
	}
}
