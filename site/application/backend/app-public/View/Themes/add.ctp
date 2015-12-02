<div class="themes form">
<?php echo $this->Form->create('Theme'); ?>
	<fieldset>
		<legend><?php echo __('Add Theme'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>