<?php

// Controller/ExampleController.php
App::import('Vendor', 'OAuth/OAuthClient');

class ExampleController extends AppController {

    var $redirect_uri = 'http://local.projects.international-alert.org/admin/example/callback';
    var $authorize_url = 'https://login.windows.net/international-alert.org/oauth2/authorize';
    var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';
    var $windowsGraphUrl = 'https://graph.windows.net/me/?api-version=1.5';


    public function beforeFilter() {
        
        // $this->Auth->allow('login', 'logout');
        $this->Auth->allow('start', 'callback', 'getUser');

        parent::beforeFilter();

    }

    function start() {


        $request_url = $this->authorize_url 
            . '?response_type=code'
            . '&client_id=' . OFFICE365_CLIENT_ID 
            . '&redirect_uri=' . urlencode($this->redirect_uri);

        $this->redirect($request_url);

    }

    function callback() {


        // get the code, and request an access token
        $code = $this->request->query('code');

        // get access token
        $data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'redirect_uri' => $this->redirect_uri,
            'resource' => 'https://graph.windows.net',
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->post($this->token_url, $data);

        // parse response body
        $response = json_decode($result->body);

        var_dump($response);


        if ( !$response ) {

            throw new Exception("We received no response from Office365", 1);

        }

        if ( property_exists($response, 'error') ) {

            throw new Exception("Office365 returned an error: " . $response->error, 1);

        }


        

        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $response->access_token
            ) 
        );

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->get($this->windowsGraphUrl, $data, $options);

        $o365_user_response = json_decode($result->body);


        
        $this->loadModel('Office365User');
        $user = $this->Office365User->getOrCreate($o365_user_response);

        // assuming we get a user back, log them in
        $this->Auth->login($user['User']);

        $this->redirect('/pdb/dashboard/dashboard');

    }





    function callback_dele() {

        $code = $this->request->query('code');


        // get access token
        $data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'redirect_uri' => $this->redirect_uri,
            'resource' => 'https://graph.windows.net',
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->post($this->token_url, $data);

        // parse response body
        $response = json_decode($result->body);

        if ( !$response ) {

            throw new Exception("Error Processing Request", 1);

        }

        var_dump($response->access_token);
        var_dump($response->refresh_token);
        var_dump($response->expires_on);


        die();
    }



    public function index() {
        $client = $this->createClient();

        $client_id = '23fd3541-101a-4cd9-9227-2b60d4c934cc';
        $redirect_uri = 'http://local.projects.international-alert.org/admin/example/callback';
        $request_url = 'https://login.windows.net/common/oauth2/authorize?response_type=code&client_id=' . $client_id .'&redirect_uri=' . urlencode($redirect_uri);

        var_dump($request_url);


        $requestToken = $client->getRequestToken('https://login.windows.net/common/oauth2/authorize', 'http://' . $_SERVER['HTTP_HOST'] . '/example/callback');

        var_dump($requestToken);

        die();

        if ($requestToken) {
            $this->Session->write('azure_ad_request_token', $requestToken);
            $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
        } else {
            // an error occured when obtaining a request token
        }
    }

    public function callback2() {
        $requestToken = $this->Session->read('twitter_request_token');
        $client = $this->createClient();
        $accessToken = $client->getAccessToken('https://api.twitter.com/oauth/access_token', $requestToken);

        if ($accessToken) {
            $client->post($accessToken->key, $accessToken->secret, 'https://api.twitter.com/1/statuses/update.json', array('status' => 'hello world!'));
        }
    }

    private function createClient() {
        return new OAuthClient('23fd3541-101a-4cd9-9227-2b60d4c934cc', 'Cp9JnhgrTWs+Kiu7ZD4T9NwpxArSYjtISYVC0P8/9EE=');
    }
}