<div class="contractcategories form">
<?php echo $this->Form->create('Contractcategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Contract Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>