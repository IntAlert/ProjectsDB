<?php

class TerritoriesController extends AppController {


	function allCountries() {

        $territories = $this->Territory->findAllCountries();

        $this->set(compact('territories'));
        
	}

	function allRegions() {

        $territories = $this->Territory->findAllRegions();

        $this->set(compact('territories'));
        
	}

}
