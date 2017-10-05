<?php
App::uses('AppController', 'Controller');
/**
 * Projectdates Controller
 *
 * @property Projectdate $Projectdate
 * @property PaginatorComponent $Paginator
 */
class ProjectdatesController extends AppController {

/**
 * Components
 *
 * @var array
 */

	function all() {
		
		$start_date_limit = $this->request->query('start_date_limit');
		$finish_date_limit = $this->request->query('finish_date_limit');
		$start_date = $this->request->query('start_date');
		$finish_date = $this->request->query('finish_date');
		$completed = $this->request->query('completed');
		
		
		// default values
		if (is_null($start_date_limit)) $start_date_limit = 0;
		if (is_null($start_date)) $start_date = date('d/m/Y');
		if (is_null($finish_date_limit)) $finish_date_limit = 1;
		if (is_null($finish_date)) {
			$now = new DateTime('now');
			$finish_date = $now->modify("+31 days")->format('d/m/Y');
		}
		if (is_null($completed)) $completed = 0;

		$projectdates = $this->Projectdate->search($start_date_limit, $start_date, $finish_date_limit, $finish_date, $completed);

		$this->set(array('data' => $projectdates));
	}

}
