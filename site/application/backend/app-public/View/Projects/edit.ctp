<?php echo $this->Html->css('projects/edit', array('inline' => false)); ?>
<div class="projects form">


<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Edit Project'); ?></legend>
	<?php
		echo $this->Form->input('id');

		echo $this->Form->input('title', array('type' => 'text'));
		echo $this->Form->input('summary');
		

		echo $this->Form->input('programme_id');
		echo $this->Form->input('status_id', array(
			'legend' => 'Status',
			'type' => 'radio',
		));
		
		
		echo $this->Form->input('owner_user_id', array(
			'label' => "Project Owner",
			'options' => $employees
		));
		echo $this->Form->input('start_date');
		echo $this->Form->input('finish_date');
		
		echo $this->Form->input('value', array('label' => 'Value (GBP)'));
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
		echo $this->element('projects/contract');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Project.id'))); ?></li>
		
	</ul>
</div>
