<div class="frameworks form">
<?php echo $this->Form->create('Framework'); ?>
	<fieldset>
		<legend><?php echo __('Edit Framework'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>