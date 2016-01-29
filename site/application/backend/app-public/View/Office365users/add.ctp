<div class="form">
<?php echo $this->Form->create('Office365user'); ?>
	<fieldset>
		<legend><?php echo __('Confirm New User'); ?></legend>


		<p>The following detais were supplied by Office365.</p>

		<table>
			<tr>
				<th>
					Name
				</th>
				<td>
					<?php echo $office365user->displayName; ?>
				</td>
			</tr>

			<tr>
				<th>
					Mail
				</th>
				<td>
					<?php echo $office365user->mail; ?>
				</td>
			</tr>
		</table>



	<?php
		echo $this->Form->input('o365_object_id', array(
			'type' => 'hidden',
			'value' => $office365user->objectId,
		));
		echo $this->Form->input('User.role', array('multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Create New User')); ?>
</div>