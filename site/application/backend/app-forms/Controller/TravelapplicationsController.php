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
		$this->Travelapplication->recursive = 0;
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
		// if ($this->request->is('post')) {
		// 	$this->Travelapplication->create();
			

		// 	if ($this->Travelapplication->saveAll($this->request->data)) {

		// 		debug($this->request->data);
		// 		die();

		// 		$this->Session->setFlash(__('The travelapplication has been saved.'));
		// 		return $this->redirect(array('action' => 'index'));
		// 	} else {
		// 		$this->Session->setFlash(__('The travelapplication could not be saved. Please, try again.'));
		// 	}
		// }
		// $users = $this->Travelapplication->User->findAllUsersList();
		// $this->set(compact('users'));
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
