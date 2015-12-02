<div class="themes view">
<h2><?php echo __('Theme'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort Order'); ?></dt>
		<dd>
			<?php echo h($theme['Theme']['sort_order']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Theme'), array('action' => 'edit', $theme['Theme']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Theme'), array('action' => 'delete', $theme['Theme']['id']), array(), __('Are you sure you want to delete # %s?', $theme['Theme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Projects'); ?></h3>
	<?php if (!empty($theme['Project'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Owner User Id'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Likelihood Id'); ?></th>
		<th><?php echo __('Department Id'); ?></th>
		<th><?php echo __('Programme Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Fund Code'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Objectives'); ?></th>
		<th><?php echo __('Goals'); ?></th>
		<th><?php echo __('Beneficiaries'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Submission Date'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('Finish Date'); ?></th>
		<th><?php echo __('Value Required'); ?></th>
		<th><?php echo __('Value Sourced'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($theme['Project'] as $project): ?>
		<tr>
			<td><?php echo $project['id']; ?></td>
			<td><?php echo $project['owner_user_id']; ?></td>
			<td><?php echo $project['status_id']; ?></td>
			<td><?php echo $project['likelihood_id']; ?></td>
			<td><?php echo $project['department_id']; ?></td>
			<td><?php echo $project['programme_id']; ?></td>
			<td><?php echo $project['title']; ?></td>
			<td><?php echo $project['fund_code']; ?></td>
			<td><?php echo $project['summary']; ?></td>
			<td><?php echo $project['objectives']; ?></td>
			<td><?php echo $project['goals']; ?></td>
			<td><?php echo $project['beneficiaries']; ?></td>
			<td><?php echo $project['location']; ?></td>
			<td><?php echo $project['submission_date']; ?></td>
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
