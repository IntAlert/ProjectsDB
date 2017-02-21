
<?

	
	$start_date = $this->request->data('Project.start_date')
		? $this->request->data('Project.start_date') : date('Y-m-d');
	$finish_date = $this->request->data('Project.finish_date')
		? $this->request->data('Project.finish_date') : date('Y-m-d');


	$proposal_date = $this->request->data('Project.proposal_date')
		? $this->request->data('Project.proposal_date') : date('Y-m-d');

	$reporting_date = $this->request->data('Project.reporting_date')
		? $this->request->data('Project.reporting_date') : date('Y-m-d');

	$evaluation_date = $this->request->data('Project.evaluation_date')
		? $this->request->data('Project.evaluation_date') : date('Y-m-d');


		

		echo $this->Form->input('start_date', array(
			'type' => 'hidden',
			'value' => $start_date,
		));

		echo $this->Form->input('finish_date', array(
			'type' => 'hidden',
			'value' => $finish_date,
		));





		echo $this->Form->input('proposal_date', array(
			'type' => 'hidden',
			'value' => $proposal_date,
		));

		echo $this->Form->input('reporting_date', array(
			'type' => 'text',
			'value' => $reporting_date,
		));

		echo $this->Form->input('evaluation_date', array(
			'type' => 'hidden',
			'value' => $evaluation_date,
		));

?>


<h3>
	Project Timespan
</h3>

<div class="timespan clearfix">

	<div class="start">
		<h4>Project<br>Start Date</h4>
		<div class="datepicker-placeholder"></div>
	</div>

	<div class="finish">
		<h4>Project<br>Finish Date</h4>
		<div class="datepicker-placeholder"></div>
		<div class="timespan-in-months"></div>
	</div>

	<div class="extension">
		<h4>Project<br>Date Extension</h4>
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

	

</div>

<h3>
	Key Dates
</h3>

<div class="other-dates">
	
	<div class="proposal">
		
		<div class="checkbox">
			<?php 
				echo $this->Form->input('proposal_required', array(
					'type' => 'checkbox',
					'label' => 'Proposal/Bid Submission Date'
				)); 
			?>
		</div>
		<div class="details">
			<div class="title">
				<?php 
					echo $this->Form->input('proposal_title', array(
						'type' => 'text',
						'label' => 'Title'
					)); 
				?>
			</div>
			<div class="datepicker-placeholder"></div>	
		</div>
		
	</div>

	<div class="evaluation">
		
		<div class="checkbox">
			<?php 
				echo $this->Form->input('evaluation_required', array(
					'type' => 'checkbox',
					'label' => 'Evaluation Due Date'
				)); 
			?>
		</div>

		<div class="details">
			<div class="title">
				<?php 
					echo $this->Form->input('evaluation_title', array(
						'type' => 'text',
						'label' => 'Title'
					)); 
				?>
			</div>
			<div class="datepicker-placeholder"></div>
		</div>
		
	</div>

	<div class="reporting">
		
		<div class="checkbox">
			<?php 
				echo $this->Form->input('reporting_required', array(
					'type' => 'checkbox',
					'label' => 'Reporting Due Date'
				)); 
			?>
		</div>

		<div class="details">
			<div class="title">
				<?php 
					echo $this->Form->input('reporting_title', array(
						'type' => 'text',
						'label' => 'Title'
					)); 
				?>
			</div>

			<div class="datepicker-placeholder"></div>
		</div>
	</div>

</div>

