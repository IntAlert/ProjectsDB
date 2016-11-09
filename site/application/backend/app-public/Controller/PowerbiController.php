<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * Themes Controller
 *
 * @property Theme $Theme
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PowerbiController extends AppController {


	var $client_id = 'b6f98dcc-5244-49b2-90c9-85a3164b91bb';
	var $client_secret = 'UvnLDx6FwSzH/K6hLIIJmP+jMaMEFowkUVjQ5fXlPug=';

	var $token_url = 'https://login.windows.net/international-alert.org/oauth2/token';
	var $callback_url = 'http://local.projects.international-alert.org/pdb/powerbi/callback';

/**
 * index method
 *
 * @return void
 */
	public function index() {

		
		$url = 'https://login.microsoftonline.com/common/oauth2/authorize?response_type=code&client_id='.$this->client_id.'&resource=https://analysis.windows.net/powerbi/api&redirect_uri=' . $this->callback_url;
		$this->redirect($url);
	}

	public function callback() {
		$code = $this->request->query('code');
		var_dump($this->getTokens($code));

		die();
	}


	private function getTokens($code) {
		// get access token
        $data = array(
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->callback_url,
            'resource' => 'https://analysis.windows.net/powerbi/api',
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

}
