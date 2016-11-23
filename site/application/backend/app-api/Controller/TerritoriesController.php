<?php

class TerritoriesController extends AppController {

// update territories set type = 'country' where iso3 is not null
// manual region
// update territories set type = 'other' where type is null

	function allCountries() {

        $territories = $this->Territory->findAllCountries();

        $this->set(compact('territories'));
        
	}

	function allRegions() {

        $territories = $this->Territory->findAllRegions();

        $this->set(compact('territories'));
        
	}

}
