<?php

// determine environment, default vagrant

Configure::write('ENVIRONMENT', isset($_SERVER['ENVIRONMENT']) ? $_SERVER['ENVIRONMENT'] : 'VAGRANT');

switch (Configure::read('ENVIRONMENT')) {
	case 'PRODUCTION':

		break;
	case 'STAGING':

		break;
	
	default:


		break;
}
