<?

	$this->Html->script('programmes/pipeline-nav', array('inline' => false));

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

			<li class="programme-summary">
				<?php echo $this->Html->link('Summary', array(
					'controller' => 'programmes', 
					'action' => 'pipelineSummary'
				), array('class' => 'summary')); ?>
			</li>

	<?php foreach ($programmesList as $programme_id => $programme_name): ?>
			<li class="programme-<?php echo $programme_id; ?>">
				<?php echo $this->Html->link($programme_name, array(
					'controller' => 'programmes', 
					'action' => 'pipeline', 
					$programme_id,
					'?' => array('selectedYear' => $selectedYear)
					
				)); ?>
			</li>
	<?php endforeach; // ($programmes as $programme): ?>



		</ul>



	</nav>