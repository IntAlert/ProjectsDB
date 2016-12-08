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

		$departmentUnrestrictedAllocationsThisYear = $this->Departmentbudget->find('list', array(
			'fields' => array('department_id', 'unrestricted_allocation_gbp'),
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

		$departments = $this->Departmentbudget->Department->findListByYear($year);
		$this->set(compact('year', 'departments', 'departmentBudgetsThisYear', 'departmentUnrestrictedAllocationsThisYear'));
	}


	public function isAuthorized($user) {
		
        // limit to admin for eveything but dashboard
        return $this->userIs('admin');
        
    }
}
