<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role', array(
			'type' => 'select',
			'options' => array('admin' => 'Admin', 'manager' => 'Manager', 'employee' => 'Employee')
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>