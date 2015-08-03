<h2>
	Hello, <?php echo AuthComponent::user('first_name'); ?>
</h2>


<!--
<section class="dashboard company-activity">

	<h3>Your activity</h3>

	<ul class='dashboard-timespan clearfix' >
		<li class="selected">
			<a href="#">
				Last 30 days
			</a>
		</li>

		<li>
			<a href="#">
				This Month
			</a>
		</li>

		<li>
			<a href="#">
				Last Month
			</a>
		</li>

	</ul>


	<ul class="activity-feed clearfix">
		<?php for ($i=0; $i < 10; $i++): ?>
		<li class='clearfix'>
			<img src="http://lorempixel.com/40/40/people/6" class="profile">
			<p>
				<strong>You</strong> edited
				<a href="#">Project title</a>
				<em>10 minutes ago</em>
			</p>
			
		</li>

		<?php endfor;  ?>

	</ul>
</section>


-->



<section class="dashboard company-activity">

	<h3>Company Activity</h3>
<!-- 
	<ul class='dashboard-timespan clearfix' >
		<li class="selected">
			<a href="#">
				Last 30 days
			</a>
		</li>

		<li>
			<a href="#">
				This Month
			</a>
		</li>

		<li>
			<a href="#">
				Last Month
			</a>
		</li>

	</ul> -->


	<ul class="activity-feed clearfix">
		<?php foreach($projectsCompanyActivity as $activity): ?>
		<li class='clearfix'>
			<img src="/pdb/img/profile-pics/default.png" class="profile">
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




<section class="dashboard recent clearfix">
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



