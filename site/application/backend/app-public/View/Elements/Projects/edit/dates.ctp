
<?

	$submission_date = $this->request->data('Project.submission_date')
		? $this->request->data('Project.submission_date') : date('Y-m-d');
	$start_date = $this->request->data('Project.start_date')
		? $this->request->data('Project.start_date') : date('Y-m-d');
	$finish_date = $this->request->data('Project.finish_date')
		? $this->request->data('Project.finish_date') : date('Y-m-d');


		echo $this->Form->input('submission_date', array(
			'type' => 'hidden',
			'value' => $submission_date,
		));

		echo $this->Form->input('start_date', array(
			'type' => 'hidden',
			'value' => $start_date,
		));

		echo $this->Form->input('finish_date', array(
			'type' => 'hidden',
			'value' => $finish_date,
		));

?>


<h3>
	Project Timespan
	<?php echo $this->Tooltip->element('Enter number of months'); ?>
</h3>

<div class="timespan clearfix">
	
	<div class="submission">
		<h4>Submission Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="start">
		<h4>Project Start Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="finish">
		<h4>Project Finish Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>
</div>