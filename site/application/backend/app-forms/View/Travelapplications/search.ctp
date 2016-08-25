<?php


$travelapplicationsClean = [];


foreach ($travelapplications as $travelapplication) {
	
		$travelapplicationClean = json_decode($travelapplication['Travelapplication']['application_json']);

		// add the id, created
		$travelapplicationClean->id = $travelapplication['Travelapplication']['id'];
		$travelapplicationClean->created = $travelapplication['Travelapplication']['created'];

		$travelapplicationsClean[] = $travelapplicationClean;
}

echo json_encode($travelapplicationsClean);