<div class="proposals form">
<?php echo $this->Form->create('Proposal'); ?>
	<fieldset>
		<legend><?php echo __('Edit Proposal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('programme_id');
		echo $this->Form->input('title');
		echo $this->Form->input('summary');
		echo $this->Form->input('due_date');
		echo $this->Form->input('donor');
		echo $this->Form->input('value');
		echo $this->Form->input('likelihood', array('options' => array(
			'high' => "High",
			'medium' => "Medium", 
			'low' => "Low", 
			'snowball' => "Snowball's Chance",
		)));
		echo $this->Form->input('Country');
		echo $this->Form->input('Theme');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Proposal.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Proposal.id'))); ?></li>
		
	</ul>
</div>
