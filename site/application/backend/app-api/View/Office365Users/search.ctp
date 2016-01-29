<?php 


// clean users
$usersClean = [];


foreach ($users as $user) {
	
	$usersClean[] = array(
		'objectId' => $user->objectId,
		'displayName' => $user->displayName,
		'mail' => $user->mail,
	);


}

// echo $this->AjaxResponse->package($users);
echo $this->AjaxResponse->package($usersClean);