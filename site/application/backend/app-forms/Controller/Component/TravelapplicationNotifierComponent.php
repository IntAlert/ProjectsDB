<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Component', 'Controller');
class TravelapplicationNotifierComponent extends Component {
    public function sendEmail($data, $travelapplication_id, $recipientsEmailAddresses) {
        
    	// data is coming in as an maga array
    	// we want as an object
    	$travelapplicationObj = json_decode(json_encode($data));

    	$Email = new CakeEmail('default');

    	// extract recipients
    	foreach ($recipientsEmailAddresses as $email) {

            var_dump($recipientsEmailAddresses);
            // For testing
    		// $Email->addTo('danm@international-alert.org');
    		// $Email->addTo('as.thomson+'.urlencode($email).'@gmail.com');


            $Email->addTo($email);
    	}

        // For testing
        // $Email->addTo('KHassan@international-alert.org');

		
		$result = $Email->template('travelapplications/send_email')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'travelapplication_id' => $travelapplication_id,
		    	'travelapplicationObj' => $travelapplicationObj
		    ))
		    ->subject('Trip')
		    ->send();


    }
}