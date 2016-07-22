<?php
class UsersController extends AppController {


    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');



	function login() {

        // redirect logged in users to their dashboard
        if ( !$this->Auth->user('id') ) {
           return $this->redirect(Router::fullBaseUrl() . '/pdb/office365users/login');    
        }

        // we must be logged in
        return $this->redirect('/dashboard');        

    }

    function logout() {

        // logout
        $this->Auth->logout();

    }

    public function isAuthorized($user) {

        // login / logout allowed
        if (in_array($this->action, array('login', 'logout'))) {
            return true;
        }

        // limit to admin
        return $this->userIs('admin');
        
    }


}
