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

        $this->Auth->allow('login', 'callback');

        $this->redirect_uri = Router::url('/office365users/callback', true);

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

        // get or create the user
        $user = $this->Office365user->getOrCreate($o365_user_response, array('budget-holder'));

        $this->Office365user->updateGraphTokens($user['Office365user']['user_id'], $tokens);

        //
        // GET ACCESS TO SHAREPOINT
        //
        $sharepoint = new Office365SharepointAPI();

        $tokens = $sharepoint->getAccessTokens($tokens['refresh_token']);

        $this->Office365user->updateSharepointTokens($user['Office365user']['user_id'], $tokens);

        // assuming we get a user back, log them in
        $this->Auth->login($user['User']);

        // $this->Session->write('post_login_redirect', null);
        // $post_login_redirect = $this->Session->read('post_login_redirect');
        // die($post_login_redirect);

        if ($post_login_redirect = $this->Session->read('post_login_redirect')) {
            $this->Session->write('post_login_redirect', null);
            return $this->redirect($post_login_redirect);
        } else {
            return $this->redirect('/dashboard');
        }

    }

    function search() {

        if ($this->request->query('data.q')) {
            
            $startsWith = trim($this->request->query('data.q'));

            // get all users from o365
            $o365auth = new Office365AuthAPI();
            $tokens = $o365auth->getAppTokens();
            $o365userAPI = new Office365UserAPI($tokens['access_token']);

            $office365Users = $o365userAPI->getAllUsers($startsWith);

            $knownUsers = $this->Office365user->getAlreadyKnownListByObjectId($office365Users);

            // debug(compact('office365Users', 'knownUsers'));
            $this->set(compact('users', 'knownUsers'));

        }

        $this->set(compact('office365Users'));
        
    }

    function add($o365_object_id) {


        // we are going to need to check the 
        // object_id with Office 365 so
        // do it up here:
        $o365auth = new Office365AuthAPI();
        $tokens = $o365auth->getAppTokens();

        // get all users from o365
        $o365userAPI = new Office365UserAPI($tokens['access_token']);
        $office365user = $o365userAPI->getUserByEmailAddressOrObjectId($o365_object_id);

        if ($this->request->is("post")) {
            $role_ids = $this->request->data("User.Role");
            
            $user = $this->Office365user->getOrCreate($office365user, $role_ids);

            
            return $this->redirect(array(
                'controller' => 'users',
                'action' => 'view',
                $user['User']['id'],
            ));
        }

        

        $roles = $this->Office365user->User->Role->findOrderedList();

        $this->set(compact('office365user', 'roles'));
        
    }


    public function isAuthorized($user) {

        // login / logout allowed
        if (in_array($this->action, array('login', 'callback'))) {
            return true;
        }

        // limit to admin
        return $this->userIs('admin');
        
    }


}
