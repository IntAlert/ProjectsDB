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
					<?php echo $office365user->userPrincipalName; ?>
				</td>
			</tr>

			<tr>
				<th>
					Role(s)
				</th>
				<td>
					<?php 
					echo $this->Form->input('User.Role', array(
						'label' => false,
						'multiple' => 'checkbox'
					));
					?>
				</td>
			</tr>
		</table>



	<?php
		echo $this->Form->input('o365_object_id', array(
			'type' => 'hidden',
			'value' => $office365user->objectId,
		));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Create New User')); ?>
</div>