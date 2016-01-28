<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'Office365/Office365AuthAPI');
App::import('Vendor', 'Office365/Office365SharepointAPI');
App::import('Vendor', 'Office365/Office365UserAPI');


#App::import('Vendor', 'OAuth/OAuthClient');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class Office365usersController extends AppController {

    

    var $redirect_uri = false;


    function beforeFilter() {

        $this->redirect_uri = Router::url('/office365users/callback', true);

        $this->Auth->allow('login', 'callback');

        parent::beforeFilter();
    }

    function login() {

        $o365auth = new Office365AuthAPI();

        $request_url = $o365auth->getRedirectURL($this->redirect_uri);

        $this->redirect($request_url);

    }


    function callback() {


        // get the code, and request an access token
        $code = $this->request->query('code');

        $o365auth = new Office365AuthAPI();

        $tokens = $o365auth->getUserTokens($code, $this->redirect_uri);

        //
        // get USER details
        //
        $o365userAPI = new Office365UserAPI($tokens['access_token']);

        $o365_user_response = $o365userAPI->getMe();


        // try dan
        $dan = $o365userAPI->getUserByEmailAddress("danm@international-alert.org");
        debug($dan);
        die();

        // get or create the user
        $user = $this->Office365user->getOrCreate($o365_user_response);

        $this->Office365user->updateGraphTokens($user['Office365user']['user_id'], $tokens);

        //
        // GET ACCESS TO SHAREPOINT
        //
        $sharepoint = new Office365SharepointAPI();

        $tokens = $sharepoint->getAccessTokens($tokens['refresh_token']);

        $this->Office365user->updateSharepointTokens($user['Office365user']['user_id'], $tokens);


        // assuming we get a user back, log them in
        $this->Auth->login($user['User']);

        $this->redirect('/dashboard/dashboard');

    }

}
