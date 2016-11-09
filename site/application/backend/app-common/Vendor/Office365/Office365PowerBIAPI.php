<?php

App::uses('HttpSocket', 'Network/Http');

class Office365PowerBIAPI {

	var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';

	public function getAccessTokens($refresh_token) {

        // returns access and refresh tokens

        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'refresh_token' => $refresh_token,
            'resource' => 'https://analysis.windows.net/powerbi/api',
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->post($this->token_url, $data);

        // parse response body
        $response = json_decode($result->body);

        // received a well-formed response?
        if ( !$response ) {
            throw new Exception("We received no response from Office365", 1);
        }

        // any errors?
        if ( property_exists($response, 'error') ) {
            throw new Exception("Office365 returned an error when getting Sharepoint details: " . $response->error, 1);
        }

        return array(
            'access_token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
        );

    }

}
