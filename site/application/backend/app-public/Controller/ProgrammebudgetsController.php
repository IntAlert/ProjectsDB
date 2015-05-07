<?php
App::uses('AppController', 'Controller');
/**
 * Programmebudgets Controller
 *
 * @property Programmebudget $Programmebudget
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProgrammebudgetsController extends AppController {

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
		$this->Programmebudget->recursive = 0;
		$this->set('programmebudgets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Programmebudget->exists($id)) {
			throw new NotFoundException(__('Invalid programmebudget'));
		}
		$options = array('conditions' => array('Programmebudget.' . $this->Programmebudget->primaryKey => $id));
		$this->set('programmebudget', $this->Programmebudget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Programmebudget->create();
			if ($this->Programmebudget->save($this->request->data)) {
				$this->Session->setFlash(__('The programmebudget has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programmebudget could not be saved. Please, try again.'));
			}
		}
		$programmes = $this->Programmebudget->Programme->find('list');
		$this->set(compact('programmes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Programmebudget->exists($id)) {
			throw new NotFoundException(__('Invalid programmebudget'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Programmebudget->save($this->request->data)) {
				$this->Session->setFlash(__('The programmebudget has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The programmebudget could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Programmebudget.' . $this->Programmebudget->primaryKey => $id));
			$this->request->data = $this->Programmebudget->find('first', $options);
		}
		$programmes = $this->Programmebudget->Programme->find('list');
		$this->set(compact('programmes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Programmebudget->id = $id;
		if (!$this->Programmebudget->exists()) {
			throw new NotFoundException(__('Invalid programmebudget'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Programmebudget->delete()) {
			$this->Session->setFlash(__('The programmebudget has been deleted.'));
		} else {
			$this->Session->setFlash(__('The programmebudget could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
