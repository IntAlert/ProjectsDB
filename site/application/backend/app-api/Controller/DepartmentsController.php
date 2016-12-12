<?php

class DepartmentsController extends AppController {


	function all() {

        $departments = $this->Department->find('all', array('contain' => false));

        $this->set(compact('departments'));
        
	}

}
