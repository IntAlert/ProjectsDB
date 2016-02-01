<?php
App::uses('AppController', 'Controller');
/**
 * Contractcategories Controller
 *
 * @property Contractcategory $Contractcategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ContractcategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public $paginate = array(
        'limit' => 100,
        'order' => array(
            'Contractcategory.sort_order' => 'asc',
            'Contractcategory.name' => 'asc',
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
		$this->Contractcategory->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('contractcategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contractcategory->exists($id)) {
			throw new NotFoundException(__('Invalid contractcategory'));
		}
		$options = array('conditions' => array('Contractcategory.' . $this->Contractcategory->primaryKey => $id));
		$this->set('contractcategory', $this->Contractcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contractcategory->create();
			if ($this->Contractcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The contractcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractcategory could not be saved. Please, try again.'));
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
		if (!$this->Contractcategory->exists($id)) {
			throw new NotFoundException(__('Invalid contractcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contractcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The contractcategory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contractcategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contractcategory.' . $this->Contractcategory->primaryKey => $id));
			$this->request->data = $this->Contractcategory->find('first', $options);
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
		$this->Contractcategory->id = $id;
		if (!$this->Contractcategory->exists()) {
			throw new NotFoundException(__('Invalid contractcategory'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contractcategory->softDelete($id)) {
			$this->Session->setFlash(__('The contractcategory has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contractcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		// limit to admin
		return $this->userIs('admin');
	}
}
