<div class="proposals form">
<?php echo $this->Form->create('Proposal'); ?>
	<fieldset>
		<legend><?php echo __('Add Proposal'); ?></legend>
	<?php
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
		echo $this->Form->input('Country', array('multiple' => 'false'));
		echo $this->Form->input('Theme', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Proposals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Programmes'), array('controller' => 'programmes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programme'), array('controller' => 'programmes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
 -->