<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DashboardController extends AppController {


	var $uses = array('Project');

	public function dashboard() {

		// get authenticated user
		$user_id = $this->Auth->user('id');

		// get most recently viewed projects
		$projectsRecentlyViewed = $this->Project->findRecentlyViewed($user_id);

		$departmentsWithProjects = $this->Project->Department->find('all', array('contain' => 'Project'));

		// get company activity
		$projectsCompanyActivity = $this->Audit->findCompanyActivity();

		$this->set(compact('projectsRecentlyViewed', 'projectsCompanyActivity', 'departmentsWithProjects'));
		
	}

	public function admin() {

		// get authenticated user
		$user_id = $this->Auth->user('id');

		// get company activity
		$projectsCompanyActivity = $this->Audit->findCompanyActivity();

		$this->set(compact('projectsCompanyActivity'));
		
	}


	public function isAuthorized($user) {

		// must be logged in
		if (parent::isAuthorized($user) == false) {
			return false;
		}

        // login / logout allowed
        if ($this->action == 'admin' && $user['role'] != 'admin') {
            return false;
        }

        return true;
        
    }



	
}
