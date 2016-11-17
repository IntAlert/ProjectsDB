<?php 


// echo $this->AjaxResponse->package($data);



$data = [
	[
		'name' => "Test name1",
		'theme1' => 0,
		'theme2' => 1,
		'theme3' => 0
	],
	[
		'name' => "Test name2",
		'theme1' => 1,
		'theme2' => 0,
		'theme3' => 0
	],
	[
		'name' => "Test name3",
		'theme1' => 1,
		'theme2' => 1,
		'theme3' => 0
	],

];

echo json_encode($data);