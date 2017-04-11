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
	                'passwordHasher' => 'Blowfish',
	            )
	        ),
	        'authorize' => array('Controller'), // Added this line
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

	public function beforeFilter() {

		if ( !$this->Session->read('post_login_redirect') ) {
			// if a redirect isn't already 'booked', save for later
			// redirect happens in o365 callback
			$this->Session->write('post_login_redirect', Router::url(null,true));
		} elseif ( $this->Session->read('post_login_redirect') == Router::url(null,true) ) {
            // if a redirect was booked
            // and we have arrived, remove the booking
            $this->Session->delete('post_login_redirect');
        }

		// stop any client side caching.. avoids missing data on user
		// hitting back button
		$this->response->disableCache();

		// make admin status available to general template
		$this->set('is_admin', $this->userIs('admin'));

	}

	public function isAuthorized($user) {

		$isAuthorized = !!$this->Auth->user('id');

		
		return $isAuthorized;
	}

	public function userIs($desired_role) {

		// check for admin role
		$roles = $this->Auth->user('Role');

		if (is_array($roles)) {
			foreach ($roles as $role) {
				if ($role['short_name'] == $desired_role) {
					return true;
				}
			}	
		}
		

		return false;

	}


}
