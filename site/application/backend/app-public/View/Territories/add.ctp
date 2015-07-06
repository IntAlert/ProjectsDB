<div class="territories form">
<?php echo $this->Form->create('Territory'); ?>
	<fieldset>
		<legend><?php echo __('Add Territory'); ?></legend>
	<?php
		echo $this->Form->input('programme_id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		echo $this->Form->input('Programme', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save')); ?>
</div>