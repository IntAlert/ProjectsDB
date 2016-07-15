<?php

class TerritoriesController extends AppController {


	function allGeographical() {

        $territories = $this->Territory->findAllGeographical();

        $this->set(compact('territories'));
        
	}

}
