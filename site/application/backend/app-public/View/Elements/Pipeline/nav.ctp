<?

	$this->Html->script('pipeline/nav', array('inline' => false));
	$this->Html->css('pipeline/nav', array('inline' => false));

	// build year options: first year to next year
	$nextYear = $thisYear + 1;
	$years = array();
	for ($year=$firstYear; $year <= $nextYear; $year++) {
		$years[$year] = $year;
	}
?>


	<nav class="pipeline-nav">
		<ul>
			

			<li class="year">
				<?php echo $this->Form->input('selectedYear', array(
					'label' => false,
					'type' => 'select',
					'options' => $years,
					'value' => $selectedYear,
				)); ?>
			</li>

			

			<li class="department-summary">
				<?php echo $this->Html->link('Summary', array(
					'controller' => 'pipeline', 
					'action' => 'summary'
				), array('class' => 'summary')); ?>
			</li>

	<?php foreach ($departmentsList as $department_id => $department_name): ?>
			<li class="department-<?php echo $department_id; ?>">
				<?php echo $this->Html->link($department_name, array(
					'controller' => 'pipeline', 
					'action' => 'department', 
					$department_id,
					'?' => array('selectedYear' => $selectedYear)
					
				)); ?>
			</li>
	<?php endforeach; // ($departments as $department): ?>

			<li>
				<?php echo $this->Html->link('Edit ' . $selectedYear . ' budgets', array(
					'controller' => 'departmentbudgets', 
					'action' => 'edit',
					$selectedYear
				), array('class' => 'departmentbudget')); ?>

			</li>

			<li>
				<?php echo $this->Html->link('Edit ' . ($selectedYear + 1) . ' budgets', array(
					'controller' => 'departmentbudgets', 
					'action' => 'edit',
					($selectedYear + 1)
				), array('class' => 'departmentbudget')); ?>

			</li>			

			<li>
				
				<?php echo $this->Html->link('Export MAC template', array(
					'controller' => 'pipeline', 
					'action' => 'preview',
					'?' => array('selectedYear' => $selectedYear)
				), array('class' => 'export')); ?>
			</li>

		</ul>



	</nav>