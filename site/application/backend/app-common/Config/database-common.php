<?php

// load database details from env variables
if (!defined('RDS_HOSTNAME')) {
  define('RDS_HOSTNAME', getenv('RDS_HOSTNAME'));
  define('RDS_USERNAME', getenv('RDS_USERNAME'));
  define('RDS_PASSWORD', getenv('RDS_PASSWORD'));
  define('RDS_DB_NAME', getenv('RDS_DB_NAME'));
}


class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => RDS_HOSTNAME,
		'login' => RDS_USERNAME,
		'password' => RDS_PASSWORD,
		'database' => RDS_DB_NAME,
		'prefix' => '',
		'encoding' => 'utf8',
	);

}