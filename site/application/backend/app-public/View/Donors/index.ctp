


<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('New Donor'), array('action' => 'add')); ?></li>
	</ul>
</nav>

<div class="donors index">
	<h2><?php echo __('Donors'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($donors as $donor): ?>
	<tr>
		<td>
			<?php echo h($donor['Donor']['name']); ?>&nbsp;
			<?php if (isset($donor['Donor']['name'])): ?>
			
			<?php endif; // (isset($donor['Donor']['name'])): ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $donor['Donor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $donor['Donor']['id']), array(), __('Are you sure you want to delete # %s?', $donor['Donor']['id'])); ?>
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