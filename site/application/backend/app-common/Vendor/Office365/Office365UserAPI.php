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

        // debug(compact('data', 'options'));

        $o365_user_response = json_decode($result->body);

        return $o365_user_response;
    }


    function search($startsWithStr = null) {


    	$options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.6"
        );

        if ($startsWithStr) {
        	$data['$filter'] = "startswith(displayName, '" . $startsWithStr . "') or startswith(userPrincipalName, '" . $startsWithStr . "')";
            // $data['$filter'] = "startswith(displayName, '" . $startsWithStr . "') or startswith(mail, '" . $startsWithStr . "')";
        }


        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));


        $url = 'https://graph.windows.net/' . OFFICE365_TENANT_ID . '/users/?$top=10';

        // debug(compact('url', 'data', 'options'));

        // /$links/members

        $result = $socket->get($url, $data, $options);

        $o365_user_response = json_decode($result->body);

        debug($o365_user_response);

        $users = $o365_user_response->value;

        return $users;

    }



    function all() {

        // All International Alert Group Id
        $all_object_id = '375abe38-5b56-4deb-b725-02ce52b2a339';

        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.6"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));

        $url = 'https://graph.windows.net/' . OFFICE365_TENANT_ID . '/groups/' . $all_object_id . '/members?$top=999';

        $result = $socket->get($url, $data, $options);

        $o365_user_response = json_decode($result->body);

        // debug($o365_user_response);

        $users = $o365_user_response->value;

        return $users;

    }

    function getUserByEmailAddressOrObjectId($uid) {


    	$options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.6"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));


        $url = 'https://graph.windows.net/' . OFFICE365_TENANT_ID . '/users/' . $uid;

        // debug(compact('url', 'data', 'options'));

        $result = $socket->get($url, $data, $options);

        $o365_user_response = json_decode($result->body);

        // debug($o365_user_response);

        $users = $o365_user_response;

        return $users;

    }

    
}
