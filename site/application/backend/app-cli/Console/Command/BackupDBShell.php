<?php

App::uses('ConnectionManager', 'Model');
App::uses('CakeEmail', 'Network/Email');

class BackupDBShell extends AppShell {

	var $uses = array('Project');

	function main() {

		// do dump
		$target = tempnam('/tmp', 'db-backup-');

		// get database details
		$dataSource = ConnectionManager::getDataSource('default');
		$dbConfig = $dataSource->config;

		// do dump 
		$dump_str = "mysqldump -u {$dbConfig['login']} -h {$dbConfig['host']} -p{$dbConfig['password']} {$dbConfig['database']} | gzip -9 > $target";

		shell_exec($dump_str);
		$this->out('Dumped to ' . $target);

		// create mail
		$Email = new CakeEmail();
		$Email->config('default');
		$Email->from(array('as.thomson@gmail.com' => 'Alan Thomson'));
		$Email->to('alan@projectmccoll.co.uk');
		$Email->subject('About');

		// add attachment

		$Email->attachments(array(
		    'backup.tar.gz' => array(
		        'file' => $target,
		        'mimetype' => 'application/x-gzip'
		    )
		));

		$Email->send('My message');


	}
}
