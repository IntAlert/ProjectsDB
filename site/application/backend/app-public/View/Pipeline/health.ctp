<?php echo $this->Html->css('pipeline/pipeline', array('inline' => false)); ?>
<?php


$projectsWithoutBudgets = [];
// $projectsWithoutStatus = [];
$projectsWithoutTerritories = [];

foreach ($projects as $project): 

	$projectChecker = new ProjectChecker($project);

	// check for annual budgets for this year and all following years (if any)
	$hasValidAnnualBudgets = $projectChecker->hasValidAnnualBudgets($selectedYear);
	if (!$hasValidAnnualBudgets) $projectsWithoutBudgets[] = $project;

	// at least one territory?
	$hasValidTerritories = $projectChecker->hasValidTerritories();
	if (!$hasValidTerritories) $projectsWithoutTerritories[] = $project;


endforeach; // ($projects as $project): 

$departmentStats = [];
foreach ($departmentsList as $department_id => $department_name) {
	$departmentStats[$department_id] = array(
		'id' => $department_id,
		'name' => $department_name,
		'counts' => array(
			'total' => 0,
			'status' => array(
				'not-submitted' => 0,
				'work-in-progress' => 0,
				'submitted' => 0,
				'approved' => 0,
				'rejected' => 0,
				'completed' => 0,
			),
			'likelihood' => array(
				'highly-likely' => 0,
				'confirmed' => 0,
				'low' => 0,
				'medium' => 0,
			),
		)
	);
}

$organisationStats = array(
	'counts' => array(
		'total' => 0,
		'status' => array(
			'not-submitted' => 0,
			'approved' => 0,
			'work-in-progress' => 0,
			'submitted' => 0,
			
			'rejected' => 0,
			'completed' => 0,
			'total' => 0,
		),
		'likelihood' => array(
			'highly-likely' => 0,
			'confirmed' => 0,
			'low' => 0,
			'medium' => 0,
			'total' => 0,
		),
	)
);

// build stats
foreach ($projects as $project): 

	$department_id = $project['Project']['department_id'];
	$status_short_name = $project['Status']['short_name'];
	$likelihood_short_name = $project['Likelihood']['short_name'];

	// increment counters
	$departmentStats[$department_id]['counts']['status'][$status_short_name]++;
	$departmentStats[$department_id]['counts']['likelihood'][$likelihood_short_name]++;
	$departmentStats[$department_id]['counts']['total']++;
	$organisationStats['counts']['status'][$status_short_name]++;
	$organisationStats['counts']['likelihood'][$likelihood_short_name]++;
	$organisationStats['counts']['total']++;

endforeach; // ($projects as $project): 




?>

<nav class="subnav">
	<ul>
		<li>
			<?php echo $this->Html->link('Cancel Export', array(
		'controller' => 'pipeline', 'action' => 'summary', $selectedYear)); ?>
		</li>
	</ul>
</nav>

<h2>
	MAC pipeline <?php echo $selectedYear; ?> health check
</h2>

<p>
	You are about to export a MAC pipeline template for <?php echo $selectedYear; ?>.
</p>


<h3>Projects data overview for <?php echo $selectedYear; ?></h3>

<table class="table">

	<thead>
		<tr>
			<th rowspan=2>
				Department
			</th>
			<td colspan="6">
				SUBMISSION STATUS
			</td>
		</tr>
		<tr>
			<th>Not Yet Submitted</th>
			<th>Submitted</th>
			<th>Rejected</th>
			<th>Approved</th>			
			<th>Completed</th>
			<th>Total</th>
		</tr>
	</thead>

<?php foreach ($departmentStats as $department): ?>


	<tr>
		<th><?php echo $department['name']; ?></th>
		<td><?php echo $department['counts']['status']['not-submitted']; ?></td>
		<td><?php echo $department['counts']['status']['submitted']; ?></td>
		<td><?php echo $department['counts']['status']['rejected']; ?></td>
		<td><?php echo $department['counts']['status']['approved']; ?></td>
		<td><?php echo $department['counts']['status']['completed']; ?></td>
		<td><strong><?php echo $department['counts']['total']; ?></strong></td>
	</tr>



<?php endforeach; // ($departmentStats as $department): ?>

	<tfoot>
		<th>Total</th>
		<td><?php echo $organisationStats['counts']['status']['not-submitted']; ?></td>
		<td><?php echo $organisationStats['counts']['status']['submitted']; ?></td>
		<td><?php echo $organisationStats['counts']['status']['rejected']; ?></td>
		<td><?php echo $organisationStats['counts']['status']['approved']; ?></td>
		<td><?php echo $organisationStats['counts']['status']['completed']; ?></td>
		<td><strong><?php echo $organisationStats['counts']['total']; ?></strong></td>
	</tfoot>

</table>


<?php if (count($projectsWithoutBudgets)): ?>
<!-- Projects without valid budgets -->

<section class="mac-health-warning">

<h3>Warning: These projects do not have all required annual planned expenditature</h3>

<p>
	This most likely means the projects below do not have a record of planned expentiture for every year of the project timeline.
</p>

<ul>
<?php foreach($projectsWithoutBudgets as $project): ?>
	<li>
		<?php echo $this->Html->link(h($project['Project']['title']), array(
		'controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
	</li>
<?php endforeach; //($projectsWithoutBudgets as $project): ?>
</ul>



</section>

<?php endif; // (count($projectsWithoutDates)): ?>


<?php if (count($projectsWithoutTerritories)): ?>
<!-- Projects without valid budgets -->

<section class="mac-health-warning">
	<h3>Warning: These projects do not have have a territory saved</h3>
	<ul>
	<?php foreach($projectsWithoutTerritories as $project): ?>
		<li>
			<?php echo $this->Html->link(h($project['Project']['title']), array(
			'controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
		</li>
	<?php endforeach; //($projectsWithoutTerritories as $project): ?>
	</ul>
</section>


<?php endif; // (count($projectsWithoutTerritories)): ?>


<?php echo $this->Html->link('Preview MAC template', array(
	'controller' => 'pipeline', 
	'action' => 'preview',
	'?' => array('selectedYear' => $selectedYear)
), array('class' => 'export-mac-template')); ?>