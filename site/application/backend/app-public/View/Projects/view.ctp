<?php echo $this->Html->css('projects/view', array('inline' => false)); ?>
<?php echo $this->Html->script('projects/view', array('inline' => false)); ?>

<script>
var data = <?php echo json_encode($project); ?>;
</script>

<div class="projects view">
<h2>Project - <?php echo h($project['Project']['title']); ?></h2>
	<dl>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($project['Status']['name']); ?>
		</dd>
		<dt><?php echo __('Programme'); ?></dt>
		<dd>
			<?php echo h($project['Programme']['name']); ?>
		</dd>
		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php echo h($project['Project']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Owner'); ?></dt>
		<dd>
			<?php echo h($project['OwnerUser']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($project['Project']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($project['Project']['value'], 'GBP'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($project['Project']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($project['Project']['modified']); ?>
			&nbsp;
		</dd>
	</dl>

<div class="projectnotes">
	<h3>Project Comments</h3>
	
		
	

	<ul>
		<? foreach ($project['Projectnote'] as $projectnote):?>
		<li>
			<p>
				<?php echo h($projectnote['content']); ?>
				by
				<strong>
					<?php echo h($projectnote['User']['first_name']); ?>
				</strong> 
			</p>
			<?php if ($projectnote['user_id'] === AuthComponent::user('id')): ?>

			<a 
				data-projectnote-id="<?php echo $projectnote['id']; ?>"
				class="delete"
			>Delete</a>

			<?php endif; // ($projectnote['user_id'] === AuthComponent::user('id')): ?>
		</li>
		<? endforeach; // ($project['Projectnote'] as $projectnotes): ?>

	</ul>

	

	<form method="post">
		<textarea></textarea>
		<input type="submit" value="Add comment">
	</form>
</div>



<br><br><br>
	<h3>Project Activity</h3>


</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id'])); ?> </li>
		
	</ul>
</div>
