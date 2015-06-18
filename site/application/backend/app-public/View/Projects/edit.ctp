<?php echo $this->Html->script('projects/edit.main', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/edit.validation', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/edit', array('inline' => false)); ?>
<div class="projects form">


<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('id');

		echo $this->Form->input('title', array('type' => 'text'));

?>




<div class="input textarea">
	<label for="ProjectSummary">Summary</label>
	
	<p>Please include key information about your project, e.g. project goal, objectives, key activities, a brief summary of who the project is aimed at and where it will take place</p>

	<?php echo $this->Form->input('summary', array(
			'label' => false,
			'div' => false,
			'placeholder' => "e.g. project goal, objectives, key activities, a brief summary of who the project is aimed at and where it will take place"
		)); ?>

</div>

<div class="input textarea">
	<label for="ProjectBeneficiaries">Beneficiaries</label>
	
	<p>Help text</p>

	<?php echo $this->Form->input('beneficiaries', array(
			'label' => false,
			'div' => false,
			'placeholder' => "e.g. help text"
		)); ?>

</div>

<div class="input textarea">
	<label for="ProjectLocation">Location</label>
	
	<p>Help text</p>

	<?php echo $this->Form->input('location', array(
			'label' => false,
			'div' => false,
			'placeholder' => "e.g. help text"
		)); ?>

</div>

<div class="input textarea">
	<label for="ProjectGoals">Goals</label>
	
	<p>Help text</p>

	<?php echo $this->Form->input('goals', array(
			'label' => false,
			'div' => false,
			'placeholder' => "e.g. help text"
		)); ?>

</div>

<div class="input textarea">
	<label for="ProjectObjectives">Objectives</label>
	
	<p>Help text</p>

	<?php echo $this->Form->input('objectives', array(
			'label' => false,
			'div' => false,
			'placeholder' => "e.g. help text"
		)); ?>

</div>





<?
		echo $this->Form->input('fund_code');
		echo $this->Form->input('programme_id', array(
			'empty' => '--- Please Select ---',
		));
		echo $this->Form->input('status_id', array(
			'legend' => 'Status',
		));

?>

<?
		echo $this->Form->input('likelihood_id', array(
			'legend' => 'Likelihood',
			'type' => 'radio',
			'class' => 'likelihood-option',
			'div' => 'input radio likelihood',
		));
		
?>


<?
		echo $this->Form->input('owner_user_id', array(
			'label' => "Budget Holder",
			'options' => $employees
		));


?>




<!-- PROJECT TIMESPAN -->

<?

		echo $this->Form->input('start_date', array(
			'type' => 'hidden',
		));
		echo $this->Form->input('finish_date', array(
			'type' => 'hidden',
		));

?>

	<div class="timespan clearfix">
		<h3>Project Timespan</h3>
		<div class="start">
			<h4>Project Start</h4>
			<div class="datepicker-placeholder"></div>
		</div>

		<div class="finish">
			<h4>Project Finish</h4>
			<div class="datepicker-placeholder"></div>
		</div>
	</div>
		
<?
	echo $this->Form->input('value_required', array('label' => 'Total project value (GBP)'));
?>

		<div class="total-contracts-value">
			<label>Total Contract(s) Value</label>
			<strong>
			&pound;<span class="value_gbp"></span>
			</strong>
			<em>This value is automatically calculated</em>
		</div>

		<div class="shortfall">
			<label>Shortfall</label>
			<strong>
				&pound;<span class="value_gbp"></span>
			</strong>
			<em>This value is automatically calculated</em>
		</div>


		<!-- Territories -->
		<div class="territory-selector clearfix">

			<h2>Territories</h2>
			<?php 
				echo $this->Form->input('Territory', array(
					'label' => false,
					'multiple' => 'checkbox'
				));
			?>
		</div>

		<!-- Themes -->
		<div class="country-selector clearfix">

			<h2>Themes</h2>
			<?php 
				echo $this->Form->input('Theme', array(
					'label' => false,
					'multiple' => 'checkbox'
				));
			?>
		</div>
	
	<?php
		echo $this->element('Projects/edit/contract-with-budgets');
	?>
	</fieldset>


<?php echo $this->Form->end(__('Save Project')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?></li>
		
	</ul>
</div>
