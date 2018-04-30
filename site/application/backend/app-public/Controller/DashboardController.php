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
		// $projectsRecentlyViewed = $this->Project->findRecentlyViewed($user_id);
		$projectsRecentlyViewed = $this->Audit->findUserActivityViewed($user_id);
		

		$departments = $this->Project->Department->findOrderedList();

		// get company activity
		$projectsCompanyActivity = $this->Audit->findCompanyActivity();


		$this->set(compact('projectsRecentlyViewed', 'projectsCompanyActivity', 'departments'));

		// map data
		$year = date('Y');
		$mapData = $this->Project->getMapData($year);
		$this->set(compact('mapData', 'year'));

		
		
	}

	public function map() {

		$year = date('Y');
		
		$mapData = $this->Project->getMapData(2015);

		$this->set(compact('mapData', 'year'));
	}

	public function admin() {

		// get authenticated user
		$user_id = $this->Auth->user('id');

		// get company activity
		$projectsCompanyActivity = $this->Audit->findCompanyActivity();

		$this->set(compact('projectsCompanyActivity'));
		
	}


    public function isAuthorized($user) {

        // login / logout allowed
        if (in_array($this->action, array('dashboard'))) {
            return parent::isAuthorized($user);
        }

        // limit to admin for eveything but dashboard
        return $this->userIs('admin');
        
    }



	
}
