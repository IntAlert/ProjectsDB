<div class="projects index">
	<h2><?php echo __('Projects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('programme_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('summary'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('owner_user_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('modified'); ?></th> -->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($projects as $project): ?>
	<tr>
		<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($project['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $project['Status']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($project['Programme']['name'], array('controller' => 'programmes', 'action' => 'view', $project['Programme']['id'])); ?>
		</td>
		<td><?php echo h($project['Project']['title']); ?>&nbsp;</td>
		<!-- <td><?php echo h($project['Project']['summary']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($project['Project']['owner_user_id']); ?>&nbsp;</td> -->
		<td><?php echo h($project['Project']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['value']); ?>&nbsp;</td>
		<td><?php echo h($project['Project']['created']); ?>&nbsp;</td>
		<!-- <td><?php echo h($project['Project']['modified']); ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']), array(), __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Project'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programmes'), array('controller' => 'programmes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programme'), array('controller' => 'programmes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projectnotes'), array('controller' => 'projectnotes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projectnote'), array('controller' => 'projectnotes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
