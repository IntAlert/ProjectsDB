<div class="proposals index">
	<h2><?php echo __('Proposals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<!-- <th><?php echo $this->Paginator->sort('id'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('programme_id'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('owner_user_id'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('project_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('summary'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('due_date'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('donor'); ?></th> -->
			<th><?php echo $this->Paginator->sort('likelihood'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('modified'); ?></th> -->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($proposals as $proposal): ?>
	<tr>
		<!-- <td><?php echo h($proposal['Proposal']['id']); ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Html->link($proposal['Proposal']['title'], array('controller' => 'proposals', 'action' => 'view', $proposal['Proposal']['id'])); ?>
		</td>
		<!-- <td><?php echo h($proposal['Proposal']['owner_user_id']); ?>&nbsp;</td> -->
		<!-- <td>
			<?php echo $this->Html->link($proposal['Project']['title'], array('controller' => 'projects', 'action' => 'view', $proposal['Project']['id'])); ?>
		</td> -->
		<!-- <td><?php echo h($proposal['Proposal']['title']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($proposal['Proposal']['summary']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($proposal['Proposal']['due_date']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($proposal['Proposal']['donor']); ?>&nbsp;</td> -->
		<td><?php echo h($proposal['Proposal']['likelihood']); ?>&nbsp;</td>
		<td><?php echo $this->Time->nice($proposal['Proposal']['created']); ?>&nbsp;</td>
		<!-- <td><?php echo h($proposal['Proposal']['modified']); ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $proposal['Proposal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $proposal['Proposal']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $proposal['Proposal']['id']), array(), __('Are you sure you want to delete # %s?', $proposal['Proposal']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Proposal'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Programmes'), array('controller' => 'programmes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programme'), array('controller' => 'programmes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Themes'), array('controller' => 'themes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'themes', 'action' => 'add')); ?> </li>
	</ul>
</div>
