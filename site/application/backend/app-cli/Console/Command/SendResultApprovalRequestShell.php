<?php
App::uses('CakeEmail', 'Network/Email');

class SendResultApprovalRequestShell extends AppShell {

	var $uses = array('Result');
	// define number of results to process at a time
	var $batchSize = 1;

	function main() {

		// get all project dates that are past remind_by
		$results = $this->Result->find('all', array(
			'contain' => array('Project.OwnerUser.Office365user', 'Impact'),
			'conditions' => array(
				'Result.created >' => '2018-02-01', // after launch
				'Result.project_owner_notified' => false, // owner has not been notified
			),
			'limit' => $this->batchSize,
			'order' => 'Result.created ASC',
		));

		$this->out('Found ' . count($results) . ' notifications');

		foreach($results as $result):

			$result_id = $result['Result']['id'];

			// send
			$this->sendNotification($result);

			// update all notifications that relate to this projectdate
			$this->Result->updateAll(
				array('Result.project_owner_notified' => true),
				array('Result.id' => $result_id)
			);
			
		endforeach; //($projectdates as $projectdate):



	}

	private function sendNotification($result) {

		// email PROMPT admins about the feedback
		
		$Email = new CakeEmail('default');
		$result = $Email->template('results/notification')
			->config(array('log' => true))
		    ->emailFormat('html')
		    ->viewVars(array(
		    	'result' => $result,
		    ))
		    ->subject('PROMPT Result Approval Request - ' . $result['Project']['title'])
				->addTo('athomson@international-alert.org')
		    ->addTo($result['Project']['OwnerUser']['Office365user']['email'])
		    ->send();

	}





}
