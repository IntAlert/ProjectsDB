<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AjaxResponseHelper extends AppHelper {

	// asmt3: returns passed data as well as:
	// - server time
	// response code
	function package($data, $status = 200) {

		$ok = true;
		$server_time = date('Y-m-d H:i:s'); // MySQL datetime
		$data = $this->extractNumbers($data);

		$response = compact('ok', 'status', 'data', 'server_time');

		return json_encode($response, JSON_PRETTY_PRINT);
	}


	private function extractNumbers($o) {

		if(is_object($o)) {

			$result = new stdClass();
		    foreach ($o->children as $child) {
		        $result[$child->name] = $this->extractNumbers($child);
		    }

		} elseif(is_array($o)) {

			$result = [];
			foreach ($o as $key => $value) {
				$result[$key] = $this->extractNumbers($value);
			}

		} elseif(is_numeric($o)) {
			$result = (float)$o;
		} else {
			$result = $o;
		}

		return $result;

	}

}
