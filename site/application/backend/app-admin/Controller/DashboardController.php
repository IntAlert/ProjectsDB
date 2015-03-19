<?php
App::uses('AppController', 'Controller');
/**
 * Questionoptions Controller
 *
 * @property Questionoption $Questionoption
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DashboardController extends AppController {

	var $uses = array('Prediction', 'Prizeentry');

	function dashboard() {


		// build totals
		$totals = array(
			'predictions' => $this->Prediction->find('count'),
			'shares' => $this->Prediction->find('count', array('conditions' => array('Prediction.shared > ' => 0))),
			'clicks' => $this->Prediction->field('SUM(clicks)'),
			'prizeentries' => $this->Prizeentry->find('count'),
		);


		$personaSummary = $this->Prediction->getPersonaSummary();

		$prizeentries = $this->Prizeentry->getDailySummary();

		$this->set(compact('totals', 'personaSummary', 'prizeentries'));
		
	}
}
