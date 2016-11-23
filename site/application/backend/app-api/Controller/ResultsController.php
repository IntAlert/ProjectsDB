<?php

class ResultsController extends AppController {

 //    public function export() {
	//     $results = $this->Result->find('all');
	//     $_serialize = 'results';
	//     $_header = array('Result ID', 'Title', 'Created');
	//     $_extract = array('Result.id', 'Result.title', 'Result.created');

	//     $this->set(compact('results', '_serialize', '_header', '_extract'));
	// }

	function create() {
		
		// TODO: must be authed

		if ($this->request->is('post')) {
			$this->Result->create();

			$data = $this->request->input('json_decode');
			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function read($id) {
		
		// TODO: must be authed
		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}

		$result = $this->Result->find('first', array(
			'Result.id' => $id,
			'contain' => ['Impact']
		));
		

		$this->set(array('data' => $result));
	}

	function update($id) {

		if (!$this->Result->exists($id)) {
			throw new NotFoundException(__('Invalid Result'));
		}
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {

			$this->Result->id = $id;

			$data = $this->request->input('json_decode');

			$result = $this->Result->saveAssociated($data);
		}

		$this->set(array('data' => $result));
	}

	function delete($id) {
		
		// TODO: must be authed and must be note owner

		if ($this->request->is('post')) {
			$result = $this->Result->delete($id);
		}

		$this->set(array('data' => $result));
	}

	function all() {
		
		// TODO: must be authed and must be note owner

		$results = $this->Result->find('all', array(
			'order' => ['date' => 'DESC'],
			'contain' => [
				'Project.Territory', 
				'Project.Pathway', 
				'Project.Theme', 
				'Impact'
			]
		));

		if ($this->isCSVrequest()) {
			return $this->csv($results);
		} else {
			return $this->json($results);
		}
	}

	public function project($project_id) {
		
		// TODO: must be authed and must be note owner

		$results = $this->Result->find('all', array(
			'conditions' => ['project_id' => $project_id],
			'order' => ['date' => 'ASC'],
			'contain' => [
				'Project.Territory', 
				'Project.Pathway', 
				'Project.Theme', 
				'Impact'
			]
		));
		
		if ($this->isCSVrequest()) {
			return $this->csv($results);
		} else {
			return $this->json($results);
		}
		
	}

	private function json($results) {
		$this->set(array('data' => $results));
	}

	// private function csvBac($results) {

	// 	// build header
	//     $header = array(
	//     	'Result ID',
	//     	'Title',
	//     	'Date',
	//     	'Target Group',
	//     	'Who',
	//     	'What',
	//     	'Where',
	//     	'Significance',
	//     	'Evidence',
	//     	'Partner contribution',
	//     	'Alert contribution',
	//     	'Territory',
	//     	'Impact',
	//     	'Pathway',
	//     );

	//     // add pathways to the data
	//     $pathways = $this->Result->Project->Pathway->find('list');
	//     foreach ($pathways as $pathway_id => $pathway_name) {
	//     	$header[] = $pathway_name
	//     }


	//     // build data
	//     $data = 


	//     $_serialize = 'data';
	//     $this->set(compact('data', '_serialize', '_header'));
	// }

	private function csv($results) {

	    $map = array(
	    	'Result ID' => 'Result.id',
	    	'Title' => 'Result.title',
	    	'Date' => 'Result.date',
	    	'Target Group' => 'Result.target_group',
	    	'Who' => 'Result.who',
	    	'What' => 'Result.what',
	    	'Where' => 'Result.where',
	    	'Significance' => 'Result.significance',
	    	'Evidence' => 'Result.evidence',
	    	'Partner contribution' => 'Result.contribution_partner',
	    	'Alert contribution' => 'Result.contribution_alert',
	    	
	    	
	    	// Record level
	    	'Impact' => 'Impact.name',

	    	// Project level
	    	'Strategic Pathway' => 'Pathway.name',
	    	'Territory' => 'Territory.name',
	    	'Theme' => 'Theme.name',
	    );
	    $_header = array_keys($map);
	    $_extract = array_values($map);


	    // re-work results to have one record for each HABTM or HasMany
	    $resultsExpanded = [];

	    foreach ($results as $result) {

	    	// Ensure all expanded fields have at least one item, null
	    	// So that there is a row for this result even without HM or HBTM
	    	if (empty($result['Project']['Pathway'])) $result['Project']['Pathway'] = array(null);

	    	if (empty($result['Project']['Territory'])) $result['Project']['Territory'] = array(null);

	    	if (empty($result['Project']['Theme'])) $result['Project']['Theme'] = array(null);

	    	if (empty($result['Impact'])) $result['Impact'] = array(null);


	    	// Expand
	    	$resultRow = $result;
	    	// Expand on Pathway
	    	foreach ($result['Project']['Pathway'] as $pathway) {
	    		$resultRow['Pathway'] = $pathway;
	    		
	    		// Expand on Impact
	    		foreach($result['Impact'] as $impact) {
	    			$resultRow['Impact'] = $impact;
	    		
	    			// Expand on Territory
	    			foreach ($result['Project']['Territory'] as $territory) {
	    				$resultRow['Territory'] = $territory;
	    				
	    				// Expand on Theme
	    				foreach ($result['Project']['Theme'] as $theme) {
		    				$resultRow['Theme'] = $theme;
		    				$resultsExpanded[] = $resultRow;
		    			}
	    			}

	    		}
	    	}

	    }

	    $_serialize = 'resultsExpanded';

	    $this->set(compact('resultsExpanded', '_serialize', '_header', '_extract'));
	}

	// function getPathwayMap() {
	// 	$pathways = $this->Result->Project->Pathway->find('list');

	// 	$map = [];
	// 	foreach ($pathways as $pathway) {
	// 		$map[]
	// 	}
	// }


}
