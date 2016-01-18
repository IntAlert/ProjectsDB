<?php
	$web_links = (array) json_decode($this->Form->value('Project.web_links_json'));
	// var_dump($web_links);
?>



<?php echo $this->Html->script('projects/elements/urls', array('inline' => false)); ?>
<div class="project-urls block">
	<h3>Project Web links</h3>
	
	<ul>
		<?php foreach ($web_links as $web_link): ?>
		
		<li>
			<i class="fa fa-arrows move"></i>

			<a href="<?php echo $web_link->url; ?>">
				<?php echo $web_link->title; ?>
			</a>
			<input class="url" type="hidden" value="<?php echo $web_link->url ?>">
			<input class="title" type="hidden" value="<?php echo $web_link->title ?>">
			
			<i class="fa fa-trash delete"></i>
		</li>

		<?php endforeach; // ($web_links as $web_link): ?>

		<li class="template">

			<i class="fa fa-arrows move"></i>

			<a href="#template">Template</a>
			
				<input class="url" type="hidden" value="">
				<input class="title" type="hidden" value="">

			<i class="fa fa-trash delete"></i>
		</li>

		<?php echo $this->Form->input('Project.web_links_json', array('type' => 'hidden')); ?>

	</ul>


	<div id="url_add_form">
		<h4>Add a website link</h4>

		<label>
			URL: 
			<input class="url" value="" placeholder="Enter a website address">
		</label>

		<label>
			Title: 
			<input class="title" placeholder="Enter a title for the link">
		</label>

		<input type="button" value="Add Weblink">
	</div>
</div>
