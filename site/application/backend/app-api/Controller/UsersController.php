<?php

class UsersController extends AppController {


	function all() {

		$users = $this->User->findAllUsersOrdered();
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


}
