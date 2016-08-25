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


// reorder $usersClean alphabetically
usort($usersClean, function($a, $b){
	if ($a['displayName'] == $b['displayName']) {
        return 0;
    }
    return ($a['displayName'] < $b['displayName']) ? -1 : 1;
});

// echo $this->AjaxResponse->package($users);
echo $this->AjaxResponse->package($usersClean);