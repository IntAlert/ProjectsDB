<?php

class ParticipantTypesController extends AppController {

	function all() {

        $participant_types = $this->ParticipantType->findOrderedAll();

        $this->set(compact('participant_types'));
        
	}

}
