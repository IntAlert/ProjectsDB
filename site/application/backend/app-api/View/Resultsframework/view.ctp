<?php 

if (!$results) {
	$data = new stdClass();
} else {
	$data = json_decode($results['ResultsFramework']['data_json']);
}

echo $this->AjaxResponse->package($data);