<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'OAuth/OAuthClient');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class Office365usersController extends AppController {

    

    var $redirect_uri = 'http://local.projects.international-alert.org/pdb/office365users/callback';
    var $authorize_url = 'https://login.windows.net/international-alert.org/oauth2/authorize';
    var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';
    var $windowsGraphUrl = 'https://graph.windows.net/me/?api-version=1.5';


    function beforeFilter() {

        $this->Auth->allow('login', 'callback');

        parent::beforeFilter();
    }

    function login() {


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

        // debug($response);

        // received a well-formed response?
        if ( !$response ) {
            throw new Exception("We received no response from Office365", 1);
        }

        // any errors?
        if ( property_exists($response, 'error') ) {
            throw new Exception("Office365 returned an error: " . $response->error, 1);
        }

/*

        // GET ACCESS TO SHAREPOINT
        $data = array(
            'code' => $code,
            'grant_type' => 'refresh_token',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'refresh_token' => $response->refresh_token,
            'resource' => 'https://intlalert.sharepoint.com',
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));
        $result = $socket->post($this->token_url, $data);

        // parse response body
        $response = json_decode($result->body);





        debug($response);

        die();

        // received a well-formed response?
        if ( !$response ) {
            throw new Exception("We received no response from Office365", 1);
        }

        // any errors?
        if ( property_exists($response, 'error') ) {
            throw new Exception("Office365 returned an error: " . $response->error, 1);
        }

*/
        
        // get USER details
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



        // get or create the user
        $user = $this->Office365user->getOrCreate($response->access_token, $o365_user_response);

        // debug($user);

        // assuming we get a user back, log them in
        $this->Auth->login($user['User']);

        $this->redirect('/dashboard/dashboard');

    }

}
