<?php echo $this->Html->script('projects/edit.main', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/edit.validation', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/edit', array('inline' => false)); ?>




<div class="projects form">


<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Project'); ?></legend>
	<?php

		echo $this->Form->input('title', array(
			'type' => 'text',
			'tooltip' => 'Complete full project title',
		));

?>



	<?php echo $this->Form->input('summary', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => '200 word summary of what your project hopes to achieve and how this will be delivered',
		)); ?>

	<?php echo $this->Form->input('beneficiaries', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Include total number of beneficiaries to be reached in the project and an estimate of gender disaggregation',
		)); ?>


	<?php echo $this->Form->input('location', array(
			'label' => 'Location(s)',
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Include regional and/or country name(s) plus any further geographic info such as province or district names',
		)); ?>



	<?php echo $this->Form->input('goals', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Include project goal from logframe (or equivalent)',
		)); ?>

	<?php echo $this->Form->input('objectives', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Include project objectives from logframe (or equivalent)',
		)); ?>



<?
		echo $this->Form->input('fund_code', array(
			'tooltip' => 'Complete the project fund code as issued by Finance team',
		));

		?>

		<!-- Territories -->
		<?php echo $this->element('Projects/edit/territory-selector'); ?>


		<?php echo $this->element('Projects/edit/status-selector'); ?>


<?
		echo $this->Form->input('owner_user_id', array(
			'label' => "Budget Holder",
			'empty' => '--- Please select --- ',
			'options' => $employees,
			'tooltip' => 'Enter name of Alert\'s budget holder',
		));


?>




<!-- PROJECT TIMESPAN -->

<?php echo $this->element('Projects/edit/dates'); ?>


<!-- Themes -->
<?php echo $this->element('Projects/edit/theme-selector'); ?>

		
<?
	echo $this->Form->input('value_required', array(
		'label' => 'Total project value (GBP)',
		'tooltip' => 'Tooltip text',
	));
?>

		<div class="total-contracts-value">
			<label>Total Contract(s) Value</label>
			<strong>
			&pound;<span class="value_gbp"></span>
			</strong>
			<em>This field is automatically calculated based on the sum of all donor contracts</em>
		</div>

		<div class="shortfall">
			<label>Shortfall</label>
			<strong>
				&pound;<span class="value_gbp"></span>
			</strong>
			<em>This value is automatically calculated</em>
		</div>


		
	
		<?php
			echo $this->element('Projects/edit/contract-with-budgets');
		?>

	</fieldset>


<?php echo $this->Form->end(__('Save Project')); ?>
</div>



<script>

	var project_likelihood_original = false; // because this is a new project


</script>
