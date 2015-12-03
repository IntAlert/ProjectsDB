<div class="contractcategories view">
<h2><?php echo __('Contractcategory'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contractcategory['Contractcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($contractcategory['Contractcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort Order'); ?></dt>
		<dd>
			<?php echo h($contractcategory['Contractcategory']['sort_order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($contractcategory['Contractcategory']['deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contractcategory'), array('action' => 'edit', $contractcategory['Contractcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contractcategory'), array('action' => 'delete', $contractcategory['Contractcategory']['id']), array(), __('Are you sure you want to delete # %s?', $contractcategory['Contractcategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contractcategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contractcategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contracts'), array('controller' => 'contracts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contract'), array('controller' => 'contracts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contracts'); ?></h3>
	<?php if (!empty($contractcategory['Contract'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Project Id'); ?></th>
		<th><?php echo __('Donor Id'); ?></th>
		<th><?php echo __('Framework Id'); ?></th>
		<th><?php echo __('Contractcategory Id'); ?></th>
		<th><?php echo __('Donor Name'); ?></th>
		<th><?php echo __('Currency Id'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($contractcategory['Contract'] as $contract): ?>
		<tr>
			<td><?php echo $contract['id']; ?></td>
			<td><?php echo $contract['project_id']; ?></td>
			<td><?php echo $contract['donor_id']; ?></td>
			<td><?php echo $contract['framework_id']; ?></td>
			<td><?php echo $contract['contractcategory_id']; ?></td>
			<td><?php echo $contract['donor_name']; ?></td>
			<td><?php echo $contract['currency_id']; ?></td>
			<td><?php echo $contract['summary']; ?></td>
			<td><?php echo $contract['deleted']; ?></td>
			<td><?php echo $contract['created']; ?></td>
			<td><?php echo $contract['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contracts', 'action' => 'view', $contract['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contracts', 'action' => 'edit', $contract['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contracts', 'action' => 'delete', $contract['id']), array(), __('Are you sure you want to delete # %s?', $contract['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contract'), array('controller' => 'contracts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
