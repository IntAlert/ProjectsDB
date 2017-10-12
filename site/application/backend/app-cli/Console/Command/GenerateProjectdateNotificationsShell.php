<?php


class GenerateProjectdateNotificationsShell extends AppShell {

	var $uses = array('Projectdate', 'Projectdatenotification');
	// define number of project dates to process at a time
	var $batchSize = 1;

	
	

	function main() {

		$db = $this->Projectdate->getDataSource(); 

		$dateClause = 'Projectdate.remind_by <= DATE_ADD(NOW(), INTERVAL ( -Projectdate.reminder_count * reminder_frequency_days) DAY)';

		// get all project dates that are past remind_by
		$projectdates = $this->Projectdate->find('all', array(
			'contain' => false,
			'conditions' => array(
				'Projectdate.reminder_frequency_days > ' => -1,
				'Projectdate.completed' => 0, // has not been marked as complete
				$db->expression($dateClause), // a reminder is due
			),
			'limit' => $this->batchSize,
		));

		$this->out('Found ' . count($projectdates) . ' reminders');

		foreach($projectdates as $projectdate):

			$projectdate_id = $projectdate['Projectdate']['id'];
			$project_id = $projectdate['Projectdate']['project_id'];

			// create record
			$unsentRecord  = array(
				'projectdate_id' => $projectdate_id,
				'project_id' => $project_id,
				'sent' => 0,
			);
			$this->Projectdatenotification->create($unsentRecord);
			$this->Projectdatenotification->save($unsentRecord);

			// increment reminder count anyway
			$this->Projectdate->updateAll(
				array('Projectdate.reminder_count' => 'Projectdate.reminder_count+1'),                    
				array('Projectdate.id' => $projectdate_id)
			);
			
		endforeach; //($projectdates as $projectdate):



	}
}
