<?php
App::uses('AppController', 'Controller');
/**
 * Frameworks Controller
 *
 * @property Framework $Framework
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FrameworksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $paginate = array(
        'limit' => 100,
        'order' => array(
            'Framework.sort_order' => 'asc',
            'Framework.name' => 'asc',
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
		$this->Framework->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('frameworks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Framework->exists($id)) {
			throw new NotFoundException(__('Invalid framework'));
		}
		$options = array('conditions' => array('Framework.' . $this->Framework->primaryKey => $id));
		$this->set('framework', $this->Framework->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Framework->create();
			if ($this->Framework->save($this->request->data)) {
				$this->Session->setFlash(__('The framework has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The framework could not be saved. Please, try again.'));
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
		if (!$this->Framework->exists($id)) {
			throw new NotFoundException(__('Invalid framework'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Framework->save($this->request->data)) {
				$this->Session->setFlash(__('The framework has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The framework could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Framework.' . $this->Framework->primaryKey => $id));
			$this->request->data = $this->Framework->find('first', $options);
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
		$this->Framework->id = $id;
		if (!$this->Framework->exists()) {
			throw new NotFoundException(__('Invalid framework'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Framework->softDelete($id)) {
			$this->Session->setFlash(__('The framework has been deleted.'));
		} else {
			$this->Session->setFlash(__('The framework could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		// limit to managers
		return $this->Auth->user('role') == 'manager';
	}
}
