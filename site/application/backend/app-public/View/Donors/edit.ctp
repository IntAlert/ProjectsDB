<div class="donors form">
<?php echo $this->Form->create('Donor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Donor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('type' => 'text'));
		echo $this->Form->input('short_name', array('type' => 'text'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
