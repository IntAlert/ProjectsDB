
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
		echo $this->Form->input('finish_extended', array(
			'legend' => 'Has the project finish date been extended?',
			'type' => 'radio',
			'options' => array(
				0 => 'No',
				1 => 'Yes',
			),
			'default' => 0,

		));
	?>

	<?php
		echo $this->Form->input('extension_reason', array(
			'div' => 'project-extension-block',
			'label' => 'Please give the reasons for the project date extension:'
		));
	?>

</div>

