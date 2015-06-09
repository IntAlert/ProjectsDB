<?

	// build year options
	$years = array();
	for ($year=$firstYear; $year <= $thisYear; $year++) {
		$years[$year] = $year;
	}
?>


	<nav class="pipelines">
	<ul>

		
		<li>
			<?php echo $this->Html->link('Summary', array('controller' => 'programmes', 'action' => 'pipelineSummary')); ?>
		</li>

<?php foreach ($programmesList as $programme_id => $programme_name): ?>
		<li>
			<?php echo $this->Html->link($programme_name, array(
				'controller' => 'programmes', 
				'action' => 'pipeline', 
				$programme_id,
				'?' => array('selectedYear' => $selectedYear)
			)); ?>
		</li>
<?php endforeach; // ($programmes as $programme): ?>

		<li class="year">
			<?php echo $this->Form->input('selectedYear', array(
				'label' => false,
				'type' => 'select',
				'options' => $years,
				'value' => $selectedYear,
			)); ?>
		</li>

	</ul>



</nav>