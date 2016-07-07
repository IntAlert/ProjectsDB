<?php

$web_links = (array)json_decode($project['Project']['web_links_json']);


if ($web_links): ?>



<div class="summary block">
	<h3>Web Links</h3>

	<ul>
		<?php foreach ($web_links as $web_link): ?>
		

			<li>

				<a href="<?php echo $web_link->url; ?>">
					<?php echo $web_link->title; ?>
				</a>


			</li>


		<?php endforeach; // ($web_links as $web_link): ?>

	</ul>


</div>

<?php endif; // ($web_links): ?>