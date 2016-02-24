<?php
App::uses('AppController', 'Controller');
/**
 * Departmentbudgets Controller
 *
 * @property Departmentbudget $Departmentbudget
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DepartmentbudgetsController extends AppController {

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
		$this->Departmentbudget->recursive = 0;
		$this->set('departmentbudgets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Departmentbudget->exists($id)) {
			throw new NotFoundException(__('Invalid departmentbudget'));
		}
		$options = array('conditions' => array('Departmentbudget.' . $this->Departmentbudget->primaryKey => $id));
		$this->set('departmentbudget', $this->Departmentbudget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Departmentbudget->create();
			if ($this->Departmentbudget->save($this->request->data)) {
				$this->Session->setFlash(__('The departmentbudget has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The departmentbudget could not be saved. Please, try again.'));
			}
		}
		$departments = $this->Departmentbudget->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($year = null) {

		if (is_null($year)) {
			throw new NotFoundException(__('Invalid departmentbudget'));
		}

		// get department budgets for this year, if any
		$departmentBudgetsThisYear = $this->Departmentbudget->find('list', array(
			'fields' => array('department_id', 'value_gbp'),
			'conditions' => array(
				'Departmentbudget.year' => $year
			),
		));
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Departmentbudget->saveAnnualBudgets($year, $this->request->data)) {
				$this->Session->setFlash(__('The Department Budget has been saved.'));
				return $this->redirect(array('action' => 'edit', $year));
			} else {
				$this->Session->setFlash(__('The Department Budget could not be saved. Please, try again.'));
			}
		} else {
			// $options = array('conditions' => array('Departmentbudget.' . $this->Departmentbudget->primaryKey => $id));
			// $this->request->data = $this->Departmentbudget->find('first', $options);
		}
		$departments = $this->Departmentbudget->Department->find('list');
		$this->set(compact('year', 'departments', 'departmentBudgetsThisYear'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Departmentbudget->id = $id;
		if (!$this->Departmentbudget->exists()) {
			throw new NotFoundException(__('Invalid departmentbudget'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Departmentbudget->delete()) {
			$this->Session->setFlash(__('The departmentbudget has been deleted.'));
		} else {
			$this->Session->setFlash(__('The departmentbudget could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		
        // limit to admin for eveything but dashboard
        return $this->userIs('admin');
        
    }
}
