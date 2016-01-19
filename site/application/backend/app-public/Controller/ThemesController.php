<?php
App::uses('AppController', 'Controller');
/**
 * Themes Controller
 *
 * @property Theme $Theme
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ThemesController extends AppController {

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
            'Theme.sort_order' => 'asc',
            'Theme.name' => 'asc',
        ),
        'conditions' => array('Theme.deleted' => false),
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Theme->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('themes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Theme->exists($id)) {
			throw new NotFoundException(__('Invalid theme'));
		}
		$options = array('conditions' => array('Theme.' . $this->Theme->primaryKey => $id));
		$this->set('theme', $this->Theme->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Theme->create();
			if ($this->Theme->save($this->request->data)) {
				$this->Session->setFlash(__('The theme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The theme could not be saved. Please, try again.'));
			}
		}
		$projects = $this->Theme->Project->find('list');
		$this->set(compact('projects', 'proposals'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Theme->exists($id)) {
			throw new NotFoundException(__('Invalid theme'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Theme->save($this->request->data)) {
				$this->Session->setFlash(__('The theme has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The theme could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Theme.' . $this->Theme->primaryKey => $id));
			$this->request->data = $this->Theme->find('first', $options);
		}
		$projects = $this->Theme->Project->find('list');
		$this->set(compact('projects', 'proposals'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Theme->id = $id;
		if (!$this->Theme->exists()) {
			throw new NotFoundException(__('Invalid theme'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Theme->softDelete($id)) {
			$this->Session->setFlash(__('The theme has been deleted.'));
		} else {
			$this->Session->setFlash(__('The theme could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function isAuthorized($user) {
		// limit to managers
		return $this->Auth->user('role') == 'admin';
	}
}
