<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('ValidationException', 'Error');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	// all calls are ajax response by default
	public $layout = 'ajax';
	// public $viewClass = 'Api';

	// components
	public $components = array(
		// 'RequestHandler',
		'Session',
		// 'Auth' => array(
	 //        'authorize' => array('controller'), // Added this line
	 //    ),

	    'RequestHandler' => array(
	        'viewClassMap' => array('csv' => 'CsvView.Csv')
	    )
	);

	public $uses = array('User');



	// request validation functions
	protected function _insistPost() {
		if (!$this->request->is('post')) {
			throw new ValidationException("You must use POST", 405);
		}
	}

	protected function _insistGet() {
		if (!$this->request->is('get')) {
			throw new ValidationException("You must use GET", 405);
		}
	}

	// ensure that a CSV is converted to a clean array of postive integers
	protected function _csvToIntList($csv_dirty) {

		// return empty array if passed nothing
		if ( !$csv_dirty ) return array();

		// extract product_ids
		$ints_dirty = explode(',', $csv_dirty);

		// build clean list of positive ints
		$ints_clean = array();
		foreach ($ints_dirty as $int_dirty) {
			$int = (int)trim($int_dirty);

			// if the product_id was a positive integer, add to clean list
			if ($int)
				$ints_clean[] = $int;

		}

		return ($ints_clean);


	}


	// callbacks
    public function beforeFilter() {

		parent::beforeFilter();
	}

	public function afterFilter() {
		// ensure responses are JSON
		$this->response->type('json');
	}

	public function isAuthorized($user) {
		// if logged in, you can access whole API unless overridden
		return true; //!!$this->Auth->user('id');
	}

	public function redirect($url, $status = null, $exit = true) {

		// never do a redirect as this is an API
		// only reason a redirect would happen would be unAuthed
		throw new ForbiddenException("Not authed");

    }

    public function isCSVrequest() {
    	return isset($this->request->params['ext']) 
    		&& $this->request->params['ext'] == 'csv';
    }

}
