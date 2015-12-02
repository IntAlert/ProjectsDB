


<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('New Theme'), array('action' => 'add')); ?></li>
	</ul>
</nav>


<div class="themes index">
	<h2><?php echo __('Themes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($themes as $theme): ?>
	<tr>
		<td><?php echo h($theme['Theme']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $theme['Theme']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $theme['Theme']['id']), array(), __('Are you sure you want to delete # %s?', $theme['Theme']['id'])); ?>
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