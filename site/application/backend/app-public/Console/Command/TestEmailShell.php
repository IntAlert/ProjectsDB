<?php
App::uses('CakeEmail', 'Network/Email');

class TestEmailShell extends AppShell {
	

	function main() {




		// email PROMPT admins about the feedback
		
		$Email = new CakeEmail('default');
		$result = $Email
			->config(array('log' => true))
		    ->emailFormat('text')
		    ->subject('PROMPT Test Email')
		    ->to('as.thomson@gmail.com')
		    ->send();


	}




}
