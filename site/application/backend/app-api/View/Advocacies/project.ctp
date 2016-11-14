<?php 

$data_augmented = [];

// for ease on frontend, create participant type count list, indexed by participant_type
foreach ($data as $advocacy) {
	$participant_type_counts = [];
	foreach ($advocacy['ParticipantType'] as $participantType) {
		$participant_type_counts[$participantType['id']] 
			= (int)$participantType['AdvocaciesParticipantType']['count'];
	}
	$advocacy['participant_type_counts'] = $participant_type_counts;	

	$data_augmented[] = $advocacy;
}



echo $this->AjaxResponse->package($data_augmented);