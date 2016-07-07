<?php echo $this->Html->script('projects/elements/projectnotes', array('inline' => false)); ?>
<div class="projectnotes block">
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
