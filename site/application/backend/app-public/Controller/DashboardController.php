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




		// get most recently viewed projects
		$projectsRecentlyViewed = $this->Project->findRecentlyViewed(10);

		$this->set(compact('projectsRecentlyViewed'));
		
	}



	
}
