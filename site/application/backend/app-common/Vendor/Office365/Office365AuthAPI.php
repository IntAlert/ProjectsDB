<?php



class Office365AuthAPI {

	var $authorize_url = 'https://login.windows.net/international-alert.org/oauth2/authorize';
	var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';

	var $callback_url = false; //


	function getRedirectURL($callback_url) {

		$redirect_url = $this->authorize_url 
            . '?response_type=code'
            . '&client_id=' . OFFICE365_CLIENT_ID 
            . '&redirect_uri=' . urlencode($callback_url);

       return $redirect_url;
	}

	function getUserTokens($code, $callback_url) {
        
        // get access token
        $data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'redirect_uri' => $callback_url,
            'resource' => 'https://graph.windows.net/',
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->post($this->token_url, $data);

        // parse response body
        $response = json_decode($result->body);

        // debug($response);

        // received a well-formed response?
        if ( !$response ) {
            throw new Exception("We received no response from Office365", 1);
        }

        // any errors?
        if ( property_exists($response, 'error') ) {
            throw new Exception("Office365 returned an error: " . $response->error, 1);
        }

        return array(
            'access_token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
        );
    }


    function getAppTokens() {

        $cache_key_name = 'Office365AuthAPI.AppTokens';
        $tokens = Cache::read($cache_key_name);

        if ( !$tokens ) {
            // get access token
            $data = array(
                'grant_type' => 'client_credentials',
                'client_id' => OFFICE365_CLIENT_ID,
                'client_secret' => OFFICE365_CLIENT_SECRET,
                'resource' => 'https://graph.windows.net/',
            );

            $socket = new HttpSocket(array(
                'ssl_verify_host' => false
            ));
            $result = $socket->post($this->token_url, $data);

            // parse response body
            $response = json_decode($result->body);

            // debug($response);

            // received a well-formed response?
            if ( !$response ) {
                throw new Exception("We received no response from Office365", 1);
            }

            // any errors?
            if ( property_exists($response, 'error') ) {
                throw new Exception("Office365 returned an error: " . $response->error, 1);
            }

            $tokens = array(
                'access_token' => $response->access_token,
                // 'refresh_token' => $response->refresh_token,
            );

            
            Cache::set(array('duration' => '+' . $response->expires_in . ' seconds'));
            Cache::write($cache_key_name, $tokens);

        }

        return $tokens;

        
    }


}