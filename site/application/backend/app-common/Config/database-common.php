<?php


class DATABASE_CONFIG {

	public $vagrant = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'rootpass',
		'database' => 'app',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $shared = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $staging = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'staging.cyf8wv8ywbwe.eu-west-1.rds.amazonaws.com',
		'login' => 'ebroot',
		'password' => 'rootpass',
		'database' => 'app',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $production = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'production.c3kgpgmqx2vw.ap-southeast-2.rds.amazonaws.com',
		'login' => 'ebroot',
		'password' => '82h2U876UG8b72U',
		'database' => 'app',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	function __construct() {

		switch (Configure::read('ENVIRONMENT')) {
			case 'PRODUCTION':
				$this->default = $this->production;
				break;

			case 'STAGING':
				$this->default = $this->staging;
				break;
			
			// assume VAGRANT
			default:
				$this->default = $this->vagrant;
				break;
		}
	}
}