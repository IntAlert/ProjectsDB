<div class="donors form">
<?php echo $this->Form->create('Donor'); ?>
	<fieldset>
		<legend><?php echo __('Add Donor'); ?></legend>
	<?php
		echo $this->Form->input('name', array('type' => 'text'));
		echo $this->Form->input('short_name', array('type' => 'text'));
		echo $this->Form->input('warning_text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
