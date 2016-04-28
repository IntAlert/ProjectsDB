<?php

class PipelineExportController extends AppController {

	var $uses = array('Department');
	var $template = false;

    public function download() {

    	$this->loadSelectedYear();
    	$this->loadHelpers();

		// get template
		$this->createExcelTemplate();

		// GET DATA
		$this->buildData();

		// write all sheets
		$this->writeContent();
		
		// save the template
		$exportFile = $this->savePipeline();

		// respond with file
		$name = 'Fundraising Pipeline ' . $this->selectedYear . ' ' . $this->Time->format('y-m-d-h-i', new DateTime()) . '.xlsx';
		$download = true;
		$this->response->file($exportFile, compact('name', 'download'));
    }

    private function buildData() {
		
		// get departments
		$this->departmentsList = $this->Department->findOrderedList();

		$this->loadComparissonData();

		// get annual contract budgets
		$this->contractbudgetsThisYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($this->selectedYear);

		// get department budgets for this year
		$this->departmentBudgetsThisYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($this->selectedYear);

		// get department unrestricted allocation for this year
		$this->departmentUnrestrictedAllocationsThisYear = $this->Department->Departmentbudget->getDepartmentUnrestrictedAllocationsList($this->selectedYear);

		// get annual contract budgets
		$this->contractbudgetsNextYear = $this->Department->Project->Contract->Contractbudget->getContractBudgets($this->nextYear);

		// get department budgets for next year
		$this->departmentBudgetsNextYear = $this->Department->Departmentbudget->getDepartmentBudgetsList($this->nextYear);

		// get department unrestricted allocation for this year
		$this->departmentUnrestrictedAllocationsNextYear = $this->Department->Departmentbudget->getDepartmentUnrestrictedAllocationsList($this->nextYear);

		// BUILD UP DEPARTMENT-LEVEL DATA
		$departmentsDetailAnnual = [];
		foreach ($this->departmentsList as $department_id => $name) {

			$departmentDetailAnnual = array(
				'department' => $this->Department->findSimpleById($department_id),
				'projects' => $this->Department->Project->getProjectsByDepartmentAndYear($department_id, $this->selectedYear),
				'departmentBudgetThisYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $this->selectedYear),
				'departmentBudgetNextYear' => $this->Department->Departmentbudget->getDepartmentBudget($department_id, $this->nextYear),
				'departmentUnrestrictedAllocationsThisYear' => $this->Department->Departmentbudget->getDepartmentUnrestrictedAllocation($department_id, $this->selectedYear),
				'departmentUnrestrictedAllocationsNextYear' => $this->Department->Departmentbudget->getDepartmentUnrestrictedAllocation($department_id, $this->nextYear),
			);

			$departmentsDetailAnnual[$department_id] = $departmentDetailAnnual;

		}

		$this->departmentsDetailAnnual = $departmentsDetailAnnual;
	}

	private function loadComparissonData() {

		$comparissonData = array(
			'this-year' => array(
				'comparisson-date' => $this->request->data('comparisson-date-this-year'),
				'total' => array(
					'department-budget' => 0,
					'department-cfhl' => 0,
				),
			),
			'next-year' => array(
				'comparisson-date' => $this->request->data('comparisson-date-next-year'),
				'total' => array(
					'department-budget' => 0,
					'department-cfhl' => 0,
				),
			)
			
		);

		foreach ($this->departmentsList as $department_id => $name) {

			// grab comparison figures, if they exist
			$departmentBudgetThisYear = (int) $this->request->data('department-budget-this-year.' . $department_id);
			$departmentCFHLThisYear = (int) $this->request->data('department-cfhl-this-year.' . $department_id);
			$departmentBudgetNextYear = (int) $this->request->data('department-budget-next-year.' . $department_id);
			$departmentCFHLNextYear = (int) $this->request->data('department-cfhl-next-year.' . $department_id);

			// add to totals
			$comparissonData['this-year']['total']['department-budget'] += $departmentBudgetThisYear;
			$comparissonData['this-year']['total']['department-cfhl'] += $departmentCFHLThisYear;
			$comparissonData['next-year']['total']['department-budget'] += $departmentBudgetNextYear;
			$comparissonData['next-year']['total']['department-cfhl'] += $departmentCFHLNextYear;

			// calculate ratios
			if ($departmentBudgetThisYear > 0) {
				$ratioThisYear = $departmentCFHLThisYear / $departmentBudgetThisYear;
			} else {
				$ratioThisYear = '';
			}

			if ($departmentBudgetNextYear > 0) {
				$ratioNextYear = $departmentCFHLNextYear / $departmentBudgetNextYear;
			} else {
				$ratioNextYear = '';
			}

			$comparissonData['this-year']['department-budget'][$department_id] = $departmentBudgetThisYear;
			$comparissonData['this-year']['department-cfhl'][$department_id] = $departmentCFHLThisYear;
			$comparissonData['this-year']['department-ratio'][$department_id] = $ratioThisYear;

			$comparissonData['next-year']['department-budget'][$department_id] = $departmentBudgetNextYear;
			$comparissonData['next-year']['department-cfhl'][$department_id] = $departmentCFHLNextYear;
			$comparissonData['next-year']['department-ratio'][$department_id] = $ratioNextYear;
		}

		// calculate total ratio
		if ($comparissonData['this-year']['total']['department-budget'] > 0) {
			$total_ratio_this_year = $comparissonData['this-year']['total']['department-cfhl'] / $comparissonData['this-year']['total']['department-budget'];
		} else {
			$total_ratio_this_year = '';
		}

		// calculate total ratio
		if ($comparissonData['next-year']['total']['department-budget'] > 0) {
			$total_ratio_next_year = $comparissonData['next-year']['total']['department-cfhl'] / $comparissonData['next-year']['total']['department-budget'];
		} else {
			$total_ratio_next_year = '';
		}

		$comparissonData['this-year']['total']['department-ratio'] = $total_ratio_this_year;
		$comparissonData['next-year']['total']['department-ratio'] = $total_ratio_next_year;

		$this->comparissonData = $comparissonData;

	}

	private function writeContent() {

		// pipeline summary this year
		$pipelineThisYear = new MACPipeline(
			$this->selectedYear, 
			$this->departmentBudgetsThisYear, 
			$this->departmentUnrestrictedAllocationsThisYear, 
			$this->contractbudgetsThisYear
		);
		$this->createSummary($pipelineThisYear, $this->comparissonData['this-year']);

		// copy summary 2016
		$pipelineNextYear = new MACPipeline(
			$this->nextYear, 
			$this->departmentBudgetsNextYear, 
			$this->departmentUnrestrictedAllocationsNextYear, 
			$this->contractbudgetsNextYear
		);
		$this->createSummary($pipelineNextYear, $this->comparissonData['next-year']);

		// Create department detail for each department
		foreach($this->departmentsList as $department_id => $unused) {
			$this->createDepartmentDetail($department_id);	
		}

	}

	private function createSummary($pipeline, $comparissonData) {

		// expects $thisYearOrNext = 'this-year' or 'next-year'

		$sheet = $this->cloneSummarySheet($pipeline->getYear() . " Summary");

		// FIRST ROW
		// Pipeline year and snapshot time
		$now = new DateTime();
		$snapshotTime = $pipeline->getYear() . ' STATUS as at ' . $this->Time->nice($now);
		$sheet->setCellValue('A1', $snapshotTime);

		// Comparisson year
		$sheet->setCellValue('K1', $this->Time->format('Y', strtotime($comparissonData['comparisson-date'])) . " Progress to Target" );

		// SECOND ROW
		// add year
		$sheet->setCellValue('A2', $pipeline->getYear() . ' Budget Targets');

		// add comparisson date
		$sheet->setCellValue('K2', 'Comparison Figures as at ' . $this->Time->format('d/m/y', strtotime($comparissonData['comparisson-date'])) . ' for current year projections');

		// ALL DEPARTMENTS
		$grandTotal = array(
			'Total',
			$pipeline->getBudget('all'), // budget this year
			$pipeline->getUnrestrictedAllocation('all'), // budget this year

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
			$comparissonData['total']['department-budget'],
			$comparissonData['total']['department-cfhl'],
			$comparissonData['total']['department-ratio'],
			
		);

		// add the row of data
		$sheet->fromArray($grandTotal, NULL, 'A4');

	    // DEPARTMENT-BY-DEPARTMENT
	    $rowNumber = 5;
	    foreach ($this->departmentsList as $department_id => $department_name):

	    	$departmentTotal = array(
				$department_name,
				$pipeline->getBudget($department_id), // budget this year
				$pipeline->getUnrestrictedAllocation($department_id), // unrestricted allocation this year

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
				$comparissonData['department-budget'][$department_id],
				$comparissonData['department-cfhl'][$department_id],
				$comparissonData['department-ratio'][$department_id],
			
				
			);


			
			// add the row of data
		    $sheet->fromArray($departmentTotal, NULL, 'A' . $rowNumber);

		    ++$rowNumber;

	    endforeach; // ($departmentsList as $department_id => $department_name):


		return $sheet;
	}

	private function createDepartmentDetail($department_id) {


		extract($this->departmentsDetailAnnual[$department_id]);

		// instantiate pipeline
		$pipeline = new MACPipelineByDepartment(
			$this->selectedYear, 
			$projects, 
			$departmentBudgetThisYear, 
			$departmentBudgetNextYear
		);

		$unconfirmedProjects = $pipeline->getFlattenedProjects(array('highly-likely', 'medium', 'low'));
		$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));

		// get sheet
		$sheet = $this->cloneDepartmentSheet($department['Department']['name']);

		// add title
		$sheet->setCellValue('A1', $department['Department']['name'] );

		// add this year budget
		$sheet->setCellValue('F1', $this->selectedYear);
		$sheet->setCellValue('G1', $departmentBudgetThisYear );

		// add this year unrestricted allocation
		$sheet->setCellValue('J1', $departmentUnrestrictedAllocationsThisYear );

		// add next year budget
		$sheet->setCellValue('F2', $this->nextYear);
		$sheet->setCellValue('G2', $departmentBudgetNextYear );

		// add next year unrestricted allocation
		$sheet->setCellValue('J2', $departmentUnrestrictedAllocationsNextYear );

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
				$this->Time->format('d/m/Y', $project['submission_date']),
				$project['duration_months'],
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

	// get selected year from query parameter
	private function loadSelectedYear() {

		$this->selectedYear = $this->request->query('selectedYear');
		if (is_null($this->selectedYear)) $this->selectedYear = date('Y');
		$this->nextYear = $this->selectedYear + 1;

	}

	private function loadHelpers() {
		App::uses('View', 'View');
		App::import('Helper', 'Time');
		$this->Time = new TimeHelper(new View());
		
	}
}

