<h2>
	Your Dashboard
</h2>



<section class="dashboard recent " style="clear:both">
	<h3>Your recently visited projects</h3>
	<ul class="document-list">
		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>

		<li>
			<a href="#">Some project title</a>
		</li>
	</ul>
</section>


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






<section class="dashboard company-activity">

	<h3>Company activity</h3>

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
			<img src="http://lorempixel.com/40/40/people/<?php echo $i; ?>" class="profile">
			<p>
				<strong>User's name</strong> edited
				<a href="#">Project title</a>
				<em>10 minutes ago</em>
			</p>
			
		</li>

		<?php endfor;  ?>

	</ul>
</section>





