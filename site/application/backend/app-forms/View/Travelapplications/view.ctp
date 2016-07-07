<div class="travelapplications view">
<h2><?php echo __('Travelapplication'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($travelapplication['User']['id'], array('controller' => 'users', 'action' => 'view', $travelapplication['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Text'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['role_text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Convenant Agreed'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['convenant_agreed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Policy Understood'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['policy_understood']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evacuation Understood'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['evacuation_understood']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conduct Understood'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['conduct_understood']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Countrymanager Notified'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['countrymanager_notified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($travelapplication['Travelapplication']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Travelapplication'), array('action' => 'edit', $travelapplication['Travelapplication']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Travelapplication'), array('action' => 'delete', $travelapplication['Travelapplication']['id']), array(), __('Are you sure you want to delete # %s?', $travelapplication['Travelapplication']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Travelapplications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Travelapplication'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('controller' => 'itineraries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Travelrisksbyusers'), array('controller' => 'travelrisksbyusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Travelrisksbyuser'), array('controller' => 'travelrisksbyusers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Itineraries'); ?></h3>
	<?php if (!empty($travelapplication['Itinerary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Travelapplication Id'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th><?php echo __('Security Level'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($travelapplication['Itinerary'] as $itinerary): ?>
		<tr>
			<td><?php echo $itinerary['id']; ?></td>
			<td><?php echo $itinerary['user_id']; ?></td>
			<td><?php echo $itinerary['travelapplication_id']; ?></td>
			<td><?php echo $itinerary['start_date']; ?></td>
			<td><?php echo $itinerary['end_date']; ?></td>
			<td><?php echo $itinerary['security_level']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'itineraries', 'action' => 'view', $itinerary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'itineraries', 'action' => 'edit', $itinerary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'itineraries', 'action' => 'delete', $itinerary['id']), array(), __('Are you sure you want to delete # %s?', $itinerary['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Itinerary'), array('controller' => 'itineraries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Travelrisksbyusers'); ?></h3>
	<?php if (!empty($travelapplication['Travelrisksbyuser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Travelapplication Id'); ?></th>
		<th><?php echo __('Travelrisk Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($travelapplication['Travelrisksbyuser'] as $travelrisksbyuser): ?>
		<tr>
			<td><?php echo $travelrisksbyuser['id']; ?></td>
			<td><?php echo $travelrisksbyuser['user_id']; ?></td>
			<td><?php echo $travelrisksbyuser['travelapplication_id']; ?></td>
			<td><?php echo $travelrisksbyuser['travelrisk_id']; ?></td>
			<td><?php echo $travelrisksbyuser['comment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'travelrisksbyusers', 'action' => 'view', $travelrisksbyuser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'travelrisksbyusers', 'action' => 'edit', $travelrisksbyuser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'travelrisksbyusers', 'action' => 'delete', $travelrisksbyuser['id']), array(), __('Are you sure you want to delete # %s?', $travelrisksbyuser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Travelrisksbyuser'), array('controller' => 'travelrisksbyusers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
