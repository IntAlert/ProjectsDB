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

            if(Configure::read('debug') > 0) {
                $Email->addTo('as.thomson+'. urlencode($email) . '@gmail.com');
            } else {
                $Email->addTo($email);
            }
            
    	}

        // For testing
        // $Email->addTo('KHassan@international-alert.org');

		
		$result = $Email->template('travelapplications/send_email')
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'travelapplication_id' => $travelapplication_id,
		    	'travelapplicationObj' => $travelapplicationObj
		    ))
		    ->subject('Trip')
		    ->send();


    }

    function sendInvite($ICSContent, $user) {
        $Email = new CakeEmail('default');
        $Email->addTo($user['Office365user']['email']);
        // $Email->addTo('as.thomson@gmail.com');
        $result = $Email->template('travelapplications/invite')
            ->emailFormat('text')

            ->subject('Invite')
            ->attachments([
                'invite.ics' => [
                    'mimetype' => 'text/calendar; method=REQUEST; charset=utf-8',
                    'data' => $ICSContent,
                ]
            ])
            ->send();
    }
}