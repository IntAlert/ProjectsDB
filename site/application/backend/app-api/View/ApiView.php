<?php


// Same as JsonView but without the override of render.. and no need for the _serialize method

App::uses('View', 'View');

class ApiView extends View {

/**
 * JSON views are always located in the 'json' sub directory for a
 * controllers views.
 *
 * @var string
 */
	public $subDir = false;

/**
 * Constructor
 *
 * @param Controller $controller
 */
	public function __construct(Controller $controller = null) {

		parent::__construct($controller);
		if (isset($controller->response) && $controller->response instanceof CakeResponse) {
			$controller->response->type('json');
		}
	}

}
