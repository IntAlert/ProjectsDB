<?php

App::import('Vendor', 'Office365/Office365AuthAPI');
App::import('Vendor', 'Office365/Office365UserAPI');

class Office365UsersController extends AppController {

  function all() {

    // get all users from o365
    $o365auth = new Office365AuthAPI();
    $tokens = $o365auth->getAppTokens();
    $o365userAPI = new Office365UserAPI($tokens['access_token']);

    $users = $o365userAPI->all();

    $users = Cache::read('office365users.all', 'short');
    // var_dump($users);
    if (!$users) {
        $users = $o365userAPI->all();
        // $users = time();
        Cache::write('office365users.all', $users, 'short');
    }

    $this->set(compact('users'));
        
  }

	function search() {

		$startsWith = $this->request->query('startsWith');

		// get all users from o365
    $o365auth = new Office365AuthAPI();
    $tokens = $o365auth->getAppTokens();
    $o365userAPI = new Office365UserAPI($tokens['access_token']);

    $users = $o365userAPI->search($startsWith);


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
