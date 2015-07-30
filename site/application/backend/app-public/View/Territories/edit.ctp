
<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Territory.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Territory.id'))); ?></li>
	</ul>
</nav>

<div class="territories form">
<?php echo $this->Form->create('Territory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Territory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Programme', array('multiple' => 'checkbox'));
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
