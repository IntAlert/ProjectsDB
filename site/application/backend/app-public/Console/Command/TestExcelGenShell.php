<?php

App::import('Helper', 'Time');


class TestExcelGenShell extends AppShell {

	var $uses = array('Department');
	var $helpers = array('Time');

	function main() {
		

		// get template
		$this->template = PHPExcel_IOFactory::load("formatted-template.xlsx");

		// GET DATA
		$this->selectedYear = 2015;
		$this->nextYear = $this->selectedYear+1;

		// get departments
		$this->departmentsList = $this->Department->findOrderedList();

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

		

		// $pipelineThisYear->getYear() . ' STATUS as at ' . $this->Time->nice($now);

		// copy summary 2015

		// populate with data
		$this->createSummary();

		// copy summary 2016

		// populate with data

		// for each department

		// copy template

		// populate with data
		$this->createDepartmentDetail();

		// save the template
		$this->savePipeline();




	}


	function createSummary() {

		// instantiate pipeline
		$pipelineThisYear = new MACPipeline($this->selectedYear, $this->departmentBudgetsThisYear, $this->contractbudgetsThisYear);

		$sheet = $this->cloneSummarySheet($this->selectedYear . " Summary");

		// FIRST ROW
		// Pipeline year and snapshot time
		$now = new DateTime();
		$snapshotTime = $pipelineThisYear->getYear() . ' STATUS as at ' . $now->format('Y-m-d H:i');
		$sheet->setCellValue('A1', $snapshotTime);

		// Comparisson year
		$sheet->setCellValue('J1', ($pipelineThisYear->getYear() - 1) . " Progress to Target" );

		// SECOND ROW
		// add year
		$sheet->setCellValue('A2', $pipelineThisYear->getYear() . ' Budget Targets');

		// add comparisson date
		$sheet->setCellValue('J2', 'Comparison Figures as at' . 'SOME DATE');

		// ALL DEPARTMENTS
		$grandTotal = array(
			'Total',
			$pipelineThisYear->getBudget('all'), // budget this year

			// pipeline (confirmed and highly likely)
			$pipelineThisYear->getTotal("all", "confirmed"), // confirmed value
			$pipelineThisYear->getPercentage("all", "confirmed"), // confirmed %
			$pipelineThisYear->getTotal("all", array('confirmed', 'highly-likely')),
			$pipelineThisYear->getPercentage("all", array('confirmed', 'highly-likely')),

			// pipeline (all unconfirmed)
			$pipelineThisYear->getTotal("all", array("highly-likely", 'medium', 'low')),
			$pipelineThisYear->getTotal("all", array("highly-likely")),
			$pipelineThisYear->getTotal("all", array('medium', 'low')),

			// TODO: add previous year snapshot
			
		);

		// add the row of data
		$sheet->fromArray($grandTotal, NULL, 'A4');

	    // DEPARTMENT-BY-DEPARTMENT
	    $rowNumber = 5;
	    foreach ($this->departmentsList as $department_id => $department_name):
	    	$departmentTotal = array(
				$department_name,
				$pipelineThisYear->getBudget($department_id), // budget this year

				// pipeline (confirmed and highly likely)
				$pipelineThisYear->getTotal($department_id, "confirmed"), // confirmed value
				$pipelineThisYear->getPercentage($department_id, "confirmed"), // confirmed %
				$pipelineThisYear->getTotal($department_id, array('confirmed', 'highly-likely')),
				$pipelineThisYear->getPercentage($department_id, array('confirmed', 'highly-likely')),

				// pipeline (all unconfirmed)
				$pipelineThisYear->getTotal($department_id, array("highly-likely", 'medium', 'low')),
				$pipelineThisYear->getTotal($department_id, array("highly-likely")),
				$pipelineThisYear->getTotal($department_id, array('medium', 'low')),

				// TODO: add previous year snapshot
				
			);
			
			// add the row of data
		    $sheet->fromArray($departmentTotal, NULL, 'A' . $rowNumber);

		    ++$rowNumber;

	    endforeach; // ($departmentsList as $department_id => $department_name):


		return $sheet;
	}

	function createDepartmentDetail() {


		extract($this->departmentsDetailAnnual[3]);

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
				$project['territory_names'][0] : $territory_name;

			// fund code			
			$fund_code = $project['fund_code'] ? $project['fund_code'] : 'none';

			// primary donor name
			if (isset($project['contract_primary']['Donor']['name'])) {
				$primary_donor_name = h($project['contract_primary']['Donor']['name']);
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
				$project['start_date'],
				$project['finish_date'],
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
				if (isset($contract_secondary['Donor']['name'])) {
					$secondary_donor_name = $contract_secondary['Donor']['name'];
				} else {
					$secondary_donor_name = 'none';
				}

				$secondaryContractDetail = array(
					NULL,
					$project['title'], // budget this year
					$fund_code,
					$secondary_donor_name,
					$project['start_date'],
					$project['finish_date'],
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
			if (isset($project['contract_primary']['Donor']['name'])) {
				$primary_donor_name = h($project['contract_primary']['Donor']['name']);
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
				$project['start_date'],
				$project['finish_date'],
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
				if (isset($contract_secondary['Donor']['name'])) {
					$secondary_donor_name = $contract_secondary['Donor']['name'];
				} else {
					$secondary_donor_name = 'none';
				}

				$secondaryContractDetail = array(
					NULL,
					$project['title'], // budget this year
					$project['likelihood_short_name'],
					$secondary_donor_name,
					$project['start_date'],
					$project['finish_date'],
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


	}

	function savePipeline() {

		// $this->deleteTemplateSheets();

		$objWriter = PHPExcel_IOFactory::createWriter($this->template, "Excel2007");
		$objWriter->save("test6.xlsx");
	}

	function fillFields() {
		$objPHPExcel = PHPExcel_IOFactory::load("test2.xlsx");

		$activeSheet = $objPHPExcel->getActiveSheet();


		// build header row 1
		$activeSheet->setCellValue('A1', 'ALAN');


		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		$objWriter->save("test3.xlsx");


	}

	function cloneSummarySheet($sheet_name) {

		$summaryTemplateSheet = $this->template->getSheetByName('Summary Template');

		$clonedWorksheet = clone $summaryTemplateSheet;
		$clonedWorksheet->setTitle($sheet_name);
		$this->template->addSheet($clonedWorksheet);

		// build header row 1
		return $clonedWorksheet;
	}

	function cloneDepartmentSheet($sheet_name) {

		$departmentTemplateSheet = $this->template->getSheetByName('Department Template');

		$clonedWorksheet = clone $departmentTemplateSheet;
		$clonedWorksheet->setTitle($sheet_name);
		$this->template->addSheet($clonedWorksheet);

		// build header row 1
		return $clonedWorksheet;
	}

	function deleteTemplateSheets() {
		

		// delete summary template
		$sheetIndex = $this->template->getIndex(
	    	$this->template->getSheetByName('Summary Template')
		);
		$this->template->removeSheetByIndex($sheetIndex);

		// delete department template
		$sheetIndex = $this->template->getIndex(
	    	$this->template->getSheetByName('Department Template')
		);
		$this->template->removeSheetByIndex($sheetIndex);
	}

	function copyRowBetweenSheets() {


		$objPHPExcel = $this->cloneDepartmentSheet();

		$objPHPExcel = PHPExcel_IOFactory::load("formatted-template.xlsx");

		// get tempalte
		$departmentTemplateSheet = $objPHPExcel->getSheetByName('Department Template');

		// create new sheet
		$newSheet = $objPHPExcel->createSheet();

		// get first row
		$departmentTemplateSheet->insertNewRowBefore(10,10); 
		$departmentTemplateSheet->insertNewRowBefore(5,10); 

		// add it

		// update fields


		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		$objWriter->save("test5.xlsx");
	}

	// function main() {



	// 	$objPHPExcel = new PHPExcel();
	// 	$activeSheet = $objPHPExcel->getActiveSheet();


	// 	// build header row 1
	// 	$activeSheet->setCellValue('A1', '2015 STATUS as at 2 Sept 2015');
	// 	$activeSheet->mergeCells('A1:H1');
	// 	$activeSheet->setCellValue('J1', '2014 Progress To Target');
	// 	$activeSheet->mergeCells('J1:L1');

	// 	// build header row 2
	// 	$activeSheet->setCellValue('A2', '2015 Budget Targets');
	// 	$activeSheet->mergeCells('A2:B2');
	// 	$activeSheet->setCellValue('C2', "Progress Status to Targets Against Budget\n (confirmed and highly likely)");
	// 	$activeSheet->mergeCells('C2:F2');
	// 	$activeSheet->setCellValue('G2', "Pipeline (all confirmed)");
	// 	$activeSheet->mergeCells('G2:I2');
	// 	$activeSheet->setCellValue('G2', "Pipeline (all confirmed)");
	// 	$activeSheet->mergeCells('G2:I2');

	// 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
	// 	$objWriter->save("test.xlsx");


	// }
}
