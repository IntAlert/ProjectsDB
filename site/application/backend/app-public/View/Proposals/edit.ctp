<div class="proposals form">
<?php echo $this->Form->create('Proposal'); ?>
	<fieldset>
		<legend><?php echo __('Edit Proposal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('programme_id');
		echo $this->Form->input('owner_user_id');
		echo $this->Form->input('project_id');
		echo $this->Form->input('title');
		echo $this->Form->input('summary');
		echo $this->Form->input('due_date');
		echo $this->Form->input('donor');
		echo $this->Form->input('likliehood');
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
