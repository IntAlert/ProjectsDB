
<?

		echo $this->Form->input('start_date', array(
			'type' => 'hidden',
		));
		echo $this->Form->input('finish_date', array(
			'type' => 'hidden',
		));

?>

<h3>
	Project Timespan
	<?php echo $this->Tooltip->element('Enter number of months'); ?>
</h3>

<div class="timespan clearfix">
	
	<div class="start">
		<h4>Project Start Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="finish">
		<h4>Project Finish Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>
</div>