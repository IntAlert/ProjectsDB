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




<?

		echo $this->Form->input('programme_id');
		echo $this->Form->input('status_id', array(
			'legend' => 'Status',
		));

?>

<?
		echo $this->Form->input('likelihood_id', array(
			'legend' => 'Likelihood',
			'type' => 'radio',
		));
		
?>


<?
		echo $this->Form->input('owner_user_id', array(
			'label' => "Budget Holder",
			'options' => $employees
		));
		echo $this->Form->input('start_date');
		echo $this->Form->input('finish_date');
		
		echo $this->Form->input('value_required', array('label' => 'Total value (GBP)'));
		?>

		<div class="country-selector clearfix">

			<h2>Countries</h2>
			<?php 
				echo $this->Form->input('Country', array(
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
