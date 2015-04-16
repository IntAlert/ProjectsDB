<div class="projects form">
<?php echo $this->Form->create('Project'); ?>
	<fieldset>
		<legend><?php echo __('Convert Proposal'); ?></legend>

		<div class="input">
			<label>Current Status</label>

			<p><strong><?php echo $current_status['name']; ?></strong></p>
		</div>

	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('status_id', array(
			'type' => 'radio',
			'legend' => 'New Status'
		));
		echo $this->Form->input('title', array('label' => 'Modify Title'));
		echo $this->Form->input('summary', array('label' => 'Modify Summary'));
		echo $this->Form->input('owner_user_id', array(

			'label' => 'Change Owner',
			'options' => array($users),

		));
		echo $this->Form->input('start_date');
		echo $this->Form->input('value', array('label' => 'Modify Project Value (USD)'));

		echo $this->Form->input('Country', array(
			'multiple' => 'checkbox',
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Convert Proposal')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Cancel Conversion'), array(

			'controller' => 'proposals',
			'action' => 'index', 
			$this->Form->value('Proposal.id')), array(), __('Are you sure you want to cancel converting %s', $this->Form->value('Project.title'))); ?></li>
		
	</ul>
</div>
