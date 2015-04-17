<?php

require_once('../../app-common/Config/core-common.php');



Configure::write('Session', array(
		'cookie' => 'IntAlertPDB',
		'timeout' => 3600,
		'cookieTimeout' => 3600,
		'defaults' => 'database',
	));