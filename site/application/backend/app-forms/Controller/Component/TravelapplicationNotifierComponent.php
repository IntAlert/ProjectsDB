<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Component', 'Controller');
class TravelapplicationNotifierComponent extends Component {
    public function sendEmail($data, $travelapplication_id, $travelapplicationReceivers) {
        
    	// data is coming in as an maga array
    	// we want as an object
    	$travelapplicationObj = json_decode(json_encode($data));

    	$Email = new CakeEmail('default');

    	// extract recipients
    	foreach ($travelapplicationReceivers as $receiver) {
    		$Email->addTo($receiver['Office365user']['email']);
    	}

		
		$result = $Email->template('travelapplications/send_email')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'travelapplication_id' => $travelapplication_id,
		    	'travelapplicationObj' => $travelapplicationObj
		    ))
		    ->subject('Travel Application')
		    ->send();


    }
}