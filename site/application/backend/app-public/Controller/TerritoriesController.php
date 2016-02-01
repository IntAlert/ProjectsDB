<?php
App::uses('AppController', 'Controller');
/**
 * Territories Controller
 *
 * @property Territory $Territory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TerritoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $paginate = array(
        'limit' => 100,
        'contain' => array('Department'),
        'order' => array(
            // 'Department.sort_order' => 'asc',
            // 'Department.name' => 'asc',
            'Territory.sort_order' => 'asc',
            'Territory.name' => 'asc',
        )
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Territory->recursive = 0;

		$this->Paginator->settings = $this->paginate;
		$this->set('territories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Territory->exists($id)) {
			throw new NotFoundException(__('Invalid territory'));
		}
		$options = array('conditions' => array('Territory.' . $this->Territory->primaryKey => $id));
		$this->set('territory', $this->Territory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Territory->create();
			if ($this->Territory->save($this->request->data)) {
				$this->Session->setFlash(__('The territory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The territory could not be saved. Please, try again.'));
			}
		}
		$departments = $this->Territory->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Territory->exists($id)) {
			throw new NotFoundException(__('Invalid territory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Territory->save($this->request->data)) {
				$this->Session->setFlash(__('The territory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The territory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Territory.' . $this->Territory->primaryKey => $id));
			$this->request->data = $this->Territory->find('first', $options);
		}
		
		$departments = $this->Territory->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Territory->id = $id;
		if (!$this->Territory->exists()) {
			throw new NotFoundException(__('Invalid territory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Territory->delete()) {
			$this->Session->setFlash(__('The territory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The territory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		// limit to admin
		return $this->userIs('admin');
	}
}
