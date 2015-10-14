<?php echo $this->Html->css('departments/pipeline', array('inline' => false)); ?>

<?

$pipeline = new MACPipelineByDepartment($selectedYear, $projects, $departmentBudgetThisYear, $departmentBudgetNextYear);

$unconfirmedProjects = $pipeline->getFlattenedProjects(array('highly-likely', 'medium', 'low'));
$confirmedProjects = $pipeline->getFlattenedProjects(array('confirmed'));



?>


<div class="pipeline-container">
	



	<h2>
		<?php echo $department['Department']['name']; ?>

		<?php echo $selectedYear; ?>
	</h2>




	<!-- Summary -->
	<div>

		<table class="table">
			<tr>
				<td>
					<h3>Summary</h3>
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
					(<a href="/pdb/departmentbudgets/edit/<?php echo $selectedYear; ?>">Edit</a>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($departmentBudgetNextYear); ?>
					(<a href="/pdb/departmentbudgets/edit/<?php echo $selectedYear + 1; ?>">Edit</a>)
				</td>
			</tr>

			<!-- Confirmed -->
			<tr>
				<th>
					Confirmed
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed'))); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed'))); ?>)
				</td>
			</tr>

			<!-- Highly Likely -->
			<tr>
				<th>
					Highly Likely
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('highly-likely'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('highly-likely'))); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('highly-likely'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('highly-likely'))); ?>)
				</td>
			</tr>

			<!-- Confirmed + Highly Likely -->
			<tr>
				<th>
					Confirmed + Highly Likely
				</th>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetThisYear(array('confirmed', 'highly-likely'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetThisYear(array('confirmed', 'highly-likely'))); ?>)
				</td>
				<td>
					<?php echo $this->MacNumber->currency($pipeline->getTotalBudgetNextYear(array('confirmed', 'highly-likely'))); ?>
					(<?php echo $this->Number->toPercentage($pipeline->getPercentageBudgetNextYear(array('confirmed', 'highly-likely'))); ?>)
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
	</div>


	<!-- Confirmed Funding -->
	<div>

		<h3>
			Projects with confirmed Funding
		</h3>
		<h4>
			<?php echo count($confirmedProjects); ?> project(s)
		</h4>
		
		<? if (count($confirmedProjects)): ?>
			<?php echo $this->element('Departments/pipeline-by-department-confirmed', compact('pipeline', 'confirmedProjects')); ?>	
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		
	</div>


	<!-- Total Confirmed + Highly Likely Funding -->

	<div>
		<h3>
			Projects with unconfirmed Funding
			
		</h3>
		<h4>
			<?php echo count($unconfirmedProjects); ?> project(s)
		</h4>

		<? if (count($unconfirmedProjects)): ?>
			<?php echo $this->element('Departments/pipeline-by-department-unconfirmed', compact('pipeline', 'unconfirmedProjects')); ?>
		<? else: // (count($confirmedProjects)): ?>
			<p>None</p>
		<? endif; // (count($confirmedProjects)): ?>
		
	</div>


</div>
