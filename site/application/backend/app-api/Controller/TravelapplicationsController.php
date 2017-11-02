<?php
App::uses('AppController', 'Controller');
/**
 * Travelapplications Controller
 *
 * @property Travelapplication $Travelapplication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TravelapplicationsController extends AppController {

	public function search() {
		$travelapplications = $this->Travelapplication->search($this->request->query);

		$this->set(compact('travelapplications'));

	}

}
