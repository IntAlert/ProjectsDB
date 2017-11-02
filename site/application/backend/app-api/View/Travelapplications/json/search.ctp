<?php 


foreach($travelapplications as &$travelapplication):

	$travelapplication['Travelapplication']['full_application'] = json_decode($travelapplication['Travelapplication']['application_json']);

endforeach; //($travelapplications as $travelapplication):


echo json_encode($travelapplications); ?>