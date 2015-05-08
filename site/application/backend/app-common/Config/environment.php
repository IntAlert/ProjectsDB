<?php

// determine environment, default vagrant

Configure::write('ENVIRONMENT', isset($_SERVER['ENVIRONMENT']) ? $_SERVER['ENVIRONMENT'] : 'VAGRANT');

switch (Configure::read('ENVIRONMENT')) {
	case 'PRODUCTION':

		Configure::write('BASE_URL', 'https://www.realinsurancenetballmums.com.au'); // no trailing slash
		Configure::write('FACEBOOK_APP_ID', '1563769737203309');
		break;
	case 'STAGING':
		Configure::write('BASE_URL', 'http://staging.realinsurancenetballmums.com.au'); // no trailing slash
		Configure::write('FACEBOOK_APP_ID', '1568002770113339');
		break;
	
	default:

		// we're on vagrant or vagrant share, set to whatever we're on
		
		if (!isset($_SERVER['SERVER_NAME'])) {
			$_SERVER['SERVER_NAME'] = 'local.realnetballmums.com.au';
		}

		Configure::write('BASE_URL', 'http://' . $_SERVER['SERVER_NAME']);
		Configure::write('FACEBOOK_APP_ID', '1568002770113339');
		break;
}
