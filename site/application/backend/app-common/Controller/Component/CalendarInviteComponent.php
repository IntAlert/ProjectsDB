<?php

App::uses('Component', 'Controller');
class CalendarInviteComponent extends Component {

	public function initialize(Controller $controller) {
	    $this->controller = $controller;
	}

	private function dateToCal($timestamp) {
		return date('Ymd\THis\Z', $timestamp);
	}
	// Escapes a string of characters
	private function escapeString($string) {
		return preg_replace('/([\,;])/','\\\$1', $string);
	}

	private function breakInto75s($string) {

		$response = '';
		$lines = preg_split("/((\r?\n)|(\r\n?))/", $string);
		foreach ($lines as $line) {
			$chunks = str_split($line, 75);
			foreach ($chunks as $chunk) {
				$response .= $chunk . "\r\n";
			}
		}
		
		return $response;
	}

	function buildTravelapplicationICS($travelapplication) {


		// determine earliest/latest date

		// debug($travelapplication);


		// iterate through itineray items to extract key info
		$startTimestamps = [];
		$finishTimestamps = [];
		$summaryParts = [];
		$itineraryParts = [];
		$locationParts = [];
		foreach ($travelapplication['TravelapplicationItinerary'] as $itinerary) {
			$startTimestamps[] = strtotime($itinerary['start'] . ' 00:00:01');
			$finishTimestamps[] = strtotime($itinerary['finish'] . ' 23:59:59');

			$itineraryParts[] = $itinerary['start'] . ': ' . $itinerary['Origin']['name'] . ' - ' . $itinerary['Destination']['name'];
			$locationParts[] = $itinerary['Origin']['name'];
			$locationParts[] = $itinerary['Destination']['name'];
		}
		$startTimestamp = min($startTimestamps);
		$finishTimestamp = max($finishTimestamps);
		$uniqueLocations = array_unique($locationParts);
		sort($uniqueLocations);

		// iterate through full application to extract contacts
		$application = json_decode($travelapplication['Travelapplication']['application_json']);

		// $contacts = [];

		// approving manager stored differently
		// $contacts['Approving Manager'] = $application->applicant->approving_manager;

		// Work through other contacts, syphoning off contacts that are saved in record
		// foreach ([
		// 	'applicant' => 'Traveller', 
		// 	'contact_hq' => 'HQ Contact', 
		// 	'contact_home' => 'Home Contact', 
		// 	'contact_incountry' => 'In-country Contact'
		// ] as $key => $niceName) {

		// 	$contact = $application->$key;
			
		// 	if (isset($contact->user)) {
		// 		// not all contacts will be 
		// 		$contacts[$niceName] = $contact->user;
		// 	}
		// }


		$url = Router::url('/travelapplications/view', true) . '/' . $travelapplication['Travelapplication']['id'];


		$description = '';
		$description .= 'Itinerary:\n';
		$description .= implode('\n', $itineraryParts);
		$description .= '\n\n';
		$description .= 'More Info: \n';
		$description .= $url;

		// foreach


		$location = implode(', ', $uniqueLocations);
		$summary = 'Travel in: ' . $location;



		return $this->buildICS($startTimestamp, $finishTimestamp, $description, $url, $summary, $location);

	}
    
    function buildICS($startTimestamp, $finishTimestamp, $description, $url, $summary, $location) {

    	$endDate = $this->dateToCal($startTimestamp);
    	$startDate = $this->dateToCal($finishTimestamp);
    	$description = $this->escapeString($description);
    	$url = $url;
    	$summary = $this->escapeString($summary);
    	$location = $this->escapeString($location);
    	$uid = uniqid();
    	$datestamp = $this->dateToCal(time());

    	$content =<<<EndICS
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
DTEND:$endDate
UID:$uid
DTSTAMP:$datestamp
LOCATION:$location
DESCRIPTION:$description
URL:$url
SUMMARY:$summary
DTSTART:$startDate
END:VEVENT
END:VCALENDAR


EndICS;

	return $this->breakInto75s($content);
		
    }
}