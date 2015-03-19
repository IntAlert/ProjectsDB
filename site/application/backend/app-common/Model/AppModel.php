<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	var $actsAs = array('Containable');


	function getAllCompDates($include_today = false) {

		// build array of dates
		Configure::write('comp_start_date', '2015-03-01');
		$start_date = new DateTime(Configure::read('comp_start_date'));
		$most_recent_day = new DateTime();

		if ($include_today == false) {
			$most_recent_day->modify('-1 day');	
		}
		

		$dates = array();
		while ($most_recent_day > $start_date) {

			$dates[] = $most_recent_day->format('Y-m-d');

			$most_recent_day->modify('-1 day');

		}

		return $dates;
	}
}
