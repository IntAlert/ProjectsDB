<div class="proposals view">
<h2><?php echo __('Proposal'); ?></h2>
	<dl>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($proposal['Proposal']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Programme'); ?></dt>
		<dd>
			<?php echo h($proposal['Programme']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Owner'); ?></dt>
		<dd>
			<?php echo h($proposal['Owner']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php 

			if ($proposal['Project']['title']) {
				echo $this->Html->link($proposal['Project']['title'], array('controller' => 'projects', 'action' => 'view', $proposal['Project']['id'])); 
			} else {
				echo ' (no project associated with this proposal ) ';
			}
			


			?>
			&nbsp;
		</dd>

		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php echo h($proposal['Proposal']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Due Date'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($proposal['Proposal']['due_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Donor'); ?></dt>
		<dd>
			<?php echo h($proposal['Proposal']['donor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Likelihood'); ?></dt>
		<dd>
			<?php echo h($proposal['Proposal']['likelihood']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Countries'); ?></dt>
		<dd>
			<?php 

			$countries = [];
			foreach ($proposal['Country'] as $country) {
				array_push($countries, $country['name']);
			}
			echo implode(', ', $countries);

			?>
			&nbsp;
		</dd>

		<dt><?php echo __('Themes'); ?></dt>
		<dd>
			<?php 

			$themes = [];
			foreach ($proposal['Theme'] as $theme) {
				array_push($themes, $theme['name']);
			}
			echo implode(', ', $themes);

			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($proposal['Proposal']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($proposal['Proposal']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Proposal'), array('action' => 'edit', $proposal['Proposal']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Proposal'), array('action' => 'delete', $proposal['Proposal']['id']), array(), __('Are you sure you want to delete # %s?', $proposal['Proposal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Proposals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proposal'), array('action' => 'add')); ?> </li>
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


<!-- 
<div class="related">
	<h3><?php echo __('Related Countries'); ?></h3>
	<?php if (!empty($proposal['Country'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($proposal['Country'] as $country): ?>
		<tr>
			<td><?php echo $country['id']; ?></td>
			<td><?php echo $country['code']; ?></td>
			<td><?php echo $country['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'countries', 'action' => 'view', $country['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'countries', 'action' => 'edit', $country['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'countries', 'action' => 'delete', $country['id']), array(), __('Are you sure you want to delete # %s?', $country['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Themes'); ?></h3>
	<?php if (!empty($proposal['Theme'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sort Order'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($proposal['Theme'] as $theme): ?>
		<tr>
			<td><?php echo $theme['id']; ?></td>
			<td><?php echo $theme['name']; ?></td>
			<td><?php echo $theme['sort_order']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'themes', 'action' => 'view', $theme['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'themes', 'action' => 'edit', $theme['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'themes', 'action' => 'delete', $theme['id']), array(), __('Are you sure you want to delete # %s?', $theme['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Theme'), array('controller' => 'themes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div> -->
