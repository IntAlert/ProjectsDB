<?php

class ThemesController extends AppController {


	function all() {

        $themes = $this->Theme->findOrderedAll();

        $this->set(compact('themes'));
        
	}

}
