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
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($donor['Donor']['created']); ?>
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
<div class="related">
	<h3><?php echo __('Related Contracts'); ?></h3>
	<?php if (!empty($donor['Contract'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Donor Id'); ?></th>
		<th><?php echo __('Currency Id'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($donor['Contract'] as $contract): ?>
		<tr>
			<td><?php echo $contract['id']; ?></td>
			<td><?php echo $contract['project_id']; ?></td>
			<td><?php echo $contract['donor_id']; ?></td>
			<td><?php echo $contract['currency_id']; ?></td>
			<td><?php echo $contract['summary']; ?></td>
			<td><?php echo $contract['deleted']; ?></td>
			<td><?php echo $contract['created']; ?></td>
			<td><?php echo $contract['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contracts', 'action' => 'view', $contract['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
