<div class="donors view">
<h2><?php echo __('Donor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($donor['Donor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($donor['Donor']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Donor'), array('action' => 'edit', $donor['Donor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Donor'), array('action' => 'delete', $donor['Donor']['id']), array(), __('Are you sure you want to delete # %s?', $donor['Donor']['id'])); ?> </li>
	</ul>
</div>
