
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
</h3>

<div class="timespan clearfix">
	
	<div class="submission">
		<h4>Proposal/Bid<br>Submission Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="start">
		<h4>Project<br>Start Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="finish">
		<h4>Project<br>Finish Date</h4>
		<div class="datepicker-placeholder"></div>
		<div class="timespan-in-months"></div>
	</div>

	<?php
		echo $this->Form->input('extension_reason', array(
			'label' => 'If the project finish date has been extended, please give reasons for this:'
		));
	?>

</div>

