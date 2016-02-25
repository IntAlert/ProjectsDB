<?php 


echo $this->AjaxResponse->package(array(
	'count' => count($projects),
	'projects' => $projects,
));