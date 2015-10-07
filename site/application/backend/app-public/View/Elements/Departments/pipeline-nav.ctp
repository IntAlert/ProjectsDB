<?

	$this->Html->script('departments/pipeline-nav', array('inline' => false));

	// build year options
	$years = array();
	for ($year=$firstYear; $year <= $thisYear; $year++) {
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
					'controller' => 'departments', 
					'action' => 'pipelineSummary'
				), array('class' => 'summary')); ?>
			</li>

	<?php foreach ($departmentsList as $department_id => $department_name): ?>
			<li class="department-<?php echo $department_id; ?>">
				<?php echo $this->Html->link($department_name, array(
					'controller' => 'departments', 
					'action' => 'pipeline', 
					$department_id,
					'?' => array('selectedYear' => $selectedYear)
					
				)); ?>
			</li>
	<?php endforeach; // ($departments as $department): ?>



		</ul>



	</nav>