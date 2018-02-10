<?php
App::uses('CakeEmail', 'Network/Email');

class SendProjectdateNotificationsShell extends AppShell {

	var $uses = array('Projectdatenotification');
	// define number of project dates to process at a time
	// BEST to do one at a time so that we don't send multiple notifications for the
	// same date (in case of some failure of this script to run for a period of time)
	// COULD also be avoided by filtering for unique projectdate_ids
	var $batchSize = 1;

	function main() {

		// get all project dates that are past remind_by
		$projectdatenotifications = $this->Projectdatenotification->find('all', array(
			'contain' => array('Project.OwnerUser.Office365user', 'Projectdate'),
			'conditions' => array(
				'Projectdatenotification.sent' => 0, // has not been marked as complete
			),
			'limit' => $this->batchSize,
			'order' => 'Projectdatenotification.created ASC',
		));

		$this->out('Found ' . count($projectdatenotifications) . ' notifications');

		foreach($projectdatenotifications as $projectdatenotification):

			$projectdate_id = $projectdatenotification['Projectdatenotification']['projectdate_id'];

			// only send if date not marked as complete
			// Just avoids any race condition where notification generated, user marks as
			// complete, then send is triggered
			if( !$projectdatenotification['Projectdate']['completed'] ) {
				$this->sendNotification($projectdatenotification);
			} else {
				$this->out('Skipping for ' . $projectdate_id . ' - now complete');
			}

			// update all notifications that relate to this projectdate
			$this->Projectdatenotification->updateAll(
				array('Projectdatenotification.sent' => true),
				array('Projectdatenotification.projectdate_id' => $projectdate_id)
			);
			
		endforeach; //($projectdates as $projectdate):



	}

	private function sendNotification($projectdatenotification) {

		// email PROMPT admins about the feedback
		
		$Email = new CakeEmail('default');
		$result = $Email->template('projectdates/notification')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'projectdatenotification' => $projectdatenotification,
		    ))
		    ->subject('PROMPT Key Date Reminder - ' . $projectdatenotification['Project']['title'])
				->addTo('athomson@international-alert.org')
		    // ->addTo($projectdatenotification['Project']['OwnerUser']['Office365user']['email'])
		    ->send();

	}





}
