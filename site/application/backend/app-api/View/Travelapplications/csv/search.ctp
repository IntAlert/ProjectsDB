<?php 




// header
$headers = [
	'Name',
	'Itinerary',
];
$rows = [];
foreach($travelapplications as &$travelapplication):

	$application = json_decode($travelapplication['Travelapplication']['application_json']);

	// debug($application->applicant->user->displayName);
	foreach($application->itinerary as $itinerary):

		if (property_exists($application->applicant, 'user')) {

			$row = [
				$application->applicant->user->displayName
				$itinerary->destination->Territory->name
			];
		}
		

		$rows[] = $row;

	endforeach; //($travelapplication['Itinerary'] as $itinerary);
			

endforeach; //($travelapplications as $travelapplication):

$this->CsvResponse->send($headers, $rows, 'results', $this->request->query);
	
	
?>