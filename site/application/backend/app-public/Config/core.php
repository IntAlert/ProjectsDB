<?php

require_once('../../app-common/Config/core-common.php');

if (Configure::read('debug') > 0) {
	Configure::write('disable_sharepoint_folder_sync', true);	
}

// Configure::write('disable_sharepoint_folder_sync', false);	
