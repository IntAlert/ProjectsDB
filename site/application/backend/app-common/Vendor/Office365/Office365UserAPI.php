<?php

App::uses('HttpSocket', 'Network/Http');

class Office365UserAPI {

	private $access_token = false;

	var $windowsGraphUrl = 'https://graph.windows.net/me/?api-version=1.5';
	var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';


	function __construct($access_token) {
		$this->access_token = $access_token;
	}

	function getMe() {
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));

        $result = $socket->get($this->windowsGraphUrl, $data, $options);

        debug(compact('data', 'options'));

        $o365_user_response = json_decode($result->body);

        return $o365_user_response;
    }

    function getUserByEmailAddress($email) {

    	$options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));


        $url = 'https://graph.microsoft.com/users';

        debug(compact('url', 'data', 'options'));

        $result = $socket->get($url, $data, $options);

        $o365_user_response = json_decode($result->body);

        return $o365_user_response;


    	


    }

}
