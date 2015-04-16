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
			<?php echo h($project['Project']['value']); ?>
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
		<li>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			</p>
		</li>
	</ul>

	<form method="post">
		<textarea></textarea>
		<input type="submit" value="Add comment">
	</form>
	<script type="text/javascript">
	$('.projectnotes form').submit(function(){
		var comment = $('.projectnotes textarea').val();

		if(comment) {
			var li = $('<li>');
			li.html('<p>' + comment + '</p>');
			$('.projectnotes ul').append(li);
			$('.projectnotes textarea').val('');	
		}
		
		return false;
	})
	</script>
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
