

<nav class="subnav clearfix">
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
	</ul>
</nav>

<div class="users view">
<h2><?php echo __('User'); ?></h2>




	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
			<?php echo h($user['User']['last_name']); ?>
		</dd>
		<dt><?php echo __('Special Role(s)'); ?></dt>
		<dd>
			<?php if (count($user['Role'])): ?>
			<ul>
			
				<?php foreach ( $user['Role'] as $role): ?>
				
				<li>
					<?php echo $role['name']; ?>
				</li>

				<?php endforeach; // ( $user['Role'] as $role): ?>

			</ul>

			<?php else: // (count($user['User']['Role'])): ?>

				<p>No special roles</p>

			<?php endif; // (count($user['User']['Role'])): ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>