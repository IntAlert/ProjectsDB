<?php


class CompleteProjectsShell extends AppShell {

	var $uses = array('Project');

	function main() {

		// get projects that are out of schedule
		$projects = $this->Project->find('all', array(
			'contain' => false,
			'conditions' => array(
				'Project.status_id' => 2, // i.e. approved and on going
				'Project.finish_date < NOW()', // and now out of timespan
			),
			'limit' => 5,
		));

		$this->out('Found ' . count($projects));

		foreach ($projects as $project) {
			$this->out('Changed status of Project #' . $project['Project']['id'] . ' to complete');

			$this->Project->id = $project['Project']['id'];

			$result = $this->Project->save(array(
				'status_id' => 6  //i.e complete
			), array(
				'callbacks' => false
			));

			$this->out('Done');			
		}



	}
}
