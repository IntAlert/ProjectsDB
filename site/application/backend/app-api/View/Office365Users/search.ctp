<?php 


// clean users
$usersClean = [];


foreach ($users as $user) {
	
	$usersClean[] = array(
		'objectId' => $user->objectId,
		'displayName' => $user->displayName,
		'mail' => $user->mail,
		'jobTitle' => $user->jobTitle,
		'telephoneNumber' => $user->telephoneNumber,
		'mobile' => $user->mobile,
		'userPrincipalName' => $user->userPrincipalName, // skype
	);

}

// echo $this->AjaxResponse->package($users);
echo $this->AjaxResponse->package($usersClean);