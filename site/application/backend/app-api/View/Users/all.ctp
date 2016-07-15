<?php

// clean
$usersClean = [];

foreach($users as $user):

	$usersClean[] = [
		"User" => [
			"id" => $user["User"]['id'],
			"last_name" => $user["User"]['last_name'],
			"first_name" => $user["User"]['first_name'],
			"name_formal" => $user["User"]['name_formal'],
			
		],
		"Office365user" => [
			"email" => $user["Office365user"]['email'],
		]
	];

endforeach; //($users as $user):


echo json_encode($usersClean);

