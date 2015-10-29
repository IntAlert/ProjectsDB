



<div id="dashboard-actions">

	<h2>
		Hello, <?php echo AuthComponent::user('first_name'); ?>
	</h2>

	<p>
		Welcome to PROMPT. This application is used to manage and search <br>
		International Alert's <strong>project metadata and documents</strong>.
	</p>

	<p>
		If you encounter any bugs or have any suggestions for improvement, <br>
		<a href="https://intalert.typeform.com/to/SUUUaZ" target="_blank">please report them here</a>.
	</p>

	<!-- <ul class="links">
		<li>
			<a class="btn" href="/pdb/projects" class="add"> Add Project </a>
		</li>
	</ul> -->


	<div class="search-form">

		<h2>Search Project Metadata</h2>
		
		<form action="/pdb/projects" method="get">

			<input type="hidden" name="action" value="search">
			<input type="text" name="q">
			<input type="submit" value="Search Project Metadata">

		</form>

	</div>


	<div class="search-form">

		<h2>Search Project Documents</h2>
		
		<form action="/pdb/projects/searchDocs" method="get">

			<input type="hidden" name="action" value="search">
			<input type="text" name="q">
			<input type="submit" value="Search Project Metadata">

		</form>

	</div>

</div>

<div id="dashboard-digest">





	<section class="recent clearfix">
		<h3>Your recently visited projects</h3>


	<?php if (count($projectsRecentlyViewed)): ?>
		<ul class="document-list">


	<?php foreach ($projectsRecentlyViewed as $project): ?>
			<li>
				<a href="/pdb/projects/view/<?php echo $project['Project']['id']?>">
					<?php echo $project['Project']['title']?>
				</a>
			</li>
	<?php endforeach; // ($projectsRecentlyViewed as $project): ?>

		</ul>

	<?php else: // (count($projectsRecentlyViewed)): ?>
		<p>
			None.
		</p>

		<p>
			<a href="/pdb/projects">Search for a project here &rarr;</a>
		</p>
	<?php endif; // (count($projectsRecentlyViewed)): ?>

	</section>




	<section class="dashboard company-activity">

		<h3>Company Activity</h3>


		<ul class="activity-feed clearfix">
			<?php foreach($projectsCompanyActivity as $activity): ?>
			<li class='clearfix'>
				<!-- <img src="/pdb/img/profile-pics/default.png" class="profile"> -->
				<p>
					<strong>
						<?php echo $activity['User']['name']; ?>
					</strong> edited
					<a href="/pdb/projects/view/<?php echo $activity['Project']['id']; ?>"><?php echo $activity['Project']['title']; ?></a>
					<br>
					<em>
						<?php echo $this->Time->timeAgoInWords($activity['Audit']['created'], array('format' => 'F jS, Y')); ?>
					</em>
				</p>
				
			</li>
			<?php endforeach; //($projectsCompanyActivity as $activity): ?>


		</ul>
	</section>

</div>