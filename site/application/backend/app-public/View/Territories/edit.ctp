<div class="territories form">
<?php echo $this->Form->create('Territory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Territory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('programme_id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		// echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Territory.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Territory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Territories'), array('action' => 'index')); ?></li>

	</ul>
</div>
