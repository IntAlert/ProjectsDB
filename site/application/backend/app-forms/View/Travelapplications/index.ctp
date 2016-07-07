<div class="travelapplications index">
	<h2><?php echo __('Travelapplications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('role_text'); ?></th>
			<th><?php echo $this->Paginator->sort('summary'); ?></th>
			<th><?php echo $this->Paginator->sort('convenant_agreed'); ?></th>
			<th><?php echo $this->Paginator->sort('policy_understood'); ?></th>
			<th><?php echo $this->Paginator->sort('evacuation_understood'); ?></th>
			<th><?php echo $this->Paginator->sort('conduct_understood'); ?></th>
			<th><?php echo $this->Paginator->sort('countrymanager_notified'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($travelapplications as $travelapplication): ?>
	<tr>
		<td><?php echo h($travelapplication['Travelapplication']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($travelapplication['User']['id'], array('controller' => 'users', 'action' => 'view', $travelapplication['User']['id'])); ?>
		</td>
		<td><?php echo h($travelapplication['Travelapplication']['role_text']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['summary']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['convenant_agreed']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['policy_understood']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['evacuation_understood']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['conduct_understood']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['countrymanager_notified']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['created']); ?>&nbsp;</td>
		<td><?php echo h($travelapplication['Travelapplication']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $travelapplication['Travelapplication']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $travelapplication['Travelapplication']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $travelapplication['Travelapplication']['id']), array(), __('Are you sure you want to delete # %s?', $travelapplication['Travelapplication']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Travelapplication'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Travelrisksbyusers'), array('controller' => 'travelrisksbyusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Travelrisksbyuser'), array('controller' => 'travelrisksbyusers', 'action' => 'add')); ?> </li>
	</ul>
</div>
