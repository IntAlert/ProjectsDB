<?php

class ImpactsController extends AppController {

	function all() {

        $impacts = $this->Impact->findOrderedAll();

        $this->set(compact('impacts'));
        
	}

}
