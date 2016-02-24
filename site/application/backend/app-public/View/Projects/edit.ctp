<?php $this->set('title', 'Projects - Edit - ' . $this->request->data('Project.title')); ?>
<?php echo $this->Html->script('projects/edit.main', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/edit.validation', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/edit', array('inline' => false)); ?>




<div class="projects form">


<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?></li>
	</ul>
</nav>




<?php echo $this->Form->create('Project'); ?>


	<fieldset>
		<legend><?php echo __('Edit Proposal/Project'); ?></legend>
	<?php echo $this->Form->input('id'); ?>


	<?php echo $this->Form->input('title', array(
		'type' => 'text',
		'between' => $this->Tooltip->inline_required(),
		'tooltip' => 'Complete full project title',
	));

?>



		
<?
	echo $this->Form->input('value_required', array(
		'label' => 'Total ALERT contract value (GBP)',
		'between' => $this->Tooltip->inline_required(),
		'tooltip' => 'This should be the total budget that Alert manages for the project. For example, in Nigeria, Alert is part of a consortium led by the British Council. British Council has a £33 million GBP contract with DFID for the whole project. Alert is a partner in British Council’s consortium and our sub-contract with British Council for the project is £795,000. In this case the Total ALERT contract value is £795,000 so that would be entered in this field. This value may include funding that Alert will later sub-contract to others or give to local partners – as long as it is still income that will be initially received by Alert.',
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



	<?php echo $this->Form->input('summary', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Up to 300 word summary of what your project hopes to achieve and how this will be delivered',
		)); ?>

	<?php echo $this->Form->input('beneficiaries', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Include all relevant information such as of type of beneficiary, total number of beneficiaries to be reached in the project and an estimate of gender disaggregation',
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


	<?php echo $this->Form->input('partners', array(
			// 'placeholder' => "e.g. help text",
			'tooltip' => 'Add details of names of partners including value of sub-grant',
		)); ?>


	<?php echo $this->element('Projects/edit/urls'); ?>




<?
		echo $this->Form->input('fund_code', array(
			'tooltip' => '(this only happens when a project is approved and Alert signs a contract)',
		));

		?>

		<!-- Territories -->
		<?php echo $this->element('Projects/edit/territory-selector'); ?>


		<?php echo $this->element('Projects/edit/status-selector'); ?>


<?
		echo $this->Form->input('owner_user_id', array(
			'label' => "Budget Holder",
			'empty' => '--- Please select --- ',
			'options' => $budget_holders,
			'tooltip' => 'Enter name of Alert\'s budget holder',
		));


?>




<!-- PROJECT TIMESPAN -->

<?php echo $this->element('Projects/edit/dates'); ?>



<!-- Pathway -->
<?php echo $this->element('Projects/edit/pathway-selector'); ?>

<!-- Themes -->
<?php echo $this->element('Projects/edit/theme-selector'); ?>



	</fieldset>


<?php echo $this->Form->end(__('Save Project')); ?>
</div>


<script>

	var project_likelihood_original = <?php echo json_encode($this->request->data('Likelihood.id')); ?>;


</script>


<?php 
// placed at end of doc as some scripts added by elements alter inputs
// at init
echo $this->element('Projects/edit/saving');
