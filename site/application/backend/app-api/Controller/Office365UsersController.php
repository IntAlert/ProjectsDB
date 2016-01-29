<?php

App::import('Vendor', 'Office365/Office365AuthAPI');
App::import('Vendor', 'Office365/Office365UserAPI');

class Office365UsersController extends AppController {


	function search() {

		$startsWith = $this->request->query('startsWith');

		// get all users from o365
        $o365auth = new Office365AuthAPI();
        $tokens = $o365auth->getAppTokens();
        $o365userAPI = new Office365UserAPI($tokens['access_token']);

        $users = $o365userAPI->getAllUsers($startsWith);


        $this->set(compact('users'));
        
	}

	function getUser() {

		$email = $this->request->query('email');

		// get all users from o365
        $o365auth = new Office365AuthAPI();
        $tokens = $o365auth->getAppTokens();
        $o365userAPI = new Office365UserAPI($tokens['access_token']);

        $user = $o365userAPI->getUserByEmailAddress($email);

        $this->set(compact('user'));
        
	}


	public function isAuthorized($user) {

		// die();


        // login / logout allowed
        if (in_array($this->action, array('login', 'logout'))) {
            return true;
        }

        // admin allowed to see the rest
        if ($user['role'] == 'admin') {
            return true;
        }

        // most people cannot see this
        return false;
        
    }


}
