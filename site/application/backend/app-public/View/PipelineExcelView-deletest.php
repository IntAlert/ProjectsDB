<?php
App::uses('View', 'View');
class PipelineExcelView extends View {

	var $uses = array('Department');
	var $helpers = array('Time');

    public function render($view = null, $layout = null) {

		$name = 'test.xlsx';
		$download = true;

		// get template
		$this->createExcelTemplate();

		// GET DATA
		$comparissonData = array(
			'date' => '2014-10-10',
			'department-budget' => array(
				1 => '2003423',
				2 => '23423',
				3 => '2003423',
				4 => '23423',
				5 => '2003423',
				6 => '232332',
				7 => '2003423',
			),
			'department-chfl' => array(
				1 => '200423',
				2 => '2343',
				3 => '200423',
				4 => '2323',
				5 => '200423',
				6 => '23232',
				7 => '23432',
			),
		);

		$this->buildData(2015, $comparissonData);

		// write all sheets
		$this->writeContent();
		
		// save the template
		$exportFile = $this->savePipeline();

		// respond with file
		$this->response->file($exportFile, compact('name', 'download'));
    }

    function buildData($selectedYear, $comparissonData) {
		
		$this->selectedYear = $selectedYear;
		$this->nextYear = $selectedYear + 1;

		// get departments
		$this->departmentsList = $this->Department->findOrderedList();

		$this->loadComparissonData($comparissonData);

		// get annual contract budgets
		$this->contractbudgetsThisYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($this->selectedYear);

		// get department budgets for this year
		$this->departmentBudgetsThisYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($this->selectedYear);

		// get annual contract budgets
		$this->contractbudgetsNextYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($this->nextYear);

		// get department budgets for next year
		$this->departmentBudgetsNextYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($this->nextYear);

		// BUILD UP DEPARTMENT-LEVEL DATA
		$departmentsDetailAnnual = [];
		foreach ($this->departmentsList as $department_id => $name) {

			$departmentDetailAnnual = array(
				'department' => $this->Department->findSimpleById($department_id),
				'projects' => $this->Department->Project->getProjectsByDepartmentAndYear($department_id, $this->selectedYear),
				'departmentBudgetThisYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $this->selectedYear),
				'departmentBudgetNextYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $this->selectedYear + 1),
			);

			$departmentsDetailAnnual[$department_id] = $departmentDetailAnnual;

		}

		$this->departmentsDetailAnnual = $departmentsDetailAnnual;
	}

	private function loadComparissonData($comparissonData) {

		$comparissonData['total'] = array(
			'department-budget' => 0,
			'department-chfl' => 0,
		);

		foreach ($this->departmentsList as $department_id => $name) {

			// add to totals
			$comparissonData['total']['department-budget'] += $comparissonData['department-budget'][$department_id];
			$comparissonData['total']['department-chfl'] += $comparissonData['department-chfl'][$department_id];

			// calculate ratio
			if ($comparissonData['department-budget'][$department_id] > 0) {
				$ratio = $comparissonData['department-chfl'][$department_id] / $comparissonData['department-budget'][$department_id];
			} else {
				$ratio = '';
			}
			$comparissonData['department-ratio'][$department_id] = $ratio;
		}

		// calculate total ratio
		if ($comparissonData['total']['department-budget'] > 0) {
			$total_ratio = $comparissonData['total']['department-chfl'] / $comparissonData['total']['department-budget'];
		} else {
			$total_ratio = '';
		}

		$comparissonData['total']['department-ratio'] = $total_ratio;

		$this->comparissonData = $comparissonData;
	}

	function writeContent() {

		// pipeline summary this year
		$pipelineThisYear = new MACPipeline($this->selectedYear, $this->departmentBudgetsThisYear, $this->contractbudgetsThisYear);
		$this->createSummary($pipelineThisYear);

		// copy summary 2016
		$pipelineNextYear = new MACPipeline($this->selectedYear + 1, $this->departmentBudgetsNextYear, $this->contractbudgetsNextYear);
		$this->createSummary($pipelineNextYear);

		// Create department detail for each department
		foreach($this->departmentsList as $department_id => $unused) {
			$this->createDepartmentDetail($department_id);	
		}

	}

	function createSummary($pipeline) {

		$sheet = $this->cloneSummarySheet($pipeline->getYear() . " Summary");

		// FIRST ROW
		// Pipeline year and snapshot time
		$now = new DateTime();
		$snapshotTime = $pipeline->getYear() . ' STATUS as at ' . $this->Time->nice($now);
		$sheet->setCellValue('A1', $snapshotTime);

		// Comparisson year
		$sheet->setCellValue('J1', $this->Time->format('Y', $this->comparissonData['date']) . " Progress to Target" );

		// SECOND ROW
		// add year
		$sheet->setCellValue('A2', $pipeline->getYear() . ' Budget Targets');

		// add comparisson date
		$sheet->setCellValue('J2', 'Comparison Figures as at ' . $this->Time->format('d/m/y', $this->comparissonData['date']));

		// ALL DEPARTMENTS
		$grandTotal = array(
			'Total',
			$pipeline->getBudget('all'), // budget this year

			// pipeline (confirmed and highly likely)
			$pipeline->getTotal("all", "confirmed"), // confirmed value
			$pipeline->getRatio("all", "confirmed"), // confirmed %
			$pipeline->getTotal("all", array('confirmed', 'highly-likely')),
			$pipeline->getRatio("all", array('confirmed', 'highly-likely')),

			// pipeline (all unconfirmed)
			$pipeline->getTotal("all", array("highly-likely", 'medium', 'low')),
			$pipeline->getTotal("all", array("highly-likely")),
			$pipeline->getTotal("all", array('medium', 'low')),

			// add previous year snapshot
			$this->comparissonData['total']['department-budget'],
			$this->comparissonData['total']['department-chfl'],
			$this->comparissonData['total']['department-ratio'],
			
		);

		// add the row of data
		$sheet->fromArray($grandTotal, NULL, 'A4');

	    // DEPARTMENT-BY-DEPARTMENT
	    $rowNumber = 5;
	    foreach ($this->departmentsList as $department_id => $department_name):

	    	$departmentTotal = array(
				$department_name,
				$pipeline->getBudget($department_id), // budget this year

				// pipeline (confirmed and highly likely)
				$pipeline->getTotal($department_id, "confirmed"), // confirmed value
				$pipeline->getRatio($department_id, "confirmed"), // confirmed %
				$pipeline->getTotal($department_id, array('confirmed', 'highly-likely')),
				$pipeline->getRatio($department_id, array('confirmed', 'highly-likely')),

				// pipeline (all unconfirmed)
				$pipeline->getTotal($department_id, array("highly-likely", 'medium', 'low')),
				$pipeline->getTotal($department_id, array("highly-likely")),
				$pipeline->getTotal($department_id, array('medium', 'low')),

				// add previous year snapshot
				$this->comparissonData['department-budget'][$department_id],
				$this->comparissonData['department-chfl'][$department_id],
				$this->comparissonData['department-ratio'][$department_id],
			
				
			);
			
			// add the row of data
		    $sheet->fromArray($departmentTotal, NULL, 'A' . $rowNumber);

		    ++$rowNumber;

	    endforeach; // ($departmentsList as $department_id => $department_name):


		return $sheet;
	}

	function createDepartmentDetail($department_id) {


		extract($this->departmentsDetailAnnual[$department_id]);

		// instantiate pipeline
		$pipeline = new MACPipelineByDepartment($this->selectedYear, $projects, $departmentBudgetThisYear, $departmentBudgetNextYear);

		$unconfirmedProjects = $pipeline->getFlattenedProjects(array('highly-likely', 'medium', 'low'));
		$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));

		// get sheet
		$sheet = $this->cloneDepartmentSheet($department['Department']['name']);

		// add title
		$sheet->setCellValue('A1', $department['Department']['name'] );

		// add this year budget
		$sheet->setCellValue('G1', $this->selectedYear . " Budget" );
		$sheet->setCellValue('I1', $departmentBudgetThisYear );

		// add next year budget
		$sheet->setCellValue('G2', $this->selectedYear + 1 . " Budget" );
		$sheet->setCellValue('I2', $departmentBudgetNextYear );

		// add row 5 headers
		$sheet->setCellValue('I4', $this->selectedYear);
		$sheet->setCellValue('J4', $this->selectedYear + 1);


		// build up data to add for confirmed projects
		$confirmedProjectValues = [];


		// add confirmed project detail
		foreach ($confirmedProjects as $project):

			// PREPARE DATA

			// primary territory name
			$territory_name = count($project['territory_names']) ?
				$project['territory_names'][0] : 'none';

			// fund code			
			$fund_code = $project['fund_code'] ? $project['fund_code'] : 'none';

			// primary donor name
			if (isset($project['contract_primary']['Donor']['short_name'])) {
				$primary_donor_name = h($project['contract_primary']['Donor']['short_name']);
			} else {
				$primary_donor_name = 'none';
			}

			// matched funding percentage
			if($project['matched_funding_percentage'] === false) {
				$matched_funding_percentage = 'n/a';
			} else {
				$matched_funding_percentage = $project['matched_funding_percentage'];
			}


			$projectDetail = array(
				$territory_name,
				$project['title'], // budget this year
				$fund_code,
				$primary_donor_name,
				$this->Time->format('d/m/Y', $project['start_date']),
				$this->Time->format('d/m/Y', $project['finish_date']),
				$project['value_required'],
				$matched_funding_percentage,
				$project['contract_primary']['contract_budget_this_year_gbp'],
				$project['contract_primary']['contract_budget_next_year_gbp']

				// TODO: add previous year snapshot
				
			);

			// add values for adding later
			$confirmedProjectValues[] = $projectDetail;

			// add secondary contracts
			foreach ($project['contracts_secondary'] as $contract_secondary):

				// PREPARE VALUES

				// donor name
				if (isset($contract_secondary['Donor']['short_name'])) {
					$secondary_donor_name = $contract_secondary['Donor']['short_name'];
				} else {
					$secondary_donor_name = 'none';
				}

				$secondaryContractDetail = array(
					NULL,
					$project['title'], // budget this year
					$fund_code,
					$secondary_donor_name,
					$this->Time->format('d/m/Y', $project['start_date']),
					$this->Time->format('d/m/Y', $project['finish_date']),
					'n/a',
					'n/a',
					$contract_secondary['contract_budget_this_year_gbp'],
					$contract_secondary['contract_budget_next_year_gbp'],

					// TODO: add previous year snapshot
					
				);

				$confirmedProjectValues[] = $secondaryContractDetail;

			endforeach; // ($project['contracts_secondary'] as $contract_secondary):
			

			
			

		endforeach; // ($confirmedProjects as $project):


		// 
		// UNCONFIRMED
		// 

		// build up data to add for confirmed projects
		$unconfirmedProjectValues = [];


		// add confirmed project detail
		foreach ($unconfirmedProjects as $project):

			// PREPARE DATA

			// primary territory name
			$territory_name = count($project['territory_names']) ?
				$project['territory_names'][0] : $territory_name;

			// primary donor name
			if (isset($project['contract_primary']['Donor']['short_name'])) {
				$primary_donor_name = h($project['contract_primary']['Donor']['short_name']);
			} else {
				$primary_donor_name = 'none';
			}

			// matched funding percentage
			if($project['matched_funding_percentage'] === false) {
				$matched_funding_percentage = 'n/a';
			} else {
				$matched_funding_percentage = $project['matched_funding_percentage'];
			}

			$projectDetail = array(
				$territory_name,
				$project['title'], // budget this year
				$project['likelihood_short_name'],
				$primary_donor_name,
				$this->Time->format('d/m/Y', $project['start_date']),
				$this->Time->format('d/m/Y', $project['finish_date']),
				$project['value_required'],
				$matched_funding_percentage,
				$project['contract_primary']['contract_budget_this_year_gbp'],
				$project['contract_primary']['contract_budget_next_year_gbp']

				// TODO: add previous year snapshot
				
			);

			// add values for adding later
			$unconfirmedProjectValues[] = $projectDetail;

			// add secondary contracts
			foreach ($project['contracts_secondary'] as $contract_secondary):

				// PREPARE VALUES

				// donor name
				if (isset($contract_secondary['Donor']['short_name'])) {
					$secondary_donor_name = $contract_secondary['Donor']['short_name'];
				} else {
					$secondary_donor_name = 'none';
				}

				$secondaryContractDetail = array(
					NULL,
					$project['title'], // budget this year
					$project['likelihood_short_name'],
					$secondary_donor_name,
					$this->Time->format('d/m/Y', $project['start_date']),
					$this->Time->format('d/m/Y', $project['finish_date']),
					'n/a',
					'n/a',
					$contract_secondary['contract_budget_this_year_gbp'],
					$contract_secondary['contract_budget_next_year_gbp'],

					// TODO: add previous year snapshot
					
				);

				$unconfirmedProjectValues[] = $secondaryContractDetail;

			endforeach; // ($project['contracts_secondary'] as $contract_secondary):
			

		endforeach; // ($confirmedProjects as $project):


	    // UNCONFIRMED



		// determine starting row for unconfirmed
		$confirmedStartingRow = 5;
		$unconfirmedStartingRow = 4 + count($confirmedProjectValues) + $confirmedStartingRow;
		
		// add rows for confirmed and unconfirmed
		$sheet->insertNewRowBefore($confirmedStartingRow + 1, count($confirmedProjectValues) - 1);
		$sheet->insertNewRowBefore($unconfirmedStartingRow + 1, count($unconfirmedProjectValues) - 1);


		// add the row of data
	    $sheet->fromArray($confirmedProjectValues, NULL, 'A5');
	    $sheet->fromArray($unconfirmedProjectValues, NULL, 'A' . $unconfirmedStartingRow);

	    // add totals for confirmed
	    $confirmedTotalRow = $confirmedStartingRow + count($confirmedProjectValues);

	    $sheet->setCellValue('I' . $confirmedTotalRow,  $pipeline->getTotalBudgetThisYear(array('confirmed')));
    	$sheet->setCellValue('J' . $confirmedTotalRow,  $pipeline->getTotalBudgetNextYear(array('confirmed')));

    	$sheet->setCellValue('I' . ($confirmedTotalRow + 1),  $pipeline->getPercentageBudgetThisYear(array('confirmed')) / 100); // turn into ratio
    	$sheet->setCellValue('J' . ($confirmedTotalRow + 1),  $pipeline->getPercentageBudgetNextYear(array('confirmed')) / 100); // turn into ratio

    	// add totals for unconfirmed/highly-likely
	    $unconfirmedTotalRow = $unconfirmedStartingRow + count($unconfirmedProjectValues);

	    // unconfirmed
	    $sheet->setCellValue('I' . $unconfirmedTotalRow,  $pipeline->getTotalBudgetThisYear(array('highly-likely', 'medium', 'low')));
	    $sheet->setCellValue('J' . $unconfirmedTotalRow,  $pipeline->getTotalBudgetNextYear(array('highly-likely', 'medium', 'low')));

	    // higly likely
	    $sheet->setCellValue('I' . ($unconfirmedTotalRow + 1),  $pipeline->getTotalBudgetThisYear(array('highly-likely')));
	    $sheet->setCellValue('J' . ($unconfirmedTotalRow + 1),  $pipeline->getTotalBudgetNextYear(array('highly-likely')));
	    
	    // highly likely + confirmed
	    $sheet->setCellValue('I' . ($unconfirmedTotalRow + 2),  $pipeline->getTotalBudgetThisYear(array('highly-likely', 'confirmed')));
	    $sheet->setCellValue('J' . ($unconfirmedTotalRow + 2),  $pipeline->getTotalBudgetNextYear(array('highly-likely', 'confirmed')));

	    // highly likely + confirmed precentage
	    $sheet->setCellValue('I' . ($unconfirmedTotalRow + 3),  $pipeline->getPercentageBudgetThisYear(array('highly-likely', 'confirmed')) / 100); // turn into ratio
	    $sheet->setCellValue('J' . ($unconfirmedTotalRow + 3),  $pipeline->getPercentageBudgetNextYear(array('highly-likely', 'confirmed')) / 100); // turn into ratio
	}

    private function createExcelTemplate() {
		$this->excelTemplate = PHPExcel_IOFactory::load(APP . "View/Layouts/mac-template.xlsx");
	}

	private function savePipeline() {

		// remove template sheets
		$this->deleteTemplateSheets();

		// get tmp filename
		$exportFile = tempnam(sys_get_temp_dir(), 'pipeline_');

		$objWriter = PHPExcel_IOFactory::createWriter($this->excelTemplate, "Excel2007");
		$objWriter->save($exportFile);

		// return path to excel
		return $exportFile;
	}


	private function cloneSummarySheet($sheet_name) {

		$summaryTemplateSheet = $this->excelTemplate->getSheetByName('Summary Template');

		$clonedWorksheet = clone $summaryTemplateSheet;
		$clonedWorksheet->setTitle($sheet_name);
		$this->excelTemplate->addSheet($clonedWorksheet);

		// build header row 1
		return $clonedWorksheet;
	}

	private function cloneDepartmentSheet($sheet_name) {

		$departmentTemplateSheet = $this->excelTemplate->getSheetByName('Department Template');

		$clonedWorksheet = clone $departmentTemplateSheet;
		$clonedWorksheet->setTitle($sheet_name);
		$this->excelTemplate->addSheet($clonedWorksheet);

		// build header row 1
		return $clonedWorksheet;
	}

	private function deleteTemplateSheets() {
		
		// delete summary template
		$sheetIndex = $this->excelTemplate->getIndex(
	    	$this->excelTemplate->getSheetByName('Summary Template')
		);
		$this->excelTemplate->removeSheetByIndex($sheetIndex);

		// delete department template
		$sheetIndex = $this->excelTemplate->getIndex(
	    	$this->excelTemplate->getSheetByName('Department Template')
		);
		$this->excelTemplate->removeSheetByIndex($sheetIndex);
	}

}

