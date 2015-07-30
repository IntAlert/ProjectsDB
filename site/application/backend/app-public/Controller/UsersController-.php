<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {



	var $redirect_uri = 'http://local.projects.international-alert.org/pdb/users/callback';
    var $authorize_url = 'https://login.windows.net/international-alert.org/oauth2/authorize';
    var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';

	public function beforeFilter() {
		
		// $this->Auth->allow('login', 'logout');
		$this->Auth->allow('*');

		parent::beforeFilter();

	}


	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect('/dashboard/dashboard');
	        }
	        $this->Session->setFlash(__('Invalid username or password, try again'));
	    }
	}

	function start() {


        $request_url = $this->authorize_url 
            . '?response_type=code'
            . '&client_id=' . OFFICE365_CLIENT_ID 
            . '&redirect_uri=' . urlencode($this->redirect_uri);

        $this->redirect($request_url);

    }

    function callback() {

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

    public function logout() {

    	$this->Auth->logout();
    	$this->redirect('/users/login');	
    }


}
