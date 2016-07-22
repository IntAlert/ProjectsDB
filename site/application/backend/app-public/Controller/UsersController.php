<?php
App::uses('AppController', 'Controller');


App::import('Vendor', 'Office365/Office365AuthAPI');
App::import('Vendor', 'Office365/Office365UserAPI');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
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
            return $this->redirect('/office365users/login');    
        }

        // we must be logged in
        return $this->redirect('/dashboard');        

    }

    function logout() {

        // logout
        $this->Auth->logout();

    }


/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Paginator->settings = array(
            'contain' => false,
            'conditions' => array('User.deleted' => false),
            'limit' => 25,
            'order' => array('User.last_name', 'User.first_name'),
        );
        $this->set('users', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }

        $this->set('roles', $this->User->Role->findOrderedList());
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->softDelete($id)) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    function leagueTable() {

        $leagueTable = $this->Audit->getLeagueTable();

        $this->set(compact('leagueTable'));
    }



    // public function add() {
        
    //     if ($this->request->is('post')) {
            
    //         // $objectId =



    //     }

    // }


    public function isAuthorized($user) {

        // login / logout allowed
        if (in_array($this->action, array('login', 'logout'))) {
            return true;
        }

        // limit to admin
        return $this->userIs('admin');
        
    }


}
