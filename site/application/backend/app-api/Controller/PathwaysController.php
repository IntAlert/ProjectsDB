<?php

class PathwaysController extends AppController {


	function all() {

        $pathways = $this->Pathway->findOrderedAll();

        $this->set(compact('pathways'));
        
	}

}
