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

	private function fold($string) {

		$response = '';
		$lines = preg_split("/((\r?\n)|(\r\n?))/", $string);
		foreach ($lines as $line) {
			$chunks = str_split($line, 74);
			foreach ($chunks as $i => $chunk) {
				if ($i) $response .= ' ';
				$response .= $chunk . "\r\n";
			}
		}
		
		return $response;
	}

	function buildTravelapplicationICS($travelapplication) {

		// debug($travelapplication);


		// iterate through itineray items to extract key info
		$timestamps = [];
		$summaryParts = [];
		$itineraryParts = [];
		$locationParts = [];
		foreach ($travelapplication['TravelapplicationItinerary'] as $itinerary) {
			$timestamps[] = strtotime($itinerary['start'] . ' 09:00:00');
			$timestamps[] = strtotime($itinerary['finish'] . ' 17:00:00');

			$itineraryParts[] = $itinerary['start'] . ': ' . $itinerary['Origin']['name'] . ' - ' . $itinerary['Destination']['name'];
			$locationParts[] = $itinerary['Origin']['name'];
			$locationParts[] = $itinerary['Destination']['name'];
		}
		$startTimestamp = min($timestamps);
		$finishTimestamp = max($timestamps);
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

    	$endDate = $this->dateToCal($finishTimestamp);
    	$startDate = $this->dateToCal($startTimestamp);
    	$description = $this->escapeString($description);
    	$url = $url;
    	$summary = $this->escapeString($summary);
    	$location = $this->escapeString($location);
    	$uid = uniqid();
    	$datestamp = $this->dateToCal(time());

    	$content =<<<EndICS
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Google Inc//Google Calendar 
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
DTSTART:$startDate
DTEND:$endDate
DTSTAMP:$datestamp
CREATED:$datestamp
ORGANIZER;CN=PROMPT:mailto:prompt@international-alert.org
UID:$uid
SEQUENCE:1
LOCATION:$location
DESCRIPTION:$description
URL:$url
SUMMARY:$summary
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR
EndICS;

	return $this->fold($content);
		
    }
}