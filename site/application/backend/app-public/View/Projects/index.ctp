<div class="projects index">
	<h2><?php echo __('Projects'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<!-- <th><?php echo $this->Paginator->sort('id'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('programme_id'); ?></th> -->
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('summary'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('owner_user_id'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('start_date'); ?></th> -->
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('modified'); ?></th> -->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($projects as $project): ?>
	<tr>
		<!-- <td><?php echo h($project['Project']['id']); ?>&nbsp;</td> -->
		<td><?php echo h($project['Project']['title']); ?>&nbsp;</td>
		<td><?php echo $this->Number->currency($project['Project']['value_required'], 'GBP'); ?>&nbsp;</td>
		<!-- <td>
			<?php echo $this->Html->link($project['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $project['Status']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($project['Programme']['name'], array('controller' => 'programmes', 'action' => 'view', $project['Programme']['id'])); ?>
		</td> -->
		
		<!-- <td><?php echo h($project['Project']['summary']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($project['Project']['owner_user_id']); ?>&nbsp;</td> -->
		<td>
			<?php echo $this->Time->format(
			  'F jS, Y',
			  $project['Project']['start_date']
			); ?>
		
		<!-- <td><?php echo h($project['Project']['created']); ?>&nbsp;</td> -->
		<!-- <td><?php echo h($project['Project']['modified']); ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id'])); ?>
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

	<?php echo $this->element('Projects/search'); ?>


</div>
