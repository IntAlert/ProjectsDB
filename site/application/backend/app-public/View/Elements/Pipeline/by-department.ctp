<?

$pipeline = new MACPipelineByDepartment(
		$selectedYear, 
		$projects, 
		$departmentBudgetThisYear, 
		$departmentBudgetNextYear,
		$departmentUnrestrictedAllocationThisYear, 
		$departmentUnrestrictedAllocationNextYear
	);

$unconfirmedProjects = $pipeline->getFlattenedProjects(array('highly-likely', 'medium', 'low'));
$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));

?>

<div class="pipeline-container">

	

	<h2>
		<?php echo $department['Department']['name']; ?>

		<?php echo $selectedYear; ?>
	</h2>




	<!-- Summary -->
	<section>

		<h3><?php echo $department['Department']['name']; ?> summary</h3>
		
		<table class="table">
			<tr>
				<td>
					
				</td>
				<th>
					<?php echo $selectedYear; ?>
				</th>
				<th>
					<?php echo $selectedYear + 1; ?>
				</th>
			</tr>

			<!-- Budget -->
			<tr>
				<th>
					Budget
				</th>
				<td>
					<?php echo $this->MacNumber->currency($departmentBudgetThisYear); ?>
				</td>
				<td>
					<?php echo $this->MacNumber->currency($departmentBudgetNextYear); ?>
				</td>
			</tr>

			<!-- Unrestricted Allocation -->
			<tr>
				<th>
					Unrestricted Allocation
				</th>
				<td>
					<?php echo $this->MacNumber->currency($departmentUnrestrictedAllocationThisYear); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageUnrestrictedAllocationThisYear()); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($departmentUnrestrictedAllocationNextYear); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageUnrestrictedAllocationNextYear()); ?>)
				</td>
			</tr>

			<!-- Confirmed -->
			<tr>
				<th>
					Confirmed
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed'), true)); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed'), true)); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed'), true)); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed'), true)); ?>)
				</td>
			</tr>

			<!-- Highly Likely -->
			<tr>
				<th>
					Highly Likely
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('highly-likely'))); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetThisYear(array('highly-likely'))); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('highly-likely'))); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetNextYear(array('highly-likely'))); ?>)
				</td>
			</tr>

			<!-- Confirmed + Highly Likely -->
			<tr>
				<th>
					Confirmed + Highly Likely
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed', 'highly-likely'), true)); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed', 'highly-likely'), true)); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed', 'highly-likely'), true)); ?>
					(<?php echo $this->MacNumber->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed', 'highly-likely'), true)); ?>)
				</td>
			</tr>

			<!-- Unconfirmed -->
			<tr>
				<th>
					Unconfirmed
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('highly-likely', 'medium', 'low'))); ?>
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('highly-likely', 'medium', 'low'))); ?>
				</td>
			</tr>
		</table>
	</section>


	<!-- Confirmed Funding -->
	<section>

		<h3>
			<?php echo $department['Department']['name']; ?> projects with <strong>confirmed</strong> funding
		</h3>
		<h4>
			<?php echo count($confirmedProjects); ?> project(s)
		</h4>
		
		<? if (count($confirmedProjects)): ?>
			<?php echo $this->element('Pipeline/confirmed', compact('pipeline', 'confirmedProjects')); ?>	
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		
	</section>


	<!-- Total Confirmed + Highly Likely Funding -->

	<section>
		<h3>
			<?php echo $department['Department']['name']; ?> projects with <strong>unconfirmed</strong> funding
		</h3>
		<h4>
			<?php echo count($unconfirmedProjects); ?> project(s)
		</h4>

		<? if (count($unconfirmedProjects)): ?>
			<?php echo $this->element('Pipeline/unconfirmed', compact('pipeline', 'unconfirmedProjects')); ?>
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		
	</section>


</div>
