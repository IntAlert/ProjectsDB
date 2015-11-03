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

	public function dashboard($id = null) {

		// get authenticated user
		$user_id = $this->Auth->user('id');

		// get most recently viewed projects
		$projectsRecentlyViewed = $this->Project->findRecentlyViewed($user_id);

		$departmentsWithProjects = $this->Project->Department->find('all', array('contain' => 'Project'));

		// get company activity
		$projectsCompanyActivity = $this->Audit->findCompanyActivity();

		$this->set(compact('projectsRecentlyViewed', 'projectsCompanyActivity', 'departmentsWithProjects'));
		
	}



	
}
