


<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('New Framework'), array('action' => 'add')); ?></li>
	</ul>
</nav>


<div class="frameworks index">
	<h2><?php echo __('Frameworks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('sort_order'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($frameworks as $framework): ?>
	<tr>
		<td><?php echo h($framework['Framework']['id']); ?>&nbsp;</td>
		<td><?php echo h($framework['Framework']['name']); ?>&nbsp;</td>
		<td><?php echo h($framework['Framework']['sort_order']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $framework['Framework']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $framework['Framework']['id']), array(), __('Are you sure you want to delete # %s?', $framework['Framework']['id'])); ?>
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