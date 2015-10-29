<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

	public function beforeFilter() {
		
		$this->Auth->allow('login', 'logout');
		parent::beforeFilter();

	}



	function login() {

        // redirect logged in users to their dashboard
        if ($this->Auth->user('id')) {
            $this->redirect('/dashboard');
        } else {
            $this->redirect('/office365users/login');
            
        }

    }

    function logout() {

        // logout
        $this->Auth->logout();

    }


}
