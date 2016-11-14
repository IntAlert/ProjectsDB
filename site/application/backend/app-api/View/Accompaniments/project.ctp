<?php 

$data_augmented = [];

// for ease on frontend, create participant type count list, indexed by participant_type
foreach ($data as $accompaniment) {
	$participant_type_counts = [];
	foreach ($accompaniment['ParticipantType'] as $participantType) {
		$participant_type_counts[$participantType['id']] 
			= (int)$participantType['AccompanimentsParticipantType']['count'];
	}
	$accompaniment['participant_type_counts'] = $participant_type_counts;	

	$data_augmented[] = $accompaniment;
}



echo $this->AjaxResponse->package($data_augmented);