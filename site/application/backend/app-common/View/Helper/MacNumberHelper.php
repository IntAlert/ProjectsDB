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
class MacNumberHelper extends AppHelper {

	public $helpers = array('Number');

	function currency($number, $currency = 'GBP') {

		return $this->Number->currency($number, 'GBP', array('places' => 0));
		
	}

}
