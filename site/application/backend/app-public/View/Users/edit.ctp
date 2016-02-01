<div class="users form">
<?php echo $this->Form->create('User'); ?>






	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>


		<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($this->request->data['User']['first_name']); ?>
			&nbsp;
			<?php echo h($this->request->data['User']['last_name']); ?>
		</dd>
		<dt><?php echo __('Special Role(s)'); ?></dt>
		<dd>
			
			<?php echo $this->Form->input('Role', array(
				'label' => false,
				'multiple' => 'checkbox',
			)); ?>

			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($this->request->data['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($this->request->data['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>


	<?php
		echo $this->Form->input('id');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update User')); ?>
</div>