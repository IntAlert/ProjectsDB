


<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
#App::import('Vendor', 'OAuth/OAuthClient');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class Office365AdminController extends AppController {

    

    var $redirect_uri = false;
    var $authorize_url = 'https://login.windows.net/common/oauth2/authorize';
    var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';
    var $windowsGraphUrl = 'https://graph.windows.net/me/?api-version=1.5';


    function beforeFilter() {

        $this->redirect_uri = Router::url('/office365Admin/callback', true);

        $this->Auth->allow('login', 'callback');

        parent::beforeFilter();
    }

    function login() {

        $request_url = $this->authorize_url 
            . '?response_type=code'
            . '&resource=https://intlalert.sharepoint.com'
            . '&client_id=' . OFFICE365_CLIENT_ID 
            . '&redirect_uri=' . urlencode($this->redirect_uri);

        $this->redirect($request_url);

    }


    function callback() {


        // get the code, and request an access token
        $code = $this->request->query('code');


        die();

    }


    private function getUserTokens($code) {
        
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

        return array(
            'access_token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
        );
    }

    private function getUserData($access_token) {
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $access_token
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

        return $o365_user_response;
    }

    private function getSharepointAccess($refresh_token) {

        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'refresh_token' => $refresh_token,
            'resource' => 'https://intlalert.sharepoint.com',
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

