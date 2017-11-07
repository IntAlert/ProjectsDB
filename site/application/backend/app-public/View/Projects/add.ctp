
<?php echo $this->Html->script('projects/edit.main', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/edit.validation', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/edit', array('inline' => false)); ?>
<!-- The order the scripts below is important, which is why not loaded from the CTP elements -->
<?php echo $this->Html->script('projects/elements/timespan', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/elements/contract-with-budgets', array('inline' => false)); ?>


<div class="projects form">


<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Add Proposal/Project'); ?></legend>


		<div class="instruction-block">
			<p>
				In order to create a project, there is a <strong>minimum</strong> requirement of adding the following data:
			</p>
			<ul>
				<li>Title</li>
				<li>Total Project Value</li>
				<li>Submission Status</li>
				<li>Likelihood</li>
				<li>Programme(s)</li>
				<li>Strategic Pathway(s)</li>
				<li>Theme(s)</li>
			</ul>
			<p>As the proposal/project progresses, please remember to come back to PROMPT and update its details.</p>
		</div>






	<?php

		echo $this->Form->input('title', array(
			'type' => 'text',
			'between' => $this->Tooltip->inline_required(),
			'tooltip' => 'Complete full project title',
		));

?>

<!-- Status -->
<?php echo $this->element('Projects/edit/status-selector'); ?>


	
<?
	echo $this->Form->input('value_required', array(
		'label' => 'Total ALERT contract value (GBP)',
		'between' => $this->Tooltip->inline_required(),
		'tooltip' => 'This should be the total budget that Alert manages for the project. For example, in Nigeria, Alert is part of a consortium led by the British Council. British Council has a £33 million GBP contract with DFID for the whole project. Alert is a partner in British Council’s consortium and our sub-contract with British Council for the project is £795,000. In this case the Total ALERT contract value is £795,000 so that would be entered in this field. This value may include funding that Alert will later sub-contract to others or give to local partners – as long as it is still income that will be initially received by Alert.',
			'after' => '<small><a target="_blank" href="https://portal.international-alert.org/fis/mer/SitePages/Home.aspx">Alert\'s working exchange rates are published here</a></small>',
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


		
	
	<?php echo $this->element('Projects/edit/contract-with-budgets'); ?>

	<?php echo $this->element('Projects/edit/IATI'); ?>
	
	<?php echo $this->element('Projects/edit/text-metadata'); ?>

	<?php echo $this->element('Projects/edit/other-metadata'); ?>

	<?php echo $this->element('Projects/edit/urls'); ?>



<?
		echo $this->Form->input('fund_code', array(
			'tooltip' => '(this only happens when a project is approved and Alert signs a contract)',
		));

		?>

		<!-- Territories -->
		<?php // echo $this->element('Projects/edit/territory-selector'); ?>

		<!-- Departments -->
		<?php echo $this->element('Projects/edit/department-selector'); ?>

		<!-- Territories -->
		<?php echo $this->element('Projects/edit/territory-selector-2'); ?>

<?
		echo $this->Form->input('owner_user_id', array(
			'label' => "Budget Holder",
			'empty' => '--- Please select --- ',
			'options' => $budget_holders,
			'tooltip' => 'Enter name of Alert\'s budget holder',
		));
?>




<!-- PROJECT TIMESPAN -->
<?php echo $this->element('Projects/edit/timespan'); ?>

<!-- KEY DATES -->
<?php echo $this->element('Projects/edit/key-dates'); ?>


<!-- Pathways -->
<?php echo $this->element('Projects/edit/pathway-selector'); ?>


<!-- Themes -->
<?php echo $this->element('Projects/edit/theme-selector'); ?>

	

	</fieldset>


<?php echo $this->Form->end(__('Save Record')); ?>
</div>



<script>

	var project_likelihood_original = false; // because this is a new project

</script>


<?php 
// placed at end of doc as some scripts added by elements alter inputs
// at init
echo $this->element('Projects/edit/saving');
