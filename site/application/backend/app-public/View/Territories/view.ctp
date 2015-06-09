<div class="territories view">
<h2><?php echo __('Territory'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Programme Id'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['programme_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort Order'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['sort_order']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Territory'), array('action' => 'edit', $territory['Territory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Territory'), array('action' => 'delete', $territory['Territory']['id']), array(), __('Are you sure you want to delete # %s?', $territory['Territory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Territories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Territory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proposals'), array('controller' => 'proposals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proposal'), array('controller' => 'proposals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Projects'); ?></h3>
	<?php if (!empty($territory['Project'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Owner User Id'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Likelihood Id'); ?></th>
		<th><?php echo __('Programme Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Fund Code'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('Finish Date'); ?></th>
		<th><?php echo __('Value Required'); ?></th>
		<th><?php echo __('Value Sourced'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($territory['Project'] as $project): ?>
		<tr>
			<td><?php echo $project['id']; ?></td>
			<td><?php echo $project['owner_user_id']; ?></td>
			<td><?php echo $project['status_id']; ?></td>
			<td><?php echo $project['likelihood_id']; ?></td>
			<td><?php echo $project['programme_id']; ?></td>
			<td><?php echo $project['title']; ?></td>
			<td><?php echo $project['fund_code']; ?></td>
			<td><?php echo $project['summary']; ?></td>
			<td><?php echo $project['start_date']; ?></td>
			<td><?php echo $project['finish_date']; ?></td>
			<td><?php echo $project['value_required']; ?></td>
			<td><?php echo $project['value_sourced']; ?></td>
			<td><?php echo $project['created']; ?></td>
			<td><?php echo $project['modified']; ?></td>
			<td><?php echo $project['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'view', $project['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'projects', 'action' => 'delete', $project['id']), array(), __('Are you sure you want to delete # %s?', $project['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Proposals'); ?></h3>
	<?php if (!empty($territory['Proposal'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Programme Id'); ?></th>
		<th><?php echo __('Owner User Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Due Date'); ?></th>
		<th><?php echo __('Donor'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Likelihood'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($territory['Proposal'] as $proposal): ?>
		<tr>
			<td><?php echo $proposal['id']; ?></td>
			<td><?php echo $proposal['programme_id']; ?></td>
			<td><?php echo $proposal['owner_user_id']; ?></td>
			<td><?php echo $proposal['project_id']; ?></td>
			<td><?php echo $proposal['title']; ?></td>
			<td><?php echo $proposal['summary']; ?></td>
			<td><?php echo $proposal['due_date']; ?></td>
			<td><?php echo $proposal['donor']; ?></td>
			<td><?php echo $proposal['value']; ?></td>
			<td><?php echo $proposal['likelihood']; ?></td>
			<td><?php echo $proposal['created']; ?></td>
			<td><?php echo $proposal['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'proposals', 'action' => 'view', $proposal['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'proposals', 'action' => 'edit', $proposal['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'proposals', 'action' => 'delete', $proposal['id']), array(), __('Are you sure you want to delete # %s?', $proposal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Proposal'), array('controller' => 'proposals', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
