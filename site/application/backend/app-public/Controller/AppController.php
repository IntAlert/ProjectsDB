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

	public $components = array(
	    'DebugKit.Toolbar',
	    'Session',
	    'Auth' => array(
	    	'logoutRedirect' => array(
	            'controller' => 'users',
	            'action' => 'login',
	        ),
	    	'authenticate' => array(
	            'Form' => array(
	                'passwordHasher' => 'Blowfish'
	            )
	        ),
	        'authorize' => array('Controller'), // Added this line


	  //       'flash' => array(
			// 	'element' => 'alert',
			// 	'key' => 'auth',
			// 	'params' => array(
			// 		'plugin' => 'BoostCake',
			// 		'class' => 'alert-error'
			// 	)
			// ),
	    ),

	    'RequestHandler' => array(
		    'viewClassMap' => array(
		        'xls' => 'CakePHPExcel.Excel',
		        'xlsx' => 'CakePHPExcel.Excel'
		    )
		),

	);



	public $helpers = array(
		'Html',
		'Form' => array('className' =>'CustomForm'),
	);
	
	public $uses = array('User', 'Audit', 'Currency', 'Donor');

	// var $layout = 'bootstrap3';


	public function beforeFilter() {
		// stop any client side caching.. avoids missing data on user
		// hitting back button
		$this->response->disableCache();
	}

	public function isAuthorized($user) {
		return !!$this->Auth->user('id');
	}


}
