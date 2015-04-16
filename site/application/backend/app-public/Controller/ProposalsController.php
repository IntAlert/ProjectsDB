<?php
App::uses('AppController', 'Controller');
/**
 * Proposals Controller
 *
 * @property Proposal $Proposal
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProposalsController extends AppController {

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
		$this->Proposal->recursive = 0;
		$this->set('proposals', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Proposal->exists($id)) {
			throw new NotFoundException(__('Invalid proposal'));
		}
		$options = array('conditions' => array('Proposal.' . $this->Proposal->primaryKey => $id));
		$this->set('proposal', $this->Proposal->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {


		if ($this->request->is('post')) {
			$this->Proposal->create();


			// assume owner is creator
			$owner_user_id = $this->Auth->user('id');
			$this->request->data['Proposal']['owner_user_id'] = $owner_user_id;


			if ($this->Proposal->save($this->request->data)) {

				// if the save worked.. 
				// create a project with the same data
				$this->Proposal->Project->create($this->request->data['Proposal']);
				$this->Proposal->Project->save();
				$project_id = $this->Proposal->Project->id;

				$this->Proposal->saveField('project_id', $project_id);
				$this->Proposal->saveField('owner_user_id', $owner_user_id);


				$this->Session->setFlash(__('Your proposal has been saved.'));
				return $this->redirect(array('action' => 'view', $this->Proposal->id));
			} else {
				$this->Session->setFlash(__('The proposal could not be saved. Please, try again.'));
			}
		}
		$programmes = $this->Proposal->Programme->find('list');
		$projects = $this->Proposal->Project->find('list');
		$countries = $this->Proposal->Country->find('list');
		$themes = $this->Proposal->Theme->find('list');
		$this->set(compact('programmes', 'projects', 'countries', 'themes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Proposal->exists($id)) {
			throw new NotFoundException(__('Invalid proposal'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Proposal->save($this->request->data)) {
				$this->Session->setFlash(__('The proposal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The proposal could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Proposal.' . $this->Proposal->primaryKey => $id));
			$this->request->data = $this->Proposal->find('first', $options);
		}
		$programmes = $this->Proposal->Programme->find('list');
		$projects = $this->Proposal->Project->find('list');
		$countries = $this->Proposal->Country->find('list');
		$themes = $this->Proposal->Theme->find('list');
		$this->set(compact('programmes', 'projects', 'countries', 'themes'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Proposal->id = $id;
		if (!$this->Proposal->exists()) {
			throw new NotFoundException(__('Invalid proposal'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Proposal->delete()) {
			$this->Session->setFlash(__('The proposal has been deleted.'));
		} else {
			$this->Session->setFlash(__('The proposal could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
